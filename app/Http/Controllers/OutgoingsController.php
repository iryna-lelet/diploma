<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Outgoing;
use App\Models\PaymentType;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OutgoingsController extends Controller
{
    public function index(Outgoing $outgoing)
    {
        $categories = Category::where('type_id', '=', 2)->get()->all();
        $paymentMethods = PaymentType::all();
        $outgoings = $outgoing->getAllOutgoings();

        $data = [
            'outgoings' => $outgoings,
            'paymentMethods' => $paymentMethods,
            'categories' => $categories,
        ];

        return view('sections.outgoings', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Outgoing $outgoing
     * @return RedirectResponse
     */
    public function store(Request $request, Outgoing $outgoing)
    {
        $user = User::where('id', '=', session('LoggedUser'))->first()['id'];
        $outgoing->create(array_merge($request->all(), ['user_id' => $user]));

        return redirect()->route('outgoings')->withSuccess('Created outgoing ' . $request->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Outgoing $outgoing
     * @return Response
     */
    public function destroy(Request $request, Outgoing $outgoing)
    {
        $ids = explode(",", $request->ids);
        $outgoing->deleteOutgoings($ids);

        return redirect()->route('outgoings')->withDanger('Selected outgoings are deleted');
    }
}
