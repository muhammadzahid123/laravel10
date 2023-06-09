@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if((session::has('success'))
<div class="alert alert-success">
    <p>{{ session::get('success') }}</p>
</div>
@endif
