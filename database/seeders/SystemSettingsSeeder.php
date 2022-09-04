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
            $id = DB::table('system_settings')->insertGetId([
                'id' => 1,
                'system_name' => "Inta-Hrm",
                'system_phone' => "01826319556",
                'system_email' => 'help.intadev@gmail.com',
                'email_notification' => 0,
                'pagination' => 10,
                'report_pagination' => 100,
                'use_cache' => 0,
                'currency_id' => 148,
                'timezone_id' => 70,
                'created_at' => Carbon::Now(),
            ]);

            if (File::isDirectory($this->demo_dir)) {
                $img = $this->demo_dir . "/logo.png";
                // if (! file_exists($img)) continue;
                $name = "logo.png";
                $targetFile = $this->dir . DIRECTORY_SEPARATOR . $name;

                if ($this->disk->put($targetFile, file_get_contents($img))) {
                    DB::table('images')->insert([
                        [
                            'name' => $name,
                            'path' => $targetFile,
                            'extension' => 'png',
                            'type' => 'logo',
                            'imageable_id' => $id,
                            'imageable_type' => 'App\Models\SystemSetting',
                            'created_at' => Carbon::Now(),
                            'updated_at' => Carbon::Now(),
                        ]
                    ]);
                }


                $loginImg = $this->demo_dir . "/cover2.jpeg";

                if ($this->disk->put($targetFile, file_get_contents($img))) {
                    DB::table('images')->insert([
                        [
                            'name' => $name,
                            'path' => $targetFile,
                            'extension' => 'png',
                            'type' => 'logo',
                            'imageable_id' => $id,
                            'imageable_type' => 'App\Models\SystemSetting',
                            'created_at' => Carbon::Now(),
                            'updated_at' => Carbon::Now(),
                        ]
                    ]);
                }


            }

            $loginImage = public_path('css/login/img/cover2.jpeg');

            if (file_exists($loginImage)) {

                if (Storage::put(storage_path('/images'), $loginImage)) {

                    DB::table('system_settings')->update([
                        [
                            'login_image' => storage_path('/images')."/cover2.jpeg",
                        ]
                    ]);
                }
            }

        } catch (\Exception $exception) {
            \Illuminate\Support\Facades\Log::error('System seed failed!');
            \Illuminate\Support\Facades\Log::info($exception->getMessage());
        }

    }
}
