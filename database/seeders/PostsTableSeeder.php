<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('posts')->insert([
            ['title' => 'First Post', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'],
            ['title' => 'Second Post', 'content' => 'Praesent at sapien vel mi bibendum condimentum.'],
            ['title' => 'Third Post', 'content' => 'Morbi vel nisl quis quam consequat iaculis ac quis velit.'],
        ]);
    }
}
