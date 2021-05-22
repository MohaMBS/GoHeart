<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Event;
use App\Models\Comment;
use App\Models\MyEventComment;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationDD;

class AdminController extends Controller
{
    //Funcion para poder borrar una entrada sabiendo su id 
    public function deletePost($id){
        if(Post::destroy($id)){
            $data = Post::find($id);
            $user = User::find($data->user_id);
            Mail::to($user->email)->send(new NotificationDD($user,$data,"GoHeart Entrada borrada."));
            return redirect()->route('posts')->with('operation', true);
        }else{
            return redirect()->route('posts')->with('operation', false);
        }
    }

    //Funcion para poder deshabilitar una entrada sabiendo su id
    public function disablePost($id){
        $post = Post::find($id);
        $post->active= false;
        if($post->save()){
            $data = Post::find($id);
            $user = User::find($data->user_id);
            Mail::to($user->email)->send(new NotificationDD($user,$data,"GoHeart Entrada deshabilidatada.",$data->id));
            return redirect()->route('posts')->with('operation', true);
        }else{
            return redirect()->route('posts')->with('operation', false);
        }
    }

    //Funcion para poder comentarios de una entrada sabiendo su id
    public function deleteCommentPost($id){
        $comment = Comment::find($id);
        $comment->comment_deleted = true;
        if($comment->save()){
            return true;
        }else{
            return false;
        }
    }

    //Funcion para poder borrar un evento sabiendo su id
    public function deleteEvent($id){
        if(Event::destroy($id)){
            $data = Event::find($id);
            $user = User::find($data->user_id);
            Mail::to($user->email)->send(new NotificationDD($user,$data,"GoHeart Evento borrado."));
            return redirect()->route('events')->with('operation', true);
        }else{
            return redirect()->route('events')->with('operation', false);
        }
    }

    //Funcion para poder deshabilitar un evento sabiendo su id
    public function disableEvent($id){
        $event = Event::find($id);
        $event->is_active= false;
        if($event->save()){
            $data = Event::find($id);
            $user = User::find($data->user_id);
            Mail::to($user->email)->send(new NotificationDD($user,$data,'GoHeart Evento deshabilidatada.',$data->id));
            return redirect()->route('events')->with('operation', true);
        }else{
            return redirect()->route('events')->with('operation', false);
        }
    }

    //Funcion para poder borrar comentarios de un evento sabiendo su id
    public function deleteCommentEvent($id){
        $comment = MyEventComment::find($id);
        $comment->comment_deleted = true;
        if($comment->save()){
            return true;
        }else{
            return false;
        }
    }

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
    public function destroy($id)
    {
        //
    }
}
