<?php
namespace Modules\CMS\Observers;

use App\Models\User;
use App\Models\RootModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
//use Modules\CMS\Entities\JobOffer;


class JobOfferObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param JobOffer $offer
     * @return void
     */
    public function creating(JobOffer $offer): void
    {
        //$product->slug = \Str::slug($product->name);
    }


    /**
     * Handle the Product "created" event.
     *
     * @param JobOffer $offer
     * @return void
     */
    public function created(JobOffer $offer): void
    {
        //$product->unique_id = 'PR-'.$product->id;
        //$product->save();
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param JobOffer $offer
     * @return void
     */
    public function updated(JobOffer $offer): void
    {
        try {

            //dd( JobOffer::STATUS_CONFIRMED);

            //dd($offer->status == JobOffer::STATUS_CONFIRMED);

            if ($offer->status == JobOffer::STATUS_CONFIRMED) {
                //dd($offer->application);

                DB::beginTransaction();

              /*  $employee = Employee::create([
                    'employee_index' => make_employee_unique_id(),
                    'name' => $offer->application->name,
                    'email' => $offer->application->email,
                    'phone' => $offer->application->phone,
                    'joining_date' =>Carbon::now()->format('Y-m-d'),
                    'status' => RootModel::STATUS_INACTIVE,
                ]);*/

                if (config('company_settings.allow_employee_login')) {
                    User::create([
                        'com_id' => com_id(),
                        'branch_id' => branch_id(),
                        'name' => $offer->application->name,
                        'email' => $offer->application->email,
                        'phone' => $offer->application->phone,
                        //'role_id' => $request->get('role_id'),
                        'level' => User::USER_EMPLOYEE,
                        'password' => bcrypt(config('company_settings.default_password')),
                        'status' => RootModel::STATUS_INACTIVE,
                    ]);
                }

                DB::commit();
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Employee create Failed from recruitment!");
            Log::info(get_exception_message($exception));

        }
    }


    /**
     * Handle the Product "deleted" event.
     *
     * @param JobOffer $offer
     * @return void
     */
    public function deleted(JobOffer $offer): void
    {
    }


    /**
     * Handle the Product "restored" event.
     *
     * @param JobOffer $offer
     * @return void
     */
    public function restored(JobOffer $offer): void
    {
    }


    /**
     * Handle the Product "force deleted" event.
     *
     * @param JobOffer $offer
     * @return void
     */
    public function forceDeleted(JobOffer $offer): void
    {

    }

}
