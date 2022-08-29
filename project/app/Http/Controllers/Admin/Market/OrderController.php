<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function all()
    {
        $orders = Order::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.order.index',compact('orders'));
    }

    public function newOrders()
    {
        $orders = Order::where('order_status',0)->orderBy('created_at','desc')->simplePaginate(15);
        foreach($orders as $order)
        {
            $order->order_status=1;
            $result=$order->save();
        }
        return view('admin.market.order.index',compact('orders'));
    }

    public function sending()
    {
        $orders = Order::where('delivery_status',1)->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.order.index',compact('orders'));
    }

    public function unpaid()
    {
        $orders = Order::where('payment_status',0)->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.order.index',compact('orders'));
    }

    public function canceled()
    {
        $orders = Order::where('order_status',4)->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.order.index',compact('orders'));
    }

    public function returned()
    {
        $orders = Order::where('order_status',5)->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.order.index',compact('orders'));
    }
    public function show()
    {
        return view('admin.market.order.show');
    }
    public function changeSendStatus()
    {
        return view('admin.market.order.changeSendStatus');
    }
    public function changeOrderStatus()
    {
        return view('admin.market.order.changeOrderStatus');
    }
    public function cancelOrder()
    {
        return view('admin.market.order.cancelOrder');
    }
}
