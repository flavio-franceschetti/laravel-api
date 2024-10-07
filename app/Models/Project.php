<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // fillable serve per definire quali attributi possono essere assegnati in massa al modello, l assegnazione di massa avviene quando utilizzi metodi come create() o fill() e passi un array di dati per popolare il modello
    protected $fillable = [
        'type_id',
        'user_id',
        'name',
        'description',
        'status',
        'github',
        'slug',
        'image_path',
        'img_original_name',
    ];
    
    //La proprietà $casts consente di definire come gli attributi devono essere automaticamente convertiti quando vengono letti o salvati nel database e viene salvata automaticamente quando si usa fill() nel controller
    protected $casts = [
        'status' => 'boolean',
    ];

    // definisco che un project può avere un type quindi la relazione inversa One-to-many
    public function type(){
        return $this->belongsTo(Type::class); //collego il modello project con il modello type
    }

    // definisco la relazione many-to-many nel model 
    // qui c'è come a strutturato nella documentazione https://laravel.com/docs/10.x/eloquent-relationships#many-to-many-model-structure
    public function technologies(){
       return $this->belongsToMany(Technology::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
    
}
