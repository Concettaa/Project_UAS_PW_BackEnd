<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Buku;

class BukuController extends Controller
{
    //
    public function index(){
        $bukus = Buku::all();

        if(count($bukus) >0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $bukus
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id){
        $buku = Buku::find($id);

        if(!is_null($buku)){
            return response([
                'message' => 'Retrieve Buku Success',
                'data' => $buku
            ], 200);
        }

        return response([
            'message' => 'Buku Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'judul' => 'required|max:60|unique:bukus',
            'tahun_terbit' => 'required|numeric',
            'genre' => 'required',
            'deskripsi' => 'required',
            'link_gambar' => 'required',
            'isi' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $buku = Buku::create($storeData);
        return response([
            'message' => 'Add Buku Success',
            'data' => $buku
        ], 200);
    }

    public function destroy($id){
        $buku = Buku::find($id);

        if(is_null($buku)){
            return response([
                'message' => 'Buku not found',
                'data' => null
            ], 404);
        }

        if($buku->delete()){
            return response([
                'message' => 'Delete Buku Success',
                'data' => $buku
            ], 200);
        }

        return response([
            'message' => 'Delete Buku Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id){
        $buku = Buku::find($id);
        if(is_null($buku)){
            return response([
                'message' => 'Buku not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'judul' => 'required|max:60',
            'tahun_terbit' => 'required|numeric',
            'genre' => 'required',
            'deskripsi' => 'required',
            'link_gambar' => 'required',
            'isi' => 'required'
        ]);

        if($validate->fails()){
            return response (['message' => $validate->errors()], 400);
        }

        $buku->judul = $updateData['judul'];
        $buku->tahun_terbit = $updateData['tahun_terbit'];
        $buku->genre = $updateData['genre'];
        $buku->deskripsi = $updateData['deskripsi'];
        $buku->link_gambar = $updateData['link_gambar'];
        $buku->isi = $updateData['isi'];        

        if($buku->save()){
            return response([
                'message' => 'Update Buku Success',
                'data' => $buku
            ], 200);
        }

        return response ([
            'message' => 'Update Buku Failed',
            'data' => null,
        ],404);
    }
}
