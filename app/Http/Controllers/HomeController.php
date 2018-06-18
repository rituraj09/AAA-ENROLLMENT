<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\District;
use App\Models\TPA;
use DB;
use App\Models\AtalVendor;
use App\Models\Enrollment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrollment = Enrollment::all(); 
        return view('report')->with('enrollment', $enrollment); 
    } 

    public function show($id) 
    { 
        $enrollment =  Enrollment::find($id); 
        return view('show')->with('enroll', $enrollment); 
    }
}
