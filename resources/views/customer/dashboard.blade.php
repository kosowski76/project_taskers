@extends('layouts.app')

@section('title', 'Dashboard - Customer of Project Taskers')

@section('content')

<div class="container">
    <div class="row py-5 justify-content-md-center">
        <div class="col-sm-12 col-lg-8">
            Customer dashboard
            @//include('customer.projects.index.nav')
           @//include('customer.projects.index.list')
        </div>
    </div>
</div>

@endsection