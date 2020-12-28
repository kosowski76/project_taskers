@extends('layouts.app')

@section('title', 'Dashboard - Staff of Project Taskers')

@section('content')

<div class="container">
    <div class="row py-5 justify-content-md-center">
        <div class="col-sm-12 col-lg-8">
            Staff dashboard
            @//include('tasks.index.nav')
           @//include('tasks.index.list')
        </div>
    </div>
</div>

@endsection