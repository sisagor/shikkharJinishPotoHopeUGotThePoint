<?php

namespace Modules\Timesheet\Database\factories;

use App\Models\RootModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class HolidayFactoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Timesheet\Entities\Holiday::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'com_id' => 1,
            'occasion' => 'Friday',
            'holiday_date' => Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d'),
            'holiday_year' => Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d'),
            'holiday_month' => Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d'),
            'status' => RootModel::STATUS_ACTIVE,
            'created_at' => now(),
        ];
    }
}

