<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\AdminLoginRequest;

class AdminLoginController extends Controller
{
  use AuthenticatesUsers;

  /**
   * Where to redirect admins after login.
   *
   * @var string
   */
  protected $redirectTo = '/admin';

  /**
   * Current guard admins before login.
   *
   * @var string
   */
  protected $guard = 'admin';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
   // $this->middleware('auth:admin')->except('logout');
    //  $this->guard = $this->guard();
  }

  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function showAdminLoginForm()
  {
    return view('admin.auth.login');
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   * @throws \Illuminate\Validation\ValidationException
   */
  //    public function signIn(AdminLoginRequest $request)
  public function signIn(Request $request)
  {

    if (Auth::guard('admin')->attempt([
        'email' => $request->email,
        'password' => $request->password
    ], $request->get('remember'))) 
    {
      return redirect()->intended(route('admin.dashboard'));
     // return redirect()->route('admin.dashboard');
    }

    return back()->withInput($request->only('email', 'remember'));  /*    */
  }

  /**
   * @param Request $request
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function signOut(Request $request)
  {
    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    return redirect()->route('admin.login');
  }

  /*  protected function guard(){
        return Auth::guard('admin');        
     } */
}
