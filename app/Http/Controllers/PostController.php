<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post-form');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input_data = $request->all();
          
        if ($request->has('id')) {
            if(Post::where('id',$request->id)->where('userId',auth()->user()->id)->exists()){
                $article =Post::find($request->id);   
            }
        }else{
            $article = new Post();   
        } 
        $article->title = $input_data['title'];
        $article->body = $input_data['body'];
        $article->typePostId = $input_data['Category'];
        $article->userId = auth()->user()->id;
        $article->save();
        return redirect('/post/'.$article->id)->withSuccess(['Data saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post,$id)
    {
        $article = Post::where('id',$id)->first();
        dd($article);
        return view('display-article', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, $id)
    {
        if(Post::where('id',$id)->exists()){
            if(Post::where('id',$id)->where('userId',auth()->user()->id)->exists()){
                $data = Post::where('id',$id)->get();
                return view('edit-post', compact('data'));
            }else{
                return "No eres el dueño del post.";
            }
        }else{
            return "No se encuentra ningun post.";
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
