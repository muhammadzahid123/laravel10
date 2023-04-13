@extends('admin.layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.districts.create') }}">Crearte District</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Division</li>
                </ol>
            </nav>
            <div class="card-header">
                Add District
            </div>
            <div class="div card-body">
                @include('partials.messages')
                <form class="forms-sample" action="{{ route('admin.districts.update', $district->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Division Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $district->name }}">
                    </div>
                    <div class="form-group">
                        <label for="division_id">Division</label>
                        <select class="form-control" name="division_id" id="division_id">
                            <option value="">-- Select Division --</option>
                            @foreach (App\Models\Division::orderBy('id', 'ASC')->get(); as $division)
                            <option value="{{ $division->id }}" {{ $division->id == $district->division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Update District</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>

        </div>

    </div>
    @endsection
