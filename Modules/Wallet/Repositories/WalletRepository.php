<?php
namespace Modules\Wallet\Repositories;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Recruitment\Entities\Cms;
use App\Repositories\EloquentRepository;
use Modules\Wallet\Repositories\WalletRepositoryInterface;


class WalletRepository extends EloquentRepository implements WalletRepositoryInterface
{
    public $model;

    public function __construct(Cms $cms)
    {
        $this->model = $cms;
    }

    /*Get all branches*/
    public function index(Request $request)
    {
        return $this->model->select('id', 'type', 'status', 'content');
    }

    /*Store Branch*/
    public function store(Request $request): bool
    {
        try {

            $this->model->create([
                'type' => $request->get('type'),
                'content' => json_encode($request->get('content')),
                'status' => $request->get('status'),
            ]);

        } catch (\Exception $e) {

            Log::error("Cms create failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }


    /*Update Branch*/
    public function update(Request $request, $model): bool
    {
        try {

            $model->update([
                'type' => $request->get('type'),
                'content' => json_encode($request->get('content')),
                'status' => $request->get('status'),
            ]);

        } catch (\Exception $e) {

            Log::error("Cms update failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }


}
