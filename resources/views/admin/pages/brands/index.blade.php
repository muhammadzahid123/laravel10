@extends('admin.layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.brands.create') }}">Create Brands</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Category</li>
                </ol>
            </nav>
            <div class="card-header">
                Manage Brand
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @endif
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Brand Image</th>
                            <th scope="col">Brand Name</th>
                            <th scope="col">Parent Brand</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brand as $brands)
                        <tr>
                            <th scope="row">{{ $brands->id }}</th>
                            <td><img src="{{ asset('images/brands/'.$brands->image ) }}" width="100" height="100" alt="" srcset=""></td>
                            <td>{{ $brands->name }}</td>
                            <td>
                                @if($brands->parent_id == NULL)
                                Primary Category
                                @else
                                {{ $brands->parent->name }}
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.brands.edit', $brands->id) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('admin.brands.destroy', $brands->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>
    @endsection
