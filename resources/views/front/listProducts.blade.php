
@extends('front')

@section('title', 'Product list')

@section('content')

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <th>Name</th>
                <th>Code</th>
                <th>VAT</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Order</th>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->code }}</td>
                        <td>@percentage($product->vat)</td>
                        <td>@price($product->price)</td>
                        <td class="form-group">
                            <input type="text" class="form-control" value="1" size="3">
                        </td>
                        <td>
                            <button class='btn btn-primary'>
                                <i class='fa fa-fw fa-cart-plus'></i>
                                Add to card
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
