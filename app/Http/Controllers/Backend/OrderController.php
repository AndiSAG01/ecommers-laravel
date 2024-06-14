<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Mail\OrderMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::with(['customer.district.city.province'])->withCount('return')->orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $order = $order->where(function($q) {
                $q->where('customer_name', 'LIKE', '%' . request()->q . '%')
                ->orWhere('invoice', 'LIKE', '%' . request()->q . '%')
                ->orWhere('customer_address', 'LIKE', '%' . request()->q . '%');
            });
        }

        if (request()->status != '') {
            $order = $order->where('status', request()->status);
        }
        $order = $order->paginate(10);
        return view('backend.pages.order.index', compact('order'));
    }

    public function view($invoice)
    {
        if (Order::where('invoice', $invoice)->exists()){
            $order = Order::with(['customer.district.city.province', 'payment', 'details.product'])->withCount('return')->where('invoice', $invoice)->first();
            return view('backend.pages.order.view', compact('order'));
        }else {
            return redirect()->back();
        }
    }

    public function acceptPayment($invoice)
    {
        $order = Order::with(['payment'])->where('invoice', $invoice)->first();
        $order->payment()->update(['status' => 1]);
        $order->update(['status' => 2]);

        Alert::toast('Pembayaran berhasil diterima', 'success');
        return redirect(route('order.view', $order->invoice));
    }

    public function shippingOrder(Request $request)
    {
        $order = Order::with(['customer'])->find($request->order_id);
        $order->update(['tracking_number' => $request->tracking_number, 'status' => 3]);

        Mail::to($order->customer->email)->send(new OrderMail($order));
        return redirect()->back();
    }

    public function return($invoice)
    {
        if (Order::where('invoice', $invoice)->exists()){
            $order = Order::with(['return', 'customer'])->where('invoice', $invoice)->first();
            return view('backend.pages.order.return', compact('order'));
        }else {
            return redirect()->back();
        }
    }

    public function acceptReturn(Request $request)
    {
        $this->validate($request, ['status' => 'required']);
        $order = Order::find($request->order_id);
        $order->return()->update(['status' => $request->status]);
        $order->update(['status' => 4]);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->details()->delete();
        $order->payment()->delete();
        $order->delete();

        Alert::toast('Pesanan berhasil dihapus', 'success');
        return redirect(route('order.index'));
    }
}
