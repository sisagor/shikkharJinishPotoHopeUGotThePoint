<?php

namespace App\Http\Controllers;

use App\Models\SmsGateway;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests\SystemSettingsUpdateRequest;


class SystemSettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        set_action('settings.update');
        $settings = config('system_settings');

        return view('settings.admin', compact('settings'));
    }

    /**Settings update*/
    public function settingsUpdate(SystemSettingsUpdateRequest $request)
    {

        $system = SystemSetting::find(1);

        $update = $system->update([
            'system_name' => $request->get('system_name'),
            'system_email' => $request->get('system_email'),
            'system_phone' => $request->get('system_phone'),
            'email_notification' => $request->get('email_notification') ?? 0,
            'sms_notification' => $request->get('sms_notification') ?? 0,
            'pagination' => $request->get('pagination'),
            'report_pagination' => $request->get('report_pagination'),
            'currency_id' => $request->get('currency_id'),
            'timezone_id' => $request->get('timezone_id'),
            'show_currency_symbol' => $request->get('show_currency_symbol'),
            'show_space_after_symbol' => $request->get('show_space_after_symbol'),
            'has_tax_policy' => $request->get('has_tax_policy'),
            'system_realtime_notification' => $request->get('system_realtime_notification'),
        ]);

        if ($request->has('logo')) {
            $system->updateImage($request->file('logo'), 'logo');
        }
        if ($update) {
            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.system_setting')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.system_setting')]));
    }


    /**sms gateway update update*/
    public function smsGatewayUpdate(Request $request)
    {
        $events = $request->get('event');
        $status = $request->get('status');
        $driver = $request->get('driver');
        //dd($request->all());
        try {

            DB::beginTransaction();

            if ($driver)
            {
                $details = $request->get($driver);

                $old = SmsGateway::where('driver', $driver)->first();

                if (!empty($old))
                {
                    $old->update([
                        'details' => json_encode($details),
                        'status' => $status,
                    ]);
                }
                else
                {
                    SmsGateway::create([
                        'driver' => $driver,
                        'details' => json_encode($details),
                        'status' => $status,
                    ]);
                }
                SmsGateway::where('driver', '!=', $driver)->update(['status' => 0]);
            }

            if ($events){
                $system = SystemSetting::first();
                $system->sms_events = json_encode($events);
                $system->save();
            }


            DB::commit();

        }catch (\Exception $exception){

            DB::rollBack();
            dd($exception);

            Log::error("sms gateway create error");
            Log::info(get_exception_message($exception));

            return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.system_setting')]));
        }

        return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.system_setting')]));
    }


    public function cacheClear()
    {
        try {

            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
            //Artisan::call('inta:clear-storage');
            //Artisan::call('optimize');

            $message = trans('msg.cache_cleared');

        } catch (\Exception $exception) {
            $message = get_exception_message($exception);
        }

        return view('partials.systemMessage', compact('message'));
    }

    public function optimize()
    {
        try {

            Artisan::call('optimize:clear');
            //Artisan::call('optimize');

            $message = trans('msg.optimized');

        } catch (\Exception $exception) {

            $message = get_exception_message($exception);

        }

        return view('partials.systemMessage', compact('message'));
    }


}
