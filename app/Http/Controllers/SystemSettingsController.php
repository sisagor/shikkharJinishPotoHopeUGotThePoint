<?php

namespace App\Http\Controllers;

use App\Models\SmsGateway;
use App\Models\SystemSetting;
use App\Models\SeoPage;
use App\Services\ZKTService;
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

        $seo = SeoPage::where('status', '1')->first();
        
        return view('settings.admin', compact('settings','seo'));
    }

    /**Settings update*/
    public function settingsUpdate(SystemSettingsUpdateRequest $request)
    {
        try
        {

            if ($request->hasFile('logo'))
            {
                $logo = save_image($request->file('logo'));
                $system = SystemSetting::where('key', 'logo')->first();
                $system->value = "$logo";
                $system->save();
            }
            if ($request->hasFile('login_image'))
            {
                $loginImage = save_image($request->file('login_image'));
                $system = SystemSetting::where('key', 'login_image')->first();
                $system->value = "$loginImage";
                $system->save();
                //dd($system);
            }

            if ($request->filled('general'))
            {
                $key = $request->get('general');
                unset($request['general']);
            }
            if ($request->filled('wallet'))
            {
                $key = $request->get('wallet');
                unset($request['wallet']);
            }
            if ($request->filled('payroll'))
            {
                $key = $request->get('payroll');
                unset($request['payroll']);
            }
            if ($request->filled('notification'))
            {
                $key = $request->get('notification');
                unset($request['notification']);
            }

            $request = $request->all();

            unset($request['_token']);
            unset($request['submit']);
            unset($request['logo']);
            unset($request['login_image']);


            $keys = config('system.settings.'.@$key);
            unset($keys['logo']);
            unset($keys['login_image']);


            foreach ($keys as $key => $item)
            {

                $settings = SystemSetting::where('key', $key);
                $settings->update([
                    'value' => (! empty($request[$key]) ? $request[$key] : null),
                ]);
            }


            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.system_setting')]));
        }
        catch (\Exception $exception)
        {
            Log::error("system setting update failed!");
            Log::info(get_exception_message($exception));

            return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.system_setting')]));
        }

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

    /**store seo info*/
    public function seoStore(Request $request)
    {
        try {

            DB::beginTransaction();

            $seo = $request->get('seo');
            $slug = $request->get('slug');
            $title = $request->get('title');
            $author = $request->get('author');
            $keywords = $request->get('keywords');
            $section = $request->get('section');
            $canonical = $request->get('canonical');
            $og_locale = $request->get('og_locale');
            $og_url = $request->get('og_url');
            $og_type = $request->get('og_type');
            $description = $request->get('description');
            $submit = $request->get('submit');

            if ($submit)
            {
                $old = SeoPage::where('id', $seo)->first();

                if (!empty($old))
                {
                    $old->update([
                        'slug' => $slug,
                        'title' => $title,
                        'description' => $description,
                        'keywords' => $keywords,
                        'author' => $author,
                        'section' => $section,
                        'canonical' => $canonical,
                        'og_locale' => $og_locale,
                        'og_url' => $og_url,
                        'og_type' => $og_type
                    ]);
                }
                else
                {
                    SeoPage::create([
                        'slug' => $slug,
                        'title' => $title,
                        'description' => $description,
                        'keywords' => $keywords,
                        'author' => $author,
                        'section' => $section,
                        'canonical' => $canonical,
                        'og_locale' => $og_locale,
                        'og_url' => $og_url,
                        'og_type' => $og_type,
                        'type' => 'home',
                        'status' => '1'
                    ]);
                }
            }

            DB::commit();

        }catch (\Exception $exception){

            DB::rollBack();
            dd($exception);

            Log::error("seo create error");
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
