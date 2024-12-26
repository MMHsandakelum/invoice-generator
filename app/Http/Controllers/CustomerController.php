<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function all_customers(){

        $customers = Customer::orderBy('id', 'DESC')->get();
        return response()->json([
            'customers' => $customers
        ], 200);
    }

    public function add_customer(Request $request){

        $customer['first_name'] = $request->first_name;
        $customer['last_name'] = $request->last_name;
        $customer['email'] = $request->email;
        $customer['address'] = $request->address;
        $customer['phone'] = $request->phone;

        Customer::create($customer);

        return response()->json([
            "message" => "successfully added"
        ]);
    }
}
