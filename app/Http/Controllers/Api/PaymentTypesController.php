<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class PaymentTypesController extends Controller
{
    public function paymentType()
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        return response()->json(PaymentType::get(), 200);
    }

    public function getPaymentTypeById($id)
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        $paymentType = PaymentType::find($id);

        if(is_null($paymentType)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($paymentType, 200);
    }

    public function savePaymentType(Request $request)
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        $rules = [
            'name' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $paymentType = PaymentType::create($request->all());

        return response()->json($paymentType, 201);
    }

    public function deletePaymentType($id)
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        $paymentType = PaymentType::find($id);

        if(is_null($paymentType)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }

        $paymentType->delete();

        return response()->json('', 204);
    }
}
