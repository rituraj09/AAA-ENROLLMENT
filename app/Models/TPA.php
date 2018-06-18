<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TPA extends Model
{
    protected $fillable 	= array('name');
	protected $table    	= 't_p_as';
    protected $guarded   	= ['_token'];
    public static $rules 	= [
    	'name' 				=> 'required',
    ];
    public function enrollment()
    {
        return $this->hasMany('App\Models\Enrollment');
    }
}
