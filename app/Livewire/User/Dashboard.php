<?php

namespace App\Livewire\User;
use App\Models\{Project, Team};

use Livewire\Component;

class Dashboard extends Component
{
    public $listProject = [];
    public $project = [];

    public function mount(){
        // $this->viewSubmission();
        $requestProjectId = request()->query('projectId');

        //Cek Kondisi bila ada $requestProjectId, ambil data project melalui model Project,
        //dimana id project adalah $requestProjectId masukkan kedalam $project
        if($requestProjectId){
            $this->project = Project::with(['user', 'teams'])->where('id', $requestProjectId)->first();
        }else{
            //Ambil semua project, masukkan kedalam listProject
             $this->listProject = Project::with(['user', 'teams'])->get();
        }
    }

    public function render(){
        return view('livewire.user.dashboard');
    }

    public function sendSubmission($id){
        Team::create([
            'user_id' => auth()->id(),
            'project_id' => $id
        ]);
        return redirect()->route('dashboard');
    }

    public function backToDashboard(){
        return redirect()->route('dashboard');
    }

}
