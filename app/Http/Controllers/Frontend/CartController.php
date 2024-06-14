<?php

namespace App\Http\Controllers\Frontend;

use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\District;
use App\Models\Province;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\CustomerRegisterMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    private function getCarts()
    {
        $carts = json_decode(request()->cookie('vapor-carts'), true);
        $carts = $carts != '' ? $carts:[];
        return $carts;
    }

    public function listCart()
    {
        $carts = $this->getCarts();

        $subtotal = collect($carts)->sum(function($q) {
            return $q['qty'] * $q['product_price'];
        });
        return view('frontend.pages.cart.index', compact('carts', 'subtotal'));
    }

    public function addToCart(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        try {
            $product = Product::find($request->product_id);

            if (!$product) {
                Alert::toast('Produk Tidak Ditemukan', 'error');
                return redirect()->back();
            }

            $availableQty = $product->qty;
            $carts = json_decode(request()->cookie('vapor-carts'), true);

            if ($carts && array_key_exists($request->product_id, $carts)) {
                $newQty = $carts[$request->product_id]['qty'] + $request->qty;
                if ($newQty > $availableQty) {
                    Alert::toast('Stok tidak mencukupi', 'error');
                    return redirect()->back();
                }
                $carts[$request->product_id]['qty'] = $newQty;
            } else {
                if ($request->qty > $availableQty) {
                    Alert::toast('Stok tidak mencukupi', 'error');
                    return redirect()->back();
                }
                $carts[$request->product_id] = [
                    'qty' => $request->qty,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_slug' => $product->slug,
                    'product_category' => $product->category->name,
                    'product_image' => $product->image,
                    'product_price' => $product->price,
                    'product_color' => $request->color,
                    'product_nicotine' => $request->nicotine,
                    'weight' => $product->weight
                ];
            }

            $cookie = cookie('vapor-carts', json_encode($carts), 2880);
            Alert::toast('Produk Berhasil Ditambah', 'success');
            return redirect()->back()->cookie($cookie);
        } catch (\Exception $e) {
            Alert::toast('Error Saat Menambah Produk', 'error');
            return redirect()->back();
        }
    }

    public function updateCart(Request $request)
    {
        try {
            $carts = $this->getCarts();

            foreach ($request->product_id as $key => $row) {
                $product = Product::find($row);

                if (!$product) {
                    continue;
                }

                if ($request->qty[$key] < 0) {
                    continue;
                }

                if ($request->qty[$key] > $product->qty) {
                    Alert::toast('Stok tidak mencukupi', 'error');
                    return redirect()->back();
                }

                if ($request->qty[$key] == 0) {
                    unset($carts[$row]);
                } else {
                    $carts[$row]['qty'] = $request->qty[$key];
                }
            }

            $cookie = cookie('vapor-carts', json_encode($carts), 2880);
            Alert::toast('Keranjang Berhasil Diupdate', 'success');
            return redirect()->back()->cookie($cookie);
        } catch (\Exception $e) {
            Alert::toast('Error Saat Mengupdate Keranjang', 'error');
            return redirect()->back();
        }
    }

    public function checkout()
    {
        $customers = auth()->guard('customer')->user();
        if ($customers) {
            $customer = auth()->guard('customer')->user()->load('district');
            $provinces = Province::orderBy('created_at', 'DESC')->get();
            $carts = $this->getCarts();

            $subtotal = collect($carts)->sum(function($q) {
                return $q['qty'] * $q['product_price'];
            });

            $weight = collect($carts)->sum(function($q) {
                return $q['qty'] * $q['weight'];
            });
            return view('frontend.pages.cart.checkout', compact('provinces', 'carts', 'subtotal', 'customer', 'weight'));
        } else {
            $provinces = Province::orderBy('created_at', 'DESC')->get();
            $carts = $this->getCarts();

            $subtotal = collect($carts)->sum(function($q) {
                return $q['qty'] * $q['product_price'];
            });

            $weight = collect($carts)->sum(function($q) {
                return $q['qty'] * $q['weight'];
            });
            return view('frontend.pages.cart.checkout', compact('provinces', 'carts', 'subtotal', 'weight'));
        }
    }

    public function processCheckout(Request $request)
    {
        $this->validate($request, [
            'customer_first_name' => 'required|string|max:100',
            'customer_last_name' => 'required|string|max:100',
            'customer_phone' => 'required|numeric',
            'email' => 'required|email',
            'customer_address' => 'required|string',
            'customer_postal_code' => 'required|numeric',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'courier' => 'required',
            'shipping' => 'required'
        ]);

        DB::beginTransaction();

        try {
            $customer = Customer::where('email', $request->email)->first();
            if (!auth()->guard('customer')->check() && $customer) {
                Alert::toast('Akun Anda Telah Terdaftar, Silahkan Login Terlebih Dahulu', 'error');
                return redirect()->back();
            }

            $carts = $this->getCarts();
            $subtotal = collect($carts)->sum(function($q) {
                return $q['qty'] * $q['product_price'];
            });

            if (!auth()->guard('customer')->check()) {
                $password = Str::random(8);
                $customer = Customer::create([
                    'first_name' => $request->customer_first_name,
                    'last_name' => $request->customer_last_name,
                    'email' => $request->email,
                    'password' => $password,
                    'phone' => $request->customer_phone,
                    'address' => $request->customer_address,
                    'postal_code' => $request->customer_postal_code,
                    'district_id' => $request->district_id,
                    'activate_token' => Str::random(30),
                    'status' => false
                ]);
            }

            $shipping = explode('-', $request->courier);
            $order = Order::create([
                'invoice' => 'INV' . '-' . rand(0,99999),
                'customer_id' => $customer->id,
                'customer_name' => $customer->first_name . ' ' . $customer->last_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'customer_postal_code' => $request->customer_postal_code,
                'district_id' => $request->district_id,
                'subtotal' => $subtotal,
                'cost' => $request->shipping,
                'courier' => $request->courier
            ]);

            foreach ($carts as $row) {
                $product = Product::find($row['product_id']);

                $product->update([
                    'qty' => $product->qty - $row['qty']
                ]);

                $color = isset($row['product_color']) ? $row['product_color'] : '';
                $nicotine = isset($row['product_nicotine']) ? $row['product_nicotine'] : '';

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $row['product_id'],
                    'color' => $color,
                    'nicotine' => $nicotine,
                    'price' => $row['product_price'],
                    'weight' => $product->weight,
                    'qty' => $row['qty']
                ]);
            }

            DB::commit();

            $carts = [];
            $cookie = cookie('vapor-carts', json_encode($carts), 2880);

            if (!auth()->guard('customer')->check()) {
                Mail::to($request->email)->send(new CustomerRegisterMail($customer, $password));
            }

            Alert::toast('Produk Berhasil Dicheckout', 'success');
            return redirect(route('front.finish_checkout', $order->invoice))->cookie($cookie);
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Produk Dicheckout'. $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function checkoutFinish($invoice)
    {
        $order = Order::with(['district.city'])->where('invoice', $invoice)->first();
        return view('frontend.pages.cart.invoice', compact('order'))->with(['success' => 'successfully']);
    }

    public function getCity()
    {
        $cities = City::where('province_id', request()->province_id)->get();
        return response()->json(['status' => 'success', 'data' => $cities]);
    }

    public function getDistrict()
    {
        $districts = District::where('city_id', request()->city_id)->get();
        return response()->json(['status' => 'success', 'data' => $districts]);
    }

    public function getCost()
    {
        $destination = request()->destination;
        $weight = request()->weight;
        $origin = 156;
        $courier = request()->courier;

        $destinations =  "origin=$origin&destination=$destination&weight=$weight&courier=$courier";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $destinations,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: b5eac45ab0fe11aa75b6d56096e90e55"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        echo $err;
        curl_close($curl);


        if ($err) {
                dd($err);
        } else {
            return json_decode($response);
        }
    }
}
