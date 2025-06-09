<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember', false);

        // Phân biệt frontend hay admin dựa vào request
        $isFrontend = $request->isJson() || $request->wantsJson() || $request->ajax();
        $guard = $isFrontend ? 'web' : 'admin';

        if (Auth::guard($guard)->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::guard($guard)->user();

            if ($isFrontend) {
                $backendCookie = cookie()->forget('backend_session');

                if (!$user->hasRole('user')) {
                    Auth::guard($guard)->logout();
                    return response()->json(['message' => 'Không có quyền user'], 403)->withCookie($backendCookie);
                }

                return response()->json([
                    'message' => 'Đăng nhập thành công',
                    'user' => [
                        'id' => $user->id,
                        'last_name' => $user->last_name,
                        'name' => $user->name,
                        'email' => $user->email,
                        'avatar' => $user->image,
                        'phone' => $user->phone,
                    ],
                ])->withCookie($backendCookie);
            } else {
                $frontendCookie = cookie()->forget('frontend_session');

                if (!$user->hasRole('admin')) {
                    Auth::guard($guard)->logout();
                    return redirect('/403')->withCookie($frontendCookie);
                }

                return redirect('/dashboard')->with('success', 'Đăng nhập thành công.')->withCookie($frontendCookie);
            }
        }

        // Sai thông tin đăng nhập
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Sai email hoặc mật khẩu'], 401);
        }

        return back()->withErrors(['failed' => 'Sai email hoặc mật khẩu'])->with('error', 'Đăng nhập không thành công.');
    }



    // Handle logout
    public function logout(Request $request)
    {
        $guard = Auth::guard('admin')->check() ? 'admin' : 'web';

        Auth::guard($guard)->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Đăng xuất thành công']);
        }

        if ($guard === 'admin') {
            return redirect('/');
        }
    }
}