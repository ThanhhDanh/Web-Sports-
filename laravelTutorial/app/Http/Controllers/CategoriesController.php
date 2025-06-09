<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Kiểm tra xem yêu cầu có phải là AJAX (hoặc request từ frontend)
        $sortColumn = $request->get('column', 'id');
        $sortDirection = $request->get('sort', 'asc');
        if ($request->wantsJson()) {
            $categories = Categories::orderBy($sortColumn, $sortDirection)->paginate(5);
            $dataCategories = Categories::all();
            // Thêm ảnh cho mỗi danh mục
            $dataCategories->transform(function ($category) {
                $category->image = $category->image;
                return $category;
            });
            return response()->json([
                'data' => $dataCategories
            ]);
        }

        // Nếu không phải AJAX, trả về view backend
        $categories = Categories::orderBy($sortColumn, $sortDirection)->paginate(5);
        return view('pages.categories.categories')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
        ];

        $messages = [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'description.required' => 'Vui lòng nhập mô tả danh mục.',
            'image.required' => 'Vui lòng chọn ảnh cho danh mục.',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'image.max' => 'Kích thước ảnh không được vượt quá 2MB.',
        ];

        $request->validate($rules, $messages);

        $category = Categories::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->hasFile('image')) {
            $category->addMedia($request->file('image'))->toMediaCollection('category_images');
        }

        return redirect()->route('categories.index')->with('success', 'Danh mục tạo thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($categoryId)
    {
        $category = Categories::find($categoryId);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json([
            'id' => $category->id,
            'name' => $category->name,
            'description' => $category->description,
            'image' => $category->image,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $categoryId)
    {
        $category = Categories::find($categoryId);
        // dd($category);

        if (!$category) {
            return redirect()->back()->with('error', 'Không tìm thấy danh mục.');
        }

        // Validate dữ liệu
        $rules1 = [
            'name-edit' => 'required|string|max:255',
            'description-edit' => 'required|string',
            'image-edit' => 'nullable|image|max:2048',
        ];

        $messages1 = [
            'name-edit.required' => 'Vui lòng nhập tên danh mục.',
            'description-edit.required' => 'Vui lòng nhập mô tả danh mục.',
            'image-edit.image' => 'Tệp tải lên phải là hình ảnh.',
            'image-edit.max' => 'Kích thước ảnh không được vượt quá 2MB.',
        ];

        $request->validate($rules1, $messages1);

        // Cập nhật dữ liệu
        $category->update([
            'name' => $request->input('name-edit'),
            'description' => $request->input('description-edit'),
        ]);

        // Kiểm tra và cập nhật ảnh
        if ($request->hasFile('image-edit')) {
            $category->clearMediaCollection('category_images');
            $category->addMedia($request->file('image-edit'))->toMediaCollection('category_images');
        }

        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categoryId)
    {
        $category = Categories::find($categoryId);
        $category->delete();
        return redirect()->action('\App\Http\Controllers\CategoriesController@index');
    }

    /**
     * Display the specified resource.
     */
    public function showDetail(Categories $category, Request $request)
    {
        $products = Products::where('category_id', $category->id)->get();
        // Trả JSON nếu là request từ JS
        if ($request->wantsJson()) {

            return response()->json(['category' => $category]);
        }
        return view('pages.categories.detail-category')->with(
            [
                'category' => $category,
                'products' => $products
            ]
        );
    }
}
