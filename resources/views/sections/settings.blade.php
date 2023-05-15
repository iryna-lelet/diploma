@extends('layouts.app')

@section('content')
<div class="settingBlock">
    @if(session('success'))
        <div class="alert alert-success" test-id="success-alert">{{ session('success') }}</div>
    @endisset
    @if(session('danger'))
        <div class="alert alert-danger" test-id="remove-alert">{{ session('danger') }}</div>
    @endisset
    <div class="settingsHeader">
        <h1>Categories</h1>
        <div class="controlBtns">
            <button id="addCategoryBtn" class="btn btn-success">add</button>
            <form action="{{ route('categories.destroy') }}" id="form-categories" method="post">
                @csrf
                <input type="hidden" id="destroy-categories" name="ids">
                <button id="removeCategoryBtn" class="btn btn-warning remove-btn" data-ref="categories">delete</button>
            </form>
        </div>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
            <th style="width: 5%"></th>
            <th style="width: 20%">Category name</th>
            <th style="width: 40%">Type</th>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>
                            <input type="checkbox" data-id="{{ $category->id }}" data-table="categories">
                        </td>
                        <td test-id="grid-category-name">{{ $category->category }}</td>
                        <td test-id="grid-category-type">{{ $category->type }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($categories->isEmpty())
            <div style="text-align: center; border-bottom: 1px solid #000000; padding-bottom: 12px">
                No records
            </div>
        @endif
    </div>
</div>
<div class="settingBlock">
    <div class="settingsHeader">
        <h1>Payment method</h1>
        <div class="controlBtns">
            <button id="addPaymentBtn" class="btn btn-success">add</button>
            <form action="{{ route('payment-type.destroy') }}" id="form-payment-type" method="post">
                @csrf
                <input type="hidden" id="destroy-payment-type" name="ids">
                <button id="removePaymentBtn" class="btn btn-warning remove-btn" data-ref="payment-type">delete</button>
            </form>
        </div>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
            <th style="width: 5%"></th>
            <th style="width: 20%">Payment method name</th>
            <th style="width: 40%">Notes</th>
            </thead>
            <tbody>
                @foreach($paymentMethods as $paymentMethod)
                    <tr>
                        <td>
                            <input type="checkbox" data-id="{{ $paymentMethod->id }}" data-table="payment-type">
                        </td>
                        <td test-id="grid-payment-name">{{ $paymentMethod->name }}</td>
                        <td test-id="grid-payment-notes">{{ $paymentMethod->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($paymentMethods->isEmpty())
            <div style="text-align: center; border-bottom: 1px solid #000000; padding-bottom: 12px">
                No records
            </div>
        @endif
    </div>
</div>
<div class="settingBlock">
    <div class="settingsHeader">
        <h1>Currencies</h1>
        <div class="controlBtns">
            <button id="addCurrencyBtn" class="btn btn-success">add</button>
            <form action="{{ route('currencies.destroy') }}" id="form-currencies" method="post">
                @csrf
                <input type="hidden" id="destroy-currencies" name="ids">
                <button id="removeCurrencyBtn" class="btn btn-warning remove-btn" data-ref="currencies">delete</button>
            </form>
        </div>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
            <th style="width: 5%"></th>
            <th style="width: 20%">Currency name</th>
            <th style="width: 40%">Symbol</th>
            </thead>
            <tbody>
                @foreach($currencies as $currency)
                    <tr>
                        <td>
                            <input type="checkbox" data-id="{{ $currency->id }}" data-table="currencies">
                        </td>
                        <td test-id="grid-currency-name">{{ $currency->name }}</td>
                        <td test-id="grid-currency-symbol">{{ $currency->symbol }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($currencies->isEmpty())
            <div style="text-align: center; border-bottom: 1px solid #000000; padding-bottom: 12px">
                No records
            </div>
        @endif
    </div>
</div>


{{--    Popups  --}}
<div id="addCategoryPopup" class="popup">
    <div class="popup-content">
        <a href="javascript:void(0)" class="popupCloseBtn"><i class="fas fa-times"></i></a>
        <form action="{{ route('categories.store') }}" method="post">
            @csrf
            <label for="name-category">Name</label>
            <input
                type="text"
                placeholder="Name"
                name="name"
                id="name-category"
            >
            <label for="type-category">Usage type</label>
            <select id="type-category" name="type_id" test-id="category-type">
                @foreach($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-success" test-id="category-save">save</button>
        </form>
    </div>
</div>

<div id="addPaymentPopup" class="popup">
    <div class="popup-content">
        <a href="javascript:void(0)" class="popupCloseBtn"><i class="fas fa-times"></i></a>
        <form action="{{ route('payment-type.store') }}" method="post">
            @csrf
            <label for="payment-name">Name</label>
            <input
                type="text"
                placeholder="Payment method name"
                name="name"
                id="payment-name"
            >
            <label for="payment-notes">Notes</label>
            <input
                type="text"
                placeholder="Notes"
                name="notes"
                id="payment-notes"
            >
            <button type="submit" class="btn btn-success" test-id="payment-save">save</button>
        </form>
    </div>
</div>

<div id="addCurrencyPopup" class="popup">
    <div class="popup-content">
        <a href="javascript:void(0)" class="popupCloseBtn"><i class="fas fa-times"></i></a>
        <form action="{{ route('currencies.store') }}" method="post">
            @csrf
            <label for="currency-name">Currency name</label>
            <input
                type="text"
                placeholder="Currency name"
                name="name"
                id="currency-name"

            >
            <label for="currency-symbol">Symbol</label>
            <input
                type="text"
                placeholder="Symbol"
                name="symbol"
                id="currency-symbol"
            >
            <button type="submit" class="btn btn-success" test-id="currency-save">save</button>
        </form>
    </div>
</div>

@endsection
