<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryValueRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\CategoryValue;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;

class PropertyValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryAttribute $categoryAttribute)
    {
        return view('admin.market.property.value.index',compact('categoryAttribute'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryAttribute $categoryAttribute)
    {
        return view('admin.market.property.value.create',compact('categoryAttribute'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryValueRequest $request , CategoryAttribute $categoryAttribute)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value, 'price_increase' => $request->price_increase],JSON_UNESCAPED_UNICODE);
        $inputs['category_attribute_id'] = $categoryAttribute->id;
        $value = CategoryValue::create($inputs);
        return redirect()->route('admin.market.value.index', $categoryAttribute->id)->with('swal-success', 'مقدار فرم کالای جدید شما با موفقیت ثبت شد');
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
    public function edit(CategoryAttribute $categoryAttribute, CategoryValue $value)
    {
        return view('admin.market.property.value.edit', compact('categoryAttribute', 'value'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryValueRequest $request, CategoryAttribute $categoryAttribute, CategoryValue $value)
    {
        $inputs = $request->all();
        $inputs['category_attribute_id'] = $categoryAttribute->id;
        $inputs['value'] = json_encode(['value'=>$request->value , 'price_increase'=>$request->price_increase],JSON_UNESCAPED_UNICODE);
        $value->update($inputs);
        return redirect()->route('admin.market.value.index',$categoryAttribute->id)->with('swal-success','مقدار فرم کالا شما با موفقیت ثبت شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryAttribute $categoryAttribute, CategoryValue $value)
    {
       $value->delete();
       return redirect()->route('admin.market.value.index',$categoryAttribute->id)->with('swal-success','مقدار فرم کالا شما با موفقیت حذف شد');
    }
}
