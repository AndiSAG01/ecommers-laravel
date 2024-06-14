<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::with(['parent'])->orderBy('id', 'ASC')->paginate(10);
        $parent = Category::getParent()->orderBy('name', 'ASC')->get();

        return view('backend.pages.category.index', compact('category', 'parent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parent = Category::getParent()->orderBy('name', 'ASC')->get();

        return view('backend.pages.category.create', compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:categories',
            'status' => 'required|integer'
        ]);

        try {
            DB::beginTransaction();

            $request->request->add(['slug' => $request->name]);
            Category::create($request->except('_token'));

            DB::commit();

            Alert::toast('Kategori Berhasil Ditambah', 'success');
            return redirect(route('category.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menambah Kategori'. $e->getMessage(), 'error');
            return redirect(route('category.index'));
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
        $category = Category::findOrFail($id);
        $parent = Category::getParent()->orderBy('name', 'ASC')->get();

        return view('backend.pages.category.edit', compact('category', 'parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:categories,name,' . $id,
            'status' => 'required|integer'
        ]);

        try {
            DB::beginTransaction();

            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'parent_id' => $request->parent_id,
                'status' => $request->status,
            ]);

            DB::commit();

            Alert::toast('Kategori Berhasil Diupdate', 'success');
            return redirect(route('category.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Mengupdate Kategori'. $e->getMessage(), 'error');
            return redirect(route('category.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::withCount(['child', 'product'])->find($id);
        if ($category->child_count == 0 && $category->product_count == 0) {
            $category->delete();

            Alert::toast('Kategori Berhasil Dihapus', 'success');
            return redirect(route('category.index'));
        }

        Alert::toast('Error Saat Menghapus Kategori', 'error');
        return redirect(route('category.index'));
    }
}
