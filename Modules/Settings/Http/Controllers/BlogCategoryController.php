<?php

namespace Modules\Settings\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\CMS\Entities\Blog;
use PhpParser\Node\Stmt\TryCatch;
use Yajra\DataTables\Facades\DataTables;
use Modules\Settings\Entities\BlogCategory;
use Illuminate\Contracts\Support\Renderable;
use Modules\Settings\Http\Requests\BlogCategoryCreateRequest;

class BlogCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable | JsonResponse
     */
    public function index(Request $request)
    {

        if (! $request->ajax())
        {
            return view('settings::blogCategory.index');
        }

        $data = BlogCategory::query();

        if ($request->get('type') == "active")
        {

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row)
                {
                    return get_status_old($row->status);
                })
                ->addColumn('action', function ($row)
                {
                    return  edit_button('componentSettings.blogCategory.edit', $row, "modal") . trash_button('componentSettings.blogCategory.trash',  $row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        if ($request->get('type') == "trash")
        {
            return DataTables::of($data->onlyTrashed())
                ->addIndexColumn()
                ->editColumn('status', function ($row)
                {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row)
                {
                    return  restore_button('componentSettings.blogCategory.restore', $row) . delete_button('componentSettings.blogCategory.delete',  $row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        set_action_title('new_blog_category');
        set_action('componentSettings.blogCategory.store');
        return view('settings::blogCategory.new');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BlogCategoryCreateRequest $request)
    {
      
        $category = BlogCategory::create($request->validated());

        if ($request->hasFile('images'))
        {
            $category = $category->saveImage($request->file('images'), 'blog_category');
        }
        if ($category) {

            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.blog_category')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.blog_category')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.blog_category')]))->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(BlogCategory $blogCategory)
    {
       // return view('settings::blogCategory.show', compact('interview'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(BlogCategory $blogCategory)
    {
        $cat_img = Image::where('imageable_id', $blogCategory->id)->where('type', 'blog_category')->first();
        set_action_title('edit_blog');
        set_action('componentSettings.blogCategory.update', $blogCategory);

        return view('settings::blogCategory.edit', compact('blogCategory','cat_img'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BlogCategoryCreateRequest $request, BlogCategory $blogCategory)
    {

        $unsetImage = $request->validated();
        unset($unsetImage['images']);

        $blogCategory->update($unsetImage);

        if ($request->hasFile('images')){
            $blogCategoryImg = $blogCategory->updateImage($request->file('images'), 'blog_category');
            Image::where('id',$blogCategoryImg->id)->update(['imageable_id' =>  $blogCategory->id]);
        }
        if ($blogCategory) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.blog_category')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.blog_category')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.blog_category')]))->withInput();
    }

    /**
     * soft delete the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function trash(BlogCategory $blogCategory)
    {
        try {
            Blog::where('blog_category_id', $blogCategory->id)->update(['blog_category_id' => 1]);
            $blogCategory->delete();
            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.blog_category')]));
            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.blog_category')]));
        }
        catch (\Exception $exception)
        {
            Log::info(get_exception_message($exception));
            dd($exception);
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.blog_category')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function restore(int $id)
    {
        if (BlogCategory::withTrashed()->find($id)->restore())
        {

            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.blog_category')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.blog_category')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.blog_category')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if (BlogCategory::withTrashed()->find($id)->forceDelete()) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.blog_category')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.blog_category')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.blog_category')]))->withInput();
    }

    /**
     * End section job posting
     */
}
