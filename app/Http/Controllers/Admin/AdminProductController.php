<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'   => 'boolean',
        ]);

        // Upload foto utama ke Cloudinary
        $imagePath = null;
        if ($request->hasFile('image')) {
            $uploaded = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'vinshop/products'
            ]);
            $imagePath = $uploaded->getSecurePath();
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image'       => $imagePath,
            'is_active'   => $request->boolean('is_active'),
        ]);

        // Upload foto tambahan ke Cloudinary
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $uploaded = Cloudinary::upload($image->getRealPath(), [
                    'folder' => 'vinshop/products'
                ]);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $uploaded->getSecurePath(),
                    'order'      => $index,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'   => 'boolean',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            $uploaded = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'vinshop/products'
            ]);
            $imagePath = $uploaded->getSecurePath();
        }

        $product->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image'       => $imagePath,
            'is_active'   => $request->boolean('is_active'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $uploaded = Cloudinary::upload($image->getRealPath(), [
                    'folder' => 'vinshop/products'
                ]);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $uploaded->getSecurePath(),
                    'order'      => $index,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk berhasil dihapus!');
    }
}