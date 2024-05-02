<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;
use Modules\Payroll\Entities\Salary;
use TADPHP\TAD;
use TADPHP\TADFactory;

require(base_path('vendor/tad/autoload.php'));


class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function test(Request $request)
    {
        //$delete = Salary::query()->delete();

        $comands = TAD::commands_available();
        $tad = (new TADFactory(['ip'=>'192.168.10.34', 'com_key'=>0]))->get_instance();

        //dd($tad);
        //$user_info = $tad->get_user_info(['pin'=>55]);
        //$logs = $tad->get_att_log(['pin'=>50])->get_response(['format'=>'array']);
        $logs = $tad->get_att_log(['pin' => '34'])->get_response(['format'=>'array']);


        $logs = array_reverse($logs['Row']);

        $result = array_filter($logs, function ($item)
        {
            return ($item);
        });

        //dd($result);

        foreach ($logs as $key => $item)
        {
            $item = array_reverse($item);

            dd($item['DateTime']);
            foreach ($item as $one)
            {

                var_dump($one);
            }
        }
        exit();

        dd($logs);

        exit("Exit!");
    }




}
