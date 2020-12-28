@extends('layouts.app')

@section('title', 'Project Taskers - Dodawanie zadania')

@section('content')

<div class="container">
    <div class="row py-5">
        <div class="col-sm-12 col-lg-8 offset-lg-2">
            <p>
                <a href="{{ url()->previous() }}">
                    &larr; Wróć do listy zadań
                </a>
            </p>

            @include('staff.tasks.components.form', [
                'action'        => route('staff.tasks.store'),
                'titleValue'    => old('title'),
                'contentValue'  => old('content'),
                'tagsValue'     => old('tags', []),
                'submitBtnText' => 'Dodaj Zadanie'
            ])
        </div>
    </div>
</div>

@endsection