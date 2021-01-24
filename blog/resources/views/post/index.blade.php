@extends('layouts.master')
@section('title')
    Laravel-Post
@endsection
@section('scripts')
    <link rel="stylesheet" href="{{ URL::to('src/css/style.css') }}">
@endsection

@section('content')
  {{-- @foreach ($products->chunk(3) as $productChunk)
    <div class="card-deck my-3">
      @foreach ($productChunk as $product)
        <div class="card">
          <img src="{{ $product->imagePath }}" class="card-img-top img-responsive" alt="...">
          <div class="card-body">
            <h5 class="card-title">{{ $product->title }}</h5>
            <p class="card-text">{{ $product->description }}</p>
          </div>
          <div class="card-footer d-flex justify-content-between align-items-center">
            <span class="price">{{ $product->price }}</span>
            <span class="">
                <a href="{{ route('product.addToCart', ['id' => $product->id]) }}" class="btn btn-primary" role="button">Add to Cart</a>
            </span>
          </div>
        </div>
      @endforeach
    </div>
  @endforeach --}}
@endsection