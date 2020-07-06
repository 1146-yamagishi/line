<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Auth;

class LineController extends Controller
{
    public function add()
    {
        return view('admin.line.create');
    }
    
    public function create(Request $request){
        $request->validate([
        'title' => 'required',
        'image' => 'required',]);
        
        $post=new Post;
        $form = $request->all();
        
    if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $post->image_path = basename($path);
    } else {
        $post->image_path = null;
    }
    unset($form['_token']);
    unset($form['image']);
    
    $post->user_id = Auth::id();
    $post->fill($form);
    $post->save();
    
    return redirect('admin/line/index');
    }
    
    public function index(Request $request)
    {
        $informations=Post::all()->sortByDesc('updated_at');
        
        $cond_title=$request->cond_title;
        if($cond_title!=''){
            $informations=Post::where('title',$cond_title)->get();
        }
        return view('admin.line.index',['informations'=>$informations,'cond_title'=>$cond_title]);
    }
}
