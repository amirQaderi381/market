<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SettingRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Setting\Setting;
use Database\Seeders\SettingSeeder;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        if($setting == null){
          $setting = new SettingSeeder();
          $setting->run();
          $setting = new SettingSeeder();
        }
        return view('admin.setting.index',compact('setting'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('admin.setting.edit',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting , ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('logo'))
        {
            if(!empty($setting->logo))
            {
                $imageService->DeleteImage($setting->logo);
            }

            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'setting');
            $imageService->setImageName('logo');
            $result = $imageService->save($request->logo);
            if($result == false)
            {
                return redirect()->route('admin.setting.update')->with('swal-success','آپلود لگو با خطا مواجه شد');

            }else{

                $inputs['logo'] = $result;
            }

        }

        if($request->hasFile('icon'))
        {
            if(!empty($setting->icon))
            {
                $imageService->DeleteImage($setting->icon);
            }

            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'setting');
            $imageService->setImageName('icon');
            $result = $imageService->save($request->icon);
            if($result == false)
            {
                return redirect()->route('admin.setting.index')->with('swal-success','آپلود لگو با خطا مواجه شد');

            }else{

                $inputs['icon'] = $result;
            }

        }

        $setting->update($inputs);
        return redirect()->route('admin.setting.index')->with('swal-success','تنظیمات سایت شما با موفقیت ویرایش شد');

    }


}
