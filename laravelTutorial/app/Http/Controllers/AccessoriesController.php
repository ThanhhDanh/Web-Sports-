<?php

namespace App\Http\Controllers;

use App\Models\Colors;
use App\Models\Sizes;
use Illuminate\Http\Request;

class AccessoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function color(Request $request)
    {
        $colors = Colors::all();
        return view('pages.products.accessories.colors')->with([
            'colors' => $colors,
        ]);
    }

    public function size(Request $request)
    {
        $sizes = Sizes::all();
        return view('pages.products.accessories.sizes')->with([
            'sizes' => $sizes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeColor(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
        ];

        $messages = [
            'name.required' => 'Vui lòng nhập tên màu sắc.',
        ];

        $request->validate($rules, $messages);

        $color = Colors::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Màu sản phẩm tạo thành công.');
    }
    public function storeSize(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
        ];

        $messages = [
            'name.required' => 'Vui lòng nhập size sản phẩm.',
        ];

        $request->validate($rules, $messages);

        $size = Sizes::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Size sản phẩm tạo thành công.');
    }

    /**
     * Update the specified resource from storage.
     */
    public function updateColor($colorId, Request $request)
    {
        $color = Colors::find($colorId);

        if ($color) {
            $color->name = $request->input('name');
            $color->save();

            return redirect()->back()->with('success', 'Cập nhật màu sản phẩm thành công!');
        }

        return redirect()->back()->with('error', 'Màu sản phẩm không tồn tại!');
    }
    public function updateSize($sizeId, Request $request)
    {
        $size = Sizes::find($sizeId);

        if ($size) {
            $size->name = $request->input('name');
            $size->save();

            return redirect()->back()->with('success', 'Cập nhật size sản phẩm thành công!');
        }

        return redirect()->back()->with('error', 'Size sản phẩm không tồn tại!');
    }
}
