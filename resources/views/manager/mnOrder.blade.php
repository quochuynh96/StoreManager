<!DOCTYPE html>
<html lang="en">
<head>
	<title>Hệ thống Quản lý cửa hàng bán lẻ - Quản lý bán hàng</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/tilt/tilt.jquery.min.js"></script>
<!--===============================================================================================-->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet"> 
<!--===============================================================================================-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<!--===============================================================================================-->
<style>
	input{
		width: 100%;
		border-style: solid;
		border-width: 1px;
		border-color: rgba(0, 0, 0, 0.4);
		border-radius: 3%;
	}
</style>
</head>
<body>
	{{-- Navbar section --}}
	<nav class="navbar-expand-lg navbar navbar-dark bg-dark">
		<a class="navbar-brand" href="{{route('getIndex')}}"><i class="fas fa-tasks"></i></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarText">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
				<a class="nav-link" href="{{route('getManager')}}">Bán hàng</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('locationGuestManager')}}">Khách hàng</a>
                </li>
                <li class="nav-item active">
						<a class="nav-link" href="{{route('locationOrder')}}">Hóa đơn</a>
				</li>
			</ul>
			<span class="navbar-text">
				Tài khoản đăng nhập : {{ $account->displayname}}
			</span>
		</div>
	</nav>
	{{-- End of section Nav Menu --}}

	<div class="container">
	{{-- Title --}}
	<div class="p-3 mb-2 bg-primary text-white"><center style="font-family: 'Josefin Sans', sans-serif;"><b>BÁN HÀNG</b></center></div>
	{{-- Content --}}
	<div class="row">
		<div class="col-md-12 col-sm-12 col-12">
			<div class="p-3 mb-2 bg-success text-white"><center style="font-family: 'Josefin Sans', sans-serif;">DANH MỤC SÁCH HÓA ĐƠN ĐÃ THANH TOÁN</center></div>
			<table class="table table-striped">
				<thead class="thead-light">
				  <tr>
					<th scope="col">Khách hàng</th>
					<th scope="col">Nhân viên</th>
					<th scope="col">Ngày lập</th>
                    <th scope="col">Thanh toán</th>
                    <th scope="col">Thao tác</th>
				  </tr>
				</thead>
				<tbody>
					@if(count($listOrder) > 0)
					@foreach ($listOrder as $order)
						<tr>
						<th scope="row">
                                @foreach ($listGuest as $guest)
                                @if ($guest->id == $order->idguest)
                                    {{$guest->name}}
                                @endif
                                @endforeach
                        </th>
							<td>
                                    @foreach ($listAcc as $acc)
                                    @if ($acc->id == $order->idaccount)
                                        {{$acc->displayname}}
                                    @endif
                                    @endforeach
                            </td>
							<td>{{$order->date}}</td>
                            <td>
                                @if($order->pay == 1)
                                Yes
                                @else
                                No
                                @endif
                            </td>
                            <td>
                                <button id="detail{{$order->id}}" type="button" class="btn btn-warning">Chi tiết</button>
                            </td>
                        </tr>
                        <script>
                            $(document).ready(function () {
                                $('#detail{{$order->id}}').click(function (e) { 
                                    $.get("{{ route('orderdetail') }}", {
										orderid : {{$order->id}}
									},
									function (data, textStatus, jqXHR) {
										$('#detailTable').html(data);
									});
                                });
                            });
                        </script>
					@endforeach
					@else
					Chưa có hóa đơn nào !
					@endif
				</tbody>
			  </table>
		</div>
    </div>
    <hr>
    <div id="detailTable"></div>
	<script src="js/main.js"></script>
</div>
</body>
</html>