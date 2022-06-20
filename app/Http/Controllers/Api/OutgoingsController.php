<?php

namespace App\Http\Controllers\Api;

use App\Models\Outgoing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class OutgoingsController extends Controller
{
    public function outgoing()
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        return response()->json(Outgoing::get(), 200);
    }

    public function getOutgoingById($id)
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        $outgoing = Outgoing::find($id);

        if(is_null($outgoing)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($outgoing, 200);
    }

    public function saveOutgoing(Request $request)
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        $rules = [
            'amount' => 'required',
            'creation_date' => 'required',
            'payment_type_id' => 'required',
            'category_id' => 'required',
            'merchant' => 'required',
            'user_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $outgoing = Outgoing::create($request->all());

        return response()->json($outgoing, 201);
    }

    public function deleteOutgoing($id)
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        $outgoing = Outgoing::find($id);

        if(is_null($outgoing)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }

        $outgoing->delete();

        return response()->json('', 204);
    }
}
