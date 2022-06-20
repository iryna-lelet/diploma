@extends('layouts.app')

@section('content')

<h1>Hello, {{ $LoggedInUser['name'] }}</h1>

<div>
    Dashboard!
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
@endsection
