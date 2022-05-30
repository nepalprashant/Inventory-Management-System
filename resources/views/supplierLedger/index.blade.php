@extends('layouts.app')

@section('content')
    <div class="card card-body shadow" style="transform: none; box-shadow: none; margin-top: 10px;">
        <form class="row g-3" method="POST" action="{{ route('supplierLedger.show') }}">
            @csrf
            <div class="col-md-4">
                <select id="inputState" class="form-select" name="supplier_id" required>
                    <option selected disabled value="">----Select Here----</option>
                    @foreach ($suppliers as $item)
                        <option value="{{ $item->id }}"{{ ($item->id == old('supplier_id'))? 'selected':'' }}>{{ $item->name }}</option>
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
            <tfoot>
                <tr>
                    <td colspan="4">Total</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection