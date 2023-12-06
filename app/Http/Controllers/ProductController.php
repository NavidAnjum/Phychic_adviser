<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\ProductOffer;
use App\Models\SubCategory;
use App\Models\User;
use App\MyHelpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class ProductController extends Controller
{
     const PRODUCT_AVAILABLE_OFFERS = [
        'hot_deal',
        'featured_product',
        'special_offer',
        'special_deal'
    ];
     const PRODUCT_IMAGES_PATH = 'uploads/images/product';

    /**
     * @return int
     */
    private function getVendorId(): int{
    }

    public function ProductView($id,$product_name)
    {
        $product=DB::table('products')
            ->join('categories','products.category_id','categories.id')
            ->join('subcategories','products.subcategory_id','subcategories.id')
            ->join('brands','products.brand_id','brands.id')
            ->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')->where('products.id',$id)->first();

        $color=$product->product_color;
        $product_color = explode(',', $color);

        $size=$product->product_size;
        $product_size = explode(',', $size);

        return response(['product' => $product ,
            'product_color' => $product_color ,
            'product_size' => $product_size ,

        ]);

    }

    public function AddCart(Request $request,$id)
    {
        $product=DB::table('products')->where('id',$id)->first();
        $data=array();
        if ($product->discount_price == NULL) {
            $data['id']=$id;
            $data['name']=$product->product_name;
            $data['qty']=$request->qty;
            $data['price']= $product->selling_price;       //-----------
            $data['weight']=1;
            $data['options']['image']=$product->image_one;
            $data['options']['color']=$request->color;
            $data['options']['size']=$request->size;

        }else{
            $data['id']=$id;
            $data['name']=$product->product_name;
            $data['qty']=$request->qty;
            $data['price']= $product->discount_price;   //---------------
            $data['weight']=1;
            $data['options']['image']=$product->image_one;
            $data['options']['color']=$request->color;
            $data['options']['size']=$request->size;


        }
    }


//---for subcategory Product showing-----
    public function productsView($id)
    {
        $products=DB::table('products')->where('subcategory_id',$id)->paginate(30);
        $brands= DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();

    }

    /**
     * @return View
     */
    public function productAdd(){
        $brands = Brand::all();
        $subCategories = SubCategory::all();

        return response(['message'=> $brands]);
    }

    public function productCreate(ProductRequest $request){
        $data = $request->validated();

        // handling the product thumbnail
        $data['product_thumbnail'] =
            MyHelpers::uploadImage($request->file('product_thumbnail'), self::PRODUCT_IMAGES_PATH);


        // handling the vendor id
        $data['vendor_id'] = $this->getVendorId();

        // handling the product slug
        $data['product_slug'] = $this->getProductSlug($data['product_name']);

        // status of the product
        $data['product_status'] = $request->get('product_status') ? 1 : 0;


        // inserting the product
        if ($data['product_images'])
            unset($data['product_images']);

        $insertedProductId = Product::insertGetId($data);
        if ($insertedProductId){
            // handling the product images
            if ($request->file('product_images'))
                $this->handleProductMultiImages($request->file('product_images'), $insertedProductId);

            // handling the product offers
            $this->handleProductOffers($request, $insertedProductId);

            return response(['msg' => 'Product is added successfully.'], 200);
        }else return redirect('add_product')->with('error', 'Failed to add this product, try again.');

    }

    /**
     * @param string $productName
     * @return array|string|string[]
     */
    private function getProductSlug(string $productName){
        return str_replace(' ', '-', strtolower(trim($productName)));
    }

    /**
     * @param array $images
     * @param int $productId
     * @return void
     */
    private function handleProductMultiImages(array $images, int $productId): void{
        $data['image_product_id'] = $productId;
        foreach ($images as $image){
            $data['product_image'] = MyHelpers::uploadImage($image, self::PRODUCT_IMAGES_PATH );
            ProductImage::insert($data);
        }
    }

    /**
     * @param Request $requestData
     * @param int $productId
     * @param bool $editCase
     * @return void
     */
    private function handleProductOffers(Request & $requestData, int $productId, bool $editCase = false): void{
        $offers['offer_product_id'] = $productId;
        foreach (self::PRODUCT_AVAILABLE_OFFERS as $offerName) {
            $offers[$offerName] = ($requestData->get($offerName)) != null? 1 : 0;
        }
        if ($editCase)
        {

            try {
                ProductOffer::firstOrFail()
                    ->where('offer_product_id', $productId)->update($offers);
            }   catch (ModelNotFoundException $exception) {
            }
        }
        else ProductOffer::insert($offers);
    }

    /**
     * @param int $productId
     * @return mixed
     */
    public static function getProductImages(int $productId){
        return ProductImage::where('image_product_id', '=', $productId)->get('product_image');
    }

    /**
     * @param string $tags
     * @return array
     */
    public static function getProductSeparatedTags(string $tags): array{
        if ($tags)
            return explode(',', $tags);
        return [];
    }

    /**
     * @param string $colors
     * @return array
     */
    public static function getProductSeparatedColors(string $colors): array{
        if ($colors)
            return explode(',', $colors);
        return [];
    }

    /**
     * @param Request $request
     */
    public function productRemove(Request $request){

    }

    /**
     * @param int $productId
     */
    public function productEdit(int $productId){


    }

    /**
     * @param ProductRequest $request
     */
    public function productUpdate(ProductRequest $request){

    }

    /**
     * @param Request $request
     */
    public function productActivate(Request $request){

    }

    /**
     * @param int $productId
     */
    public function productDeActivate(int $productId){

    }

    /**
     * To get the products of the current authenticated vendor/shop
     */
    public function getProducts(){

    }
}
