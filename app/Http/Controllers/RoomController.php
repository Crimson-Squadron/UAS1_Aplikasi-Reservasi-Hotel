<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
class RoomController extends Controller
{
    public function index()
    {
        $room = Room::all();
        return $room;
    }

    public function store(Request $request)
    {
        $table = Room::create([
            "room_type" => $request->room_type,
            "bed_size" => $request->bed_size,
            "facilities" => $request->facilities,
            "available_at" => $request->available_at,
            "available_room" => $request->available_room,
            "price" => $request->price
        ]);
        
        return response ()->json ([
            'success' => 201,
            'message' => 'Room saved successfully!',
            'data' => $table
        ], 201);
    }

    public function show($id)
    {
        $room = Room::find($id);
        if ($room) {
            return response()->json ([
                'status' => 200,
                'data' => $room
            
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
        $room = Room::find($id);
        if($room){
            $room->room_type = $request->room_type ? $request->room_type : $room->room_type;
            $room->bed_size = $request->bed_size ? $request->bed_size : $room->bed_size;
            $room->facilities = $request->facilities ? $request->facilities : $room->facilities;
            $room->available_at = $request->available_at ? $request->available_at : $room->available_at;
            $room->available_room = $request->available_room ? $request->available_room : $room->available_room;
            $room->price = $request->price ? $request->price : $room->price;
            $room->save();
            return response()->json([
                'status' => 200,
                'data' => $room
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
        $room = Room::where('id',$id)->first();
        if($room){
            $room->delete();
            return response()->json([
                'status'=>200,
                'data'=>$room
            ],200);

        }else{
            return response()->json([
                'status'=>404,
                'message'=>'id not found'
            ],404);
        }
    }
}
