@extends('layouts.master')

@section('content')
<div class="container mt-20">
    <h2> Welcome{{ $user->first_name.' '.$user->last_name  }}</h2>
<p>You can change your profile and every information</p>
</div>

@endsection
