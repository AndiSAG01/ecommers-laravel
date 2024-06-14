<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Province;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function account()
    {
        $orders = Order::where('customer_id', auth()->guard('customer')->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        $orderDetails = OrderDetail::whereIn('order_id', $orders->pluck('id')->toArray())->get();

        $customer = auth()->guard('customer')->user();
        return view('frontend.pages.dashboard.account', compact('orders', 'orderDetails', 'customer'));
    }

    public function setting()
    {
        $province = Province::orderBy('name', 'ASC')->get();
        $customer = auth()->guard('customer')->user()->load('district');
        return view('frontend.pages.dashboard.setting', compact('province', 'customer'));
    }

    public function settingUpdate(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:100',
            'first_name' => 'nullable|string|max:100',
            'phone' => 'nullable|numeric',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'postal_code' => 'nullable|numeric',
            'district_id' => 'nullable|exists:districts,id',
            'password' => 'nullable|string|min:6'
        ]);

        $customer = auth()->guard('customer')->user();
        $data = $request->only('first_name', 'last_name', 'phone', 'address', 'country', 'postal_code', 'district_id');

        if ($request->password != '') {
            $data['password'] = $request->password;
        }

        $customer->update($data);
        Alert::toast('Account Berhasil Diubah', 'success');
        return redirect()->back();
    }
}
