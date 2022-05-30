@extends('layouts.app')

@section('content')

    @if (Session::has('success'))
        <div class="alert alert-message">
            {{ Session::get('success') }}
        </div>
    @endif

    <a href="{{ route('home') }}"><div class="card" style="width: 5rem; margin: 10px; padding: 5px; float: left; text-align: center;">Back</div></a>
    <a href="{{ route('supplier.create') }}"><div class="card" style="width: 18rem; margin: 10px; padding: 5px; float: right; text-align: center;">Create New Supplier</div></a>
    <table class="table table-dark table-striped" style="margin-top: 5px">
        <thead>
            <tr>
                <th scope="col">S.N</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Contact</th>
                <th scope="col">Contact Person</th>
                <th scope="col">Pan No</th>
                <th scope="col">Email</th>
                <th scope="col">Remark</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody>
            @php
                $i = 0;    
            @endphp
            
            @foreach ($suppliers as $row)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->address }}</td>
                    <td>{{ $row->contact }}</td>
                    <td>{{ $row->contact_person }}</td>
                    <td>{{ $row->pan_no }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->remark }}</td>
                    <td><a href="{{ route('supplier.edit', $row->id) }}"><button type="button" class="btn btn-secondary">Edit</button></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection