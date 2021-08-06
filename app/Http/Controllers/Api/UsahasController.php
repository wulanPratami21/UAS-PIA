<?php

namespace App\Http\Controllers\Api;
use App\Models\usahas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsahasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usaha = Usahas :: all ();
        return  response ()-> json ([ 
            'success' => true,
            'message' => 'Daftar Data pengalaman',
            'data' => $usaha
        ], 200 );
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
            'tahun' => 'required|unique:usahas|max:255',
            'pt' => 'required|unique:usahas|max:255',
            'bagian' => 'required|unique:usahas|max:255',
            
        ]);
        
        $usahas = usahas::create([
            'tahun' => $request->tahun,
            'pt' => $request->pt,
            'bagian' => $request->bagian
        ]);

        if($usahas)
        {
            return response()->json([
                'success' => true,
                'message' =>'usaha berhasil ditambahkan'
                'data' => $usahas
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' =>'usaha gagal ditambahkan'
                'data' => $usahas
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
        $usaha = Usahas::where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Detail data pengalaman',
            'data' => $usaha
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
            'tahun' => 'required|unique:usahas|max:255',
            'pt' => 'required|unique:usahas|max:255',
            'bagian' => 'required|unique:usahas|max:255',
            
        ]);
        
        $p = Usahas::find($id)->update([
            'tahun' => $request->tahun,
            'pt' => $request->pt,
            'bagian' => $request->bagian
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
        $cek = Usahas::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post Deleted',
            'data' => $cek
        ], 200);
    }
}
