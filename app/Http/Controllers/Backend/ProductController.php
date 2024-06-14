<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Models;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with(['category'])->orderBy('id', 'ASC')->paginate(10);
        if (request()->q != '') {
            $product = $product->where('name', 'LIKE', '%' . request()->q . '%');
        }
        return view('backend.pages.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::where('status', 1)->whereNot('name', 'Liquid')->get();
        return view('backend.pages.product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'color' => 'nullable',
            'nicotine' => 'nullable',
            'price'=> 'required|numeric',
            'weight' => 'required|numeric',
            'qty' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpeg,jpg,webp|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|integer'
        ]);

        try {
            DB::beginTransaction();

            $category = Category::find($request->category_id);

            $filename = 'default.png';
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::slug($category->slug) . '-' . Str::slug($request->name) . '-' . rand(0, 99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/products', $filename);
            }

            $color = $request->input('color');
            if ($color) {
                $data['color'] = is_array($color) ? implode(',', $color) : $color;
            } else {
                $data['color'] = '';
            }

            $nicotine = $request->input('nicotine');
            if ($nicotine) {
                $data['nicotine'] = is_array($nicotine) ? implode(',', $nicotine) : $nicotine;
            } else {
                $data['nicotine'] = '';
            }

            $product->create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'slug' => Str::slug($category->slug) . '-' . Str::slug($request->name) . '-' . rand(0, 99999),
                'color' => $data['color'],
                'nicotine' => $data['nicotine'],
                'price' => $request->price,
                'weight' => $request->weight,
                'qty' => $request->qty,
                'image' => $filename,
                'description' => $request->description,
                'status' => $request->status
            ]);

            DB::commit();

            Alert::toast('Produk Berhasil Ditambah', 'success');
            return redirect(route('product.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menambah Produk'. $e->getMessage(), 'error');
            return redirect(route('product.index'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $items = Product::where('id', $id)->get();
        $category = Category::where('status', 1)->whereNot('name', 'Liquid')->get();
        return view('backend.pages.product.edit', compact('product', 'items', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'color' => 'nullable',
            'nicotine' => 'nullable',
            'price'=> 'required|numeric',
            'weight' => 'required|numeric',
            'qty' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpeg,jpg,webp|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|integer'
        ]);

        try {
            DB::beginTransaction();

            $product = Product::findOrFail($id);
            $category = Category::find($request->category_id);

            $filename = $product->image;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::slug($category->slug) . '-' . Str::slug($request->name) . '-' . rand(0, 99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/products', $filename);

                if ($product->image !== 'default.png') {
                    File::delete(storage_path('app/public/products/' . $product->image));
                }
            }

            $color = $request->input('color');
            if ($color) {
                $data['color'] = is_array($color) ? implode(',', $color) : $color;
            } else {
                $data['color'] = '';
            }

            $nicotine = $request->input('nicotine');
            if ($nicotine) {
                $data['nicotine'] = is_array($nicotine) ? implode(',', $nicotine) : $nicotine;
            } else {
                $data['nicotine'] = '';
            }

            $product->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'slug' => Str::slug($category->slug) . '-' . Str::slug($request->name) . '-' . rand(0, 99999),
                'color' => $data['color'],
                'nicotine' => $data['nicotine'],
                'price' => $request->price,
                'weight' => $request->weight,
                'qty' => $request->qty,
                'image' => $filename,
                'description' => $request->description,
                'status' => $request->status
            ]);

            DB::commit();

            Alert::toast('Produk Berhasil Diubah', 'success');
            return redirect(route('product.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Mengubah Produk'. $e->getMessage(), 'error');
            return redirect(route('product.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);
            $imagePath = storage_path('app/public/products/' . $product->image);
            if ($product->image !== 'default.png' && File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $product->delete();

            Alert::toast('Produk Berhasil Dihapus', 'success');
            return redirect(route('product.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menghapus Produk', 'error');
            return redirect(route('product.index'));
        }
    }
}
