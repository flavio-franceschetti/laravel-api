<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    // definisco la relazione many-to-many nel model 
    // qui c'è come a strutturato nella documentazione https://laravel.com/docs/10.x/eloquent-relationships#many-to-many-model-structure
    public function projects(){
       return $this->belongsToMany(Project::class);
    }
    
}
