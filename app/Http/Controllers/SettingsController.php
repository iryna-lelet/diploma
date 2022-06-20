<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Currency;
use App\Models\PaymentType;
use App\Models\Type;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $types = Type::all();
        $categories = Category::getAllCategories();
        $paymentMethods = PaymentType::all();
        $currencies = Currency::all();

        $data = [
            'types' => $types,
            'categories' => $categories,
            'paymentMethods' => $paymentMethods,
            'currencies' => $currencies
        ];

        return view('sections.settings', $data);
    }
}
