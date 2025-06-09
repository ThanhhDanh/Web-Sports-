<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::where('user_id', auth()->id())->get();
        $user = User::where('id', auth()->id())->first();
        // dd($user->getRoleNames()->first());
        return view('auth.profile')->with([
            'products' => $products,
            'user' => $user,
            'isEditing' => false
        ]);
    }

    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        return view('auth.profile', [
            'user' => $user,
            'isEditing' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userId)
    {
        $user = User::find($userId);
        $user->update($request->all());
        return redirect()->route('profile.index', $user->id)->with('success', 'Cập nhật thông tin của bạn thành công.');
    }
}
