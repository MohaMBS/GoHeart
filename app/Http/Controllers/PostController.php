<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["posts"] = Post::withCount("comments")->get();
        return view("index-posts",$data);
    }

    public function home(){
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post-form');
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
          
        if ($request->has('id') && $request->has('token_post')) {
            $article =Post::where('id',$request->id)->where('security_token',$request->token_post)->first();  
        }else{
            do{
                $token = Str::random(50);
            }while(Post::where("security_token",$token)->exists());
            $article = new Post();   
            $article->security_token =$token;
            $article->creator_name= auth()->user()->name;
        } 
        $article->title = $input_data['title'];
        $article->body = $input_data['body'];
        $article->typePostId = $input_data['Category'];
        $article->user_id = auth()->user()->id;
        $article->save();
        return redirect()->route('seeOne',$article->id)->withSuccess(['Data saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post,$id)
    {
        $data["post"] = Post::where('id',$id)->with('comments')->get();
        return view('display-post', $data);
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
            if(Post::where('id',$id)->where('user_id',auth()->user()->id)->exists()){
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
    public function destroy(Post $post, $id)
    {
        Post::destroy($id);
        return redirect()->route('my-posts');
    }

    public function postsUser(Post $post)
    {
        $myPosts["posts"] = Post::where("user_id",auth()->user()->id)->get();

        return view('managment-posts',$myPosts);
    }
}
