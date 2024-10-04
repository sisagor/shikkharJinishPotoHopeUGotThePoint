<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'blog_id' => "1",
            'name' => "Biplob",
            'email' => "mekbiplob@gmail.com",
            'comment' => "This is test comment.",
            'parent_id' => 0,
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);

    }
}
