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
       
       // return $q1;
        $data=DB::table('enrollments')
                ->select(
                    DB::raw("reportdate"),
                    DB::raw("SUM(total_enrolled) as tot"),
                    DB::raw("SUM(scsp_card_issued) as card")
                ) 
                ->where($where);
                     

        if($request->date1 && $request->date2){       
            $data =   $data->whereBetween('reportdate', [date('Y-m-d', strtotime($request->date1)),date('Y-m-d', strtotime($request->date2))]);      
            
        }   
        $data= $data->orderBy("reportdate")
             ->groupBy(DB::raw("reportdate"))
                ->get();        

        if($request->date1 && $request->date2){   
             $oldata=DB::table('enrollments')
            ->select( 
                DB::raw("SUM(total_enrolled) as tot")  
            )
            ->where('reportdate','<',(date('Y-m-d', strtotime($request->date1))))
            ->where($where) 
            ->orderBy("reportdate", 'desc')->groupBy(DB::raw("reportdate"))
            ->take(1)->get();    
        }  
        else
        {
            $oldata=[]; 
        }
        $result[0] = ['Date','Card Issued','Not Issued' ];
        if(count($data) > 0)
        {
            foreach ($data as $key => $value) {
                if($request->date1 && $request->date2)
                { 
                    $result[++$key] = [date('d/m/Y', strtotime($value->reportdate)), (int)$value->card, (int)$value->tot-(int)$value->card ];
                
                }
                else{                
                    if($key!=0)
                    { 
                        $result[++$key-1] = [date('d/m/Y', strtotime($value->reportdate)), (int)$value->card, (int)$value->tot-(int)$value->card ];
                    }
                    else{     
                }
                }
            }  
        }
        $resultline[0] = ['Date','Total Enrolled'];
        if(count($data) > 0)
        {
            foreach ($data as $key => $value) {
                $oldval =   0;
                if($key==0)
                {
                    if(count($oldata) > 0)
                    {
                        if($request->date1 && $request->date2)
                        { 
                        $oldval=  (int)$value->tot - (int)$oldata[0]->tot  ;  
                        $resultline[++$key] = [date('d/m/Y', strtotime($value->reportdate)), $oldval];
                        
                        }
                        else
                        { 
                            $oldval=  (int)$value->tot;   
                        }
                    }
                    else{
                            $oldval=  (int)$value->tot;    
                            $resultline[++$key] = [date('d/m/Y', strtotime($value->reportdate)), $oldval];
                    }
                }
                else
                {  
                    $oldval=(int)$data[$key]->tot-(int)$data[$key-1]->tot;
                    if($request->date1 && $request->date2)
                    { 
                    $resultline[++$key] = [date('d/m/Y', strtotime($value->reportdate)), $oldval];  
                    }
                    else{                    
                    $resultline[++$key-1] = [date('d/m/Y', strtotime($value->reportdate)), $oldval];  
                    }
                }
                
            }   
        }
       //return $result;
        return view('graphreport', compact('request'))->with('result',json_encode($result))->with('resultline',json_encode($resultline))->with('dist', $dist); 
    }   
}
