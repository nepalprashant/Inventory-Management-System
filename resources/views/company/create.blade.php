@extends('layouts.app')

@section('content')
    <div class="card card-body shadow" style="transform: none; box-shadow: none; margin-top: 10px;">
        <form class="row g-3" method="POST" action="{{ route('company.save') }}">
            @csrf 
            <div class="col-12">
              <label for="inputAddress" class="form-label">Name</label>
              <input type="text" class="form-control" id="inputAddress" placeholder="Surya" name="name">
            </div>
            <div class="col-6">
              <label for="inputAddress2" class="form-label">Address</label>
              <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" name="address">
            </div>
            <div class="col-6">
                <label for="inputAddress2" class="form-label">Country</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Nepal" name="country">
              </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
    </div>
    <a href="{{ route('company.index') }}"><div class="card" style="width: 5rem; margin: 10px; padding: 5px; float: left; text-align: center;">Back</div></a>
@endsection