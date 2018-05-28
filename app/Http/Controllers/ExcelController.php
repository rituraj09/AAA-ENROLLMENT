<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel;

class ExcelController extends Controller
{
    public function upload(Request $request) {
    	$path = $request->file('excel_data')->getRealPath();
    	$data = Excel::load($path, function($reader) {})->get();

    	foreach($data as $k => $v) {
    		
    	}
    }
}
