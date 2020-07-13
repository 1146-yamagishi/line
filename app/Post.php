<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $guarded = array('id');
    
    
    public static $rules = array(
        'title' => 'required',
        'image_path' => 'required',
        'user_id'=>'required',
    );
    
     public function evaluations()
    {
        return $this->hasMany(Evaluation::class,'post_id');
    }
    
    public function is_evaluationed_by_auth_user()
    {
    $id = Auth::id();
    
    $likers = array();
    foreach($this->evaluations as $evaluation) {
    array_push($likers, $evaluation->user_id);
    }
    
    if (in_array($id, $likers)) {
    return true;
    } else {
    return false;
    }
    }
}
