<div>
    @if ($project)
        @include('user.dashboard._card-single-project', ['project' => $project])
    @elseif ($listProject)
        @include('user.dashboard._card-multi-project', ['listProject' => $listProject])
    @else
        I don't have any records!
    @endif
</div>
