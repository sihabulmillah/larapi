<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
        //unutk mengurutkan dari data yang terbaru
        $data = Category::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Category',
            'data' => $data
        ], 200);
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
        $validete = Validator::make($request->all(), [
            "kategori" => "required",
        ]);

        // 400 = terdapat request tidak valid
        if ($validete->fails()) {
            return response()->json($validete->errors(), 400);
        }
        //lolos validate lalu di simpan di DB
        $data = Category::create([
            'kategori' => $request->kategori
        ]);

        if ($data) {
            return response()->json([
                'succes' => true,
                "message" => "data kateogri berhasil di tambah",
                "data" => $data
            ], 201);
        }

        return response()->json([
            'succes' => false,
            "message" => "data kateogri gagal di tambah",
            "data" => $data
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // opsi 1
        $data = Category::find($id);

        if ($data) {
            return response()->json([
                "success" => true,
                "message" => "detail data kategori",
                'data' => $data
            ], 203);
        }
        return response()->json([
            "success" => true,
            "message" => "detail kategori tidak ditemukan",
        ], 404);

        // opsi 2
        // $data = Category::findOrFail($id);

        // return response()->json([
        //     "success" => true,
        //     "message" => "detail data kategori",
        //     'data' => $data
        // ], 203);
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
}
