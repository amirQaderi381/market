<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function all()
    {
        return view('admin.market.order.index');
    }

    public function newOrders()
    {
        return view('admin.market.order.newOrders');
    }

    public function sending()
    {
        return view('admin.market.order.sending');
    }

    public function unpaid()
    {
        return view('admin.market.order.unpaid');
    }

    public function canceled()
    {
        return view('admin.market.order.canceled');
    }

    public function returned()
    {
        return view('admin.market.order.returned');
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
