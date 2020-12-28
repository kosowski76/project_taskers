@extends('layouts.app')

@section('title', "Staff's Tasks - Project Taskers")

@section('content')

<div class="container">
    <div class="row py-5 justify-content-md-center">
        <div class="col-sm-12 col-lg-8">
            @include('staff.tasks.index.nav')
            @include('staff.tasks.index.list')
        </div>
    </div>
</div>

@endsection