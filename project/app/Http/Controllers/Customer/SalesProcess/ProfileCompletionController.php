<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Models\Market\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileCompletionController extends Controller
{

    public function profileCompletion()
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id',$user->id)->get();
       return view('customer.sales-process.profile-completion',compact('user','cartItems'));
    }

    public function update(Request $request)
    {
       $request->validate([

         'first_name'=>'sometimes|required|min:2|max:120',
         'last_name'=>'sometimes|required|min:2|max:120',
         'mobile'=>'sometimes|required|unique:users,mobile,id',
         'email'=>'sometimes|required|unique:users,email,id',
         'national_code'=>'sometimes|required|unique:users,national_code,id'
       ]);

       $inputs = $request->all();
       $user=Auth::user();
       $user->update($inputs);
       return redirect()->route('customer.sales-process.address-and-delivery');
    }
}
