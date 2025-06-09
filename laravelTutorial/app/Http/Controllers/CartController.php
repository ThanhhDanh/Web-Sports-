<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $carts = CartItem::with(['product', 'size', 'color', 'discount'])
            ->where('user_id', $request->user()->id)
            ->get();

        $carts->each(function ($cart) {
            if ($cart->product) {
                $cart->product->image = $cart->product->image;
            }
        });

        return response()->json($carts);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'size_id' => 'nullable|exists:sizes,id',
            'color_id' => 'nullable|exists:colors,id',
            'discount_id' => 'nullable|exists:discounts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $validated['user_id'] = $request->user()->id;

        $cart = CartItem::where([
            'user_id' => $validated['user_id'],
            'product_id' => $validated['product_id'],
            'size_id' => $validated['size_id'],
            'color_id' => $validated['color_id'],
        ])->first();

        if ($cart) {
            $cart->quantity += $validated['quantity'];
            $cart->discount_id = $validated['discount_id'] ?? $cart->discount_id;
            $cart->save();
        } else {
            $cart = CartItem::create($validated);
        }

        $cart = $cart->load(['product', 'size', 'color', 'discount']);

        if ($cart->product) {
            $cart->product->image = $cart->product->image;
        }

        return response()->json($cart);
    }

    public function update(Request $request, $id)
    {
        $cart = CartItem::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();

        $request->validate([
            'quantity' => 'required|integer|min:1',
            'discount_id' => 'nullable|exists:discounts,id',
        ]);

        $cart->update([
            'quantity' => $request->quantity,
            'discount_id' => $request->discount_id,
        ]);

        return response()->json($cart);
    }

    public function destroy(Request $request, $id)
    {
        $cart = CartItem::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $cart->delete();

        return response()->json(['message' => 'Đã xóa khỏi giỏ hàng']);
    }
}
