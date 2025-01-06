<?php

namespace Modules\CMS\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Modules\CMS\Entities\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\BlogDetails;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Modules\Settings\Entities\BlogCategory;
use Modules\CMS\Entities\Book;
use Illuminate\Contracts\Support\Renderable;
use Modules\CMS\Http\Requests\BlogCreateRequest;
use Modules\CMS\Repositories\BlogRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Modules\CMS\Entities\Comment;
use Modules\CMS\Http\Requests\BlogUpdateRequest;

class BlogController extends Controller
{
    protected $repo;

    public function __construct(BlogRepositoryInterface $repository)
    {
        $this->repo = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable | JsonResponse
     */
    public function index(Request $request)
    {

        if (! $request->ajax())
        {
            return view('cms::blog.index');
        }

        $data = $this->repo->index($request);

        //dd($data);

        if ($request->get('type') == "active")
        {

            return DataTables::of($data)
                ->addIndexColumn()
                // ->editColumn('details', function ($row){
                //     return substr(json_decode($row->details), 0, 500);
                // })
                ->editColumn('status', function ($row)
                {
                    return get_status($row->status);
                })
                ->addColumn('blogCatName', function ($row)
                {
                    return ($row->blog_category ? $row->blog_category->name : null);
                })
                ->editColumn('created_at', function ($row){
                    return \Carbon\Carbon::parse( $row->created_at)->format('H:i:s A');
                })
                ->editColumn('details', function ($row){
                    $details = '<ul>';
                    foreach ($row->details as $detail){
                        $details .='<li>'. $detail->details .'</li>';
                    }
                    $details .= '</ul>';
                    return $details;
                })
                ->addColumn('action', function ($row) {
                    return view_button('cms.blog.view', $row). edit_button('cms.blog.edit', $row, "modal") . trash_button('cms.blog.trash', $row);
                })
                ->rawColumns(['status', 'action', 'details'])
                ->make(true);
        }

        if ($request->get('type') == "trash")
        {

            return DataTables::of($data->onlyTrashed())
                ->addIndexColumn()
                ->editColumn('created_at', function ($row){
                    return \Carbon\Carbon::parse( $row->interview_time)->format('H:i:s A');
                })
                ->addColumn('blogCatName', function ($row)
                {
                    return ($row->blog_category ? $row->blog_category->name : null);
                })
                // ->editColumn('details', function ($row){
                //     return substr(json_decode($row->details), 0, 500);
                // })
                ->editColumn('status', function ($row)
                {
                    return get_status($row->status);
                })
                ->editColumn('details', function ($row){
                    $details = '<ul>';
                    foreach ($row->details as $detail){
                        $details .='<li>'. $detail->details .'</li>';
                    }
                    $details .= '</ul>';
                    return $details;
                })
                ->addColumn('action', function ($row) {
                    return restore_button('cms.blog.restore', $row) . delete_button('cms.blog.delete', $row);
                })
                ->rawColumns(['status', 'action', 'details'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        set_action_title('new_blog');
        set_action('cms.blog.store');
        $blog = [];
        $categories = BlogCategory::active()->pluck('name', 'id');
        $books = Book::where('status',1)->get();
        $authors = User::where('status',1)->where('role_id', 2)->get();
        return view('cms::blog.new', compact('blog', 'categories', 'books', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(BlogCreateRequest $request) : RedirectResponse
    {
        if ($this->repo->store($request)) {

            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.blog')]));

            return redirect()->route('cms.blogs')->with('success', trans('msg.create_success', ['model' => trans('model.blog')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.blog')]))->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(JobInterview $interview)
    {
        return view('cms::blog.show', compact('interview'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $blog = Blog::with('details.image','seo','books')->where('id',$id)->first();
        $categories = BlogCategory::active()->pluck('name', 'id');
        $books = Book::where('status',1)->get();
        $authors = User::where('status',1)->where('role_id', 2)->get();
        set_action_title('edit_blog');
        set_action('cms.blog.update', $blog);

        return view('cms::blog.edit', compact('blog','categories','books','authors'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BlogUpdateRequest $request, $id): RedirectResponse
    {
     
        if ($this->repo->update($request, $id)) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.blogs')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.blogs')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.blogs')]))->withInput();
    }

    public function comments(Request $request)
    {

       
        // $data = Contact::get();

        // return view('cms::book.contact',compact('data'));

        if (! $request->ajax()){
            return view('cms::blog.comments');
        }

        $data = Comment::with('blog','parent_comment')->get();

        if ($request->get('type') == "active"){

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row)
                {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    if($row->status == 1){
                        return delete_button('cms.comments.delete', $row);
                    }else{
                        return approve_button('cms.comments.approve', $row) . delete_button('cms.comments.delete', $row);
                    }
                   
                })
                ->make(true);
        }
    }

    public function approveComment($id)
    {
       
        $update = Comment::where('id',$id)->update(['status'=>1]);

        if($update){
            return redirect()->back()->with('success', trans('msg.approve_success', ['model' => trans('app.comment')]));
        }

        return redirect()->back()->with('success', trans('msg.approve_failed', ['model' => trans('app.comment')]));
       
    }

    public function deleteComment($id)
    {
        $delete = Comment::where('id', $id)->delete();

        if($delete){
            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('app.comment')]));
        }
       
        return redirect()->back()->with('success', trans('msg.delete_failed', ['model' => trans('app.comment')]));
    }

    /**
     * soft delete the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function trash(JobInterview $interview)
    {
        if ($interview->delete()) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.blog')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.blog')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.blog')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function restore($interview)
    {
        if ($this->repo->restore($interview)) {

            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.blog')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.blog')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.blog')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($interview)
    {
        if ($this->repo->destroyTrash($interview)) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.job')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.blog')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.blog')]))->withInput();
    }

    /**
     * End section job posting
     */

     
  
}
