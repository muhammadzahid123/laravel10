@extends('layouts.master')
@section('title')
{{ $products->title }} | Laravel Ecommerce Site
@endsection
@section('content')
<div class="container margin-top-20">
    <div class="row">
        <div class="col-md-4">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($products->images as $image)
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('images/'.$image->image) }}" alt="First slide">
                    </div>
                    @endforeach
                </div>
                <div class="mt-3">
                    <p>Category&nbsp; <span class="badge badge-info">{{ $products->category->name }}</span></p>
                    <p>Brand&nbsp; <span class="badge badge-info">{{ $products->brand->name }}</span></p>
                </div>
            </div>

        </div>
        <div class="col-md-8">
            <div class="div widgets">
                <h3>{{ $products->title }}</h3>
                <h3>{{ $products->price }} Rs <span class="badge badge-primary">
                        {{ $products->quantity < 1 ? 'No Item Available' :  $products->quantity.'item in stock'}}
                    </span> </h3>
                <hr>

                <h3>{{ $products->description }}</h3>

            </div>
        </div>
    </div>
</div>
@endsection
