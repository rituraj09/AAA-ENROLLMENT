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
    public function index(Request $request)
    {
        $dist= District::all(['districtname','id']);
        $where = [];
        if($request->q) {
            $where['reportdate'] =  date('Y-m-d', strtotime($request->q));
        }
        if($request->dist_id){            
            $where['district_id']= $request->dist_id;
        }
        //$enrollment = Enrollment::where($where)->orderBy('id', 'asc')->paginate(11); 
        $enrollment = Enrollment::where($where)->orderBy('id', 'asc')->get(); 
        return view('report', compact('enrollment','request'))->with('dist', $dist); 
    } 

    public function show($id) 
    { 
        $enrollment =  Enrollment::find($id); 
        return view('show')->with('enroll', $enrollment); 
    }

    public function graph(Request $request) 
    {  
        $dist= District::all(['districtname','id']);
        $where = []; 
        if($request->dist_id){            
            $where['district_id']= $request->dist_id;
        }
        $data=DB::table('enrollments')
                ->select(
                    DB::raw("reportdate"),
                    DB::raw("SUM(bpl_scsp_enrolled) as bpl"),
                    DB::raw("SUM(apl_scsp_enrolled) as apl"),
                    DB::raw("SUM(minor_scsp_enrolled) as minor") 
                )
                ->where($where)
                ->orderBy("reportdate")
                    ->groupBy(DB::raw("reportdate"))
                    ->get();
        $result[] = ['Date','BPL','APL', 'Minor'];
        foreach ($data as $key => $value) {
            $result[++$key] = [date('d/m/Y', strtotime($value->reportdate)), (int)$value->bpl, (int)$value->apl, (int)$value->minor ];
        }
            // dump(json_encode($result));
        //return view('graphreport')->with('result',json_encode($result))->with('dist', $dist); 
        return view('graphreport', compact('request'))->with('result',json_encode($result))->with('dist', $dist); 
    }   
}
