<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Evaluation;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function __construct()
    {
    $this->middleware(['auth', 'verified'])->only(['evaluation', 'unevaluation']);
    }
    
    public function evaluation($id)
    {
    Evaluation::create([
      'post_id' => $id,
      'user_id' => Auth::id(),
    ]);
    
    session()->flash('success', 'You evaluationed the Post.');
    
    return redirect()->back();
    }
    
   
    public function unevaluation($id)
    {
    $evaluation = Evaluation::where('post_id', $id)->where('user_id', Auth::id())->first();
    $evaluation->delete();
    
    session()->flash('success', 'You Unevaluationed the Post.');
    
    return redirect()->back();
        
    }
}