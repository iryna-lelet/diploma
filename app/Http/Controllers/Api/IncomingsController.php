<?php

namespace App\Http\Controllers\Api;

use App\Models\Incoming;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class IncomingsController extends Controller
{
    public function incoming()
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        return response()->json(Incoming::get(), 200);
    }

    public function getIncomingById($id)
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        $incoming = Incoming::find($id);

        if(is_null($incoming)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($incoming, 200);
    }

    public function saveIncoming(Request $request)
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        $rules = [
            'amount' => 'required|numeric|max:10000000000',
            'creation_date' => 'required|min:10|max:10',
            'payment_type_id' => 'required',
            'category_id' => 'required',
            'merchant' => 'required|max:60',
            'user_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $incoming = Incoming::create($request->all());

        return response()->json($incoming, 201);
    }

    public function deleteIncoming($id)
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        $incoming = Incoming::find($id);

        if(is_null($incoming)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }

        $incoming->delete();

        return response()->json('', 204);
    }
}
