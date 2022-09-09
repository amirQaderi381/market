<?php

namespace App\Http\Controllers\Customer\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function product(Product $product)
    {
        return view('customer.product.product',compact('product'));
    }

    public function addComment(Product $product)
    {

    }
}
