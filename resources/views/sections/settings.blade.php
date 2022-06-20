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
        <h1>Категории</h1>
        <div class="controlBtns">
            <button id="addCategoryBtn" class="btn btn-success">добавить</button>
            <form action="{{ route('categories.destroy') }}" id="form-categories" method="post">
                @csrf
                <input type="hidden" id="destroy-categories" name="ids">
                <button id="removeCategoryBtn" class="btn btn-warning remove-btn" data-ref="categories">удалить</button>
            </form>
        </div>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
            <th style="width: 5%"></th>
            <th style="width: 20%">Название категории</th>
            <th style="width: 40%">Тип использования</th>
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
        <h1>Методы оплаты</h1>
        <div class="controlBtns">
            <button id="addPaymentBtn" class="btn btn-success">добавить</button>
            <form action="{{ route('payment-type.destroy') }}" id="form-payment-type" method="post">
                @csrf
                <input type="hidden" id="destroy-payment-type" name="ids">
                <button id="removePaymentBtn" class="btn btn-warning remove-btn" data-ref="payment-type">удалить</button>
            </form>
        </div>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
            <th style="width: 5%"></th>
            <th style="width: 20%">Название метода</th>
            <th style="width: 40%">Заметки</th>
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
        <h1>Валюта</h1>
        <div class="controlBtns">
            <button id="addCurrencyBtn" class="btn btn-success">добавить</button>
            <form action="{{ route('currencies.destroy') }}" id="form-currencies" method="post">
                @csrf
                <input type="hidden" id="destroy-currencies" name="ids">
                <button id="removeCurrencyBtn" class="btn btn-warning remove-btn" data-ref="currencies">удалить</button>
            </form>
        </div>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
            <th style="width: 5%"></th>
            <th style="width: 20%">Название валюты</th>
            <th style="width: 40%">Символ</th>
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
            <label for="name-category">Название</label>
            <input
                type="text"
                placeholder="Название"
                name="name"
                id="name-category"
            >
            <label for="type-category">Тип использования категории</label>
            <select id="type-category" name="type_id" test-id="category-type">
                @foreach($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-success" test-id="category-save">Сохранить</button>
        </form>
    </div>
</div>

<div id="addPaymentPopup" class="popup">
    <div class="popup-content">
        <a href="javascript:void(0)" class="popupCloseBtn"><i class="fas fa-times"></i></a>
        <form action="{{ route('payment-type.store') }}" method="post">
            @csrf
            <label for="payment-name">Название категории</label>
            <input
                type="text"
                placeholder="Название категории"
                name="name"
                id="payment-name"
            >
            <label for="payment-notes">Заметки</label>
            <input
                type="text"
                placeholder="Заметки"
                name="notes"
                id="payment-notes"
            >
            <button type="submit" class="btn btn-success" test-id="payment-save">Сохранить</button>
        </form>
    </div>
</div>

<div id="addCurrencyPopup" class="popup">
    <div class="popup-content">
        <a href="javascript:void(0)" class="popupCloseBtn"><i class="fas fa-times"></i></a>
        <form action="{{ route('currencies.store') }}" method="post">
            @csrf
            <label for="currency-name">Название валюты</label>
            <input
                type="text"
                placeholder="Название валюты"
                name="name"
                id="currency-name"

            >
            <label for="currency-symbol">Символ</label>
            <input
                type="text"
                placeholder="Символ"
                name="symbol"
                id="currency-symbol"
            >
            <button type="submit" class="btn btn-success" test-id="currency-save">Сохранить</button>
        </form>
    </div>
</div>

@endsection
