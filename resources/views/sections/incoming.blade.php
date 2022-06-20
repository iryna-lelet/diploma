@extends('layouts.app')

@section('content')
    <div class="controlBtns">
        <button id="addIncomingBtn" class="btn btn-success">добавить</button>
        <form action="{{ route('incomings.destroy') }}" id="form-incomings" method="post">
            @csrf
            <input type="hidden" id="destroy-incomings" name="ids">
            <button id="removeIncomingBtn" class="btn btn-warning remove-btn" data-ref="incomings">удалить</button>
        </form>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
            <th style="width: 5%"></th>
            <th style="width: 13%">Дата</th>
            <th>Мерчант</th>
            <th>Сумма</th>
            <th>Категория</th>
            <th>Метод оплаты</th>
            </thead>
            <tbody>
                @foreach($incomings as $incoming)
                    <tr>
                        <td>
                            <input type="checkbox" data-id="{{ $incoming->id }}" data-table="incomings">
                        </td>
                        <td>{{ $incoming->creation_date }}</td>
                        <td test-id="incoming-merchant">{{ $incoming->merchant }}</td>
                        <td>{{ $incoming->amount }}</td>
                        <td>{{ $incoming->category }}</td>
                        <td>{{ $incoming->payment_type }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($incomings->isEmpty())
            <div style="text-align: center; border-bottom: 1px solid #000000; padding-bottom: 12px">
                No records
            </div>
        @endif
    </div>

    <div class="currenctCurrency">
        <div class="currentCurrencyHolder">
            <a href="javascript:void(0)" class="currencySelectBtn  btn btn-secondary dropdown-toggle">Текущая валюта: <span class="currentCurrencyValue">none</span></a>
            <div class="currencyDropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                <ul>
                    <li class="currencyOption">dollar</li>
                    <li class="currencyOption">euro</li>
                </ul>
            </div>
        </div>
    </div>

    {{--    Popups  --}}
    <div id="addIncomingRecord" class="popup">
        <div class="popup-content">
            <a href="javascript:void(0)" class="popupCloseBtn"><i class="fas fa-times"></i></a>
            <form action="{{ route('incomings.store') }}" method="post">
                @csrf
                <label for="incomings-creation_date">Дата</label>
                <input
                    type="date"
                    placeholder="Дата"
                    name="creation_date"
                    id="date-picker"
                >
                <label for="incomings-merchant">Описание</label>
                <input
                    type="text"
                    placeholder="Описание"
                    name="merchant"
                    id="incomings-merchant"
                >
                <label for="incomings-amount">Сумма</label>
                <input
                    type="number"
                    placeholder="Сумма"
                    name="amount"
                    id="incomings-amount"
                >
                <label for="category-incomings">Категория</label>
                <select id="category-incomings" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
                <label for="payment-type-incoming">Способ оплаты</label>
                <select name="payment_type_id" id="payment-type-incoming">
                    @foreach($paymentMethods as $paymentMethod)
                        <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success" test-id="save-incoming">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
