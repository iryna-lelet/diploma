<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Incoming;
use App\Models\PaymentType;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class IncomingsController extends Controller
{
    public function index(Incoming $incoming)
    {
        $categories = Category::where('type_id', '=', 1)->get()->all();
        $paymentMethods = PaymentType::all();
        $incomings = $incoming->getAllIncomings();

        $data = [
            'incomings' => $incomings,
            'paymentMethods' => $paymentMethods,
            'categories' => $categories,
        ];

        return view('sections.incoming', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Incoming $incoming
     * @return RedirectResponse
     */
    public function store(Request $request, Incoming $incoming): RedirectResponse
    {
        $user = User::where('id', '=', session('LoggedUser'))->first()['id'];
        $incoming->create(array_merge($request->all(), ['user_id' => $user]));
        return redirect()->route('incomings')->withSuccess('Created incoming ' . $request->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Incoming $incoming
     * @return Response
     */
    public function destroy(Request $request, Incoming $incoming)
    {
        $ids = explode(",", $request->ids);
        $incoming->deleteIncomings($ids);

        return redirect()->route('incomings')->withDanger('Selected incomings are deleted');
    }

    public function incoming()
    {
        return response()->json(Incoming::get(), 200);
    }

    public function getIncomingById($id)
    {
        $incoming = Incoming::find($id);

        if(is_null($incoming)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($incoming, 200);
    }

    public function saveIncoming(Request $request)
    {
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
        $incoming = Incoming::create($request->all());

        return response()->json($incoming, 201);
    }

    public function deleteIncoming(Request $request, Incoming $incoming)
    {
        $incoming->delete();

        return response()->json('', 204);
    }


}
