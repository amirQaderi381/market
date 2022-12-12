<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\PostCategory;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:super-admin')->only(['edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = auth()->user();
        // if($user->can('سوپر ادمین'))
        // {
            $postCategories = PostCategory::orderBy('created_at', 'desc')->simplePaginate(15);
            return view('admin.content.category.index', compact('postCategories'));

        // }else{
        //     abort(403);
        // }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCategoryRequest $request , ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('image'))
        {
            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'post_category');
            $result=$imageService->createIndexAndSave($request->file('image'));
        }

        if($result == false)
        {
            return redirect()->route('admin.content.category.index')->with('swal-error','آپلود تصویر با خطا مواجه شد');
        }

        $inputs['image'] = $result;

        $postCategory = PostCategory::create($inputs);
        return redirect()->route('admin.content.category.index')->with('swal-success','دسته بندی جدید شما با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCategory $postCategory)
    {
        return view('admin.content.category.edit', compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCategoryRequest $request, PostCategory $postCategory , ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('image'))
        {
            // delete previous image
           if(!empty($postCategory->image))
           {
             $imageService->deleteIndex($postCategory->image);
           }

           $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'post_category');

           // execute provider
           $result=$imageService->createIndexAndSave($request->file('image'));

           if($result == false)
           {
             return redirect()->route('admin.content.category.index')->with('swal-error','آپلود تصویر با خطا مواجه شد');

           }else{

            $inputs['image'] = $result;

           }

        }else{

            if(isset($inputs['currentImage']) && !empty($postCategory->image))
            {
                $image=$postCategory->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }
        $postCategory->update($inputs);
        return redirect()->route('admin.content.category.index')->with('swal-success','دسته بندی با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $postCategory)
    {
        $result = $postCategory->delete();
        return redirect()->route('admin.content.category.index')->with('swal-success','دسته بندی شما با موفقیت حذف شد');
    }

    public function status(PostCategory $postCategory)
    {
        $postCategory->status = $postCategory->status == 0 ? 1 : 0;
        $result = $postCategory->save();
        if ($result) {
            if ($postCategory->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);

            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
