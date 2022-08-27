<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CommonDiscountRequest;
use App\Models\Market\CommonDiscount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function copan()
    {
        return view('admin.market.discount.copan');
    }

    public function copanCreate()
    {
        return view('admin.market.discount.copan-create');
    }

    public function commonDiscount()
    {
        $commonDiscounts = CommonDiscount::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.discount.common-discount',compact('commonDiscounts'));
    }

    public function commonDiscountCreate()
    {
        return view('admin.market.discount.common-discount-create');
    }

    public function commonDiscountStore(CommonDiscountRequest $request)
    {
        $inputs=$request->all();
        $realFormatStartDateTimestamp = substr($request->start_date,0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$realFormatStartDateTimestamp);
        $realFormatEndDateTimestamp = substr($request->end_date,0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$realFormatEndDateTimestamp);
        CommonDiscount::create($inputs);
        return redirect()->route('admin.market.discount.common.discount')->with('swal-success','تخفیف عمومی شما با موفقیت ثبت شد');
    }

    public function commonDiscountEdit(CommonDiscount $commonDiscount)
    {
        return view('admin.market.discount.common-discount-edit',compact('commonDiscount'));
    }

    public function commonDiscountUpdate(CommonDiscountRequest $request , CommonDiscount $commonDiscount)
    {
        $inputs=$request->all();
        $realFormatStartDateTimestamp = substr($request->start_date,0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$realFormatStartDateTimestamp);
        $realFormatEndDateTimestamp = substr($request->end_date,0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$realFormatEndDateTimestamp);
        $commonDiscount->update($inputs);
        return redirect()->route('admin.market.discount.common.discount')->with('swal-success','تخفیف عمومی شما با موفقیت ویرایش شد');
    }

    public function commonDiscountDestroy(CommonDiscount $commonDiscount)
    {
         $commonDiscount->delete();
         return redirect()->route('admin.market.discount.common.discount')->with('swal-success','تخفیف عمومی شما با موفقیت حذف شد');

    }

    public function amazingSale()
    {
        return view('admin.market.discount.amazing-sale');
    }

    public function amazingSaleCreate()
    {
        return view('admin.market.discount.amazing-sale-create');
    }
}
