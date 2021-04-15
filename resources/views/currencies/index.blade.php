@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center flex-column">
            <h2>Currencies</h2>
            <p>Base Currency: <b class="text-danger">{{$baseCurrency->symbol ?? '-'}}
                    ({{$baseCurrency->description ?? '-'}})</b></p>
            @if($baseCurrency)
                <a href="{{ route('currency.rates', ['symbol' => $baseCurrency->symbol]) }}" class="btn btn-sm btn-outline-primary">View Exchange Rate</a>
            @endif
        </div>

        <table class="table table-hover mt-5">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Currency</th>
                <th scope="col">Description</th>
                <th class="text-center">Base</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $key => $datum)
                <tr>
                    <th scope="row">{{ ++$key }}</th>
                    <td>{{$datum->symbol}}</td>
                    <td>{{$datum->description}}</td>
                    <td class="text-center">
                        @if($baseCurrency && $datum->symbol ===  $baseCurrency->symbol)
                            <strong style="font-size: 1.3rem" class="text-danger">&#9679;</strong>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('currency.setBase') }}" method="post">
                            @csrf
                            <input type="hidden" name="currency_id" value="{{$datum->id}}">
                            @if($baseCurrency && $datum->symbol !==  $baseCurrency->symbol)
                                <button type="submit" class="btn btn-outline-primary">Set as base</button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

