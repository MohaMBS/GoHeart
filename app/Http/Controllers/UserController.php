<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        return view('edit-user');
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
        if($request->has('email')){
            if(auth()->user()->email != $request->email && $request->email != null){
                $request->validate([
                    'email' => 'unique:users',
                ]);
            }
        }
        if($request->has('name')){
            if($request->name != null){
                $request->validate([
                    'name' => 'required',
                ]);
            }
        }
        if($request->has('oldPass') | $request->has('newPass')){
            if($request->oldPass != null | $request->newPass != null){
                $request->validate([
                    'oldPass' => ['required', function ($attribute, $value, $fail) use ($user) {
                        if (!\Hash::check($value, $user->password)) {
                            return $fail(__('No la contraseña es incorrecta.'));
                        }
                    }],                
                    'newPass' => 'required|min:8|confirmed',
                ]);
            }
        }
        
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

    public function changeAvatar(Request $req){

        $user = User::find(auth()->user()->id);
        $user->url_avatar = $req->url_avatar;
        if($user->save()){
            return response("Guardado el cambio.",200 );
        }else{
            return response("No se guardo los cambios",500);
        }

    }
}
