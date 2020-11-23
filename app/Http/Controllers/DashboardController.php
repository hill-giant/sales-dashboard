<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getCustomers($startDate, $endDate)
    {
        $customers = array();
        $customersQuery = Customer::selectRaw("DATE_FORMAT(created_at, '%Y %m %d') date, COUNT(*) count")
                            ->whereDate('created_at', '>', $startDate->toDateString())
                            ->whereDate('created_at', '<', $endDate->toDateString())
                            ->groupBy('date')
                            ->orderByRaw("STR_TO_DATE(date, '%Y %m %d')")
                            ->get();

        foreach ($customersQuery as $row)
        {
            $customers['label'][] = $row->date;
            $customers['data'][] = (int) $row->count;
        }

        return $customers;
    }

    public function getOrders($startDate, $endDate)
    {
        $orders = array();
        $ordersQuery = Order::selectRaw("DATE_FORMAT(purchase_date, '%Y %m %d') date, COUNT(*) count")
                            ->whereDate('purchase_date', '>', $startDate->toDateString())
                            ->whereDate('purchase_date', '<', $endDate->toDateString())
                            ->groupBy('date')
                            ->orderByRaw("STR_TO_DATE(date, '%Y %m %d')")
                            ->get();

        foreach ($ordersQuery as $row)
        {
            $orders['label'][] = $row->date;
            $orders['data'][] = (int) $row->count;
        }

        return $orders;
    }


    public function getRevenue($startDate, $endDate)
    {
        $revenue = array();
        $revenueQuery = OrderItem::SelectRaw("DATE_FORMAT(created_at, '%Y %m %d') date")
                                    ->whereDate('created_at', '>', $startDate->toDateString())
                                    ->whereDate('created_at', '<', $endDate->toDateString())
                                    ->groupBy('date')
                                    ->orderByRaw("STR_TO_DATE(date, '%Y %m %d')")
                                    ->selectRaw("SUM(price) as revenue")
                                    ->get();

        foreach ($revenueQuery as $row)
        {
            $revenue['label'][] = $row->date;
            $revenue['data'][] = (int) $row->revenue;
        }

        return $revenue;
    }

    public function index()
    {
        $startDate = Carbon::now()->subMonths(1);
        $endDate = Carbon::now();
        $customers = $this->getCustomers($startDate, $endDate);
        $orders = $this->getOrders($startDate, $endDate);
        $revenue = $this->getRevenue($startDate, $endDate);

        return view('sales.dashboard')
                ->with(compact('customers'))
                ->with(compact('orders'))
                ->with(compact('revenue'));
    }

    public function dateRangeRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start' => 'required',
            'end' => 'required'
        ]);

        if ($validator->passes())
        {
            $startDate = Carbon::createFromFormat("Y m d", $request->start);
            $endDate = Carbon::createFromFormat("Y m d", $request->end);
            $customers = $this->getCustomers($startDate, $endDate);
            $orders = $this->getOrders($startDate, $endDate);
            $revenue = $this->getRevenue($startDate, $endDate);

            return response()->json([compact('customers'), compact('orders'), compact('revenue')]);
        }
        return response()->json(['error'=>$validator->errors()]);
    }
}
