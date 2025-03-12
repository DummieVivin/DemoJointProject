<?php

namespace App\Livewire;
use App\Models\Project;
use Livewire\Component;

class ListProject extends Component
{
    public $listProject = [];

    public function mount(){
        $this->refreshListProject();
    }

    public function render()
    {
        return view('livewire.list-project');
    }

    public function refreshListProject(){
        $this->listProject = Project::where('status', 'PUBLISHED')->get();
    }

    public function sendSubmission($projectId){
        //Mengirim Parameter projectID melalui session
        session()->put('selected_projectId', $projectId);
        $this->redirectIntended(route('login'), navigate: true);
        //Dan mengarahkan user ke halaman login
    }
}
