<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    /**
     * checkAccount function
     *
     * @param Request $request
     * @return view
     */
    public function checkAccount(Request $request)
    {
        if(!$request->session()->has('account'))
        {
            return view('general.login');
        }
        $account = $request->session()->get('account');

        if($account->role == 0)
        {
            $listAcc = DB::table('account')->where('role', '<>','0')->get();
            return view('manager.mnAccount',['account'=> $account,'listAcc'=>$listAcc]);
        }
        else if($account->role == 1)
        {
            $listGoods = DB::table('goods')->where('active', '=','1')->get();
            $listGuest = DB::table('guest')->get();
            return view('manager.mnSales',['account'=> $account,'listGoods'=>$listGoods,'listGuest' => $listGuest]);
        }
        else
        {
            $listGoods = DB::table('goods')->where('active', '=','1')->get();
            return view('manager.mnWareHouse',['account'=> $account,'listGoods'=>$listGoods]);
        }
    }

    /**
     * locationStatistical function
     *
     * @param Request $request
     * @return view
     */
    public function locationStatistical(Request $request)
    {
        if(!$request->session()->has('account'))
        {
            return view('general.login');
        }
        $account = $request->session()->get('account');

        if($account->role == 0)
        {
            $listHisAddGoods = DB::table('hisaddgoods')->get();
            $listAcc = DB::table('account')->get();
            $listGoods = DB::table('goods')->get();
            $listGuest = DB::table('guest')->get();
            $listOrder = DB::table('guestorder')->get();

            return view('manager.mnStatistical',['account'=> $account , 'listHisAddGoods'=> $listHisAddGoods,'listAcc' => $listAcc,'listGoods' => $listGoods,'listGuest'=>$listGuest,'listOrder'=>$listOrder]);
        }
        else if($account->role == 1)
        {
            return view('general.index')->with('account', $account);
        }
        else
        {
            return view('general.index')->with('account', $account);
        }
    }

    public function locationGuestManager(Request $request)
    {
        if(!$request->session()->has('account'))
        {
            return view('general.login');
        }
        $account = $request->session()->get('account');

        if($account->role == 0)
        {
            return view('general.index')->with('account', $account);
        }
        else if($account->role == 1)
        {
            $listGuest = DB::table('guest')->get();
            return view('manager.mnGuest',['account'=> $account,'listGuest'=>$listGuest]);
        }
        else
        {
            return view('general.index')->with('account', $account);
        }
    }
    
    /**
     * addAccount function
     *
     * @param Request $request
     * @return view
     */
    public function addAccount(Request $request)
    {
        if(!$request->has('username'))
        {
            return '<p class="text-danger">Lỗi dữ liệu tên tài khoản !</p>';
        }
        if(!$request->has('password'))
        {
            return '<p class="text-danger">Lỗi dữ liệu mật khẩu !</p>';
        }
        if(!$request->has('displayname'))
        {
            return '<p class="text-danger">Lỗi dữ liệu tên hiển thị !</p>';
        }
        if(!$request->has('role'))
        {
            return '<p class="text-danger">Lỗi dữ liệu quyền truy cập !</p>';
        }

        $username = $request->get('username');
        $password = $request->get('password');
        $displayname = $request->get('displayname');
        $role = $request->get('role');

        if(strlen($username) == 0)
        {
            return '<p class="text-danger">Tên tài khoản rỗng !</p>';
        }
        if(strlen($password) == 0)
        {
            return '<p class="text-danger">Mật khẩu rỗng !</p>';
        }
        if(strlen($displayname) == 0)
        {
            return '<p class="text-danger">Tên hiển thị rỗng !</p>';
        }
        if($role == 0)
        {
            return '<p class="text-danger">Quyền truy cập lỗi !</p>';
        }

        $account = DB::table('account')->where('username', '=',$username)->first();
        if($account != null)
        {
            return '<p class="text-danger">Tài khoản đã đăng ký !</p>';
        }

        DB::table('account')->insert(
            ['username' => $username, 'password' => $password, 'displayname' => $displayname, 'role' => $role]
        );

        $account = DB::table('account')->where('username', '=',$username)->first();
        
        if($account != null)
        {
            return '<p class="text-success">Thêm thành công tài khoản : '.$account->displayname.' . Tự động tải lại trang  !</p>';
        }
        else
        {
            return '<p class="text-danger">Lỗi truy cập dữ liệu !</p>';
        }

    }
    
    /**
     * delAccount function
     *
     * @param Request $request
     * @return view
     */
    public function delAccount(Request $request)
    {
        if(!$request->has('id'))
        {
            return '<p class="text-danger">Lỗi truy cập dữ liệu !</p>';
        }
        $id = $request->get('id');
        DB::table('account')->where('id', '=', $id)->delete();

        $account = DB::table('account')->where('id', '=',$id)->first();
        
        if($account == null)
        {
            return '<p class="text-success">Xóa thành công. Tự động tải lại trang  !</p>';
        }
        else
        {
            return '<p class="text-danger">Lỗi truy cập dữ liệu !</p>';
        }
    }

    /**
     * locationAddGoods function
     *
     * @param Request $request
     * @return view
     */
    public function locationAddGoods(Request $request)
    {
        if(!$request->session()->has('account'))
        {
            return view('general.login');
        }
        $account = $request->session()->get('account');

        if($account->role == 0)
        {
            return view('general.index')->with('account', $account);
        }
        else if($account->role == 2)
        {
            return view('manager.mnAddGoods')->with('account', $account);
        }
        else
        {
            return view('general.index')->with('account', $account);
        }
    }

    /**
     * locationManagerGoods function
     *
     * @param Request $request
     * @return view
     */
    public function locationManagerGoods(Request $request)
    {
        if(!$request->session()->has('account'))
        {
            return view('general.login');
        }
        $account = $request->session()->get('account');

        if($account->role == 0)
        {
            return view('general.index')->with('account', $account);
        }
        else if($account->role == 2)
        {
            $listGoods = DB::table('goods')->where('active', '=','1')->get();
            return view('manager.mnGoods',['account'=> $account],['listGoods' => $listGoods]);
        }
        else
        {
            return view('general.index')->with('account', $account);
        }
    }

    /**
     * locationHisAddGoods function
     *
     * @param Request $request
     * @return view
     */
    public function locationHisAddGoods(Request $request)
    {
        if(!$request->session()->has('account'))
        {
            return view('general.login');
        }
        $account = $request->session()->get('account');

        if($account->role == 0)
        {
            return view('general.index')->with('account', $account);
        }
        else if($account->role == 2)
        {
            $listHisAddGoods = DB::table('hisaddgoods')->get();
            $listAcc = DB::table('account')->get();
            $listGoods = DB::table('goods')->get();

            return view('manager.mnHisAddGoods',['account'=> $account , 'listHisAddGoods'=> $listHisAddGoods,'listAcc' => $listAcc,'listGoods' => $listGoods]);
        }
        else
        {
            return view('general.index')->with('account', $account);
        }
    }

    /**
     * searchGoods function
     *
     * @param Request $request
     * @return view
     */
    public function searchGoods(Request $request)
    {
        if(!$request->has('id'))
        {
            return '<p class="text-danger">Lỗi dữ liệu mã mặt hàng !</p>';
        }

        $id = $request->get('id');
        $goods = DB::table('goods')->where('id', '=',$id)->first();
        
        if($goods == null)
        {
            return '<p class="text-danger">Không tìm thấy mặt hàng !</p>';
        }
        return view('manager.formRepair')->with('goods', $goods);
    }

    /**
     * addGoods function
     *
     * @param Request $request
     * @return view
     */
    public function addGoods(Request $request)
    {
        if(!$request->has('name'))
        {
            return '<p class="text-danger">Lỗi dữ liệu tên mặt hàng !</p>';
        }
        if(!$request->has('image'))
        {
            return '<p class="text-danger">Lỗi dữ liệu hình ảnh !</p>';
        }
        if(!$request->has('detail'))
        {
            return '<p class="text-danger">Lỗi dữ liệu chi tiết mặt hàng !</p>';
        }
        if(!$request->has('num'))
        {
            return '<p class="text-danger">Lỗi dữ liệu số lượng !</p>';
        }
        if(!$request->has('price'))
        {
            return '<p class="text-danger">Lỗi dữ liệu giá !</p>';
        }

        $name = $request->get('name');
        $image = $request->get('image');
        $detail = $request->get('detail');
        $num = $request->get('num');
        $price = $request->get('price');

        if(strlen($name) == 0)
        {
            return '<p class="text-danger">Tên tài khoản rỗng !</p>';
        }
        if(strlen($image) == 0)
        {
            return '<p class="text-danger">Mật khẩu rỗng !</p>';
        }
        if(strlen($detail) == 0)
        {
            return '<p class="text-danger">Tên hiển thị rỗng !</p>';
        }
        if(!is_numeric($num))
        {
            return '<p class="text-danger">Số lượng lỗi !</p>';
        }
        if(!is_numeric($price))
        {
            return '<p class="text-danger">Giá nhập vào bị lỗi !</p>';
        }

        $goods = DB::table('goods')->where('name', '=',$name)->first();

        if($goods != null)
        {
            DB::table('goods')
            ->where('name', '=',$name)
            ->update(['num' => $num,'image' => $image,'detail' => $detail,'price' => $price]);

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ldate = date('Y-m-d H:i:s');
            $account = $request->session()->get('account');
            $note = 'Cập nhật mặt hàng : '.$name.'. Số lượng : '.$num;
            DB::table('hisaddgoods')->insert(
                ['type' => 2, 'idgoods' => $goods->id, 'idaccount' => $account->id, 'date' => $ldate, 'note' => $note]
            );

            return '<p class="text-info">Hệ thống đã tự động cập nhật các thông tin !</p>';
        }

        DB::table('goods')->insert(
            ['name' => $name, 'image' => $image, 'detail' => $detail, 'num' => $num, 'active' => 1, 'price' => $price]
        );

        $goods = DB::table('goods')->where('name', '=',$name)->first();
        
        if($goods != null)
        {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ldate = date('Y-m-d H:i:s');
            $account = $request->session()->get('account');
            $note = 'Thêm mặt hàng : '.$name.'. Số lượng : '.$num;
            DB::table('hisaddgoods')->insert(
                ['type' => 1, 'idgoods' => $goods->id, 'idaccount' => $account->id, 'date' => $ldate, 'note' => $note]
            );
            return '<p class="text-success">Thêm thành công mặt hàng : '.$name.' . Hệ thống tự động tải lại trang  !</p>';
        }
        else
        {
            return '<p class="text-danger">Lỗi truy cập dữ liệu !</p>';
        }

    }

    /**
     * addGuest function
     *
     * @param Request $request
     * @return view
     */
    public function addGuest(Request $request)
    {
        if(!$request->has('name'))
        {
            return '<p class="text-danger">Lỗi dữ liệu tên khách hàng !</p>';
        }
        if(!$request->has('address'))
        {
            return '<p class="text-danger">Lỗi dữ liệu địa chỉ !</p>';
        }
        if(!$request->has('phone'))
        {
            return '<p class="text-danger">Lỗi dữ liệu số điện thoại !</p>';
        }
       

        $name = $request->get('name');
        $address = $request->get('address');
        $phone = $request->get('phone');


        if(strlen($name) == 0)
        {
            return '<p class="text-danger">Tên khách hàng rỗng !</p>';
        }
        if(strlen($address) == 0)
        {
            return '<p class="text-danger">Địa chỉ khách hàng rỗng !</p>';
        }
        if(strlen($phone) == 0)
        {
            return '<p class="text-danger">Số điện thoại khách hàng rỗng !</p>';
        }
        DB::table('guest')->insert(
            ['name' => $name, 'address' => $address, 'phone' => $phone]
        );

        $guest = DB::table('guest')->where('name', '=',$name)->first();
        
        if($guest != null)
        {
            return '<p class="text-success">Thêm thành công khách hàng : '.$name.' . Tự động tải lại trang  !</p>';
        }
        else
        {
            return '<p class="text-danger">Lỗi truy cập dữ liệu !</p>';
        }

    }
    
    /**
     * delGuest function
     *
     * @param Request $request
     * @return view
     */
    public function delGuest(Request $request)
    {
        if(!$request->has('id'))
        {
            return '<p class="text-danger">Lỗi truy cập dữ liệu !</p>';
        }
        $id = $request->get('id');

        DB::table('guest')->where('id', '=', $id)->delete();

        $guest = DB::table('guest')->where('id', '=',$id)->first();
        
        if($guest == null)
        {
            return '<p class="text-success">Xóa thành công. Tự động tải lại trang  !</p>';
        }
        else
        {
            return '<p class="text-danger">Lỗi truy cập dữ liệu !</p>';
        }
    }

    public function addToCart(Request $request)
    {

        if(!$request->has('add'))
        {
            return '<p class="text-danger">Lỗi thao tác !</p>';
        }
        $add = $request->get('add');
        if($add == 'true')
        {
                if(!$request->has('id'))
                {
                    return '<p class="text-danger">Lỗi mã hàng !</p>';
                }
                if(!$request->has('num'))
                {
                    return '<p class="text-danger">Lỗi số lượng !</p>';
                }


                $id = $request->get('id');
                $num = $request->get('num');
                
                if($num == 0)
                {
                    return '<p class="text-danger">Số lượng vào bị lỗi !</p>';
                }

                if(!is_numeric($num))
                {
                    return '<p class="text-danger">Số lượng vào bị lỗi !</p>';
                }

                if(!$request->session()->has('listCart'))
                {
                    $listCart = array($id=>$num);
                    $request->session()->put('listCart',$listCart);
                    return '<p class="text-success">Đã thêm !</p>';
                }
                else
                {
                    $listCart =  $request->session()->get('listCart');
                    
                    if(array_has($listCart,$id))
                    {
                        $nums = array_get($listCart,$id);
                        $nums = $nums + $num;
                        array_set($listCart,$id,$nums);
                        $request->session()->put('listCart',$listCart);
                        return '<p class="text-success">Đã thay đổi số lượng !</p>';
                    }
                    else
                    {
                        $listCart = array_add($listCart,$id,$num);
                        $request->session()->put('listCart',$listCart);
                        return '<p class="text-success">Đã thêm !</p>';
                    }
                }
        }
        else
        {
            if(!$request->has('id'))
            {
                return '<p class="text-danger">Lỗi mã hàng !</p>';
            }

            $id = $request->get('id');

            if(!$request->session()->has('listCart'))
            {
                return '<p class="text-success">Giỏ hàng rỗng !</p>';
            }
            else
            {
                $listCart =  $request->session()->get('listCart');
                
                if(array_has($listCart,$id))
                {
                    array_forget($listCart,$id);
                    if(count($listCart) != 0)
                    {
                        $request->session()->put('listCart',$listCart);
                    }
                    else
                    {
                        $request->session()->forget('listCart');
                    }
                    return '<p class="text-success">Đã xóa khỏi giỏ hàng !</p>';
                }
                else
                {
                    return '<p class="text-success">Mặt hàng không tồn tại trong giỏ !</p>';
                }
            }
        }
        
    }

    public function loadCart(Request $request)
    {
        if(!$request->session()->has('listCart'))
        {
            return '<p class="text-danger">Giỏ hàng rỗng !</p>';
        }
        else
        {
            $listCart =  $request->session()->get('listCart');
            $listGoods = DB::table('goods')->where('active', '=','1')->get();
            return view('manager.tableCart',['listCart'=> $listCart,'listGoods'=>$listGoods]);
        }
    }

    public function pay(Request $request)
    {
        if(!$request->has('guest'))
        {
            return '<p class="text-danger">Lỗi thông tin khách hàng !</p>';
        }

        $id = $request->get('guest');
        
        if(!$request->session()->has('listCart'))
        {
            return '<p class="text-danger">Giỏ hàng rỗng !</p>';
        }
        
        $listCart =  $request->session()->get('listCart');

        if(!$request->session()->has('account'))
        {
            return '<p class="text-danger">Lỗi đăng nhập !</p>';
        }

        $account = $request->session()->get('account');

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ldate = date('Y-m-d H:i:s');

        DB::table('guestorder')->insert(
            ['idguest' => $id, 'idaccount' => $account->id, 'date' => $ldate, 'pay' => 1]
        );
        
        $listGoods = DB::table('goods')->where('active', '=','1')->get();

        $order = DB::table('guestorder')->where('date', '=',$ldate)->first();
       
        foreach ($listGoods as $goods)
        {
            $num = array_get($listCart,$goods->id);
            
            if($num)
            {
                DB::table('orderdetail')->insert(
                    ['idguestorder' => $order->id, 'idgoods' => $goods->id, 'num' => $num]
                );
                $newnum = $goods->num - $num;
                DB::table('goods')->where('id', $goods->id)->update(['num' => $newnum]);
            }
        }
        
        $request->session()->forget('listCart');
        return '<p class="text-success">Thanh toán thành công !</p>';

    }
    public function locationOrder(Request $request)
    {
        if(!$request->session()->has('account'))
        {
            return view('general.login');
        }
        $account = $request->session()->get('account');

        if($account->role == 0)
        {
            return view('general.index')->with('account', $account);
        }
        else if($account->role == 1)
        {
            $listGuest = DB::table('guest')->get();
            $listOrder = DB::table('guestorder')->get();
            $listAcc = DB::table('account')->where('role', '<>','0')->get();
            return view('manager.mnOrder',['account'=> $account,'listOrder' => $listOrder,'listGuest'=>$listGuest,'listAcc'=>$listAcc]);
        }
        else
        {
            return view('general.index')->with('account', $account);
        }
    }

    public function orderdetail(Request $request)
    {
        if(!$request->has('orderid'))
        {
            return '<p class="text-danger">Lỗi thông tin hóa đơn !</p>';
        }

        $orderid = $request->get('orderid');
        $listDetail = DB::table('orderdetail')->where('idguestorder', '=',$orderid)->get();
        $listGoods = DB::table('goods')->where('active', '=','1')->get();
        return view('manager.orderDetail',['listDetail'=> $listDetail,'listGoods'=>$listGoods]);
    }
}
