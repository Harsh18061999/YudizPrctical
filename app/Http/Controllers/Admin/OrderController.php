<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index($top10 = null){
        if($top10){
            $orders = OrderItem::with(['order','product'])->groupBy('product_id')->orderByRaw('SUM(queintity) DESC')->paginate(5)->withQueryString();
        }else{
            $orders = OrderItem::with(['order','product'])->paginate(5)->withQueryString();
        }
        return view('admin.order.index',compact('orders'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
