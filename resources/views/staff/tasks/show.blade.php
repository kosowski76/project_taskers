@extends('layouts.app')

@section('title', 'Project Taskers - Szczegóły zadania')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="col-sm-12 col-lg-8 offset-lg-2 mb-3">
            <div class="d-flex w-100 justify-content-between">
                <p>
                    <a href="{{ route('staff.tasks.index') }}">
                        &larr; Wróć do listy zadań
                    </a>
                </p>
                <form action="{{ route('staff.tasks.update', ['task' => $task]) }}" method="POST" novalidate>
                    <input type="hidden" name="title" value="{{ $task->title }}">
                    <input type="hidden" name="content" value="{{ $task->content }}">
                    @csrf
                    @method('PUT')

                    @if($task->hasStatus('Active'))
                    <input type="hidden" name="status" value="{{ Task::getStatus('Completed') }}">
                    <button type="submit" class="btn btn-success">
                        Oznacz jako zakończone
                    </button>
                    @endif

                    @if($task->hasStatus('Completed'))
                    <input type="hidden" name="status" value="{{ Task::getStatus('Active') }}">
                    <button type="submit" class="btn btn-success">
                        Oznacz jako aktywne
                    </button>
                    @endif
                </form>
            </div>
        </div>

        <div class="col-sm-12 col-lg-8 offset-lg-2 py-2">
            <small>
                <p>
                    <b>Utworzone:</b> {{ $task->created_at->format('Y-m-d') }}
                </p>
            </small>
            <h1>{{ $task->title }}</h1>

            @if($task->content)
            <p><b>{{ $task->content }}</b></p>
            @endif

            <p>
                Status zadania:

                @switch($task->status)               
                    @case(Task::getStatus('Active'))
                       <b>Aktywne</b>
                      @break                
                     @case(Task::getStatus('Completed'))
                       <b>Kompletne</b>
                      @break
                @endswitch
            </p>
        </div>

        <div class="col-sm-12 col-lg-8 offset-lg-2">
            <div class="d-flex">
                <a href="{{ route('staff.tasks.edit', ['task' => $task]) }}" class="btn btn-success d-block mr-1">
                    {{ __('staffTask.common.edit') }}
                </a>
                <form action="{{ route('staff.tasks.delete', ['task' => $task]) }}" method="POST" novalidate>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        {{ __('staffTask.common.delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection