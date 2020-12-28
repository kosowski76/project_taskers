<nav class="d-flex w-100 justify-content-between mb-3">

    <ul class="nav nav-pills mb-3" id="pills-tab">
        @foreach($data as $type => $data)
        <li class="nav-item">
            <a class="nav-link @if($data['isActive']) active @endif" href="{{ route('staff.tasks.index', ['type' => $type]) }}">
            {{ $data['labels']['nav'] }}</a>
        </li>
        @endforeach
    </ul>
    
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="btn btn-success" href="{{ route('staff.tasks.add') }}">
                Dodaj nowe zadanie</a>
        </li>
    </ul>

</nav>