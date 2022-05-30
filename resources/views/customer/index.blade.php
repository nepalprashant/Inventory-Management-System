@extends('layouts.app')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <a href="{{ route('home') }}">
        <div class="card" style="width: 5rem; margin: 10px; padding: 5px; float: left; text-align: center;">Back
        </div>
    </a>
    <a href="{{ route('customer.create') }}">
        <div class="card" style="width: 18rem; margin: 10px; padding: 5px; float: right; text-align: center;">
            Create New Customer</div>
    </a>
    <table class="table table-dark table-striped" style="margin-top: 5px">
        <thead>
            <tr>
                <th scope="col">S.N</th>
                <th scope="col">Name</th>
                <th scope="col">Contact</th>
                <th scope="col">Address</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody>
            @php
                $i = 0;
            @endphp

            @foreach ($customers as $row)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->contact }}</td>
                    <td>{{ $row->address }}</td>
                    <td><a href="{{ route('customer.edit', $row->id) }}"><button type="button"
                                class="btn btn-secondary">Edit</button></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
