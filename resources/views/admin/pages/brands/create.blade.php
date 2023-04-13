@extends('admin.layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.brands') }}">Brands</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Brand</li>
                </ol>
            </nav>
            <div class="card-header">
                Add Brand
            </div>
            <div class="div card-body">
                @include('partials.messages')
                <form class="forms-sample" action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Brand Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="80" rows="8"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="product_image">Brand Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Add Brand</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>

        </div>

    </div>
    @endsection
