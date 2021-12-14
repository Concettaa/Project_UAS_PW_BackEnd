<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Komentar;

class ReviewController extends Controller
{
    //
    public function index(){
        $reviews = Komentar::all();

        if(count($reviews) >0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $reviews
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id){
        $review = Komentar::find($id);

        if(!is_null($review)){
            return response([
                'message' => 'Retrieve Review Success',
                'data' => $review
            ], 200);
        }

        return response([
            'message' => 'Review Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama' => 'required|max:60|unique:komentars',
            'point' => 'required|max:5|numeric',
            'review' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $review = Komentar::create($storeData);
        return response([
            'message' => 'Add Review Success',
            'data' => $review
        ], 200);
    }

    public function destroy($id){
        $review = Komentar::find($id);

        if(is_null($review)){
            return response([
                'message' => 'Review not found',
                'data' => null
            ], 404);
        }

        if($review->delete()){
            return response([
                'message' => 'Delete Review Success',
                'data' => $review
            ], 200);
        }

        return response([
            'message' => 'Delete Review Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id){
        $review = Komentar::find($id);
        if(is_null($review)){
            return response([
                'message' => 'Review not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama' => 'required|max:60',
            'point' => 'required|max:5|numeric',
            'review' => 'required'
        ]);

        if($validate->fails()){
            return response (['message' => $validate->errors()], 400);
        }
        $review->nama = $updateData['nama'];
        $review->point = $updateData['point'];
        $review->review = $updateData['review'];

        if($review->save()){
            return response([
                'message' => 'Update Review Success',
                'data' => $review
            ], 200);
        }

        return response ([
            'message' => 'Update Review Failed',
            'data' => null,
        ],404);
    }
}
