@extends('layouts.app')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-message">
            {{ Session::get('success') }}
        </div>
    @endif
    <div style="margin-top: 10px">
        <a href="{{ route('home') }}"><button type="button" class="btn btn-outline-primary">Back</button></a>
        <a href="{{ route('purchase.create') }}" style="float: right"><button  type="button" class="btn btn-outline-primary">Add a New Purchase</button></a>
    </div>
    <div style="margin-top: 20px">
        <table class="table table-striped" style="margin-top: 5px; font-size:80%" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">Date</th>
                    <th scope="col">Invoice No</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Purchase Type</th>
                    <th scope="col">Remark</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
    
            <tbody>
                @php
                    $i = 0;    
                @endphp
                
                @foreach ($purchase as $row)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $row->date }}</td>
                        <td>{{ $row->invoice_no }}</td>
                        <td>{{ $row->supplier->name }}</td>
                        <td>{{ $row->purchase_type }}</td>
                        <td>{{ $row->remark }}</td>
                        @if ($row->status == 'running' && $row->purchase_type == 'Return')
                            <td><a href="{{ route('purchaseReturn.create', ['id'=>$row->supplier->id, 'pid'=>$row->id]) }}"><button type="button" class="btn btn-outline-secondary">Continue</button></a></td>
                        @elseif ($row->status == 'running')
                            <td><a href="{{ route('purchaseItem.create', ['var'=>$row->id]) }}"><button type="button" class="btn btn-outline-secondary">Continue</button></a></td>
                        @else
                            <td><a href="{{ route('purchaseItem.final', ['id'=>$row->id]) }}"><button type="button" class="btn btn-outline-secondary">Statement</button></a></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection