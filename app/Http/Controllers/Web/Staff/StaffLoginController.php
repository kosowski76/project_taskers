<?php

namespace App\Http\Controllers\Web\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Staff\StaffLoginRequest;

class StaffLoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect admins after login.
     *
     * @var string
     */
    protected $redirectTo = '/staff';

    protected $guard = 'staff';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    //    $this->middleware('guest:staff')->except('logout');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showStaffLoginForm()
    {
        return redirect(
            route('login'), 
            301
        );
      //  return view('staff.auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
                        // StaffLoginRequest 
    public function signIn(Request $request)
    {  
                     
        if (Auth::guard('staff')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->get('remember')))
        {
            return redirect()->intended(route('staff.dashboard'));
        }

        return back()->withInput($request->only('email', 'remember'));
       
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signOut(Request $request)
    {
        Auth::guard('staff')->logout();
        $request->session()->invalidate();
         return redirect()->route('staff.login');
    }

}
