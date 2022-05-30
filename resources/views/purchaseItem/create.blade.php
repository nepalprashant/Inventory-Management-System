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
            <form class="row g-3" method="POST" action="{{ route('purchaseItem.save', ['id'=>$purchase->id]) }}">
                @csrf
                <div class="col-md-3">
                    <label for="inputState" class="form-label">Item</label>
                    <select id="inputState" class="form-select" name="item" required>
                        <option selected disabled value="">----Select Here----</option>
                        @foreach ($products as $item)
                            <option value="{{ $item->id }}"{{ ((old('item') == $item->id)? 'selected':'') }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">Quantity</label>
                    <input type="number" name="quantity" min="1" placeholder="Quantity" class="form-control" required value="{{ old('quantity') }}">
                </div>
                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">Rate</label>
                    <input type="number" name="rate" min="1" placeholder="Rate" class="form-control" required value="{{ old('rate') }}">
                </div>
                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">Discount %</label>
                    <input type="number" name="discount" min="0" max="99" placeholder="Discount" class="form-control" required value="{{ old('discount') }}">
                </div>
                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">S.P</label>
                    <input type="text" name="sp" placeholder="Selling Price" class="form-control" required value="{{ old('sp') }}">
                </div>
                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">M.P</label>
                    <input type="text" name="mrp" placeholder="Marked Price" class="form-control" required value="{{ old('mrp') }}">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>

    <div class="card card-body shadow" style="transform: none; box-shadow: none; margin-top: 20px;">
        <div style="text-align: center"><h3>{{ $purchase->purchase_type }} # {{ $purchase->id }}</h3></div>
        <table class="table" style="margin-top: 15px">
            <thead class="table table-light">
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">Product Code-Name</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Discount %</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $x = 1;
                @endphp
                @foreach ($purchase->items as $item)
                    <tr style="text-align: center">
                        <td>{{ $x++ }}</td>
                        <td>{{ $item->product->code.'-' }}{{ $item->product->name }}</td>
                        <td>{{ $item->product->unit }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->rate }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ $item->discount }}</td>
                        <td><a href="{{ route('purchaseItem.delete', ['id'=>$item->id, 'pid'=>$purchase->id]) }}"><button type="button" class="btn btn-outline-danger">Delete</button></a></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="table table-light">
                <tr>
                    <th scope="row">Total Amount</th>
                    <td colspan="4"></td>
                    <td>{{ $purchase->items_sum_amount }}</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <th scope="row">Discount Amount</th>
                    <td colspan="4"></td>
                    <td>{{ $purchase->items_sum_discount_amount }}</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <th scope="row">Net Amount</th>
                    <td colspan="4"></td>
                    <td>{{ $purchase->items_sum_amount - $purchase->items_sum_discount_amount }}</td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>

        <form class="row g-3" method="POST" action="{{ route('purchaseItem.show', ['id'=>$purchase->id]) }}">
            @csrf
            <div class="col-md-4">
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Shipping Charge" name="shipping_charge" style="text-align: center" value="{{ old('shipping_charge') }}">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Adjustable Discount" name="adjustable_discount" style="text-align: center" value="{{ old('adjustable_discount') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary" style="float: right;">Save</button>
            </div>
        </form>
    </div>
@endsection