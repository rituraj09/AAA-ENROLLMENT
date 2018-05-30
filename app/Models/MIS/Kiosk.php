<?php

namespace App\Models\MIS;

use Illuminate\Database\Eloquent\Model;

class Kiosk extends Model
{
    protected $fillable 	= array('district_id', 'kiosk_setup_address', 'arm_setup_address');
	protected $table    	= 'kiosks';
    protected $guarded   	= ['_token'];
    public static $rules 	= [
    	'district_id' 			=> 'required|exists:districts,id',
    	'kiosk_setup_address' 	=> 'required',
    	'arm_setup_address' 	=> 'required',
    ];

    public function district()
	{
		return $this->belongsTo('App\Models\District', 'district_id');
	}
}
