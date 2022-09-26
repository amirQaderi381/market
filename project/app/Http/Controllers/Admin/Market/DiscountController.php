<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\User;
use App\Models\Market\Copan;
use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\AmazingSale;
use App\Http\Controllers\Controller;
use App\Models\Market\CommonDiscount;
use App\Http\Requests\Admin\Market\AmazingSaleRequest;
use App\Http\Requests\Admin\Market\CommonDiscountRequest;
use App\Http\Requests\Admin\Market\CopanRequest;

class DiscountController extends Controller
{
    public function copan()
    {
        $copans = Copan::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.discount.copan',compact('copans'));
    }

    public function copanCreate()
    {
        $users = User::all();
        return view('admin.market.discount.copan-create',compact('users'));
    }

    public function copanStore(CopanRequest $request)
    {
        $inputs = $request->all();
        $realFormatStartDateTimestamp = substr($request->start_date,0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$realFormatStartDateTimestamp);
        $realFormatEndDateTimestamp = substr($request->end_date,0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$realFormatEndDateTimestamp);
        Copan::create($inputs);
        return redirect()->route('admin.market.discount.copan')->with('swal-success','کوپن جدید شما با موفقیت ثبت شد');

    }

    public function copanEdit(Copan $copan)
    {
        $users = User::all();
        return view('admin.market.discount.copan-edit',compact('copan','users'));
    }

    public function copanUpdate(CopanRequest $request , Copan $copan)
    {
        $inputs = $request->all();
        if($inputs['type'] == 0)
        {
            $inputs['user_id']=null;
        }
        $realFormatStartDateTimestamp = substr($request->start_date,0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$realFormatStartDateTimestamp);
        $realFormatEndDateTimestamp = substr($request->end_date,0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$realFormatEndDateTimestamp);
        $copan->update($inputs);
        return redirect()->route('admin.market.discount.copan')->with('swal-success','کوپن  شما با موفقیت ویرایش شد');

    }

    public function copanDestroy(Copan $copan)
    {
         $copan->delete();
         return redirect()->route('admin.market.discount.copan')->with('swal-success','کوپن شما با موفقیت حذف شد');
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
        $amazingSales = AmazingSale::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.discount.amazing-sale',compact('amazingSales'));
    }

    public function amazingSaleCreate()
    {
        $products = Product::all();
        return view('admin.market.discount.amazing-sale-create',compact('products'));
    }

    public function amazingSaleStore(AmazingSaleRequest $request)
    {
        $inputs=$request->all();
        $realFormatStartDateTimestamp = substr($request->start_date,0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$realFormatStartDateTimestamp);
        $realFormatEndDateTimestamp = substr($request->end_date,0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$realFormatEndDateTimestamp);
        AmazingSale::create($inputs);
        return redirect()->route('admin.market.discount.amazing.sale')->with('swal-success',' فروش شگفت انگیز شما با موفقیت ثبت شد');
    }

    public function amazingSaleEdit(AmazingSale $amazingSale)
    {
        $products = Product::all();
        return view('admin.market.discount.amazing-sale-edit',compact('amazingSale','products'));
    }

    public function amazingSaleUpdate(AmazingSaleRequest $request , AmazingSale $amazingSale)
    {
        $inputs=$request->all();
        $realFormatStartDateTimestamp = substr($request->start_date,0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$realFormatStartDateTimestamp);
        $realFormatEndDateTimestamp = substr($request->end_date,0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$realFormatEndDateTimestamp);
        $amazingSale->update($inputs);
        return redirect()->route('admin.market.discount.amazing.sale')->with('swal-success',' فروش شگفت انگیز شما با موفقیت ویرایش شد');
    }

    public function amazingSaleDestroy(AmazingSale $amazingSale)
    {
         $amazingSale->delete();
         return redirect()->route('admin.market.discount.amazing.sale')->with('swal-success','فروش شگفت انگیز شما با موفقیت حذف شد');

    }
}
