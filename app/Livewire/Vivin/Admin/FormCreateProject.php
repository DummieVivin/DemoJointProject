<?php

namespace App\Livewire\Vivin\Admin;

use Livewire\Component;
use App\Models\Project;

class FormCreateProject extends Component
{
    public $titleComponent= "Halaman form create Project Component";
    public $content= "";
    public $name= "";
    public $description= "";
    public $status= "";
    public $category= "";

    public function render()
    {
        return view('livewire.vivin.admin.form-create-project');
    }

    public function sendDataProject(){
        $this->validate([
            'name'        => 'required|min:5',
            'description' => 'required',
            'status'      => 'required',
            'category'    => 'required|min:5',
        ],[
            'name.required'        => 'Nama Project Minimal 5 Karakter',
            'status.required'      => 'Status Wajib di Isi',
            'description.required' => 'Deskripsi Minimal 5 Karakter',
            'category.required'    => 'Category Wajib di Isi'
        ]);
        Project::create([
            'name'        => $this->name,
            'user_id'     => auth()->id(),
            'status'      => $this->status,
            'category'    => $this->category,
            'description' => $this->description,
        ]);
        // dd('data berhasil disimpan');
        $this->resetForm();
        $this->dispatch('project-created');
    }

    public function resetForm(){
        $this->name = "";
        $this->description = "";
        $this->status = "";
        $this->category = "";
        $this->resetErrorBag();
    }
}
