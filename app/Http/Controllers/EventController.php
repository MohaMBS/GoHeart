<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\CommentsEvent;
use View;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $events = Event::where('is_active',true)->with("user")->withCount('comment')->get();
        return view('goheart.events-index')->with(compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goheart.create-event');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'daterange'=>'required',
            'cords' => 'required'
        ]);
        $event = new Event();
        $event->user_id = auth()->user()->id;
        $event->name_user = auth()->user()->name;
        $event->is_active= true;
        $event->dates = $request->daterange;
        $event->title = $request->title;
        $event->front_page = $request->filepath;
        $event->cords = $request->cords;
        $event->body = $request->body;

        if ($event->save()) {
            return redirect()->route('see-event',$event->id);
        } else {
           return response("Ops algo fallo a la hora de guardar el evento...");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth()->check()){
            if(Event::where("user_id",auth()->user()->id)->exists()){    
                View::share ( 'ownevent', true );
            }else{
                View::share ( 'ownevent', false );
            }
        }else{
            View::share ( 'ownevent', false );
        }
        return view('goheart.event')
        ->with("event",Event::where('id',$id)->with(array('comment' => function($query){
            $query->where("comment_deleted",0)->with('user');}))->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        return view('goheart.edit-event')
        ->with('event',Event::where('id',$id)->where('user_id',auth()->user()->id)->first());
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req,$id)
    {
        if($req->has("id_comment_to_delete")){
            if(CommentsEvent::where('id',$req->id_comment_to_delete)->where('event_id',$id)->delete()){
                return true;
            }else{
                return false;
            }
        }else{
            if(CommentsEvent::where('id',$req->id)->where('event_id',$id)->where("user_id",auth()->user()->id)->delete()){
                return true;
            }else{
                return false;
            }
        }
    }

    public function updateEvent(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'daterange'=>'required',
            'cords' => 'required'
        ]);

        $event = Event::where('user_id',auth()->user()->id)->where('id',$id)->first();
        $event->dates = $request->daterange;
        $event->title = $request->title;
        $event->front_page = $request->filepath;
        $event->cords = $request->cords;
        $event->body = $request->body;
        $event->save();
        return redirect()->route('see-event',$event->id);
    }

    public function deleteEvent($id){
        Event::destroy($id);
        return redirect()->route('my-events');
    }

    public function comment(Request $request, $id)
    {
        $comment = new CommentsEvent();
        $comment->user_name = auth()->user()->name;
        $comment->user_id= auth()->user()->id;
        $comment->event_id= $id;
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
                <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">'.$comment->user_name.' <a class="comment-button-delete btn btn-danger" href="'.route('delete.my.comment',$comment->id).'" id="'.$comment->id.'"><i class="far fa-trash-alt" aria-hidden="true"> Eliminar.</i></a>'.'</span><span class="date text-black-50">'.explode(' ',$comment->created_at )[0].'</span></div>
                </div>
                    <div class="mt-2">
                        <p class="comment-text">'.$comment->comment.'</p>
                </div>
            </div>';
            $data= array('comment' => $commentReturn);
            return json_encode($data);
        }
    }
}
