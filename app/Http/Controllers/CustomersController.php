<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customers::all();
        return view('index', compact('customers'));
    }

    public function store(Request $request)
    {
        $customer = new Customers();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->save();

        return response()->json($customer);
    }

    public function update($id, Request $request)
    {
        DB::table('customer')->where('id', $id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        $customer = Customers::find($id);

        return response()->json($customer);
    }

    public function show($id)
    {
        $customer = Customers::find($id);
        return response()->json($customer);
    }

    public function delete($id)
    {
        $customer = Customers::find($id);
        $customer->delete();
        return response()->json("ok");
    }
}
