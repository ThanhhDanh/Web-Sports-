<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

// nohup /d/PHP-Laragon/mailpit/mailpit.exe/mailpit.exe > mailpit.log 2>&1 &
class RegisterController extends Controller
{

    protected $redirectAfterRegistrationTo = '/users-management';
    // Show register page
    public function showRegister()
    {
        return view('auth.register');
    }

    // Create a new user
    public function create(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->createUser($request->all())));

        return $this->registered($request, $user)
            ?: redirect($this->redirectAfterRegistrationPath())->with('confirmation', __('confirmation::confirmation.confirmation_info'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'avatar' => 'required|image|max:2048',
        ], [
            'name.required' => 'Vui lòng nhập tên của bạn',
            'last_name.required' => 'Vui lòng nhập họ của bạn',
            'email.required' => 'Vui lòng nhập email của bạn',
            'email.unique' => 'Email này đã tồn tại. Vui lòng nhập email khác',
            'phone.required' => "Vui lòng nhập số điện thoại của bạn.",
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.confirmed' => 'Mật khẩu xác nhận chưa nhập đúng',
            'password_confirmation.required' => 'Vui lòng nhập mật khẩu xác nhận',
            'avatar' => 'Vui lòng chọn ảnh nền'
        ]);
    }

    protected function createUser(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        if (request()->hasFile('avatar')) {
            $user->addMedia(request()->file('avatar'))->toMediaCollection('avatar');
        }

        // Role
        $user->assignRole('user');

        $user->sendEmailVerificationNotification();

        return $user;
    }

    protected function registered()
    {
        return redirect()->route('users.index')->with('success', 'Đăng ký người dùng thành công. Vui lòng kiểm tra email để xác minh tài khoản.');
    }

    public function redirectAfterRegistrationPath()
    {
        if (method_exists($this, 'redirectAfterRegistrationTo')) {
            return $this->redirectAfterRegistrationTo();
        }

        return property_exists($this, 'redirectAfterRegistrationTo') ? $this->redirectAfterRegistrationTo : route('users.index');
    }
}
