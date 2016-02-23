
@extends('front')

@section('title', 'Product list')

@section('content')

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <th>Name</th>
                <th>Code</th>
                <th>VAT</th>
                <th>Price (incl. VAT)</th>
                <th>Quantity</th>
                <th>Order</th>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->code }}</td>
                        <td>@percentage($product->vat)</td>
                        <td>@price($product->price_including_vat)</td>
                        <td class="form-group">
                            <input type="text" class="form-control" id="quantity-product-{{ $product->id }}" value="1" size="3">
                        </td>
                        <td>
                            <orderbutton
                                product-id="{{ $product->id }}"
                                input-quantity="#quantity-product-{{ $product->id }}"
                                action='add'
                            ></orderbutton>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
