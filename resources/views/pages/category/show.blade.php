@extends('layouts.master')

@section('content')
    <div class="container margin-top-20">
        <div class="row">
            <div class="col-md-4">
                @include('partials.product-sidebar')
            </div>
            <div class="col-md-8">
                <div class="widgets">
                    <h3>All Products in <span class="badge badge-info">{{ $category->name }}</span></h3>
                    @php
                        $products = $catgeory->products;
                    @endphp

                    @if($products->count() > 0)
                    @include('pages.product.partials.all_products')
                    @else
                     <div class="alert alert-warning">
                      No product has been added yet in this category
                     </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
