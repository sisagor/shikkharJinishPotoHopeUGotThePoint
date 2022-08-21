<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SystemSetting;
use App\Common\HasPermission;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class InitSettings
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()) {

            $module = str_replace('-', '_', request()->segment(1));
            Session::put('module', $module);

            setSystemConfig();
            // update the visitor table for state
            //if (! $request->ajax()) {
            // updateVisitorTable($request);
            // }

            if (! $this->check_installed()){
                if (! $this->verify()){
                    die('<h1>' . trans('installer_messages.license_corrupted') . '</h1>');
                }
            }


            if ($this->check_installed()){

                if ($this->check_installed() !== config('app.url')) {

                    $this->updateCorrupt();

                    die('<h1>' . trans('installer_messages.license_corrupted') . '</h1>');
                }
            }

            if (! config('system.use_cache')) {
                if (str_contains($request->getRequestUri(), 'logout')) {
                    HasPermission::clearCache();
                }
            }
        }


        return $next($request);
    }


    private function updateCorrupt(){

        $http = Http::post(LI_ROOT_URL . 'block',
            [
                'domain' => config('app.url'),
                'email' => config('app.email'),
                'license' => config('app.license'),
            ]
        );

        if ($http->status() == 200)
        {
            $response = $http->json();

            if ($response['msg'] == "license_corrupted")
            {
                return true;
            }

            return false;
        }

    }


    /**
     * Check the license
     *
     * @param string $sCheckHost Default: www.google.com
     * @return           boolean
     */
    private function verify()
    {
        try {

            (!check_internet_connection() ? die('Check your Internet connection') : null );

            $http = Http::post(LI_ROOT_URL . 'verify',
                [
                    'domain' => config('app.url'),
                    'email' => config('app.email'),
                    'license' => config('app.license'),
                ]
            );

            if ($http->status() == 200)
            {
                $response = $http->json();

                if ( $response['msg'] == "already_installed" ||  $response['msg'] == "verify_success")
                {
                    $this->updateMix();

                    return true;
                }
            }

            if ($http->status() == 400)
            {
               return false;
            }
        }
        catch (\Exception $exception){
            Log::error("installation Error!");
            Log::info(get_exception_message($exception));
            return false;
        }

    }


    /**
     * Check Internet Connection Status.
     *
     * @param string $sCheckHost Default: www.google.com
     * @return           boolean
     */
    private function check_installed()
    {
        /// decode process:
        $encrypted = config('system_settings.mix') ?? (SystemSetting::orderBy('id', 'asc')->pluck('mix'))[0];

        if (! empty($encrypted))
        {
            $encoded = my_decode($encrypted);
            $split = explode('|', $encoded);
            return $split[0];
        }

        return null;
    }

    /**
     * Check Internet Connection Status.
     *
     * @param string $sCheckHost Default: www.google.com
     * @return           boolean
     */
    private function updateMix(){
        //encode Process:
        try
        {
            $code = my_encode(config('app.url') . '|' . config('app.license'));
            SystemSetting::orderBy('id', 'asc')->update(['mix' => $code]);
            return true;
        }
        catch (\Exception $exception)
        {
            Log::error('License error');
            Log::info(get_exception_message($exception));
            return false;
        }
    }




}
