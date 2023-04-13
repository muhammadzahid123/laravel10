@extends('admin.layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.brands.create') }}">Crearte Brand</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Category</li>
                </ol>
            </nav>
            <div class="card-header">
                Edit Brands
            </div>
            <div class="div card-body">
                @include('partials.messages')
                <form class="forms-sample" action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Category Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $brand->name }}" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="80" rows="8">{{ $brand->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="old-image">Category Old Image</label><br><br>
                        <img src="{{ asset('images/brands/'.$brand->image ) }}" width="100" height="100" alt="" srcset=""><br><br>
                        <label for="new-image">Category New Image (optional)</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Update Category</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>

        </div>

    </div>
    @endsection
