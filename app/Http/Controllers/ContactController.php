<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contact_name' => 'required|max:75|min:2',
            'contact_email' => 'required',
            'contact_text' => 'required|min:2'
        ]);

        $name = Str::limit($request->contact_name, 75);
        
        $contact = New Contact ([
            'contact_name' => $name,
            'contact_email' => $request->contact_email,
            'contact_text' => $request->contact_text
        ]);

        $contact->save();

        return redirect()-> route('contactIndex');
    }

    /**     
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
