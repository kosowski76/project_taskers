<div class="tab-content">

        <div class="row h-140">

            @if($tasks->hasPages())
            <div class="col-sm-12">
                {{ $tasks->links() }}
            </div>
            @endif

            @forelse($tasks as $task)
            <div class="col-sm-12">
                <div class="card bg-light mb-3">

                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($task->title, 75) }}</h5>
                        @if($task->content)
                        <p class="card-text">{{ Str::limit($task->content, 50) }}</p>
                        @endif
                        <div class="btn-group">
                            <form action="{{ route('staff.tasks.update', ['task' => $task]) }}" method="POST" novalidate>
                                <input type="hidden" name="title" value="{{ $task->title }}">
                                <input type="hidden" name="content" value="{{ $task->content }}">
                                <input type="hidden" name="status" value="{{ $tasksData['oppositeStatus'] }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">
                                    {{ $tasksData['labels']['mark'] }}
                                </button>
                            </form>
                        </div>

                        <div class="btn-group" role="group">
                            <button type="button" id="btnGroupDrop1" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                                Więcej
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('staff.tasks.show', ['task' => $task]) }}">
                                    Szczegóły
                                </a>
                                <a class="dropdown-item" href="{{ route('staff.tasks.edit', ['task' => $task]) }}">
                                    Edytuj
                                </a>
                                <form action="{{ route('staff.tasks.delete', ['task' => $task]) }}" method="POST" novalidate>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item">
                                        Usuń
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @empty
            <div class="col-sm-12">
                <p>{{ $tasksData['labels']['empty'] }}</p>
            </div>
            @endforelse

            @if($tasks->hasPages())
            <div class="col-sm-12">
                {{ $tasks->links() }}
            </div>
            @endif

        </div>

</div>