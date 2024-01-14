@extends('layout')

@section('title', 'Forecast')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>city</th>
                <th>temperature</th>
                <th>created_at</th>
                <th>updated_at</th>
            </tr>
        </thead>

        <tbody>
        @foreach($forecasts as $forecast)
            <tr>
                <td>{{ $forecast->id }}</td>
                <td>{{ $forecast->city }}</td>
                <td>{{ $forecast->temperature }}</td>
                <td>{{ $forecast->created_at }}</td>
                <td>{{ $forecast->updated_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
