<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class Testing extends Component
{
    //membuat properti
    public $judul = "SAYA CANTIK";
    public $name = "";
    public function render()
    {
        return view('livewire.testing');
    }

    public function sendDataProject()
    {
        //melakukan store data project
        Project::create([
            'name'=> $this -> name,
            'user_id'=> Auth ::user()->id,
            'status'=> 'testing'
        ]);
        dd('mau mengirim data');
    }
}
