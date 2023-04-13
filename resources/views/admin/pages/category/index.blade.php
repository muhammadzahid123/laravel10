@extends('admin.layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.categories.create') }}">Create Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Category</li>
                </ol>
            </nav>
            <div class="card-header">
                Manage Category
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
                            <th scope="col">Category Image</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Parent CAtegory</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $categories)
                        <tr>
                            <th scope="row">{{ $categories->id }}</th>
                            <td><img src="{{ asset('images/categories/'.$categories->image ) }}" width="100" height="100" alt="" srcset=""></td>
                            <td>{{ $categories->name }}</td>
                            <td>
                                @if($categories->parent_id == NULL)
                                Primary Category
                                @else
                                {{ $categories->parent->name }}
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.categories.edit', $categories->id) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('admin.categories.destroy', $categories->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>
    @endsection
