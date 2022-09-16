<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Models\Market\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {

    }

    public function updateCart()
    {

    }

    public function addToCart(Product $product , Request $request)
    {

        if(Auth::check())
        {
            $request->validate([

                'color'=>'nullable|exists:product_colors,id',
                'guarantee'=>'nullable|exists:guarantees,id',
                'number'=>'numeric|min:1|max:5'
            ]);


            $cartItems = CartItem::where('product_id',$product->id)->where('user_id',Auth::user()->id)->get();


            if(!isset($request->color))
            {
                $request->color = null;
            }

            if(!isset($request->guarantee))
            {
                $request->guarantee = null;
            }

            foreach($cartItems as $cartItem)
            {
                if($request->color == $cartItem->color_id && $request->guarantee == $cartItem->guarantee_id)
                {
                    if((int)$request->number !== $cartItem->number)
                    {
                        $cartItem->update(['number'=>$request->number]);

                        return back()->with('swal-success','محصول مورد نظر با موفقیت به سبد خرید شما اضافه شد');

                    }else
                    {
                        return back()->with('swal-error','محصول مورد نظر شما در سبد خرید موجود است');
                    }
                }
            }

            $inputs=[];
            $inputs['color_id']=$request->color;
            $inputs['guarantee_id']=$request->guarantee;
            $inputs['user_id']=Auth::user()->id;
            $inputs['product_id']=$product->id;
            $inputs['number'] = $request->number;

            CartItem::create($inputs);
            return back()->with('swal-success','محصول مورد نظر شما با موفقیت به سبد خرید اضافه شد');;


        }else
        {
            return redirect()->route('auth.customer.login-confirm-form');
        }
    }

    public function removeFromCart()
    {

    }
}
