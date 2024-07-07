<?php

namespace Modules\Organization\Database\Seeders;

use App\Models\RootModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Modules\Organization\Entities\LeavePolicy;


class DemoLeavePolicyDatabaseSeeder extends Seeder
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
            //Type Add
            DB::table('leave_policies')->insertGetId([
                'com_id' => 1,
                'type_id' => json_encode(json_encode([1, 2, 3])),
                'name' => "Permanent Policy",
                'apply_at' => LeavePolicy::APPLY_AFTER_JOINING,
                'details' => "This will allow employee to know how much leave he will get from company.",
                'status' => RootModel::STATUS_ACTIVE,
                'created_at' => now(),
            ]);

            DB::table('leave_policies')->insertGetId([
                'com_id' => 1,
                'type_id' => json_encode(json_encode([3, 2, 1])),
                'name' => "Provision period Policy",
                'apply_at' => LeavePolicy::APPLY_AFTER_PROVISION,
                'details' => "This will allow employee to know how much leave he will get from company.",
                'status' => RootModel::STATUS_ACTIVE,
                'created_at' => now(),
            ]);

            DB::table('leave_policies')->insertGetId([
                'com_id' => 1,
                'type_id' => json_encode(json_encode([3, 2, 1])),
                'name' => "Contractual Policy",
                'apply_at' => LeavePolicy::APPLY_AFTER_PROVISION,
                'details' => "this is contractual policy.",
                'status' => RootModel::STATUS_ACTIVE,
                'created_at' => now(),
            ]);

        } catch (\Exception $exception) {
            Log::error("Demo Leave policy create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
