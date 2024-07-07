<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;


class DatabaseSeeder extends Seeder
{

    protected $disk;

    protected $dir;

    protected $demo_dir;

    public function __construct()
    {
        $dir = image_storage_dir();

        if (! Storage::exists($dir)) {
            Storage::makeDirectory($dir, 0755, true, true);
        }

        $this->dir = image_storage_dir();

        $this->demo_dir = public_path('images/demo');

        $this->disk = Storage::disk(config('filesystems.default'));
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SystemSettingsSeeder::class);
        $this->call(CountriesSeeder::class);
        //$this->call(StatesSeeder::class);
        $this->call(CurrenciesSeeder::class);
        $this->call(TimezonesSeeder::class);
        if (config('app.demo')){
            $this->call(DemoSmsGatewaySeeder::class);
        }
    }


}
