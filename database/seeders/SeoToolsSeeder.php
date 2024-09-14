<?php

namespace Database\Seeders;

use App\Models\RootModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SeoToolsSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seo_pages')->insert([
            'slug' => "edu cms",
            'title' => "edu cms",
            'description' => "edu cms",
            'keywords' => "edu cms",
            'author' => "edu cms",
            'section' => "edu cms",
            'canonical' => "edu cms",
            'og_locale' => "edu cms",
            'og_url' => "edu cms",
            'og_type' => "edu cms",
            'type' => "edu cms",
            'status' => RootModel::STATUS_ACTIVE,
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);

    }
}
