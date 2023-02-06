
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Aval Qty</th>
            <th>Selling Price</th>
            <th>Purchase Price</th>
            <th>Unit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->name }}</td>
            <td>{{ $record->category }}</td>
            <td>{{ $record->qty }}</td>
            <td>{{ $record->selling_price }}</td>
            <td>{{ $record->purchase_price }}</td>
            <td>{{ $record->unit }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
