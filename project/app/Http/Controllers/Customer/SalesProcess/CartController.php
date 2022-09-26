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
        if(Auth::check())
        {
            $cartItems = CartItem::where('user_id',Auth::user()->id)->get();

            if($cartItems->count() > 0)
            {
                $relatedProducts = Product::all();
                return view('customer.sales-process.cart',compact('cartItems','relatedProducts'));

            }else{

                return back();
            }

        }else
        {
            return redirect()->route('auth.customer.login-register-form');
        }

    }

    public function updateCart(Request $request)
    {
        $inputs = $request->all();
        $cartItems = CartItem::Where('user_id',Auth::user()->id)->get();
        foreach($cartItems as $cartItem)
        {
            if(isset($inputs['number'][$cartItem->id]))
            {
                $cartItem->update(['number' => $inputs['number'][$cartItem->id]]);
            }
        }

        return redirect()->route('customer.sales-process.address-and-delivery');


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

    public function removeFromCart(CartItem $cartItem)
    {
        if($cartItem->user_id == Auth::user()->id)
        {
            $cartItem->delete();
        }

        return back()->with('swal-success','محصول شما با موفقیت از سبد خرید حذف شد');
    }
}
