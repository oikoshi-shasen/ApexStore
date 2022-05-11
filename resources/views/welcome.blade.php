<link rel="stylesheet" href="css/welcome.css">
@extends('layouts.app')

@section('content')
    <div class="btn-wrapper col-md-2 offset-sm-9">
        <a href="/login" class="btn btn-gradient"><span>Log in！</span></a>
        <a href="/signup" class="btn btn-gradient"><span>Sign up！</span></a>
    </div>
@endsection