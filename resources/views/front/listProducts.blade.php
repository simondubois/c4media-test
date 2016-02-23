
@extends('front')

@section('title', 'Product list')

@section('content')
    @foreach ($products as $product)
        {{ var_dump($product->toArray()) }}
    @endforeach
@endsection
