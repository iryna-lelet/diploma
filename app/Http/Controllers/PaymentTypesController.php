<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentTypesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request, PaymentType $paymentType): RedirectResponse
    {
        $paymentType->create($request->only(['name', 'notes']));

        return redirect()->route('settings')->withSuccess('Created payment method ' . $request->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, PaymentType $paymentType)
    {
        $ids = explode(",", $request->ids);
        $paymentType->deletePaymentTypes($ids);

        return redirect()->route('settings')->withDanger('Selected payment methods are deleted');
    }
}
