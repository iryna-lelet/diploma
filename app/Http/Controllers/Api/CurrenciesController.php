<?php

namespace App\Http\Controllers\Api;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class CurrenciesController extends Controller
{
    public function currency()
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        return response()->json(Currency::get(), 200);
    }

    public function getCurrencyById($id)
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        $currency = Currency::find($id);

        if(is_null($currency)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($currency, 200);
    }

    public function saveCurrency(Request $request)
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        $rules = [
            'name' => 'required',
            'symbol' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $currency = Currency::create($request->all());

        return response()->json($currency, 201);
    }

    public function deleteCurrency($id)
    {
        try {
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }


        $currency = Currency::find($id);

        if(is_null($currency)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }

        $currency->delete();

        return response()->json('', 204);
    }
}
