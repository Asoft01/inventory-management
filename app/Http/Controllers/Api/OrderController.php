<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function TodayOrder(){
        $data = date('d/m/Y');
        $order= DB::table('orders')
                ->join('customers', 'orders.customer_id', 'customers.id')
                ->where('order_date', $data)
                ->select('customers.name', 'orders.*')
                ->orderBy('orders.id', 'DESC')->get();
                return response()->json($order);
    }
}
