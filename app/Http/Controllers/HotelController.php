<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
class HotelController extends Controller
{
    public function index()
    {
        $hotel = Hotel::all();
        return $hotel;
    }

    public function store(Request $request)
    {
        $table = Hotel::create([
            "hotel_name" => $request->hotel_name,
            "city" => $request->city,
            "address" => $request->address,
            "rating" => $request->rating,
            "description" => $request->description
        ]);
        
        return response ()->json ([
            'success' => 201,
            'message' => 'Hotel saved successfully!',
            'data' => $table
        ], 201);
    }

    public function show($id)
    {
        $hotel = Hotel::find($id);
        if ($hotel) {
            return response()->json ([
                'status' => 200,
                'data' => $hotel
            
            ], 200);
        } else {
            return response()->json ([
                'status' => 404,
                'message' => 'id not found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::find($id);
        if($hotel){
            $hotel->hotel_name = $request->hotel_name ? $request->hotel_name : $hotel->hotel_name;
            $hotel->city = $request->city ? $request->city : $hotel->city;
            $hotel->address = $request->address ? $request->address : $hotel->address;
            $hotel->rating = $request->rating ? $request->rating : $hotel->rating;
            $hotel->description = $request->description ? $request->description : $hotel->description;
            $hotel->save();
            return response()->json([
                'status' => 200,
                'data' => $hotel
            ],200);
        
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'id not found'
            ],404);
        }
    }

    public function destroy($id)
    {
        $hotel = Hotel::where('id',$id)->first();
        if($hotel){
            $hotel->delete();
            return response()->json([
                'status'=>200,
                'data'=>$hotel
            ],200);

        }else{
            return response()->json([
                'status'=>404,
                'message'=>'id not found'
            ],404);
        }
    }
}
