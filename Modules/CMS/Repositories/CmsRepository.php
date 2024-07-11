<?php
namespace Modules\CMS\Repositories;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\CMS\Entities\BlogDetails;
use App\Repositories\EloquentRepository;


class CmsRepository extends EloquentRepository implements CmsRepositoryInterface
{
    public $model;

    public function __construct(BlogDetails $cms)
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

            Log::error("BlogDetails create failed");
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

            Log::error("BlogDetails update failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }


}
