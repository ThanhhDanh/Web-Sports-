<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | Controller này chịu trách nhiệm xử lý việc xác nhận mật khẩu và
    | sử dụng một trait đơn giản để bao gồm hành vi này. Bạn có thể tự do
    | khám phá trait này và ghi đè bất kỳ hàm nào cần tùy chỉnh.
    |
    */

    use ConfirmsPasswords;

    /**
     * Nơi để chuyển hướng người dùng khi URL dự định thất bại.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Tạo một instance mới của controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}