<?php

namespace App\Http\Controllers;
use App\Models\profils;
use Illuminate\Http\Request;

class ProfilsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profils = Profils::orderBy('id', 'desc')->paginate(3);
        return view('profils.index', compact('profils'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profils.create');
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
            'nama' => 'required|unique:profils|max:255',
            'gambar' => 'required|unique:profils|max:255',
            'ttl' => 'required|unique:profils|max:255',
            'jk' => 'required|unique:profils|max:255',
            'agama' => 'required|unique:profils|max:255',
            'alamat' => 'required|unique:profils|max:255',
        ]);

        $profils = new Profils;
      
        $profils->nama = $request->nama;
        $profils->gambar = $request->gambar;
        $profils->ttl = $request->ttl;
        $profils->jk = $request->jk;
        $profils->agama = $request->agama;
        $profils->alamat = $request->alamat;

        $profils->save();

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
        $profil = Profils::where('id', $id)->first();
        return view('profils.show', ['profil' => $profil]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profil = Profils::where('id', $id)->first();
        return view('profils.edit', ['profil' => $profil]);
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
            'nama' => 'required|unique:profils|max:255',
            'gambar' => 'required|unique:profils|max:255',
            'ttl' => 'required|unique:profils|max:255',
            'jk' => 'required|unique:profils|max:255',
            'agama' => 'required|unique:profils|max:255',
            'alamat' => 'required|unique:profils|max:255',
            
        ]);

        Profils::find($id)->update([
            'nama' => $request->nama,
            'gambar' => $request->gambar,
            'ttl' => $request->ttl,
            'agama' => $request->agama,
            'alamat' => $request->alamat
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
        Profils::find($id)->delete();
        return redirect('/');
    }
}
