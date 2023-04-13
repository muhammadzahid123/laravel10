@extends('admin.layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.divisions.create') }}">Create Division</a></li>
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
                            <th scope="col">Priority</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($division as $divisions)
                        <tr>
                            <th scope="row">{{ $divisions->id }}</th>
                            <td>{{ $divisions->name }}</td>
                            <td>{{ $divisions->priority }}</td>
                            <td>
                                <a href="{{ route('admin.divisions.edit', $divisions->id) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('admin.divisions.destroy', $divisions->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>
    @endsection
