<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $post = Post::where("security_token",$request->token_post)->get();
        $comment = new Comment();
        $comment->name = auth()->user()->name;
        $comment->user_id= auth()->user()->id;
        $comment->post_id= $post[0]->id;
        $comment->comment = $request->comment;
        $comment->save();
        if(!$comment){
            return response('Error.', 403);
        }else{
            if(auth()->user()->url_avatar){
                $avatar = '<img class="rounded-circle" src="'.auth()->user()->url_avatar.'" width="75">';
            }else{
                $avatar = '<span class="mr-2 mr-sm-1" style="font-size: 1.8em;">
                        <i class="fas fa-user-circle"></i> 
                    </span>';
            }

            $commentReturn = '
            <div id="comment-id-'.$comment->id.'" class="p-2 bg-commnets rounded border border-light">
                <div class="d-flex flex-row user-info">'.$avatar.'
                <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">'.$comment->name.' <a class="comment-button-delete btn btn-danger" href="'.route('delete.my.comment',$comment->id).'" id="'.$comment->id.'"><i class="far fa-trash-alt" aria-hidden="true"> Eliminar.</i></a>'.'</span><span class="date text-black-50">'.explode(' ',$comment->created_at )[0].'</span></div>
                </div>
                    <div class="mt-2">
                        <p class="comment-text">'.$comment->comment.'</p>
                </div>
            </div>';
            $data= array('comment' => $commentReturn);
            return json_encode($data);
        }
    }

    public function deleteMessage(Request $req, $id){

        $message = Comment::where('id',$req->id)->where('post_id',$id)->where("user_id",auth()->user()->id)->first();
        if(Comment::where('id',$req->id)->where('post_id',$id)->where("user_id",auth()->user()->id)->delete()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$cid, Request $req)
    {   
        if(Post::where("security_token",$req->token_post)->where("user_id",auth()->user()->id)->exists()){

            $c = Comment::where("post_id",$id)->where("id",$cid)->whereHas("post", function($query) use ($id){
                return $query->where('id',$id)->where('user_id',\Auth::id());
            })->first();
            $c->comment_deleted = true ;
            $c->save();
            return response('Borrado.', 200);
        }{
            return response('No se encuentra el mensaje o usted no es el dueño.', 403);
        }
        
    }
}
