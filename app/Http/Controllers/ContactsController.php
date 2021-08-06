<?php

namespace App\Http\Controllers;
use App\Models\contacts;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contacts::orderBy('id', 'desc')->paginate(3);
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           //validate the request...

           $request->validate([
            'nama' => 'required|unique:contacts|max:255',
            'email' => 'required|unique:contacts|max:255',
            'pesan' => 'required|unique:contacts|max:255',
        ]);

        $contacts = new Contacts;
      
        $contacts->nama = $request->nama;
        $contacts->email = $request->email;
        $contacts->pesan = $request->pesan;

        $contacts->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contacts::where('id', $id)->first();
        return view('contacts.show', ['contact' => $contact]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contacts::where('id', $id)->first();
        return view('contacts.edit', ['contact' => $contact]);
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
        $request->validate([
            'nama' => 'required|unique:contacts|max:255',
            'email' => 'required|unique:contacts|max:255',
            'pesan' => 'required|unique:contacts|max:255',
            
        ]);

        Contacts::find($id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan
        ]);

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contacts::find($id)->delete();
        return redirect('/');
    }
}
