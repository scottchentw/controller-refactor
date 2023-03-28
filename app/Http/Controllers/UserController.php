<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        return view('user.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('dashboard');
    }

    public function store(Request $request)
    {
        // 1. 驗證
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. 創建用户
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. 上傳頭像圖片並更新用户
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('avatars');
            $user->update(['avatar' => $avatar]);
        }

        // 4. 登錄
        Auth::login($user);

        // 5. 生成一個個人憑證
        // $voucher = Voucher::create([
        //     'code' => Str::random(8),
        //     'discount_percent' => 10,
        //     'user_id' => $user->id
        // ]);

        // 6. 發送帶有歡迎電子郵件的憑證
        // $user->notify(new NewUserWelcomeNotification($voucher->code));

        // 7. 通知管理員有新用户
        // foreach (config('app.admin_emails') as $adminEmail) {
        //     Notification::route('mail', $adminEmail)
        //         ->notify(new NewUserAdminNotification($user));
        // }

        return redirect()->route('dashboard');
    }
}
