<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john.doe@example.com', 'phone' => '+1 212 555 7834', 'joined' => '2026-04-12', 'orders' => 5, 'status' => 'Active'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane.smith@example.com', 'phone' => '+1 310 555 9012', 'joined' => '2026-04-15', 'orders' => 2, 'status' => 'Active'],
            ['id' => 3, 'name' => 'Mike Johnson', 'email' => 'mike.j@example.com', 'phone' => '+44 20 7946 0958', 'joined' => '2026-05-01', 'orders' => 0, 'status' => 'Inactive'],
        ];
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function show($id)
    {
        return view('admin.customers.show', compact('id'));
    }

    public function store(Request $request)
    {
        return back()->with('success', 'Customer created successfully!');
    }
}
