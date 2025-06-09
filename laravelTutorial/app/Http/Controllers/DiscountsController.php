<?php

namespace App\Http\Controllers;

use App\Models\Discounts;
use Illuminate\Http\Request;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortColumn = $request->get('column', 'id');
        $sortDirection = $request->get('sort', 'asc');
        $discounts = Discounts::orderBy($sortColumn, $sortDirection)->paginate(5);
        return view('pages.discounts.discounts')->with([
            'discounts' => $discounts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'price_discount' => 'required',
            'expirate_time' => 'required',
            'amount_discount' => 'required',
        ];

        $messages = [
            'name.required' => 'Vui lòng nhập tên phiếu giảm giá',
            'price_discount.required' => 'Vui lòng nhập giá giảm',
            'expirate_time.required' => 'Vui lòng chọn ngày hết hạn',
            'amount_discount.required' => 'Vui lòng nhập số lượng phiếu giảm giá'
        ];
        $request->validate($rules, $messages);

        $discounts = Discounts::create([
            'name' => $request->name,
            'price_discount' => $request->price_discount,
            'expirate_time' => $request->expirate_time,
            'amount_discount' => $request->amount_discount,
        ]);

        return redirect()->route('discounts.index')->with('success', 'Tạo phiếu giảm giá thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($discountId)
    {
        $discount = Discounts::find($discountId);

        if (!$discount) {
            return response()->json(['error' => 'Không tìm thấy phiếu giảm giá'], 404);
        }

        return response()->json([
            'id' => $discount->id,
            'name' => $discount->name,
            'price_discount' => $discount->price_discount,
            'expirate_time' => $discount->expirate_time,
            'amount_discount' => $discount->amount_discount,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $discountId)
    {
        $discount = Discounts::find($discountId);

        if (!$discount) {
            return redirect()->back()->with('error', 'Phiếu giảm giá không tìm thấy.');
        }

        // Validate dữ liệu
        $rules = [
            'name-edit' => 'required|string|max:255',
            'price_discount-edit' => 'required',
            'expirate_time-edit' => 'required',
            'amount_discount-edit' => 'required',
        ];

        $messages = [
            'name-edit.required' => 'Vui lòng nhập tên phiếu giảm giá',
            'price_discount-edit.required' => 'Vui lòng nhập giá giảm',
            'expirate_time-edit.required' => 'Vui lòng chọn ngày hết hạn',
            'amount_discount-edit.required' => 'Vui lòng nhập số lượng phiếu giảm giá'
        ];

        $request->validate($rules, $messages);

        // Cập nhật dữ liệu
        $discount->update([
            'name' => $request->input('name-edit'),
            'price_discount' => $request->input('price_discount-edit'),
            'expirate_time' => $request->input('expirate_time-edit'),
            'amount_discount' => $request->input('amount_discount-edit'),
        ]);

        return redirect()->route('discounts.index')->with('success', 'Cập nhật phiếu giảm giá thành công.');
    }
}
