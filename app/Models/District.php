<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable 	= array('districtname');
	protected $table    	= 'districts';
    protected $guarded   	= ['_token'];
    public static $rules 	= [
    	'districtname' 				=> 'required',
    ];
    public function enrollment()
    {
        return $this->hasMany('App\Models\Enrollment');
    }
}
