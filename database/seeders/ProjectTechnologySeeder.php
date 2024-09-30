<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();
        $technologies = Technology::all();

        foreach($projects as $project){
            //la funzione random(rand(1, 3)) prende da 0 a 3 elementi casuali dalla collection di tecnologie perche random() accetta un numero che è il numero di elementi da prendere e rand() genera un numero fra 0 e 3
            //pluck('id') mi restituisce solo i valori del campo id degli elementi seleizionati
             // toArray() inserisce tutti gli id in un normale array php che viene accettato dal metodo attach
            $randomTechnologies = $technologies->random(rand(0, 3))->pluck('id')->toArray();
            $project->technologies()->attach($randomTechnologies);
        }

        // for($i = 0; $i < 50; $i++){
        //     $project = Project::inRandomOrder()->first();

        //     $technology_id = Technology::inRandomOrder()->first()->id;

        //     $project->technology()->attach($technology_id);
        // }

    }
}
