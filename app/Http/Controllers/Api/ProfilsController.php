<?php

namespace App\Http\Controllers\Api;
use App\Models\profils;
use App\Http\Controllers\Controller;
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
        return response()->json([
            'success' => true,
            'message' =>'Daftar data profile'
            'data' => $profils
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
            'nama' => 'required|unique:profils|max:255',
            'gambar' => 'required|unique:profils|max:255',
            'ttl' => 'required|unique:profils|max:255',
            'jk' => 'required|unique:profils|max:255',
            'agama' => 'required|unique:profils|max:255',
            'alamat' => 'required|unique:profils|max:255',
        ]);
        
        $profils = Profils::create([
            'nama' => $request->nama,
            'gambar' => $request->gambar,
            'ttl' => $request->ttl,
            'agama' => $request->agama,
            'alamat' => $request->alamat
        ]);

        if($profils)
        {
            return response()->json([
                'success' => true,
                'message' =>'profile berhasil ditambahkan'
                'data' => $profils
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' =>'profile gagal ditambahkan'
                'data' => $profils
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
        $profil = profils::where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Detail data profile',
            'data' => $profil
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
            'nama' => 'required|unique:profils|max:255',
            'gambar' => 'required|unique:profils|max:255',
            'ttl' => 'required|unique:profils|max:255',
            'jk' => 'required|unique:profils|max:255',
            'agama' => 'required|unique:profils|max:255',
            'alamat' => 'required|unique:profils|max:255',
        ]);
        
        $p = Profils::find($id)->update([
            'nama' => $request->nama,
            'gambar' => $request->gambar,
            'ttl' => $request->ttl,
            'agama' => $request->agama,
            'alamat' => $request->alamat
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
        $cek = Profils::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post Deleted',
            'data' => $cek
        ], 200);
    }
}
