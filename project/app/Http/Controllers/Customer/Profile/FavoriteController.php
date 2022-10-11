<?php

namespace App\Http\Controllers\Customer\Profile;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{

    public function myFavorite()
    {
        return view('customer.profile.my-favorite');
    }

    public function delete(Product $product)
    {
        $user = auth()->user();
        $user->products()->detach($product->id);
        return redirect()->route('customer.profile.my-favorite')->with('toast-success','محصول با موفقیت از علاقه مندی ها حذف شد');
    }
}
