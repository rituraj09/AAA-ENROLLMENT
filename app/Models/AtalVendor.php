<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtalVendor extends Model
{
    protected $fillable 	= array('name');
	protected $table    	= 'atal_vendors';
    protected $guarded   	= ['_token'];
    public static $rules 	= [
    	'name' 				=> 'required',
    ];
}
