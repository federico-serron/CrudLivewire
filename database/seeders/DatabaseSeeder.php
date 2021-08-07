<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Delete directory if exists before create it again//
        Storage::deleteDirectory('posts');

        // Create a folder called posts//
        //Storage::makeDirectory('posts');

        //Excecute FACTORY//
         \App\Models\Post::factory(100)->create();
    }
}
