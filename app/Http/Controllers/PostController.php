<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // home page
    public function home(){
        $data = Post::when(request('search'),function($db){
            $db->where('title','like','%'.request('search').'%')->orderBy('id','desc')->paginate(4);
        })->orderBy('id','desc')->paginate(4);
        return view('home',compact('data'));
    }
    // create post
    public function create(PostRequest $request){
        $validated = $request->validated();
        if ($request->hasFile('image'))
        {
            $imgName =uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$imgName);
            $validated['image'] = $imgName;
        }
        Post::create($validated);
        return redirect()->route('post#home')->with('created',config('process.condition.created'));
    }
    //show post or view post
    public function show(Post $id){
        return view('show',['data'=>$id]);
    }
    //edit post
    public function edit(Post $id){
        return view('edit',['data'=>$id]);
    }
    //update post
    public function update(Post $id,PostRequest $request){
        $validated = $request->validated();
        if ($request->hasFile('image'))
        {
            $imgName =uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$imgName);
            $validated['image'] = $imgName;
            Storage::delete('public/'.$id->image);
        }else
        {
            $validated['image'] = $id->image;
        }
        $id->update($validated);
        return redirect()->route('post#home')->with('updated',config('process.condition.updated'));
    }
    // delete post
    public function delete(Post $id){
        $id->delete();
        return redirect()->route('post#home')->with('deleted',config('process.condition.deleted'));
    }
}

