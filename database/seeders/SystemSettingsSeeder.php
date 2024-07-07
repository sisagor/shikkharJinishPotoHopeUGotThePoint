<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SystemSettingsSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            foreach (config('system.settings') as $items) {

                foreach ($items as $key => $value) {
                    DB::table('system_settings')->insertGetId([
                        'key' => $key,
                        'value' => $value,
                    ]);
                }
            }

            if (File::isDirectory($this->demo_dir)) {
                $img = $this->demo_dir . "/logo.png";
                // if (! file_exists($img)) continue;
                $name = "logo.png";
                $targetFile = $this->dir . DIRECTORY_SEPARATOR . $name;

                //logo seeder
                /* if ($this->disk->put($targetFile, file_get_contents($img)))
                 {
                    DB::table('system_settings')->where('key', 'logo')->update(['value' => $targetFile]);
                 }*/

                //login image:
                $img2 = $this->demo_dir . "/cover2.jpeg";
                $filePath = $this->dir . DIRECTORY_SEPARATOR . "cover2.jpeg";

                if ($this->disk->put($filePath, file_get_contents($img2)))
                {
                    DB::table('system_settings')->where('key', 'login_image')
                        ->update(['value' => $filePath,]);
                }

            }

        } catch (\Exception $exception) {
            \Illuminate\Support\Facades\Log::error('System seed failed!');
            \Illuminate\Support\Facades\Log::info($exception->getMessage());
        }

    }
}
