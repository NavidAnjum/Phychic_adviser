<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class ApiAuth extends Controller
{
    public function register(Request $request)
    {
      $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'user_name'  => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:8',
            'role_id'   => Rule::in(['1','2'])
        ]);
        $response   = ['message' => 'Success!'];
        $statusCode = 200;
        DB::beginTransaction();
        try {

            $user = User::create(request(['name', 'user_name','email', 'password']));

            $token = $user->createToken('auth_token')->plainTextToken;

            $user = UserRole::create([
                'role_id' => $validatedData['role_id'],
                'user_id' => $user->id
            ]);

            DB::commit();
            $response['token']=$token;

        }catch (\Exception $e) {
            $response = [
                'message' => 'Oops!',
                'errors'  => $e->getMessage(),
            ];
            $statusCode = 500;
            DB::rollback();
            throw $e;
        }

        return response()->json($response, $statusCode);

    }

    public function login(Request $request)
    {

        // login
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(
                [
                    'message' => 'Unauthorized',
                    'errors'  => 'Invalid login details',
                ],
                401
            );
        }

        $user = User::where('email', $request['email'])->firstOrFail();
// Accessing the role_id
        $role_id = $user->roles->first()->id; // Assuming a user can have multiple roles, get the first one

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Success!',
            'data'    => [
                'role_id' => $role_id,
                'access_token' => $token,
                'token_type'   => 'Bearer',
            ],
        ]);

    }

    public function changePassword(Request $request)
    {
        $validatedData = $request->validate([
            'old_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8',

        ]);
        $hashedPassword = Auth::user()->getAuthPassword();


        if (Hash::check($request->old_password, $hashedPassword)) {
            DB::beginTransaction();
            try {
                $user_id = Auth::user()->id;

                $user = User::find($user_id);
                $user->password = $request->new_password;
                $user->save();
                DB::commit();

                return response(['message' => 'Password updated!']);
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        } else {
            return response()->json([
                'message' => 'Incorrect Old Password!'
            ]);
        }
    }

    public function currentUser(Request $request){
        $user = $request->user();
        //$user->load(['name', 'first_name', 'email']);

        return (new UserResource($user))->additional(['message' => 'Success!']);
    }

}
