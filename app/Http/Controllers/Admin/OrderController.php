<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = [
            ['id' => '#ORD-1001', 'date' => '2026-05-14', 'customer' => 'John Doe', 'total' => 225.00, 'payment' => 'Paid', 'status' => 'Processing'],
            ['id' => '#ORD-1002', 'date' => '2026-05-14', 'customer' => 'Jane Smith', 'total' => 170.00, 'payment' => 'Pending', 'status' => 'Pending'],
            ['id' => '#ORD-1003', 'date' => '2026-05-13', 'customer' => 'Mike Johnson', 'total' => 310.00, 'payment' => 'Paid', 'status' => 'Shipped'],
        ];
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        return view('admin.orders.show', compact('id'));
    }
}
