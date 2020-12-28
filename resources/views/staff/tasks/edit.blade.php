@extends('layouts.app')

@section('title', 'Projects Tasker - edycja zadania')

@section('content')

<div class="container">
    <div class="row py-5">
        <div class="col-sm-12 col-lg-8 offset-lg-2">
            <p>
                <a href="{{ url()->previous() }}">
                    &larr; Wróć do listy zadań
                </a>
            </p>
            <p>
                <a href="{{ route('staff.tasks.show', ['task' => $task]) }}">
                    &larr; Wróć do zadania:&nbsp;
                    <b>{{ $task->title }}</b>
                </a>
            </p>
            @include('staff.tasks.components.form', [
                'action'        => route('staff.tasks.update', ['task' => $task]),
                'formMethod'    => 'POST',
                'method'        => 'PUT',
                'titleValue'    => old('title', $task->title),
                'contentValue'  => old('content', $task->content), 
                'submitBtnText' => 'Zauktualizuj Zadanie'
            ])
        </div>
    </div>
</div>

@endsection