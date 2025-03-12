@forelse ($listProject as $project)

    <div class="max-w-auto mt-3 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <div class="mb-2">
                @if($project->category == 'WEBSITE')
                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-green-400 border border-green-400">
                            {{ $project->category }}
                        </span>

                        @elseif($project->category == 'MOBILE')
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">
                            {{ $project->category }}
                        </span>

                        @elseif($project->category == 'DESKTOP')
                        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-red-400 border border-red-400">
                            {{ $project->category }}
                        </span>
                    @endif
            </div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $project->name }}
            </h5>
        </a>
        <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
            {{ $project->description }}
        </p>

        <p> {{ $project->teams }} </p>
        @forelse ($project->teams as $team)
            @if ($team->user_id == auth()->id() && $team->status == 'submission')
            <button type="button" class="cursor-not-allowed inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" disabled>
                {{ $team->status }}
            </button>

            @endif
        @empty
            <button wire:click="sendSubmission({{$project->id}})" type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Join Project
            </button>
        @endforelse

    </div>

@empty

@endforelse

