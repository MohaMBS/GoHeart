<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Event;
use App\Models\SavePost;
use App\Models\FavoritePost;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('goheart.edit-user');
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
    public function update(Request $request)
    {
        $dataUser = User::find(auth()->user()->id);
        if($request->has('email')){
            if(auth()->user()->email != $request->email && $request->email != null){
                $request->validate([
                    'email' => 'unique:users',
                ]);
                $dataUser->email= $request->email;
                
            }
        }
        if($request->has('name')){
            if($request->name != null && auth()->user()->name != $request->name){
                $request->validate([
                    'name' => 'required',
                ]);
                $dataUser->name =  $request->name;
                if($dataUser->save()){
                    return redirect()->route('update-profile')->with('msg',true);
                }else{
                    return redirect()->route('update-profile')->with('msg',false);
                }
            }
        }
        if($request->has('oldPass') | $request->has('newPass')){
            if($request->oldPass != null | $request->newPass != null){
                $request->validate([
                    'oldPass' => ['required',function ($attribute, $value, $fail) 
                    {if (!\Hash::check($value , \Auth::user()->password)) {
                        return $fail(__('La contraseña es incorrecta.'));
                    }}],                
                    'newPass1' => ['required','same:newPass2'],
                ]); 
                $dataUser->password = Hash::make($request->newPass1);
                if($dataUser->save()){
                    return redirect()->route('update-profile')->with('msg',true);
                }else{
                    return redirect()->route('update-profile')->with('msg',false);
                }

            }
        }
        return redirect()->route('update-profile')->with('msg',null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req, $id)
    {
        User::destroy(auth()->user()->id);
        $req->session()->flush();
        return redirect()->route('home');
    }

    public function changeAvatar(Request $req){

        $user = User::find(auth()->user()->id);
        $user->url_avatar = $req->url_avatar;
        if($user->save()){
            return response("Guardado el cambio.",200 );
        }else{
            return response("No se guardo los cambios",500);
        }

    }

    public function fovritesPost()
    {
        return view('goheart.fovrite-post')
        ->with('posts',FavoritePost::where("onFavorite",1)
        ->where("user_id",auth()->user()->id)
        ->orderBy("updated_at","desc")
        ->with('post')->get());
    }

    public function savedPost()
    {
        return view('goheart.save-post')
        ->with('posts',SavePost::where("onSave",1)
        ->where("user_id",auth()->user()->id)
        ->orderBy("updated_at","desc")
        ->with('post')->get());
    }

    public function myEvents ()
    {
        return view('goheart.my-events')
        ->with('events',Event::where("user_id",auth()->user()->id)
        ->orderBy("updated_at","desc")
        ->get());
    }
}
