@extends('layouts.app')

@section('content')
    <a href="{{ route('purchase.index') }}"><div class="card" style="width: 5rem; margin: 10px; padding: 5px; text-align: center;">Back</div></a>

    <div class="col-md-12">
        <div class="card card-body shadow" style="transform: none; box-shadow: none; margin-top: 20px;">
            <h3 style="text-align: center">{{ $purchase->purchase_type }} # {{ $purchase->id }}</h3>
            <p style="text-align: right">Date: {{ $purchase->date }}</p>
            <p style="text-align: right">Invoice No: {{ $purchase->invoice_no }}</p>
            <p>Supplier: {{ $purchase->supplier->name }}</p>
            <table class="table table-bordered" style="margin-top: 15px">
                <thead class="table table-light">
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Product Code-Name</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Discount %</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $x = 1;
                    @endphp
                    @foreach ($purchase->items as $item)
                        <tr style="text-align: center">
                            <td>{{ $x++ }}</td>
                            <td>{{ $item->product->code.' - ' }}{{ $item->product->name }}</td>
                            <td>{{ $item->product->unit }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->rate }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->discount }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table table-light">
                    <tr>
                        <th scope="row">Total Amount</th>
                        <td colspan="4"></td>
                        <td>{{ $purchase->total_amount }}</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <th scope="row">Discount Amount</th>
                        <td colspan="4"></td>
                        <td>{{ $purchase->total_discount }}</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <th scope="row">Rounding Amount</th>
                        <td colspan="4"></td>
                        <td>{{ $purchase->rounding_amount }}</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <th scope="row">Net Amount</th>
                        <td colspan="4"></td>
                        <td>{{ $purchase->net_amount }}</td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
            <div>
                <p>Checked By: {{ $purchase->user->name }}</p>
            </div>
        </div>
    </div>
    
@endsection