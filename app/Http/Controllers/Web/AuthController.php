<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $plan=$request->plan;
        // return $plan;
        return view('auth.register',compact('plan'));
    }
}
