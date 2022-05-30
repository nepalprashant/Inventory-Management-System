@extends('layouts.app')

@section('content')
    <div class="card card-body shadow" style="transform: none; box-shadow: none; margin-top: 10px;">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('fail'))
            <div class="alert alert-danger">
                <ul>
                    <li>
                        {{ Session::get('fail') }}
                    </li>
                </ul>
            </div>
        @endif
        <form class="row g-3" method="POST" action="{{ route('purchase.save') }}">
            @csrf
            <div class="col-4">
                <label for="exampleInputEmail1" class="form-label">Invoice No</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Invoice No" name="invoice_no"
                    required value="{{ old('invoice_no') }}">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Supplier</label>
                <select id="inputState" class="form-select" name="supplier" required>
                    <option selected disabled value="">----------select supplier---------</option>
                    @foreach ($suppliers as $sup)
                        <option value="{{ $sup->id }}" {{ old('supplier') == $sup->id ? 'selected' : '' }}>
                            {{ $sup->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Purchase Type</label>
                <select id="inputState" class="form-select" name="purchase_type" required>
                    @foreach ($purchase_t as $pur)
                        <option {{ old('purchase_type') == $pur ? 'selected' : '' }}>{{ $pur }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label for="exampleInputEmail1" class="form-label">Remarks</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="remark"
                    value="{{ old('remark') }}">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Next</button>
            </div>
        </form>
    </div>
    <a href="{{ route('purchase.index') }}">
        <div class="card" style="width: 5rem; margin: 10px; padding: 5px; float: left; text-align: center;">Back
        </div>
    </a>
@endsection
