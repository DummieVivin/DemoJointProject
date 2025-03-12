<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'status',
        'category',
        'description'
    ];

    //Function Relasi dari model Project ke model User
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function teams(){
        return $this->hasMany(Team::class);
    }

    public function todos(){
        return $this->hasMany(Todo::class);
    }
}
