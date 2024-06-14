<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderDetail;
use App\Models\OrderReturn;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\PDF as PDF;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function view($invoice)
    {
        $order = Order::with(['district.city.province', 'details', 'details.product', 'payment'])->where('invoice', $invoice)->first();
        $customer = auth()->guard('customer')->user();
        if (Order::where('invoice', $invoice)->exists()){
            if(Gate::forUser(auth()->guard('customer')->user())->allows('order-view', $order)){
                return view('frontend.pages.order.view', compact('order', 'customer'));
            }
        } else {
            return redirect()->back();
        }

        Alert::toast('You are not allowed to access other people`s orders', 'error');
        return redirect(route('customer.orders'));
    }

    public function orderPDF($invoice)
    {
        $order = Order::with(['district.city.province', 'details', 'details.product', 'payment'])->where('invoice', $invoice)->first();
        $customer = auth()->guard('customer')->user();
        if(Order::where('invoice', $invoice)->exists()) {
            if(Gate::forUser(auth()->guard('customer')->user())->allows('order-view', $order)) {
                $pdf = PDF::loadView('frontend.pages.order.pdf', compact('order', 'customer'));
                $filename = $order->invoice;
                return $pdf->download($filename.'-invoice.pdf');
            }else {
                Alert::toast('You are not allowed to access other people`s invoices', 'error');
                return redirect(route('customer.orders'));
            }
        } else {
            Alert::toast('Invoice not included in your order', 'error');
            return redirect(route('customer.orders'));
        }
    }

    public function acceptOrder(Request $request)
    {
        $order = Order::find($request->order_id);
        if (!Gate::forUser(auth()->guard('customer')->user())->allows('order-view', $order)) {
            return redirect()->back()->with(['error' => 'Bukan Pesanan Kamu']);
        }
        $order->update(['status' => 4]);
        Alert::toast('Order Confirmed', 'success');
        return redirect()->back();
    }

    public function returnForm($invoice)
    {
        $order = Order::where('invoice', $invoice)->first();
        $customer = auth()->guard('customer')->user();
        if (Order::where('invoice', $invoice)->exists()){
            if(Gate::forUser(auth()->guard('customer')->user())->allows('order-view', $order)){
                return view('frontend.pages.order.return', compact('order', 'customer'));
            }
        } else {
            return redirect()->back();
        }

        Alert::toast('You are not allowed to access other people`s orders', 'error');
        return redirect()->back();
    }

    // public function processReturn(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'reason' => 'required|string',
    //         'refund_transfer' => 'required|string',
    //         'photo' => 'required|image|mimes:png,jpeg,jpg,webp|max:2048'
    //     ]);

    //     try {
    //         $return = OrderReturn::where('order_id', $id)->first();
    //         if ($return) {
    //             return redirect()->back()->with(['error' => 'Permintaan Refund Dalam Proses']);
    //         }

    //         if ($request->hasFile('photo')) {
    //             $file = $request->file('photo');
    //             $filename = time() . Str::random(5) . '.' . $file->getClientOriginalExtension();
    //             $file->storeAs('public/returns', $filename);
    //         }

    //         OrderReturn::create([
    //             'order_id' => $id,
    //             'photo' => $filename,
    //             'reason' => $request->reason,
    //             'refund_transfer' => $request->refund_transfer,
    //             'status' => 0
    //         ]);

    //         DB::commit();

    //         Alert::toast('Berhasil Melakukan Pengembalian', 'success');
    //         return redirect()->back();
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         Alert::toast('Error Saat Melakukan Pengembalian'. $e->getMessage(), 'error');
    //         return redirect()->back();
    //     }
    // }

    public function processReturn(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string',
            'refund_transfer' => 'required|string',
            'photo' => 'required|image|mimes:png,jpeg,jpg,webp|max:2048'
        ]);

        try {
            DB::beginTransaction();

            $return = OrderReturn::where('order_id', $id)->first();
            if ($return) {
                return redirect()->back()->with(['error' => 'Permintaan Pengembalian Dalam Proses']);
            }

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . Str::random(5) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/returns', $filename);
            }

            OrderReturn::create([
                'order_id' => $id,
                'photo' => $filename,
                'reason' => $request->reason,
                'refund_transfer' => $request->refund_transfer,
                'status' => 0
            ]);

            DB::commit();

            Alert::toast('Berhasil Melakukan Pengembalian', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Melakukan Pengembalian'. $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function pdf($invoice)
    {
        $order = Order::with(['district.city.province', 'details', 'details.product', 'payment'])
                ->where('invoice', $invoice)->first();
        if (Order::where('invoice', $invoice)->exists()) {
            if(Gate::forUser(auth()->guard('customer')->user())->allows('order-view', $order)) {
                $pdf = PDF::loadView('ecommerce.pages.order.pdf', compact('order'));
                $filename = $order->invoice;
                return $pdf->download($filename.'-invoice.pdf');
            } else {
                return redirect(route('customer.orders'))->with(['error' => 'Anda Tidak Diizinkan Untuk Mengakses Invoice Orang Lain']);
            }
        } else {
            return redirect(route('customer.orders'))->with(['error' => 'Invoice Tidak ada dalam Orderan Anda']);
        }
    }

    public function paymentForm($invoice)
    {
        $order = Order::with([ 'payment'])->where('invoice', $invoice)->first();
        if (Order::where('invoice', $invoice)->exists()){
            if(Gate::forUser(auth()->guard('customer')->user())->allows('order-view', $order)){
                return view('frontend.pages.order.payment', compact('order'));
            }
        }else {
            return redirect()->back();
        }

        return redirect()->back()->with(['error' => 'Anda Tidak Diizinkan Untuk Mengakses Payment Order Orang Lain']);
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'transfer_to' => 'required|string',
            'transfer_date' => 'required|date',
            'amount'=> 'required|numeric',
            'proof' => 'required|image|mimes:png,jpeg,jpg,webp|max:2048'
        ]);

        try {
            DB::beginTransaction();

            $order = Order::where('invoice', $request->invoice)->first();

            if ($request->hasFile('proof')) {
                $file = $request->file('proof');
                $filename = Str::slug($order->invoice) . '-' . time() . Str::random(5) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/payments', $filename);
            }

            Payment::create([
                'order_id' => $order->id,
                'name' => $request->name,
                'transfer_to' => $request->transfer_to,
                'transfer_date' => Carbon::parse($request->transfer_date)->format('d M Y'),
                'amount' => $request->amount,
                'proof' => $filename,
                'status' => false
            ]);

            $order->update(['status' => 1]);

            DB::commit();

            Alert::toast('Berhasil Melakukan Pembayaran', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Melakukan Pembayaran'. $e->getMessage(), 'error');
            return redirect()->back();
        }
    }
}
