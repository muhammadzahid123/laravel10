@extends('admin.layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.districts.create') }}">Create Division</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Division</li>
                </ol>
            </nav>
            <div class="card-header">
                Manage Division
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
                            <th scope="col">Division Name</th>
                            <th scope="col">Divsion Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($district as $districts)
                        <tr>
                            <th scope="row">{{ $districts->id }}</th>
                            <td>{{ $districts->name }}</td>
                            <td>{{ $districts->division->name }}</td>
                            <td>
                                <a href="{{ route('admin.districts.edit', $districts->id) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('admin.districts.destroy', $districts->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>
    @endsection
