<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Todo;

class TodoListController extends Controller
{
    public function todo() {
        $todos = Todo::with('project')->get();
        $projects = Project::all();  // Mengambil semua data project
        return view('admin-todo', [
            'pageTitle' => 'Haha',
            'todos' => $todos,
            'projects' => $projects,  // Kirim data projects ke view
        ]);
    }


    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'category' => 'required',
            'project_id' => 'required|exists:projects,id', // Pastikan project_id valid
        ]);

        // Membuat Todo baru
        Todo::create([
            'name' => $validated['name'],
            'status' => $validated['status'],
            'category' => $validated['category'],
            'project_id' => $validated['project_id'],
        ]);

        // Redirect setelah berhasil menyimpan
        return redirect()->route('admin-todo')->with('success', 'Todo berhasil dibuat!');
    }

    public function destroy($id){
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->route('admin-todo')->with('success', 'Todo berhasil di hapus!');
    }
}
