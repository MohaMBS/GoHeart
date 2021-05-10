<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["posts"] = Post::withCount("comments")->with('user')->orderBy('id', 'desc')->paginate(10);
        return view("goheart.index-posts",$data);
    }

    public function home(){
        return view('goheart.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goheart.post-form');
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
        if($request->has('filepath')){
            if($request->filepath  != null){
                $article->front_page  = $request->filepath;
            }
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
        if(auth()->check()){
            if(Post::where("user_id",auth()->user()->id)->exists()){    
                View::share ( 'ownpost', true );
            }else{
                View::share ( 'ownpost', false );
            }
        }else{
            View::share ( 'ownpost', false );
        }
        $data["post"] = Post::where('id',$id)->with(array('comments' => function($query){
            $query->where("comment_deleted",0);
        }))->get();
        return view('goheart.display-post', $data);
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

        return view('goheart.managment-posts',$myPosts);
    }
}
