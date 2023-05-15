@extends('layouts.app')

@section('content')
    <div class="controlBtns">
        <button id="addOutgoingBtn" class="btn btn-success">add</button>
        <form action="{{ route('outgoings.destroy') }}" id="form-outgoings" method="post">
            @csrf
            <input type="hidden" id="destroy-outgoings" name="ids">
            <button id="removeOutgoingBtn" class="btn btn-warning remove-btn" data-ref="outgoings">delete</button>
        </form>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
            <th style="width: 5%"></th>
            <th style="width: 13%">Date</th>
            <th>Merchant</th>
            <th>Amount</th>
            <th>Category</th>
            <th>Payment method</th>
            </thead>
            <tbody>
                @foreach($outgoings as $outgoing)
                    <tr>
                        <td>
                            <input type="checkbox" data-id="{{ $outgoing->id }}" data-table="outgoings">
                        </td>
                        <td>{{ $outgoing->creation_date }}</td>
                        <td test-id="grid-outgoing-merchant">{{ $outgoing->merchant }}</td>
                        <td>{{ $outgoing->amount }}</td>
                        <td>{{ $outgoing->category }}</td>
                        <td>{{ $outgoing->payment_type }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($outgoings->isEmpty())
            <div style="text-align: center; border-bottom: 1px solid #000000; padding-bottom: 12px">
                No records
            </div>
        @endif
    </div>
    <div class="currenctCurrency">
        <div class="currentCurrencyHolder">
            <a href="javascript:void(0)" class="currencySelectBtn  btn btn-secondary dropdown-toggle">Currency: <span class="currentCurrencyValue">none</span></a>
            <div class="currencyDropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                <ul>
                    <li class="currencyOption">dollar</li>
                    <li class="currencyOption">euro</li>
                </ul>
            </div>
        </div>
    </div>

    {{--    Popups  --}}
    <div id="addOutgoingRecord" class="popup">
        <div class="popup-content">
            <a href="javascript:void(0)" class="popupCloseBtn"><i class="fas fa-times"></i></a>
            <form action="{{ route('outgoings.store') }}" method="post">
                @csrf
                <label for="outgoings-creation_date">Date</label>
                <input
                    type="date"
                    placeholder="Date"
                    name="creation_date"
                    id="date-picker"
                >
                <label for="outgoings-merchant">Description</label>
                <input
                    type="text"
                    placeholder="Description"
                    name="merchant"
                    id="outgoings-merchant"
                >
                <label for="outgoings-amount">Amount</label>
                <input
                    type="number"
                    placeholder="Amount"
                    name="amount"
                    id="outgoings-amount"
                >
                <label for="category-outgoings">Category</label>
                <select id="category-outgoings" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
                <label for="payment-type-outgoings">Payment method</label>
                <select name="payment_type_id" id="payment-type-outgoings">
                    @if(!$paymentMethods->isEmpty())
                        @foreach($paymentMethods as $paymentMethod)
                            <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                        @endforeach
                    @endif
                </select>
                <button type="submit" class="btn btn-success" test-id="save-outgoing">save</button>
            </form>
        </div>
    </div>
@endsection
