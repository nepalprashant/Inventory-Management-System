@extends('layouts.app')

@section('content')
    <div class="card card-body shadow" style="transform: none; box-shadow: none; margin-top: 10px;">
        <form class="row g-3" method="POST" action="{{ route('supplier.update', $data->id) }}">
            @csrf
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputEmail4" name="name" value="{{ $data->name }}">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Address</label>
                <input type="text" class="form-control" id="inputPassword4" name="address" value="{{ $data->address }}">
            </div>
            <div class="col-6">
                <label for="inputAddress" class="form-label">Contact</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="" name="contact"
                    value="{{ $data->contact }}">
            </div>
            <div class="col-6">
                <label for="inputAddress" class="form-label">Contact Person</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="" name="contact_person"
                    value="{{ $data->contact_person }}">
            </div>
            <div class="col-6">
                <label for="inputAddress" class="form-label">Pan No</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="" name="pan_no"
                    value="{{ $data->pan_no }}">
            </div>
            <div class="col-6">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="@" name="email" value="{{ $data->email }}">
            </div>
            <div class="col-12">
                <label for="exampleInputEmail1" class="form-label">Remarks</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="remark"
                    value="{{ $data->remark }}">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

    <a href="{{ route('supplier.index') }}">
        <div class="card" style="width: 5rem; margin: 10px; padding: 5px; float: left; text-align: center;">Back
        </div>
    </a>
@endsection
