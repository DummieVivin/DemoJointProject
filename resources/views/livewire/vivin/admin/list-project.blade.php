<div  x-data="{
    deleteConfirmation(id){
    let confirm = window.confirm('Yakin Menghapus?');
    if(confirm){
    {{-- Kondisi True --}}
        $wire.deleteProject(id)
    }
    {{-- Kondisi False --}}
    return;
    }
}">
    {{-- {{ __('Halaman List Project, Jumlah Data: ') }} {{ count($projects) }} --}}

    <div class="mt-2 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Project
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kategori
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah Tim
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $project->name }}
                    </th>
                    <td class="px-6 py-4">
                        @if($project->status == 'DRAFTED')
                            <span class="text-pink-400">{{ $project->status }}</span>
                        @elseif($project->status == 'PENDING')
                            <span class="text-blue-400">{{ $project->status }}</span>
                        @elseif($project->status == 'ARCHIVED')
                            <span class="text-yellow-400">{{ $project->status }}</span>
                        @elseif($project->status == 'PUBLISHED')
                            <span class="text-green-400">{{ $project->status }}</span>
                        {{-- @else
                            <span class="text-gray-500">Unknown</span> --}}
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if ($project->category)
                            {{ $project->category }}
                        @else
                        <span class="text-gray-500">Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{-- {{ $project->team_count }} --}}
                    </td>
                    <td class="px-6 py-4 text-right">

                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        <button @click="deleteConfirmation( {{ $project->id }} )" type="button" class="font-medium ml-3 text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
