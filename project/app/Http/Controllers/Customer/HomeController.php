<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home()
    {
        $slideShows = Banner::where('position',0)->where('status',1)->get();
        $topSlideShows = Banner::where('position',1)->where('status',1)->take(2)->get();
        $middleSlideShows = Banner::where('position',2)->where('status',1)->take(2)->get();
        $bottomSlideShow = Banner::where('position',3)->where('status',1)->first();

        $brands = Brand::all();

        $mostVisitedProducts = Product::latest()->take(10)->get();
        $offerProducts = Product::latest()->take(10)->get();

        return view('customer.home',compact('slideShows','topSlideShows','middleSlideShows','bottomSlideShow','brands','mostVisitedProducts','offerProducts'));
    }
}
