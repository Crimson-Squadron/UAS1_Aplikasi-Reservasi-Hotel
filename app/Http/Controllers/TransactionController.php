<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::all();
        return $transaction;
    }

    public function store(Request $request)
    {
        $table = Transaction::create([
            "guest_name" => $request->guest_name,
            "guest_email" => $request->guest_email,
            "total" => $request->total,
            "payment_req_at" => $request->payment_req_at,
            "payment_status" => $request->payment_status,
            "reservation_code" => $request->reservation_code
        ]);
        
        return response ()->json ([
            'success' => 201,
            'message' => 'Transaction saved successfully!',
            'data' => $table
        ], 201);
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            return response()->json ([
                'status' => 200,
                'data' => $transaction
            
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
        $transaction = Transaction::find($id);
        if($transaction){
            $transaction->guest_name = $request->guest_name ? $request->guest_name : $transaction->guest_name;
            $transaction->guest_email = $request->guest_email ? $request->guest_email : $transaction->guest_email;
            $transaction->total = $request->total ? $request->total : $transaction->total;
            $transaction->payment_req_at = $request->payment_req_at ? $request->payment_req_at : $transaction->payment_req_at;
            $transaction->payment_status = $request->payment_status ? $request->payment_status : $transaction->payment_status;
            $transaction->reservation_code = $request->reservation_code ? $request->reservation_code : $transaction->reservation_code;
            $transaction->save();
            return response()->json([
                'status' => 200,
                'data' => $transaction
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
        $transaction = Transaction::where('id',$id)->first();
        if($transaction){
            $transaction->delete();
            return response()->json([
                'status'=>200,
                'data'=>$transaction
            ],200);

        }else{
            return response()->json([
                'status'=>404,
                'message'=>'id not found'
            ],404);
        }
    }
}
