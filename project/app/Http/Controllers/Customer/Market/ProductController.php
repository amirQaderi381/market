<?php

namespace App\Http\Controllers\Customer\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Models\Market\Comment;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function product(Product $product)
    {
        $relatedProducts = Product::all();
        return view('customer.product.product',compact('product','relatedProducts'));
    }

    public function addComment(Product $product , Request $request)
    {
       $validated = $request->validate([
        'body'=>'required|min:2|max:500|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u'
       ]);
       $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
       $inputs['author_id'] = Auth::user()->id;
       $inputs['commentable_id'] = $product->id;
       $inputs['commentable_type'] = Product::class;
       Comment::create($inputs);
       return redirect()->route('customer.market.product',$product)->with('swal-success','دیدگاه شما با موفقیت ثبت شد');
    }

    public function addToFavorite(Product $product)
    {
        if(Auth::check())
        {
            $product->users()->toggle([Auth::user()->id]);

            if($product->users->contains(Auth::user()->id))
            {
                return response()->json(['status'=>1]);

            }else{

                return response()->json(['status'=>2]);
            }

        }else{

            return response()->json(['status'=>3]);
        }
    }



}
