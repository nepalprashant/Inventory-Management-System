@extends('layouts.app')

@section('content')
    <div class="card card-body shadow" style="transform: none; box-shadow: none; margin-top: 10px;">
        <form class="row g-3" method="POST" action="{{ route('supplierLedger.show') }}">
            @csrf
            <div class="col-md-4">
                <select id="inputState" class="form-select" name="supplier_id" required>
                    @php
                        $var = '';
                    @endphp
                    <option selected disabled value="">----Select Here----</option>
                    @foreach ($suppliers as $item)
                        <option value="{{ $item->id }}"{{ $check = ($item->id == optional($details->first())->supplier_id)? 'selected':'' }}>{{ $item->name }}</option>
                        @php
                            if($check == 'selected'){
                                $var = $item->name;
                            }
                        @endphp
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary">Display</button>
            </div>
        </form>
    </div>

    <div class="card card-body shadow" style="transform: none; box-shadow: none; margin-top: 10px;">
        <table class="table" style="margin-top: 15px">
            <h4 style="text-align: center">Supplier Ledger: {{ $var }}</h4>
            <thead class="table table-light">
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">Date</th>
                    <th scope="col">Purchase Type</th>
                    <th scope="col">Invoice No</th>
                    <th scope="col">Debit (Dr.)</th>
                    <th scope="col">Credit (Cr.)</th>
                    <th scope="col">Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $x = 1;
                @endphp
                @foreach ($details as $item)
                    <tr style="text-align: center">
                        <td>{{ $x++ }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->purchase_type }}</td>
                        <td>{{ $item->invoice_no }}</td>
                        <td>{{ $item->debit }}</td>
                        <td>{{ $item->credit }}</td>
                        <td>{{ $item->balance }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot style="text-align: center">
                <tr>
                    <td colspan="4" style="text-align: left">Total</td>
                    <td>{{ $details->sum('debit') }}</td>
                    <td>{{ $details->sum('credit') }}</td>
                    <td>{{ $details->sum('debit') - $details->sum('credit') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection