<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel;

use App\Models\District;
use App\Models\TPA;
use App\Models\AtalVendor;
use App\Models\Enrollment;

class ExcelController extends Controller
{
    public function upload(Request $request) {
    	$path = $request->file('excel_data')->getRealPath();
    	$data = Excel::load($path, function($reader) {})->get();

		$msgtype='error';
		$msg='Somethings went Wrong!';
		//dump($data);
		$enroll_data= Enrollment::where('reportdate', date('Y-m-d', strtotime($request->date)));
			if(!$enroll_data->count())
			{
				$a=0;
				foreach($data as $k => $v) {
					DB::beginTransaction();
					if($v->district != '') { 
						/*
						** Insert dist data
						* @return district id
						*/ 
							$dist_data = District::where('districtname', trim($v->district));
							if(!$dist_data->count())
							{
								$dist_arr = [];
								$dist_arr['districtname'] = trim($v->district);
								$district = District::create($dist_arr);
							}else{
								$district = $dist_data->first();
							}


							//TPA
							$tpa_data= TPA::where('name', trim($v->name_of_tpa));
							if(!$tpa_data->count())
							{
								$tpa_arr=[];
								$tpa_arr['name'] = trim($v->name_of_tpa);
								$tpa=TPA::create($tpa_arr);
							}else
							{
								$tpa=$tpa_data->first();
							}
							//Vendor
							$vendor_data= AtalVendor::where('name', trim($v->name_of_vendor_card_provider));
							if(!$vendor_data->count())
							{
								$vendor_arr=[];
								$vendor_arr['name'] = trim($v->name_of_vendor_card_provider);
								$vendor=AtalVendor::create($vendor_arr);
							}else
							{
								$vendor=$vendor_data->first();
							}	
							$enroll_arr=[];
							$enroll_arr['district_id']=$district->id;
							$enroll_arr['t_p_a_id']=$tpa->id;
							$enroll_arr['atal_vendor_id']=$vendor->id;
							$enroll_arr['targeted_persons']=$v->target_no_of_personsnfsa;
							$enroll_arr['number_of_kits_deployed']=$v->no_of_kits_deployed;
							$enroll_arr['bpl_scsp_enrolled']=$v->bpl_scsp_enrolled;
							$enroll_arr['bpl_district_kiosk_enrolled']=$v->bpl_district_kiosk_enrolled;
							$enroll_arr['apl_scsp_enrolled']=$v->apl_scsp_enrolled;
							$enroll_arr['apl_district_kiosk_enrolled']=$v->apl_district_kiosk_enrolled;
							$enroll_arr['minor_scsp_enrolled']=$v->minor_scsp_enrolled;
							$enroll_arr['minor_district_kiosk_enrolled']=$v->minor_district_kiosk_enrolled;
							$enroll_arr['total_enrolled']=$v->total_no_of_person_enrolledall; 
							$enroll_arr['scsp_card_issued']=$v->card_scsp_enrolled;
							$enroll_arr['district_kiosk_card_issued']=$v->card_district_kiosk_enrolled;
							$enroll_arr['fee_collected_from_apl']="0.00"; 
							$enroll_arr['reportdate'] = date('Y-m-d', strtotime($request->date));

							$validator = Validator::make($enroll_arr, Enrollment::$rules);
							if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();
							$eroll = Enrollment::create($enroll_arr); 
							$msgtype='success';
							$msg='Import Successfully';
					}
					else
					{  
					}
						
					DB::commit();
				}
			}
			else
			{
				$msgtype='error';
				$msg='Data Already Exist';
			}
		return redirect('')->with($msgtype,$msg);
    }


    
}
