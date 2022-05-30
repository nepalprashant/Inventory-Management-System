@extends('layouts.app')

@section('content')
    <div class="card card-body shadow" style="transform: none; box-shadow: none; margin-top: 10px;">
        <form class="row g-3" method="POST" action="{{ route('product.update', $data->id) }}">
            @csrf
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Code</label>
                <input type="text" class="form-control" id="inputEmail4" name="code" value="{{ $data->code }}">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Barcode</label>
                <input type="text" class="form-control" id="inputPassword4" name="barcode" value="{{ $data->barcode }}">
            </div>
            <div class="col-6">
                <label for="inputAddress" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Clinic Plus Shampooho" name="name" value="{{ $data->name }}">
            </div>
            <div class="col-md-6">
                <label for="inputState" class="form-label">Category</label>
                <select id="inputState" class="form-select" name="category" value="{{ $data->category }}">
                    <option value="Cosmetics"{{ ($data->category=="Cosmetics")? 'selected':'' }}>Cosmetics</option>
                    <option value="Electronics"{{ ($data->category=="Electronics")? 'selected':'' }}>Electronics</option>
                    <option value="Pastery"{{ ($data->category=="Pastery")? 'selected':'' }}>Pastery</option>
                    <option value="Fruits & Vegetables"{{ ($data->category=="Fruits & Vegetables")? 'selected':'' }}>Fruits & Vegetables</option>
                    <option value="Grains"{{ ($data->category=="Grains")? 'selected':'' }}>Grains</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="inputCity" class="form-label">Unit</label>
                <input type="text" class="form-control" id="inputCity" placeholder="10" name="unit" value="{{ $data->unit }}">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Pack</label>
                <select id="inputState" class="form-select" name="pack" value="{{ $data->pack }}">
                    <option value="Non Packeted"{{ ($data->pack=="Non Packeted")? 'selected':'' }}>Non Packeted</option>
                    <option value="Paper Boxes"{{ ($data->pack=="Paper Boxes")? 'selected':'' }}>Paper Boxes</option>
                    <option value="Corrugated Boxes"{{ ($data->pack=="Corrugated Boxes")? 'selected':'' }}>Corrugated Boxes</option>
                    <option value="Plastic Boxes"{{ ($data->pack=="Plastic Boxes")? 'selected':'' }}>Plastic Boxes</option>
                    <option value="Rigid Boxes"{{ ($data->pack=="Rigid Boxes")? 'selected':'' }}>Rigid Boxes</option>
                    <option value="Chip Board Packaging"{{ ($data->pack=="Chip Board Packaging")? 'selected':'' }}>Chip Board Packaging</option>
                    <option value="Poly Bags"{{ ($data->pack=="Poly Bags")? 'selected':'' }}>Poly Bags</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Company</label>
                <select id="inputState" class="form-select" name="company_id">
                    @foreach ($companies as $item)
                        <option value="{{ $item->id }}"{{ ($data->company_id==$item->id)? 'selected':'' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

    <a href="{{ route('product.index') }}"><div class="card" style="width: 5rem; margin: 10px; padding: 5px; float: left; text-align: center;">Back</div></a>
@endsection