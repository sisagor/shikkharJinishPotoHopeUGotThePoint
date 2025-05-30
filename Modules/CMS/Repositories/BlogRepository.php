<?php

namespace Modules\CMS\Repositories;

use App\Common\Filter;
use App\Models\Image;
use App\Models\SeoPage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\CMS\Entities\Blog;
use Illuminate\Queue\Jobs\JobName;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Modules\CMS\Entities\BlogDetails;
use App\Repositories\EloquentRepository;
use Modules\CMS\Entities\BlogBook;

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
            $created_by = Auth::user()->id;
            if ($request->filled('author_id')) {
                $created_by = $request->get('author_id');
            }
            
            // Create blog entry
            $blog = $this->model->create([
                'com_id' => '',
                'blog_category_id' => $request->get('category_id'),
                'title' => $request->get('title'),
                'slug' => Str::slug($request->get('title'), '-'),
                'status' => $request->get('status'),
                'order' => 1,
                'url_type' => $request->get('url_type'),
                'created_by' => $created_by
            ]);

            /*create file*/
            if ($request->hasFile('docs'))
            {
                $doc = $request->file('docs');
                $path = $doc->store('images', 'public');
                $image = new Image([
                    'path' => $path,
                    'name' => $doc->getClientOriginalName(),
                    'extension' => $doc->getClientOriginalExtension(),
                    'size' => $doc->getSize(),
                    'order' => 0,
                    'image_alter' => null,
                    'type' => 'blogDoc',
                    'imageable_id' => $blog->id,
                    'imageable_type' => Blog::class,
                ]);

                $blog->images()->save($image);
            }


            // Extract details, orders, and images from the request
            $books = $request->get('books');
            $details = $request->get('details');
            $orders = $request->get('orders');
            $images_alter = $request->get('images_alter');
            $images = $request->file('images', []);


            $seoPage = SeoPage::create([
                'page_id' => $blog->id,
                'keywords' => $request->get('tags'),
                'description' => $request->get('meta_description'),
                'title' => $request->get('title'),
                'type' => 'blog',
                'status' => 1,
            ]);

            foreach ($books as $index => $book) {
                $blogBook = BlogBook::create([
                    'blog_id' => $blog->id,
                    'book_id' => $book,
                ]);
            }

            // Store details and associate images
            foreach ($details as $index => $detail) {
                $order = $orders[$index];
                $image_alter = $images_alter[$index];

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
                        'image_alter' => $image_alter,
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
    public function update(Request $request, $id): bool
    {
        try {

           // Retrieve the blog entry to update
            $blog = $this->model->findOrFail($id);
            
            // Determine the creator or author
            $created_by = Auth::user()->id;
            if ($request->filled('author_id')) {
                $created_by = $request->get('author_id');
            }

            //dd($created_by);
            // Update blog entry
            $blog->update([
                'com_id' => null,
                'blog_category_id' => $request->get('category_id'),
                'title' => $request->get('title'),
                'status' => $request->get('status'),
                'url_type' => $request->get('url_type'),
                'slug' => $request->get('slug'),
                //'order' => $request->get('order'),
                'created_by' => $created_by,
                'updated_at' => Carbon::now()
            ]);

            /*create file*/
            if ($request->hasFile('docs'))
            {
                $clear = Image::where('imageable_id', $blog->id)->where('imageable_type', Blog::class);
                if ($clear->count())
                {
                    $oldImage = $clear->first();
                    Storage::disk('public')->delete($oldImage->path);
                    $clear->delete();
                }

                $doc = $request->file('docs');
                $path = $doc->store('images', 'public');
                $image = new Image([
                    'path' => $path,
                    'name' => $doc->getClientOriginalName(),
                    'extension' => $doc->getClientOriginalExtension(),
                    'size' => $doc->getSize(),
                    'order' => 0,
                    'image_alter' => null,
                    'type' => 'blogDoc',
                    'imageable_id' => $blog->id,
                    'imageable_type' => Blog::class,
                ]);

                $blog->images()->save($image);
            }

            //Delete Old blog details
            //$blog->details()->delete();

            // Update or create SEO data
            $seoPage = SeoPage::updateOrCreate(
                ['page_id' => $blog->id, 'type' => 'blog'],
                [
                    'keywords' => $request->get('tags'),
                    'description' => $request->get('meta_description'),
                    'title' => $request->get('title'),
                    'status' => 1,
                ]
            );

            // Sync books
            $books = $request->get('books', []);
            BlogBook::where('blog_id', $blog->id)->delete(); // Delete existing relations
            foreach ($books as $book_id) {
                BlogBook::create([
                    'blog_id' => $blog->id,
                    'book_id' => $book_id,
                ]);
            }

            // Extract details and images from the request
            $details = $request->get('details', []);
            $orders = $request->get('orders', []);
            $images_alter = $request->get('images_alter', []);
            $images = $request->file('images', []);
            //$detailsId = $request->get('details_id', []);



            // Update blog details
            foreach ($details as $index => $detail) {
                $order = $orders[$index];
                $image_alter = $images_alter[$index];

                if (!empty($detail)) {
                    // Find or create new BlogDetail
                    $blogDetail = BlogDetails::updateOrCreate(
                        ['blog_id' => $blog->id, 'order' => $order],
                        [
                            'details' => ($detail),
                            'order' => $order,
                            'status' => $request->get('status'),
                        ]
                    );

                    // Update or store associated image if exists
                    if (isset($images[$index])) {
                        $file = $images[$index];
                        $path = $file->store('images', 'public');

                        // Check if image exists and delete old image if updating
                        if ($blogDetail->images()->exists()) {
                            $blogDetail->images()->delete();
                        }

                        // Save new image
                        $image = new Image([
                            'path' => $path,
                            'name' => $file->getClientOriginalName(),
                            'extension' => $file->getClientOriginalExtension(),
                            'size' => $file->getSize(),
                            'order' => $order,
                            'image_alter' => $image_alter,
                            'type' => 'blog',
                            'imageable_id' => $blogDetail->id,
                            'imageable_type' => BlogDetails::class,
                        ]);

                        $blogDetail->images()->save($image);
                    }
                }
            }

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



}
