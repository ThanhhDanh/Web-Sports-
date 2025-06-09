<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Colors;
use App\Models\Products;
use App\Models\Sizes;
use App\Models\User;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $sortColumn = $request->get('column', 'id');
        $sortDirection = $request->get('sort', 'asc');
        $query = Products::query();

        if ($request->filled('size')) {
            $query->whereHas('sizes', function ($q) use ($request) {
                $q->where('sizes.id', $request->size);
            });
        }

        if ($request->filled('color')) {
            $query->whereHas('colors', function ($q) use ($request) {
                $q->where('colors.id', $request->color);
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Trả JSON nếu là request từ JS
        if ($request->wantsJson()) {
            $products = $query->orderBy($sortColumn, $sortDirection)->paginate(5);

            // Thêm ảnh cho mỗi sản phẩm
            $products->getCollection()->transform(function ($product) {
                $product->image = $product->image;
                return $product;
            });

            return response()->json(['products' => $products]);
        }

        $products = $query->orderBy($sortColumn, $sortDirection)->paginate(5);

        $sizes = Sizes::all();
        $colors = Colors::all();
        return view('pages.products.products')->with(
            [
                'products' => $products->appends(request()->query()),
                'sizes' => $sizes,
                'colors' => $colors,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin']);
        })->get();
        $categories = Categories::all();
        $colors = Colors::all();
        $sizes = Sizes::all();
        $product = Products::all();
        return view('pages.products.create-product')->with(
            [
                'users' => $users,
                'categories' => $categories,
                'colors' => $colors,
                'sizes' => $sizes,
                'product' => $product,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|max:2048', // Only images are allowed
            'price' => 'required',
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'sizes' => 'required|array',
            'colors' => 'required|array'
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'description.required' => 'Vui lòng nhập mô tả sản phẩm',
            'image.required' => 'Vui lòng chọn hình ảnh sản phẩm', // Only images are allowed
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'user_id.required' => 'Vui lòng chọn thông tin người tạo',
            'category_id.required' => 'Vui lòng chọn loại sản phẩm',
            'sizes.required' => 'Vui lòng chọn size sản phẩm',
            'colors.required' => 'Vui lòng chọn màu sắc sản phẩm'
        ]);


        $product = Products::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id
        ]);

        if ($request->hasFile('image')) {
            $product->addMedia($request->file('image'))->toMediaCollection('product_images');
        }

        $product->colors()->sync($request->colors ?? []);
        $product->sizes()->sync($request->sizes ?? []);

        return redirect()->route('products.index')->with('success', 'Sản phẩm được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function showDetail(Products $product, Request $request)
    {
        $previous = Products::where('id', '<', $product->id)->orderBy('id', 'desc')->first();
        $next = Products::where('id', '>', $product->id)->orderBy('id', 'asc')->first();
        // Trả JSON nếu là request từ JS
        if ($request->wantsJson()) {
            // Thêm ảnh cho mỗi sản phẩm
            $product->image = $product->image;
            $product->load(['sizes', 'colors']);

            return response()->json([
                'product' => $product,
                'previous' => $previous,
                'next' => $next
            ]);
        }
        return view('pages.products.detail-product')->with(
            'product',
            $product
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        $colors = Colors::all();
        $sizes = Sizes::all();
        return view('pages.products.edit-product')->with(
            [
                'product' => $product,
                'colors' => $colors,
                'sizes' => $sizes
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $productId)
    {

        $validate = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // Only images are allowed
            'price' => 'required',
            'colors' => 'array',
            'sizes' => 'array',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'description.required' => 'Vui lòng nhập mô tả sản phẩm',
            'image.required' => 'Vui lòng chọn hình ảnh sản phẩm', // Only images are allowed
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'color.array' => 'Vui lòng chọn màu sản phẩm nhiều được',
            'sizes.array' => 'Vui lòng chọn size sản phẩm nhiều được',
        ]);

        $product = Products::find($productId);

        $price = convertPriceToInteger($request->input('price'));

        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => (string) $price,
        ]);
        $product->colors()->sync($request->colors);
        $product->sizes()->sync($request->sizes);

        // Kiểm tra và cập nhật ảnh
        if ($request->hasFile('image')) {
            $product->clearMediaCollection('product_images');
            $product->addMedia($request->file('image'))->toMediaCollection('product_images');
        }
        return redirect()->route('products.index')->with('success', 'Sản phẩm được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productId)
    {
        $product = Products::find($productId);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Sản phẩm được xóa thành công');
    }


    /**
     * Search the specified resource from storage.
     */
    public function search(Request $request)
    {
        $request->validate([
            'name' => "required|max:50",
        ]);

        $query = Products::query();

        if ($request->filled('size')) {
            $query->whereHas('sizes', function ($q) use ($request) {
                $q->where('sizes.id', $request->size);
            });
        }

        if ($request->filled('color')) {
            $query->whereHas('colors', function ($q) use ($request) {
                $q->where('colors.id', $request->color);
            });
        }

        $products = Products::where('name', 'LIKE', "%{$request->name}%")->paginate(3);

        $sizes = Sizes::all();
        $colors = Colors::all();

        return view('pages.products.products')->with([
            'products' => $products,
            'sizes' => $sizes,
            'colors' => $colors,
        ]);
    }
}
