@extends('layouts.app')

@section('content')
    <a href="{{ route('home') }}"><div class="card" style="width: 5rem; margin: 10px; padding: 5px; float: left; text-align: center;">Back</div></a>
    <table class="table table-dark table-striped" style="margin-top: 5px">
        <thead>
            <tr>
                <th scope="col">S.N</th>
                <th scope="col">Batch</th>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">SP</th>
                <th scope="col">Mrp</th>
            </tr>
        </thead>

        <tbody>
            @php
                $i = 0; 
            @endphp
            
            @foreach ($data as $row)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $row->batch }}</td>
                    <td>{{ $row->product->name }}</td>
                    <td>{{ $row->quantity }}</td>
                    <td>{{ $row->sp }}</td>
                    <td>{{ $row->mrp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection