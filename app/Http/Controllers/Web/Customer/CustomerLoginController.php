<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Customer\CustomerLoginRequest;

class CustomerLoginController extends Controller
{
    use AuthenticatesUsers;
    
    /**
     * Where to redirect admins after login.
     *
     * @var string
     */
    protected $redirectTo = '/customer';
    
    /**
     * Current guard customers before login.
     *
     * @var string
     */
    protected $guard = 'customer';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:customer')->except('logout');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCustomerLoginForm()
    {
        return view('customer.auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */

    public function signIn(CustomerLoginRequest $request)
    {       
        return 'sing-In customer';
        /*     
        if (Auth::guard('customer')->attempt([
 //       if (auth('customer')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->get('remember')))
        {
            return redirect()->intended(route('customer.dashboard'));
        }

        return back()->withInput($request->only('email', 'remember'));
        */
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signOut(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
         return redirect()->route('customer.login');
    }
}
