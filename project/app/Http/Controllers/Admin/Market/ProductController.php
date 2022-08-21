<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Brand;
use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\ProductMeta;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Market\ProductCategory;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Market\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request , ImageService $imageService)
    {
        $inputs = $request->all();
        if($request->hasFile('image'))
        {
            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'product');
            $result=$imageService->createIndexAndSave($request->file('image'));
            if($result == false)
            {
                return redirect()->route('admin.market.category.index')->with('swal-error','آپلود تصویر با خطا مواجه شد');
            }
        }
        $inputs['image'] = $result;
        $realTimestampFormat = substr($request->published_at,0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$realTimestampFormat);

        DB::transaction(function () use($inputs,$request) {

            $product=Product::create($inputs);
            $metas = array_combine($request->meta_names , $request->meta_values);
            foreach($metas as $key=>$value)
            {
                ProductMeta::create([
                  'meta_name'=>$key,
                  'meta_value'=>$value,
                  'product_id'=>$product->id
                ]);
            }
        });

        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول جدید شما با موفقیت ثبت شد');
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
    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.edit',compact('product','categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product , ImageService $imageService)
    {
        $inputs = $request->all();
        $realTimestampFormat = substr($request->published_at,0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$realTimestampFormat);
        if($request->hasFile('image'))
        {
           if(!empty($product->image))
           {
              $imageService->deleteIndex($product->image);
           }

            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'product');
            $result=$imageService->createIndexAndSave($request->file('image'));
            if($result == false)
            {
                return redirect()->route('admin.market.category.index')->with('swal-error','آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;

        }else{

            $image = $product->image;
            $image['currentImage'] = $inputs['currentImage'];
            $inputs['image'] = $image;
        }

        DB::transaction(function() use($product,$inputs,$request) {

            $product->update($inputs);

            $meta_names_array = $request->meta_names;
            $meta_values_array = $request->meta_values;
            $meta_ids_array = array_keys($request->meta_names);

           $metas=array_map(function($meta_id , $meta_name , $meta_value){

              return array_combine(
                 ['meta_id','meta_name','meta_value'],
                 [$meta_id , $meta_name , $meta_value]
              );

           },$meta_ids_array,$meta_names_array,$meta_values_array);


           foreach($metas as $meta)
           {
             ProductMeta::where('id',$meta['meta_id'])->update([
                'meta_name' => $meta['meta_name'],
                'meta_value' => $meta['meta_value']
             ]);
           }
        });

        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول  شما با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $result = $product->delete();
        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول  شما با موفقیت حذف شد');
    }

    public function status(Product $product)
    {

        $product->status = $product->status == 0 ? 1 : 0;
        $result = $product->save();

        if($result)
        {
            if($product->status == 0)
            {
               return response()->json(['status' => true , 'checked' => false]);

            }else{

                return response()->json(['status' => true , 'checked' => true]);
            }

        }else{

            return response()->json(['status' => false]);
        }
    }

    public function marketable(Product $product)
    {

        $product->marketable = $product->marketable == 0 ? 1 : 0;
        $result = $product->save();

        if($result)
        {
            if($product->marketable == 0)
            {
               return response()->json(['marketable' => true , 'checked' => false]);

            }else{

                return response()->json(['marketable' => true , 'checked' => true]);
            }

        }else{

            return response()->json(['marketable' => false]);
        }
    }
}
