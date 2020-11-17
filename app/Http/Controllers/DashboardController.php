<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = array();
        $order = [];
        $revenue = [];
        $fromDate = Carbon::createFromFormat('Y-m-d','2019-16-11');
        $toDate = Carbon::createFromFormat('Y-m-d','2020-16-11');
        $customersQuery = Customer::selectRaw("DATE_FORMAT(created_at, '%Y %m %d') date, COUNT(*) count")
                            ->whereDate('created_at', '>', $fromDate->toDateString())
                            ->whereDate('created_at', '<', $toDate->toDateString())
                            ->groupBy('date')
                            ->orderByRaw("STR_TO_DATE(date, '%Y %m %d')")
                            ->pluck('count','date');

        foreach ($customersQuery as $key => $value) {
            $row = array($key, $value);
            $customer[] = $row;
        }

        $ordersQuery = Order::selectRaw("DATE_FORMAT(purchase_date, '%Y %m %d') date, COUNT(*) count")
                            ->whereDate('purchase_date', '>', $fromDate->toDateString())
                            ->whereDate('purchase_date', '<', $toDate->toDateString())
                            ->groupBy('date')
                            ->orderByRaw("STR_TO_DATE(date, '%Y %m %d')")
                            ->pluck('count','date');

        foreach ($ordersQuery as $key => $value) {
            $row = array($key, $value);
            $order[] = $row;
        }

        $revenueQuery = OrderItem::SelectRaw("DATE_FORMAT(created_at, '%Y %m %d') date")
                                    ->whereDate('created_at', '>', $fromDate->toDateString())
                                    ->whereDate('created_at', '<', $toDate->toDateString())
                                    ->groupBy('date')
                                    ->orderByRaw("STR_TO_DATE(date, '%Y %m %d')")
                                    ->selectRaw("SUM(price) as revenue")
                                    ->pluck('revenue','date');

        foreach ($revenueQuery as $key => $value) {
            $row = array($key, $value);
            $revenue[] = $row;
        }

        return view('sales.dashboard')
                ->with(compact('customer'))
                ->with(compact('order'))
                ->with(compact('revenue'));
    }
}
