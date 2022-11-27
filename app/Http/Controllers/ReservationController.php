<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
class ReservationController extends Controller
{
    public function index()
    {
        $reservation = Reservation::all();
        return $reservation;
    }

    public function store(Request $request)
    {
        $table = Reservation::create([
            "reservation_code" => $request->reservation_code,
            "guest_name" => $request->guest_name,
            "phone_number" => $request->phone_number,
            "hotel_name" => $request->hotel_name,
            "room_type" => $request->room_type,
            "starts_on" => $request->starts_on,
            "ends_on" => $request->ends_on,
            "total" => $request->total
        ]);
        
        return response ()->json ([
            'success' => 201,
            'message' => 'Reservation saved successfully!',
            'data' => $table
        ], 201);
    }

    public function show($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation) {
            return response()->json ([
                'status' => 200,
                'data' => $reservation
            
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
        $reservation = Reservation::find($id);
        if($reservation){
            $reservation->reservation_code = $request->reservation_code ? $request->reservation_code : $reservation->reservation_code;
            $reservation->guest_name = $request->guest_name ? $request->guest_name : $reservation->guest_name;
            $reservation->phone_number = $request->phone_number ? $request->phone_number : $reservation->phone_number;
            $reservation->hotel_name = $request->hotel_name ? $request->hotel_name : $reservation->hotel_name;
            $reservation->room_type = $request->room_type ? $request->room_type : $reservation->room_type;
            $reservation->starts_on = $request->starts_on ? $request->starts_on : $reservation->starts_on;
            $reservation->ends_on = $request->ends_on ? $request->ends_on : $reservation->ends_on;
            $reservation->total = $request->total ? $request->total : $reservation->total;
            $reservation->save();
            return response()->json([
                'status' => 200,
                'data' => $reservation
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
        $reservation = Reservation::where('id',$id)->first();
        if($reservation){
            $reservation->delete();
            return response()->json([
                'status'=>200,
                'data'=>$reservation
            ],200);

        }else{
            return response()->json([
                'status'=>404,
                'message'=>'id not found'
            ],404);
        }
    }
}
