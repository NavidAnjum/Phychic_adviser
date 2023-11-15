<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Http;

class SubCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SubCategory';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SubCategory());

        $grid->column('id', __('Id'));
        $grid->column('sub_category', __('Sub category'));

        // Display category name instead of category id
        $grid->column('category_id', __('Category'))->display(function () {
            return $this->category->category;
        });

        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
//        $grid = new Grid(new SubCategory());
//
//        $grid->column('id', __('Id'));
//        $grid->column('sub_category', __('Sub category'));
//        $grid->column('category_id', __('Category id'));
//        $grid->column('created_at', __('Created at'));
//        $grid->column('updated_at', __('Updated at'));
//
//        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(SubCategory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('sub_category', __('Sub category'));
        $show->field('category_id', __('Category id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }



    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SubCategory());

      //  $form->text('category_id', __('Category'));

        $categories = Category::all(['id', 'category']);
        $options = $categories->pluck('category', 'id');

        $form->text('sub_category', __('Sub category'));
        $form->select('category_id', __('Category'))->options($options);


        return $form;
    }
}
