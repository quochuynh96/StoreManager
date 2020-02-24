<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function checkLogin(Request $request)
    {
        if(($request->session()->has('login'))&&($request->session()->has('account')))
        {
            $account = $request->session()->get('account');
            return view('general.index')->with('account', $account);
        }
        else
        {
            return view('general.login');
        }
    }

    public function getLogin(Request $request)
    {
        if(!$request->has('username'))
        {
            return '<p class="text-danger">Lỗi dữ liệu tên tài khoản !</p>';
        }
        if(!$request->has('password'))
        {
            return '<p class="text-danger">Lỗi dữ liệu mật khẩu !</p>';
        }

        $username = $request->get('username');
        $password = $request->get('password');

        if(strlen($username) == 0)
        {
            return '<p class="text-danger">Tên tài khoản rỗng !</p>';
        }
        if(strlen($password) == 0)
        {
            return '<p class="text-danger">Mật khẩu rỗng !</p>';
        }
        
        $account = DB::table('account')->where('username', '=',$username)->first();

        if($account === null)
        {
            return '<p class="text-danger">Tài khoản chưa được đăng ký !</p>';
        }
        if($account->password === $password)
        {
            $request->session()->put('login',1);
            $request->session()->put('account',$account);
            
            return '<p class="text-success">Đăng nhập thành công tài khoản : '.$account->displayname.' . Tự động chuyển về trang quản lý  !</p>';
        }
        else
        {
            return '<p class="text-danger">Tìm thấy tài khoản : '.$account->displayname.' . Nhưng mật khẩu không đúng !</p>';
        }
    }

    public function getLogout(Request $request)
    {
        $request->session()->forget('login');
        $request->session()->forget('account');
        
        return view('general.login');
    }
}
