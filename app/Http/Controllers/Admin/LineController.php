<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Evaluation;
use Storage;

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
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        $post->image_path = Storage::disk('s3')->url($path);
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
        $cond_title=$request->cond_title;
        if($cond_title!=''){
            $informations=Post::where('title',$cond_title)->get()->sortByDesc('updated_at');
        }else{
            $informations=Post::all()->sortByDesc('updated_at');
        }
        // Post::withCount('evaluations')
        // ->orderBy('evaluations_count', 'desc')
        // ->limit(3)
        // ->get();
    
    return view('admin.line.index',['informations'=>$informations,'cond_title'=>$cond_title]);
    }
    public function ranking(Request $request)
    {
    $informations=Post::withCount('evaluations')
    ->orderBy('evaluations_count', 'desc')
    ->limit(10)
    ->get();
    return view('admin.line.ranking',['informations'=>$informations,]);
    }
}
