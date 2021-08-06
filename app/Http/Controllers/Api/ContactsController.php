<?php

namespace App\Http\Controllers\Api;
use App\Models\contacts;
use App\Http\Controllers\Controller;
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
        $Contacts = Contacts::orderBy('id', 'desc')->paginate(3);
        return response()->json([
            'success' => true,
            'message' =>'Daftar data Contact'
            'data' => $Contacts
        ], 200);
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
            'nama' => 'required|unique:Contacts|max:255',
            'email' => 'required|unique:Contacts|max:255',
            'pesan' => 'required|unique:Contacts|max:255',
            
        ]);
        
        $Contacts = Contacts::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan
        ]);

        if($Contacts)
        {
            return response()->json([
                'success' => true,
                'message' =>'Contacte berhasil ditambahkan'
                'data' => $Contacts
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' =>'Contacte gagal ditambahkan'
                'data' => $Contacts
            ], 409);
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
        $Contact = Contacts::where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Detail data Contact',
            'data' => $Contact
        ], 200);
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
            'nama' => 'required|unique:Contacts|max:255',
            'email' => 'required|unique:Contacts|max:255',
            'pesan' => 'required|unique:Contacts|max:255',
        ]);
        
        $p = Contacts::find($id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan
        ]);

            return response()->json([
                'success' => true,
                'message' =>'Post Updated'
                'data' => $p
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cek = Contacts::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post Deleted',
            'data' => $cek
        ], 200);
    }
}
