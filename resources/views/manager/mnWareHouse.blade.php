<!DOCTYPE html>
<html lang="en">
<head>
	<title>Hệ thống Quản lý cửa hàng bán lẻ - Quản lý kho hàng</title>
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
	.nav-menu ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		width: 100%;
		background-color: #f1f1f1;
	}
	.nav-menu li a {
		display: block;
		color: #000;
		padding: 8px 16px;
		text-decoration: none;
	}
	.nav-menu li a.active {
		background-color: #4CAF50;
		color: white;
	}
	.nav-menu li a:hover:not(.active) {
		background-color: #555;
		color: white;
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
				<li class="nav-item active">
				<a class="nav-link" href="{{route('getManager')}}">Kho hàng</a>
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
	<div class="p-3 mb-2 bg-primary text-white"><center style="font-family: 'Josefin Sans', sans-serif;"><b>QUẢN LÝ KHO HÀNG</b></center></div>
	{{-- Content --}}
	<div class="row">
		<div class="col-md-3 col-sm-12 col-12">
			<div class="nav-menu">
			<ul>
					<li><a class="active" href="{{route('getManager')}}" style="font-family: 'Josefin Sans', sans-serif;">KHO HÀNG</a></li>
					<li><a class="active" href="{{route('getManager')}}">Tình trạng</a></li>
                    <li><a href="{{route('locationAddGoods')}}">Nhập hàng</a></li>
                    <li><a href="{{route('locationManagerGoods')}}">Quản lý hàng trong kho</a></li>
                    <li><a href="{{route('locationHisAddGoods')}}">Lịch sử xuất nhập hàng</a></li>
			</ul>
			</div>
		</div>
		<div class="col-md-9 col-sm-12 col-12">
			<div class="p-3 mb-2 bg-success text-white"><center style="font-family: 'Josefin Sans', sans-serif;">DANH SÁCH HÀNG TỒN KHO</center></div>
			<table class="table table-striped">
					<thead class="thead-light">
					  <tr>
						<th scope="col">Tên mặt hàng</th>
						<th scope="col">Số lượng</th>
						<th scope="col">Giá</th>
					  </tr>
					</thead>
					<tbody>
						@if(count($listGoods) > 0)
						@foreach ($listGoods as $goods)
							<tr>
							<th scope="row">{{$goods->name}}</th>
								<td>{{$goods->num}}</td>
								<td>{{$goods->price}}</td>
							</tr>
						@endforeach
						@else
						Chưa có tài khoản nào !
						@endif
					</tbody>
				  </table>
		</div>
	</div>
	<script src="js/main.js"></script>
</div>
</body>
</html>