<form action="{{ $action }}" method="{{ $formMethod ?? 'POST' }}" novalidate>
    <div class="form-group">
        <label for="title">Tytuł zadania</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $titleValue }}" placeholder="Wyjść z psem">
        @error('title')
        <div class="invalid-feedback">
            {{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="content">Treść zadania</label>
        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ $contentValue }}</textarea>
        @error('content')
        <div class="invalid-feedback">
            {{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="status">Status zadania</label>
        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
            <option value="{{ Task::getStatus('Active') }}" @if(isset($task) && $task->hasStatus('Active')) selected @endif>
                Aktywne</option>
            <option value="{{ Task::getStatus('Completed') }}" @if(isset($task) && $task->hasStatus('Completed')) selected @endif>
                Zakończone</option>
        </select>
        @error('status')
        <div class="invalid-feedback">
            {{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        {{ $submitBtnText}}
    </button>

    @csrf
    @method($method ?? 'POST')
</form>