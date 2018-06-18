<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable 	= array('district_id','t_p_a_id','atal_vendor_id','targeted_persons','number_of_kits_deployed','bpl_scsp_enrolled','bpl_district_kiosk_enrolled','apl_scsp_enrolled','apl_district_kiosk_enrolled','minor_scsp_enrolled','total_enrolled','scsp_card_issued','district_kiosk_card_issued','fee_collected_from_apl', 'minor_district_kiosk_enrolled','reportdate');
	protected $table    	= 'enrollments';
    protected $guarded   	= ['_token'];
    public static $rules 	= [
    	'district_id' 			=> 'required',
    	't_p_a_id' 				=> 'required',
    	'atal_vendor_id' 				=> 'required',
    	'targeted_persons' 				=> 'required',
    	'number_of_kits_deployed' 				=> 'required',
    	'bpl_scsp_enrolled' 				=> 'required',
    	'bpl_district_kiosk_enrolled' 				=> 'required',
    	'apl_scsp_enrolled' 				=> 'required',
    	'apl_district_kiosk_enrolled' 				=> 'required',
    	'minor_scsp_enrolled' 				=> 'required',
    	'total_enrolled' 				=> 'required',
    	'scsp_card_issued' 				=> 'required',
    	'district_kiosk_card_issued' 				=> 'required',
    	'fee_collected_from_apl' 				=> 'required', 
    	'minor_district_kiosk_enrolled' => 'required',
    	'reportdate' => 'required',
    ];

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }
    public function atalvendor()
    {
        return $this->belongsTo('App\Models\AtalVendor');
    }
    public function tpa()
    {
        return $this->belongsTo('App\Models\TPA');
    }
}
