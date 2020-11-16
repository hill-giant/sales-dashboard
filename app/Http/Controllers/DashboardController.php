<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = [];
        $order = [];
        $revenue = [];

        $customers = Customer::select(
            \DB::raw("COUNT(*) as count"),
            \DB::raw("DATE(created_at) as date")
        )->groupBy('date')
         ->orderBy('date')
         ->get();
        
        $orders = Order::select(
            \DB::raw("COUNT(*) as count"),
            \DB::raw("DATE(purchase_date) as date")
        )->groupBy('date')
         ->orderBy('date')
         ->get();

        foreach($customers as $row)
        {
            $customer['label'][] = Carbon::parse($row->date)->format('F d');
            $customer['data'][] = (int) $row->count;
        }

        foreach($orders as $row)
        {
            $order['label'][] = Carbon::parse($row->date)->format('F d');
            $order['data'][] = (int) $row->count;
        }

        return view('sales.dashboard')
                ->with('customer',json_encode($customer,JSON_NUMERIC_CHECK))
                ->with('order',json_encode($order,JSON_NUMERIC_CHECK));
                //->with('revenue',json_encode($order,JSON_NUMERIC_CHECK));
    }
}
