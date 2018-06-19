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
        $enrollment = Enrollment::where($where)->orderBy('id', 'asc')->paginate(25); 
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
                    DB::raw("SUM(total_enrolled) as tot"),
                    DB::raw("SUM(scsp_card_issued) as card")
                )
                ->where($where)
                ->orderBy("reportdate")
                    ->groupBy(DB::raw("reportdate"))
                    ->get();
        $result[] = ['Date','Card Issued','Not Issued' ];
        foreach ($data as $key => $value) {
            $result[++$key] = [date('d/m/Y', strtotime($value->reportdate)), (int)$value->card, (int)$value->tot-(int)$value->card ];
        }

        $resultline[] = ['Date','Total Enrolled'];
        foreach ($data as $key => $value) {
            $resultline[++$key] = [date('d/m/Y', strtotime($value->reportdate)), (int)$value->tot];
        }
            // dump(json_encode($result));
        //return view('graphreport')->with('result',json_encode($result))->with('dist', $dist); 
        return view('graphreport', compact('request'))->with('result',json_encode($result))->with('resultline',json_encode($resultline))->with('dist', $dist); 
    }   
}
