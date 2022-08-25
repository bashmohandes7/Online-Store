@extends('layouts.dashboard')
@section('title', 'Home')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Home</li>
@endsection
@section('content')
    <h1>Hello Laravel</h1>

@endsection
