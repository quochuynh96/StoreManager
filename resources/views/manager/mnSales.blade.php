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
				<li class="nav-item active">
				<a class="nav-link" href="{{route('getManager')}}">Bán hàng</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('locationGuestManager')}}">Khách hàng</a>
				</li>
				<li class="nav-item">
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
		<div class="col-md-9 col-sm-12 col-12">
			<div class="p-3 mb-2 bg-success text-white"><center style="font-family: 'Josefin Sans', sans-serif;">DANH MỤC HÀNG TRONG KHO</center></div>
			<table class="table table-striped">
				<thead class="thead-light">
				  <tr>
					<th scope="col">Hình ảnh</th>
					<th scope="col">Tên mặt hàng</th>
					<th scope="col">Số lượng</th>
					<th scope="col">Giá</th>
					<th scope="col">Thao tác</th>
				  </tr>
				</thead>
				<tbody>
					@if(count($listGoods) > 0)
					@foreach ($listGoods as $goods)
						<tr>
						<th scope="row"><img src="{{$goods->image}}" alt="#" width="auto" height="100px"></th>
							<td>{{$goods->name}}</td>
							<td>{{$goods->num}}</td>
							<td>{{$goods->price}}</td>
							<td>
								<input type="number" id="num{{$goods->id}}" value="0" style="text-align: center; width: 50%"><br><br>
								<button id="addToCart{{$goods->id}}" type="button" class="btn btn-success">Thêm vào giỏ</button><br><br>
								<button id="delFromCart{{$goods->id}}" type="button" class="btn btn-danger">Xóa khỏi giỏ hàng</button>
							</td>
						</tr>
						<script>
							$(document).ready(function () {
								$('#addToCart{{$goods->id}}').click(function (e) {
									var num = $('#num{{$goods->id}}').val(); 
									$.get("{{ route('addGoodsToCart') }}", {
										add : true,
										id : {{$goods->id}},
										num : num
									},
									function (data, textStatus, jqXHR) {
										$('#notification').html(data);
										$('#notification').show();
										loadListCart();
										setTimeout(function(){ $('#notification').hide()}, 2000)
									});
								});
								$('#delFromCart{{$goods->id}}').click(function (e) {
									$.get("{{ route('addGoodsToCart') }}", {
										add : false,
										id : {{$goods->id}}
									},
									function (data, textStatus, jqXHR) {
										$('#notification').html(data);
										$('#notification').show();
										loadListCart();
										setTimeout(function(){ $('#notification').hide()}, 2000)
									});
								});
							});
						</script>
					@endforeach
					@else
					Chưa có tài khoản nào !
					@endif
				</tbody>
			  </table>
		</div>
		<div class="col-md-3 col-sm-12 col-12">
			<div class="p-3 mb-2 bg-success text-white"><center style="font-family: 'Josefin Sans', sans-serif;">THAO TÁC</center></div>
			<div id="notification"></div>
			<div id="listCart"></div>
			<br><hr><br>
			<div class="row">
					<div class="col-md-12">
					<center>
						<select name="guest" id="guest" style="width: 100%">
							@foreach ($listGuest as $guest)
								<option value="{{$guest->id}}">{{$guest->name}}</option>
							@endforeach
						</select>
						<br><hr><br>
						&nbsp;&nbsp;<button id="btnPay" type="button" class="btn btn-success">Thanh toán</button>
					</center>
					</div>
			</div>
		</div>
	</div>
	<script src="js/main.js"></script>
</div>
<script>
	$(document).ready(function () {
		$('#btnPay').click(function (e) { 
			var guest = $('#guest').val(); 
			$.get("{{ route('pay') }}", {
				guest : guest
			},
			function (data, textStatus, jqXHR) {
				$('#notification').html(data);
				$('#notification').show();
				loadListCart();
			});
		});
	});
</script>
<script>
	$(document).ready(function () {
		loadListCart();
	});
</script>
<script>
	function loadListCart(){
		$.get("{{ route('loadCart') }}"
		,{
			load : '1'
		},
		function (data, textStatus, jqXHR) {
			$('#listCart').html(data);
		});
		}
</script>
</body>
</html>