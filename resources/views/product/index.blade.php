@extends('layouts.app')

@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <a href="{{ route('home') }}"><div class="card" style="width: 5rem; margin: 10px; padding: 5px; float: left; text-align: center;">Back</div></a>
    <a href="{{ route('product.create') }}"><div class="card" style="width: 18rem; margin: 10px; padding: 5px; float: right; text-align: center;">Add a New Product</div></a>
    <table class="table table-dark table-striped" style="margin-top: 5px">
        <thead>
            <tr>
                <th scope="col">S.N</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Barcode</th>
                <th scope="col">Category</th>
                <th scope="col">Unit</th>
                <th scope="col">Pack</th>
                <th scope="col">Company</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody>
            @php
                $i = 0;    
            @endphp
            
            @foreach ($products as $row)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $row->code }}</td>
                    <td>{{ $row->barcode }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->category }}</td>
                    <td>{{ $row->unit }}</td>
                    <td>{{ $row->pack }}</td>
                    <td>{{ $row->company->name }}</td>
                    <td><a href="{{ route('product.edit', $row->id) }}"><button type="button" class="btn btn-secondary">Edit</button></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection