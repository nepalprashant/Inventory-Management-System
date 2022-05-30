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
        <form class="row g-3" method="POST" action="{{ route('customer.save') }}">
            @csrf 
            <div class="col-12">
                <label for="inputAddress" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Rajesh Hamal" name="name" required value="{{ old('name') }}">
            </div>
            <div class="col-6">
                <label for="inputAddress2" class="form-label">Contact</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="98xxxxxxxx" name="contact" required value="{{ old('contact') }}">
            </div>
            <div class="col-6">
                <label for="inputAddress2" class="form-label">Country</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" name="address" required value="{{ old('address') }}">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <a href="{{ route('customer.index') }}"><div class="card" style="width: 5rem; margin: 10px; padding: 5px; float: left; text-align: center;">Back</div></a>
    
@endsection