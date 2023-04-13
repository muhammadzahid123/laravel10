@extends('admin.layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                </ol>
            </nav>
            <div class="card-header">
                Add Product
            </div>
            <div class="div card-body">
                @include('partials.messages')
                <form class="forms-sample" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="80" rows="8"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="price">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="price" placeholder="quantity">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="">-- Select Category --</option>

                            @foreach (App\Models\Category::orderBy('id', 'ASC')->whereNull('parent_id')->get(); as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @foreach (App\Models\Category::orderBy('id', 'ASC')->where('parent_id', $parent->id)->get(); as $child)
                            <option value="{{ $child->id }}">------>{{ $child->name }}</option>

                            @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="brand_id">Brand</label>
                        <select class="form-control" name="brand_id" id="brand_id">
                            <option value="">-- Select Brand --</option>
                            @foreach (App\Models\Brand::orderBy('id', 'ASC')->get(); as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_image">Product Image</label>
                        <input type="file" class="form-control" name="product_image" id="product_image">
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Add Product</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>

        </div>

    </div>
    @endsection
