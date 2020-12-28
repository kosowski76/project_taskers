<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
      //  $this->middleware('guest:staff');
    }

    //
    public function index()
    {
     /*   return redirect(
            route('tasks.index'), 
            301
        ); */
        return redirect(
            route('home'), 
            301
        ); 
    }
}
