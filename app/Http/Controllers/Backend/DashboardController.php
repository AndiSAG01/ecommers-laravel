<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\PDF as PDF;

class DashboardController extends Controller
{
    public function index()
    {
        $order = Order::selectRaw('COALESCE(sum(CASE WHEN status = 4 THEN subtotal + cost END), 0) as turnover,
        COALESCE(count(CASE WHEN status = 0 THEN subtotal END), 0) as newOrder,
        COALESCE(count(CASE WHEN status = 2 THEN subtotal END), 0) as processOrder,
        COALESCE(count(CASE WHEN status = 3 THEN subtotal END), 0) as shipping,
        COALESCE(count(CASE WHEN status = 4 THEN subtotal END), 0) as completeOrder')->whereDoesntHave('return')->get();

        $orders = Order::get();
        $products = Product::get();
        $customers = Customer::get();
        $categories = Category::get();
        $order_details = OrderDetail::get();
        return view('backend.pages.dashboard.index', compact('categories', 'products', 'customers', 'orders', 'order_details', 'order'));
    }

    public function orderReport()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        $order = Order::with(['customer.district'])->whereDoesntHave('return')->whereBetween('created_at', [$start, $end])->get();
        return view('backend.pages.report.order', compact('order'));
    }

    public function orderReportPdf($daterange)
    {
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $order = Order::with(['customer.district'])->whereDoesntHave('return')->whereBetween('created_at', [$start, $end])->get();
        $pdf = PDF::loadView('backend.pages.report.order_pdf', compact('order', 'date'));
        return $pdf->stream();
    }

    public function returnReport()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        $order = Order::with(['customer.district'])->has('return')->whereBetween('created_at', [$start, $end])->get();
        return view('backend.pages.report.return', compact('order'));
    }

    public function returnReportPdf($daterange)
    {
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $order = Order::with(['customer.district'])->has('return')->whereBetween('created_at', [$start, $end])->get();
        $pdf = PDF::loadView('backend.pages.report.return_pdf', compact('order', 'date'));
        return $pdf->stream();
    }

    public function productReport()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        $order = OrderDetail::with(['product'])->has('product')->whereBetween('created_at', [$start, $end])->get();
        return view('backend.pages.report.product', compact('order'));
    }

    public function productReportPdf($daterange)
    {
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $order = OrderDetail::with(['product'])->has('product')->whereBetween('created_at', [$start, $end])->get();
        $pdf = PDF::loadView('backend.pages.report.product_pdf', compact('order', 'date'));
        return $pdf->stream();
    }
}
