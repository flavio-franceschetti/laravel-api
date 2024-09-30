<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

   protected $fillable = [
    'name',
    'slug'
   ];
   
   
    
    //definisco che ogni type può avere molti projects quindi la relazione One-to-many
    public function projects(){
        return $this->hasMany(Project::class); // relazione con il modello project
    }
}
