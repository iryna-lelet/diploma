<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CurrenciesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request, Currency $currency): RedirectResponse
    {
        $currency->create($request->only(['name', 'symbol']));

        return redirect()->route('settings')->withSuccess('Created currency ' . $request->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, Currency $currency)
    {
        $ids = explode(",", $request->ids);
        $currency->deleteCurrencies($ids);

        return redirect()->route('settings')->withDanger('Selected currencies are deleted');
    }
}
