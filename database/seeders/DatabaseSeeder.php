<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        //richiamado il seeder qui possiamo rilanciarlo semplicemente con il comando php artisan db:seed senza dover inserire il nome 
        $this->call([
            // devo lanciare prima i primi 2 seeder e poi gli altri 2 per poter far funzionare anche l'user_id
        TypesTableSeeder::class,
        TechnologiesSeeder::class, 
        ProjectsTableSeeder::class, 
        ProjectTechnologySeeder::class
    ]);
    }
}
