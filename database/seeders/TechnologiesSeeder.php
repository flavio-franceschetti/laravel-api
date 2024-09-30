<?php

namespace Database\Seeders;

use App\functions\Helper;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class TechnologiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['PHP', 'JavaScript', 'VueJs', 'HTML', 'Laravel', 'CSS', 'TypeScript'];

        foreach($data as $technology){
            $newTechnology = new Technology();
            $newTechnology->name = $technology;
            $newTechnology->slug = Helper::generateSlug($newTechnology->name, Technology::class);
            $newTechnology->save();
        }
    }
}
