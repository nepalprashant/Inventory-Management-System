@extends('layouts.app')

@section('content')
    <form class="row g-3" method="POST" action="{{ route('purchaseReturnBill.show', ['pid'=>$pid]) }}" style="margin-top: 10px">
        @csrf
        <div class="col-8">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
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
        
        @if (Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>
                        {{ Session::get('error') }}
                    </li>
                </ul>
            </div>
        @elseif (Session::has('fail'))
            <div class='alert alert-danger'>
                <ul>
                    <li>
                        {{ Session::get('fail') }}
                    </li>
                </ul>
            </div>
        @endif

        <form class="row g-3" method="POST" action="{{ route('purchaseReturn.save', ['pid'=>$pid]) }}">
            @csrf
            <div class="col-md-4">
                <label for="inputState" class="form-label">Item</label>
                <select id="inputState" class="form-select" name="product_id" required>
                    <option selected disabled value="">----Select Here----</option>
                    @foreach ($data->purchase as $item)
                        @foreach ($item->items as $x)
                            @php
                                $var = json_decode($x)->product_details;
                            @endphp
                            @if ($var->quantity != 0)
                                <option value="{{ $var->id }}"{{ ($var->id == old('product_id'))? 'selected':'' }}>{{ $var->product->name }} ({{ $var->quantity }})</option>
                            @endif
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">Quantity</label>
                <input type="number" name="quantity" placeholder="Quantity" min="1" class="form-control" value="{{ old('quantity') }}"required>
            </div>
            <div class="col-8">
                <button type="submit" class="btn btn-primary">Return</button>
            </div>
        </form>
    </div>

    <div class="card card-body shadow" style="transform: none; box-shadow: none; margin-top: 10px;">
        <div style="text-align: center"><h5>Return # {{ $data->id }}</h5></div>
        <table class="table" style="margin-top: 15px">
            <thead class="table table-light">
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">Product Code-Name</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Discount %</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $x = 1;
                @endphp
                @foreach ($details as $item)
                    <tr style="text-align: center">
                        <td>{{ $x++ }}</td>
                        <td>{{ $item->product->code.'-' }}{{ $item->product->name }}</td>
                        <td>{{ $item->product->unit }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->discount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection