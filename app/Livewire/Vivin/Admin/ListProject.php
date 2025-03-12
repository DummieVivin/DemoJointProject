<?php

namespace App\Livewire\Vivin\Admin;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Project;

class ListProject extends Component
{
    public $projects = [];

    #[On('project-created')]
    #[On('project-deleted')]
    public function getListProject(){
        $this->projects = Project::with('user')->get();
    }

    public function mount(){
        $this->getListProject();
    }

    public function render()
    {
        return view('livewire.vivin.admin.list-project');
    }

    public function deleteProject($projectId){
        $project = Project::find($projectId);
        // dd('Melakukan penghapusan ke tabel', $project);
        $project->delete();
        $this->dispatch('project-deleted')->self();
    }

    public function sendSubmission($id){
        $project = Project::where($id);
        $this->project;
        dd($this->project);
    }

}
