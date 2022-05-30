@extends('layouts.app')

@section('content')
    <div class="card card-body shadow" style="transform: none; box-shadow: none; margin-top: 10px;">
        <form class="row g-3" method="POST" action="{{ route('customer.update', $data->id) }}">
            @csrf 
            <div class="col-12">
            <label for="inputAddress" class="form-label">Name</label>
            <input type="text" class="form-control" id="inputAddress" value="{{ $data->name }}" name="name">
            </div>
            <div class="col-6">
            <label for="inputAddress2" class="form-label">Address</label>
            <input type="text" class="form-control" id="inputAddress2" value="{{ $data->contact }}" name="contact">
            </div>
            <div class="col-6">
                <label for="inputAddress2" class="form-label">Country</label>
                <input type="text" class="form-control" id="inputAddress2" value="{{ $data->address }}" name="address">
            </div>
            <div class="col-12">
            <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    <a href="{{ route('customer.index') }}"><div class="card" style="width: 5rem; margin: 10px; padding: 5px; float: left; text-align: center;">Back</div></a>
@endsection