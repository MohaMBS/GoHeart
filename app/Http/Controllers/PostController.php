<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SavePost;
use App\Models\FavoritePost;

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
        $data["posts"] = Post::where('active',true)
        ->withCount("comments")
        ->with('user')
        ->withCount(array('favorite' => function($query){
            $query->where("onFavorite",1);
        } ))->orderBy('id', 'desc')->paginate(10);
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
        $article->	typepost_id  = $input_data['Category'];
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
            if(Post::where("user_id",auth()->user()->id)->where('id',$id)->exists()){    
                View::share ( 'ownpost', true );
            }else{
                View::share ( 'ownpost', false );
            }
            $data["post"] = Post::where('id',$id)
            ->where('active', true)
            ->with(array('comments' => function($query){
                $query->where("comment_deleted",0)->with('user');}))
            ->withCount(array('favorite' => function ($query) use ($id) { $query->where('post_id',$id)->where("user_id",\Auth::user()->id)->where("onFavorite",1); }))
            ->withCount(array('savePost'=> function ($query) use ($id) { $query->where('post_id',$id)->where("user_id",\Auth::user()->id)->where("onSave",1); }))
            ->get();
        }else{
            View::share ( 'ownpost', false );
            $data["post"] = Post::where('id',$id)
            ->with(array('comments' => function($query){
                $query->where("comment_deleted",0)->with('user');}))
            ->get();
        }
        
        $data["post_id"] = $id;
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
                return view('goheart.edit-post', compact('data'));
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
        $myPosts["posts"] = Post::where("user_id",auth()->user()->id)->orderBy('updated_at','desc')->get();
        
        return view('goheart.managment-posts',$myPosts);
    }

    public function savePost($id)
    {
        try {
            if (SavePost::where("post_id",$id)->where("user_id",auth()->user()->id)->exists()) {
                if(SavePost::where("post_id",$id)->where("user_id",auth()->user()->id)->where("onSave",true)->exists()){
                    SavePost::where("post_id",$id)->where("user_id",auth()->user()->id)->update(['onSave'=>false]);
                }else{
                    SavePost::where("post_id",$id)->where("user_id",auth()->user()->id)->update(['onSave'=>true]);
                }
                return true;
            } else {
                $status = new SavePost();
                $status->user_id = auth()->user()->id;
                $status->post_id = $id;
                $status->onSave = true;
                if($status->save()){
                    return true;
                }else{
                    return false;
                }
            }
        } catch (\Throwable $th) {
            return false;
        }
        
    }
    
    public function favoritePost($id)
    {
        try {
            if(FavoritePost::where("post_id",$id)->where("user_id",auth()->user()->id)->exists()){
                if(FavoritePost::where("post_id",$id)->where("user_id",auth()->user()->id)->where("onFavorite",true)->exists()){
                    FavoritePost::where("post_id",$id)->where("user_id",auth()->user()->id)->update(['onFavorite'=>false]);
                }else{
                    FavoritePost::where("post_id",$id)->where("user_id",auth()->user()->id)->update(['onFavorite'=>true]);
                }
                return true;
            }else{
                $status = new FavoritePost();
                $status->user_id = auth()->user()->id;
                $status->post_id = $id;
                $status->onFavorite = true;
                if($status->save()){
                    return true;
                }else{
                    return false;
                }
            }   
        } catch (\Throwable $th) {
            return false;
        }
        
    }
}
