@extends('admin.layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card card-body">
            <h3>Welcome To Your Admin</h3><br><br>
            <p>
                <a href="{{ route('index') }}" class="btn btn-primary btn-lg" target="_blank">Visit Main Site</a>
            </p>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
        </div>
    </footer>
</div>
@endsection
