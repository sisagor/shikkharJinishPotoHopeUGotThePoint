<?php

namespace Modules\User\Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;


class UserDatabaseSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        try {

            DB::beginTransaction();

            $this->call(ModuleDatabaseSeeder::class);
            $this->call(RoleDatabaseSeeder::class);

            $profile = [
                [
                    'id' => 1,
                    'name' => 'Super Admin',
                    'phone' => '01826319556',
                    'email' => 'superadmin@demo.com',
                    'gender' => 'Male',
                    'dob' => '1993-01-01',
                    'address' => 'Dhaka, Bangladesh',
                ],
                [
                    'id' => 2,
                    'name' => 'Admin',
                    'phone' => '01826319556',
                    'email' => 'admin@demo.com',
                    'gender' => 'Male',
                    'dob' => '1993-01-01',
                    'address' => 'Dhaka, Bangladesh',
                ],
                [
                    'id' => 3,
                    'name' => 'Author',
                    'phone' => '01826319556',
                    'email' => 'author@demo.com',
                    'gender' => 'Male',
                    'dob' => '1993-01-01',
                    'address' => 'Dhaka, Bangladesh',
                ],
            ];

            $users = [
                [
                    'id' => 1,
                    'role_id' => null,
                    'profile_id' => 1,
                    'name' => 'Super Admin',
                    'email' => 'superadmin@demo.com',
                    'password' => bcrypt('123456'),
                    'status' => 1,
                    'level' => User::USER_SUPER_ADMIN,
                    'created_at' => Carbon::Now(),
                    'updated_at' => Carbon::Now(),
                ],
                [
                    'id' => 2,
                    'profile_id' => 2,
                    'role_id' => 1,
                    'name' => 'Admin',
                    'email' => 'admin@demo.com',
                    'password' => bcrypt('123456'),
                    'status' => 1,
                    'level' => User::USER_ADMIN_ADMIN,
                    'created_at' => Carbon::Now(),
                    'updated_at' => Carbon::Now(),
                ],
                [
                    'id' => 3,
                    'profile_id' => 3,
                    'role_id' => 2,
                    'name' => 'Author',
                    'email' => 'author@demo.com',
                    'password' => bcrypt('123456'),
                    'status' => 1,
                    'level' => User::USER_AUTHOR,
                    'created_at' => Carbon::Now(),
                    'updated_at' => Carbon::Now(),
                ]
            ];

            foreach ($users as $key => $user) {
                $profileId = DB::table('profiles')->insertGetId($profile[$key]);
                 DB::table('users')->insert($user);

                if (File::isDirectory($this->demo_dir))
                {
                    $img = $this->demo_dir . "/user.jpg";
                    if (! file_exists($img)) continue;

                    $name = "user.jpg";
                    $targetFile = $this->dir . DIRECTORY_SEPARATOR . $name;

                    if ($this->disk->put($targetFile, file_get_contents($img))) {
                        DB::table('images')->insert([
                            [
                                'name' => $name,
                                'path' => $targetFile,
                                'extension' => 'jpg',
                                'type' => 'profile',
                                'imageable_id' => $profileId,
                                'imageable_type' => 'Modules\User\Entities\Profile',
                                'created_at' => Carbon::Now(),
                                'updated_at' => Carbon::Now(),
                            ]
                        ]);
                    }
                }
            }

            //DB::table('users')->where('level', 'branch_admin')->update(['com_id' => 1]);

            DB::commit();

        } catch (\Exception $exception) {
            Log::error("User Seeding Error");
            Log::info(get_exception_message($exception));

            DB::rollBack();

        }

    }

}
