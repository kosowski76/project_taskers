<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerProjectController extends Controller
{
    //
    protected $guard = 'customer';

    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    /**
     * Show dashboard.
     * 
     * @return void
     */
    public function dashboard()
    {
      //  return view('staff.index');
        return view('customer.dashboard');
    }
}
