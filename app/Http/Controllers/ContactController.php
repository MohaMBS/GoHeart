<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('goheart.contact-us');
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

    public function send(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' =>'required',
            'message' => 'required'
        ]);
        $contact = new Contact();
        $ref = Str::random(15);
        do {
            $ref = Str::random(15);
        } while (Contact::where('ref',$ref)->exists());
        $contact->ref = $ref;
        $contact->name = $req->name;
        $contact->email = $req->email;
        $contact->message = $req->message;
        $contact->subject = $req->subject;
        if ($contact->save()) {
            Mail::to($req->email)->send(new ContactMail($req,"Gracias por contactar con GoHeart, con ref ".$ref,$ref));
            Mail::to('mohamoha144@gmail.com')->send(new ContactMail($req,"Nueva consulta con referencia ".$ref,$ref));
            return true;
        } else {
            return false;
        }
        
    }

    public function privacy(){
        return view('goheart.privacy');
    }

    public function legal(){
        return view('goheart.legal');
    }

    public function cookie(){
        return view('goheart.cookie');
    }
    
}
