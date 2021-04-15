@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center flex-column">
            <h2>Currencies - Exchange rates for {{ $baseCurrency->symbol }}</h2>
            <p>Base Currency: <b class="text-danger">{{$baseCurrency->symbol ?? '-'}}
                    ({{$baseCurrency->description ?? '-'}})</b></p>
            @if($baseCurrency)
                <a href="{{ route('currency.index') }}" class="btn btn-sm btn-outline-primary">View Currencies</a>
            @endif
        </div>

        <table class="table table-hover mt-5">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Currency</th>
                <th scope="col">Rate</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $key => $datum)
                <tr>
                    <th scope="row">{{ ++$loop->index }}</th>
                    <td>{{$key}}</td>
                    <td>{{round($datum, 3)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

