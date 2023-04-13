@extends('admin.layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.divisions.create') }}">Crearte Division</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Division</li>
                </ol>
            </nav>
            <div class="card-header">
                Add Product
            </div>
            <div class="div card-body">
                @include('partials.messages')
                <form class="forms-sample" action="{{ route('admin.divisions.update', $division->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Division Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $division->name }}">
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <input type="text" class="form-control" name="priority" id="priority" value="{{ $division->priority }}">
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Update Division</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>

        </div>

    </div>
    @endsection
