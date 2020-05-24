<?php

namespace App\Http\Erp\Common\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class testController extends Controller
{
    public function index(Request $request){
        dd('Erp/Common');
    }
    public function fun(Request $request){
        dd('Erp/Common/forfun');
    }
  
}

