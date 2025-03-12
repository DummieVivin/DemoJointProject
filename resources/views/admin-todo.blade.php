<x-app-layout>
    <title>Todo List | {{ config('app.name') }}</title>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Flash Message -->
                    @if(session('success'))
                        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Tes Github -->

                    <!-- Button to open modal -->
                    <button id="createTodoButton" type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Create Todo
                    </button>

                    <!-- Todo Table -->
                    <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Project</th>
                                    <th scope="col" class="px-6 py-3">Category</th>
                                    <th scope="col" class="px-6 py-3"> Aksi </th>
                                </tr>
                            </thead>
                            <tbody id="todosTableBody">
                                @foreach ($todos as $todos)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $todos->name }}</td>
                                        <td class="px-6 py-4">{{ $todos->status }}</td>
                                        <td class="px-6 py-4">{{ $todos->project->name ?? 'No Project' }}</td>
                                        <td class="px-6 py-4">{{ $todos->category }}</td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('admin-tododestroy', $todos->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus todo ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form -->
    <div id="todoModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden dark:bg-gray-700 dark:bg-opacity-60">
        <div class="relative p-4 w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <form id="createTodoForm" action="{{ route('admin-todocreate') }}" method="POST">
                @method('POST')
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Todo Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-white text-gray-900 border border-gray-300 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter Todo Name" required>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="status" class="bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-white text-gray-900 border border-gray-300 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option selected disabled value="">Selected Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select name="category" id="category" class="bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-white text-gray-900 border border-gray-300 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"required>
                            <option selected disabled value="">Selected Category</option>
                            <option value="Work">Work</option>
                            <option value="Personal">Personal</option>
                        </select>
                    </div>

                    <div class="col-span-2 mb-3">
                        <label for="project" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project</label>
                        <select name="project_id" id="project" class="bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-white text-gray-900 border border-gray-300 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option selected disabled value="">Selected Project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Add new Todo
                    </button>
                    <button type="button" id="closeModalButton" class="text-white inline-flex items-center bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Pembatalan -->
    <div id="confirmCancelModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden dark:bg-gray-700 dark:bg-opacity-60 z-50">
        <div class="relative p-4 w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <h3 class="text-lg font-bold text-white">Konfirmasi Pembatalan</h3>
            <p class="text-white">Apakah Anda yakin ingin membatalkan? Semua data yang belum disimpan akan hilang.</p>
            <div class="mt-4 flex justify-end">
                <button id="cancelConfirmButton" class="px-4 py-2 bg-gray-400 text-white rounded mr-2">Batal</button>
                <button id="confirmCancelButton" class="px-4 py-2 bg-red-500 text-white rounded">Ya, Batalkan</button>
            </div>
        </div>
    </div>


    <script>
        let isFormDirty = false;

        // Menandai form sebagai dirty jika ada perubahan
        const todoForm = document.getElementById('createTodoForm');
        todoForm.addEventListener('input', () => {
            isFormDirty = true;
        });

        // Show modal when button is clicked
        document.getElementById('createTodoButton').addEventListener('click', () => {
            document.querySelector('.mt-4.relative').style.display = 'none';
            document.getElementById('todoModal').classList.remove('hidden');
            document.getElementById('createTodoForm').reset();
            isFormDirty = false;
        });

        // Handle close modal button
        document.getElementById('closeModalButton').addEventListener('click', () => {
            if (isFormDirty) {
                document.getElementById('confirmCancelModal').classList.remove('hidden');
            } else {
                document.querySelector('.mt-4.relative').style.display = 'block';
                document.getElementById('todoModal').classList.add('hidden');
            }
        });

        // Confirm cancel action
        document.getElementById('confirmCancelButton').addEventListener('click', () => {
            document.querySelector('.mt-4.relative').style.display = 'block';
            document.getElementById('todoModal').classList.add('hidden');
            document.getElementById('confirmCancelModal').classList.add('hidden');
        });

        // Cancel the modal without closing it
        document.getElementById('cancelConfirmButton').addEventListener('click', () => {
            document.getElementById('confirmCancelModal').classList.add('hidden');
        });
    </script>
</x-app-layout>
