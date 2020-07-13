<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    // protected $guarded = array('id');
    
    // public static $rules = array(
    //     'user_id' => 'required',
    //     'post_id' => 'required',
    //     );
    protected $fillable = ['post_id','user_id'];

      public function post()
      {
        return $this->belongsTo(Post::class);
      }
    
      public function user()
      {
        return $this->belongsTo(User::class);
      }
            
        
}
