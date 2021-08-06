<?php

namespace App\Http\Controllers\Api;
use App\Models\historys;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistorysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $history = Historys :: all ();
        return  response ()-> json ([ 
            'success' => true,
            'message' => 'Daftar Data history',
            'data' => $history
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
        $request->validate([
            'tahun' => 'required|max:255',
            'nama' => 'required',
        ]);

        $historys = History::create([
            'tahun'=> $request->tahun,
            'nama' => $request->nama
            ]);

            if($historys)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'history berhasil di tambahkan',
                    'data' => $historys
                ], 200);
            }else{
                return response()->json([
                'success' => false,
                'message' => 'history gagal di tambahkan',
                'data' => $historys
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
        $historys = History::where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Detail Data history',
            'data' => $historys
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
            'tahun' => 'required|max:255',
            'nama' => 'required',
        ]);

        $j = History::create([
            'tahun'=> $request->tahun,
            'nama' => $request->nama
            ]);

            return response()->json([
                'success' => true,
                'message' => 'History Berhasil Di Update',
                'data' => $j
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
        $des = History::find($id)->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'History Berhasil Dihapus',
            'data' => $des
        ], 200);
    }
}
