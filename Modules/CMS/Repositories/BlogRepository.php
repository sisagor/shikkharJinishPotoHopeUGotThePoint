<?php

namespace Modules\CMS\Repositories;

use App\Common\Filter;
use App\Models\Image;
use App\Models\SeoPage;
use Illuminate\Http\Request;
use Modules\CMS\Entities\Blog;
use Illuminate\Queue\Jobs\JobName;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Modules\CMS\Entities\BlogDetails;
use App\Repositories\EloquentRepository;


class BlogRepository extends EloquentRepository implements BlogRepositoryInterface
{
    public $model;

    public function __construct(Blog $blog)
    {
        $this->model = $blog;
    }

    /*Get all blog*/
    public function index(Request $request)
    {
        $query =  $this->model
            ->with('blog_category:id,name')
            ->with('details:id,blog_id,details,order,status')
            ->select('id','blog_category_id', 'title', 'status', 'created_at');
        return (new Filter($request, $query))
            ->statusFilter(['status' => 'status'])
            ->execute();

    }


    /*Store Blog*/
    public function store(Request $request): bool
    {
        try {
            // Create blog entry
            $blog = $this->model->create([
                'com_id' => '',
                'blog_category_id' => $request->get('category_id'),
                'title' => $request->get('title'),
                'status' => $request->get('status'),
                'order' => 1,
                'created_by' => Auth::user()->id
            ]);

            // Extract details, orders, and images from the request
            $details = $request->get('details');
            $orders = $request->get('orders');
            $images = $request->file('images', []);


            $seoPage = SeoPage::create([
                'page_id' => $blog->id,
                'keywords' => $request->get('tags'),
                'type' => 'blog',
                'status' => 1,
            ]);

        

            // Store details and associate images
            foreach ($details as $index => $detail) {
                $order = $orders[$index];

                // Create BlogDetail
                $blogDetail = BlogDetails::create([
                    'blog_id' => $blog->id,
                    'details' => $detail,
                    'order' => $order,
                    'status' => $request->get('status'),
                ]);

                // Store associated image if it exists
                if (isset($images[$index])) {
                    $file = $images[$index];
                    $path = $file->store('images', 'public');

                    $image = new Image([
                        'path' => $path,
                        'name' => $file->getClientOriginalName(),
                        'extension' => $file->getClientOriginalExtension(),
                        'size' => $file->getSize(),
                        'order' => $order,
                        'type' => 'blog',
                        'imageable_id' => $blogDetail->id,
                        'imageable_type' => BlogDetails::class,
                    ]);

                    $blogDetail->images()->save($image);
                }
            }

        } catch (\Exception $e) {
            Log::error("Blog create failed");
            Log::info(get_exception_message($e));
            dd($e);

            return false;
        }

        return true;
    }


    /*Update Blog*/
    public function update(Request $request, $model): bool
    {
        try {

            $model->update([
                'job_id' => $request->get('job_id'),
                'job_application_id' => $request->get('job_application_id'),
                'interview_date' => $request->get('interview_date'),
                'interview_time' => $request->get('interview_time'),
                'address' => $request->get('address'),
                'interviewers' => json_encode($request->get('interviewers')),
                'details' => json_encode($request->get('details')),
                'status' => $request->get('status'),
            ]);

        } catch (\Exception $e) {

            Log::error("Interview update failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }


    /*Delete branch */
    public function destroy($model): bool
    {
        try {

            DB::beginTransaction();

            $model->user->forceDelete();
            $model->forceDelete();

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Delete Failed');
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;
    }


    public function getJobs($status = Blog::STATUS_OPEN)
    {
        return Blog::where('status', $status)->pluck('position', 'id');
    }


}
