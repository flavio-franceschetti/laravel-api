<?php

namespace Database\Seeders;

use App\functions\Helper;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Sito Web', 'Applicazione', 'API', 'e-commerce'];

        foreach($types as $type){
            $newType = new Type();
            $newType->name = $type;
            $newType->slug = Helper::generateSlug($newType->name, Type::class);
            $newType->save();
        }
    }
}
