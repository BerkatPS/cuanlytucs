<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan daftar kategori
    public function index(Request $request)
    {
        // Menampilkan kategori hanya untuk user yang sedang login
        $categories = Category::where('user_id', auth()->id())
            ->when($request->has('search_name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search_name . '%');
            })
            ->when($request->has('search_description'), function ($query) use ($request) {
                $query->where('description', 'like', '%' . $request->search_description . '%');
            })
            ->get();

        return view('dashboard.categories', compact('categories'));
    }



    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        return view('dashboard.categories_create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:255',
        ]);

        // Menyimpan kategori baru
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->id(), // Menyimpan ID user yang sedang login
        ]);

        return redirect()->route('categories')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories_edit', compact('category'));
    }

    // Mengupdate kategori yang sudah ada
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('categories')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories')->with('success', 'Kategori berhasil dihapus.');
    }
}
