<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Customer;

class CustomerApiLoginController extends Controller
{

    public function index()
    {
        //  $posts = auth()->user()->posts;
        $welcome = 'Customer Api index';

        return response()->json([
            'success' => true,
            'data' => $welcome
        ]);
    }

    public function dashboard(Request $request)
    {
        // the full object of the customer as containted in the able would
        // be available now  - $customer = null;
        // $customer = $request->user();
        $customer = auth()->user();

        return response()->json([
            'success' => true,
            'data' => 'dashboard',
            'user' => $customer
        ]);
    }

    public function signIn(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        /*      $validator = Validator::make( $request->all(), $rules, $this->validationMessages() );
            if ( $validator->fails() ) { return  response()->json( ["message" => $validator->errors()->first()],400 ); }
    */

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Customer::where('email', $email)->count() <= 0) {
            return response(array("message" => "Email number does not exist"), 400);
        }

        $customer = Customer::where('email', $email)->first();

        if (password_verify($password, $customer->password)) {
            $customer->last_login = Carbon::now();
            $customer->save();
            return response(array("message" => "Sign In Successful", "data" => [
                "customer" => $customer,

                // Below the customer key passed as the second parameter sets the role
                // anyone with the auth token would have only customer access rights
                "token" => $customer->createToken('Personal Access Token', ['customer'])->accessToken
            ]), 200);
        } else {
            return response(array("message" => "Wrong Credentials."), 400);
        }
    }
}
