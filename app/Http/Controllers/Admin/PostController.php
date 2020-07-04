<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
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
    
    $news->fill($form);
    $news->save();
    
    return redirect('admin/line/create');
    }
}
