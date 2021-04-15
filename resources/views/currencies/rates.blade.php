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
                <th scope="col">Threshold</th>
            </tr>
            </thead>
            <tbody>
            @error('rate')
            <div class="mt-3 mb-2 text-center alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            @foreach($data as $key => $datum)
                <tr>
                    <th scope="row">{{ ++$loop->index }}</th>
                    <td>{{ $key }}</td>
                    <td>{{ round($datum, 3) }}</td>
                    <td>
                        <form method="post" action="{{ route('currency.setThreshold') }}">
                            @csrf
                            <div class="input-group">
                                <input type="hidden" name="symbol" value="{{ $key }}">
                                <input type="number" min="0" value="0" class="form-control" placeholder="Enter rate" name="rate">
                                <div class="input-group-append" id="button-addon4">
                                    <button class="btn btn-outline-secondary" type="submit">Add threshold</button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

