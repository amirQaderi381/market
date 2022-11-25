<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AdminUserRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('user_type',1)->simplePaginate(15);
        return view('admin.user.admin-user.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.admin-user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request , ImageService $imageService)
    {
        $inputs = $request->all();
        if($request->hasFile('profile_photo_path'))
        {
           $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'user'.DIRECTORY_SEPARATOR.'admin-user');
           $result=$imageService->save($request->file('profile_photo_path'));
           if($result == false)
           {
             return redirect()->route('admin.user.admin-user.index')->with('swal-error','آپلود تصویر با خطا مواجه شد');
           }
           $inputs['profile_photo_path'] = $result;
        }
        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 1;

        User::create($inputs);

       return redirect()->route('admin.user.admin-user.index')->with('swal-success','ادمین جدید با موفقیت ثبت شد');
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
    public function edit(User $user)
    {
        return view('admin.user.admin-user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, User $user , ImageService $imageService)
    {
        $inputs = $request->all();
        if($request->hasFile('profile_photo_path'))
        {
            if(!empty($user->profile_photo_path))
            {
                $imageService->DeleteImage($user->profile_photo_path);
            }
           $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'user'.DIRECTORY_SEPARATOR.'admin-user');
           $result=$imageService->save($request->file('profile_photo_path'));
           if($result == false)
           {
             return redirect()->route('admin.user.admin-user.index')->with('swal-error','آپلود تصویر با خطا مواجه شد');
           }
           $inputs['profile_photo_path'] = $result;
        }

        $user->update($inputs);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success','ادمین با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->forceDelete();
        return redirect()->route('admin.user.admin-user.index')->with('swal-success','ادمین با موفقیت حذف شد');

    }

    public function activation(User $user)
    {
        $user->activation = $user->activation == 0 ?  1 : 0;
        $result = $user->save();

        if($result)
        {
            if($user->activation == 0)
            {
               return response()->json(['activation' => true , 'checked' => false]);

            }else{

                return response()->json(['activation' => true , 'checked' => true]);
            }

        }else{

            return response()->json(['activation' => false]);
        }
    }

    public function status(User $user)
    {
        $user->status = $user->status == 0 ?  1 : 0;
        $result = $user->save();

        if($result)
        {
            if($user->status == 0)
            {
               return response()->json(['status' => true , 'checked' => false]);

            }else{

                return response()->json(['status' => true , 'checked' => true]);
            }

        }else{

            return response()->json(['status' => false]);
        }
    }

    public function roles(User $admin)
    {
        $roles = Role::all();
        return view('admin.user.role.roles',compact('admin','roles'));
    }

    public function rolesStore(Request $request , User $admin)
    {
        $validated = $request->validate([
            'roles'=>'required|exists:roles,id|array'
        ]);

        $admin->roles()->sync($request->roles);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success','نقش ادمین با موفقیت ویرایش شد');
    }

    public function permissions(User $admin)
    {
        $permissions = Permission::all();
        return view('admin.user.role.permissions',compact('admin','permissions'));
    }

    public function permissionsStore(Request $request , User $admin)
    {
        $validated = $request->validate([
            'permissions'=>'required|exists:permissions,id|array'
        ]);

        $admin->permissions()->sync($request->permissions);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success','سطوح دسترسی با موفقیت ویرایش شد');
    }
}
