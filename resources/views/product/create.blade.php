@extends('layouts.app')

@section('content')
    <div class="card card-body shadow" style="transform: none; box-shadow: none; margin-top: 10px;">
        <form class="row g-3" method="POST" action="{{ route('product.save') }}">
            @csrf
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Code</label>
                <input type="text" class="form-control" id="inputEmail4" name="code">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Barcode</label>
                <input type="text" class="form-control" id="inputPassword4" name="barcode">
            </div>
            <div class="col-6">
                <label for="inputAddress" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Clinic Plus Shampooho" name="name">
            </div>
            <div class="col-md-6">
                <label for="inputState" class="form-label">Category</label>
                <select id="inputState" class="form-select" name="category">
                    <option selected>Choose...</option>
                    <option>Cosmetics</option>
                    <option>Electronics</option>
                    <option>Pastery</option>
                    <option>Fruits & Vegetables</option>
                    <option>Grains</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="inputCity" class="form-label">Unit</label>
                <input type="text" class="form-control" id="inputCity" placeholder="sack" name="unit">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Pack</label>
                <select id="inputState" class="form-select" name="pack">
                    <option selected>Choose...</option>
                    <option>Non Packeted</option>
                    <option>Paper Boxes</option>
                    <option>Corrugated Boxes</option>
                    <option>Plastic Boxes</option>
                    <option>Rigid Boxes</option>
                    <option>Chip Board Packaging</option>
                    <option>Poly Bags</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Company</label>
                <select id="inputState" class="form-select" name="company_id">
                    <option selected>Choose...</option>
                    @foreach ($companies as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>

    <a href="{{ route('product.index') }}"><div class="card" style="width: 5rem; margin: 10px; padding: 5px; float: left; text-align: center;">Back</div></a>
@endsection