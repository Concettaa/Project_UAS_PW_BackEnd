<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Artikel;


class ArtikelController extends Controller
{
    //
    public function index(){
        $artikels = Artikel::all();

        if(count($artikels) >0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $artikels
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id){
        $artikel = Artikel::find($id);

        if(!is_null($artikel)){
            return response([
                'message' => 'Retrieve Artikel Success',
                'data' => $artikel
            ], 200);
        }

        return response([
            'message' => 'Aritkel Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'writer' => 'required|max:60|unique:artikels',
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
            'link_gambar' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $artikel = Artikel::create($storeData);
        return response([
            'message' => 'Add Artikel Success',
            'data' => $artikel
        ], 200);
    }

    public function destroy($id){
        $artikel = Artikel::find($id);

        if(is_null($artikel)){
            return response([
                'message' => 'Artikel not found',
                'data' => null
            ], 404);
        }

        if($artikel->delete()){
            return response([
                'message' => 'Delete Artikel Success',
                'data' => $artikel
            ], 200);
        }

        return response([
            'message' => 'Delete Artikel Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id){
        $artikel = Artikel::find($id);
        if(is_null($artikel)){
            return response([
                'message' => 'Artikel not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'writer' => 'required|max:60',
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
            'link_gambar' => 'required'
        ]);

        if($validate->fails()){
            return response (['message' => $validate->errors()], 400);
        }

        $artikel->writer = $updateData['writer'];
        $artikel->title = $updateData['title'];
        $artikel->content = $updateData['content'];
        $artikel->description = $updateData['description'];
        $artikel->link_gambar = $updateData['link_gambar'];

        if($artikel->save()){
            return response([
                'message' => 'Update Artikel Success',
                'data' => $artikel
            ], 200);
        }

        return response ([
            'message' => 'Update Artikel Failed',
            'data' => null,
        ],404);
    }
}
