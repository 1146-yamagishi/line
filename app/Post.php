<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = array('id');
    
    
    public static $rules = array(
        'title' => 'required',
        'image' => 'required',
        'user_id'=>'required',
    );
    
}
