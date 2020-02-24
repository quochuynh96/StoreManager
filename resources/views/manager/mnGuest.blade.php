<!DOCTYPE html>
<html lang="en">
<head>
	<title>Hệ thống Quản lý cửa hàng bán lẻ - Quản lý tài khoản</title>
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
				<li class="nav-item active">
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
	<div class="p-3 mb-2 bg-primary text-white"><center style="font-family: 'Josefin Sans', sans-serif;"><b>QUẢN LÝ KHÁCH HÀNG</b></center></div>
	{{-- Content --}}
	<div class="row">
		<div class="col-md-3 col-sm-12 col-12">
			<div class="p-3 mb-2 bg-success text-white"><center style="font-family: 'Josefin Sans', sans-serif;">THÊM KHÁCH HÀNG MỚI</center></div>
			
			<br><b>Tên khách hàng : </b><input type="text" name="name" id="name" placeholder=" Nguyễn Văn A...">
			<br><b>Địa chỉ : </b><input type="text" name="address" id="address" placeholder=" 77 Nguyễn Huệ...">
			<br><b>Số điện thoại : </b><input type="text" name="phone" id="phone" placeholder=" 0123456789...">
			<br><br><center>
			<button id='addGuest' type="button" class="btn btn-success">Thêm khách hàng</button></center>
			<br>
			<center><div id="notification"></div></center>
		</div>
		<div class="col-md-9 col-sm-12 col-12">
			<div class="p-3 mb-2 bg-success text-white"><center style="font-family: 'Josefin Sans', sans-serif;">DANH SÁCH KHÁCH HÀNG</center></div>
			<br>
			<table class="table table-striped">
				<thead class="thead-light">
				  <tr>
					<th scope="col">Tên khách hàng</th>
					<th scope="col">Địa chỉ</th>
                    <th scope="col">Số diện thoại</th>
                    <th scope="col">Thao tác</th>
				  </tr>
				</thead>
				<tbody>
					@if(count($listGuest) > 0)
					@foreach ($listGuest as $guest)
						<tr>
						<th scope="row">{{$guest->name}}</th>
							<td>{{$guest->address}}</td>
							<td>{{$guest->phone}}</td>
							<td>
								<button id="del{{$guest->id}}" type="button" class="btn btn-danger">Xóa</button>
							</td>
						</tr>
						<script>
							$(document).ready(function () {
								$('#del{{$guest->id}}').click(function (e) { 
								$.get("{{ route('delGuest') }}", 
								{
									id : {{$guest->id}}
								}
								,function (data, textStatus, jqXHR) {
										$('#notification').html(data);
										$("#notification").slideDown();
										if(data.indexOf("thành công") != -1)
										setTimeout(function(){ window.location = "{{ route('locationGuestManager') }}";}, 3000)
									}
								);
								});
							});
						</script>
					@endforeach
					@else
					Chưa có khách hàng nào !
					@endif
				</tbody>
			  </table>
		</div>
	</div>
	<script src="js/main.js"></script>
	<script>
		$(document).ready(function () {
		
		$(document).keypress(function(e) {
            if(e.which == 13) {
                 $('#addGuest').click();
            }
        });

        $('#name').on('input',function(e){
             $("#notification").slideUp("slow");
             $("#notification").html("");
        });
        $('#address').on('input',function(e){
             $("#notification").slideUp("slow");
             $("#notification").html("");
        });
		$('#phone').on('input',function(e){
             $("#notification").slideUp("slow");
             $("#notification").html("");
        });

		$('#addGuest').click(function (e) { 
				var name = $('#name').val();
				var address = $('#address').val();
				var phone = $('#phone').val();
				$.get("{{ route('addGuest') }}", 
				{
					name : name,
					address : address,
					phone : phone
				}
				,function (data, textStatus, jqXHR) {
						$('#notification').html(data);
                        $("#notification").slideDown();
                        if(data.indexOf("thành công") != -1)
                  	    setTimeout(function(){ window.location = "{{ route('locationGuestManager') }}";}, 3000)
					}
				);
			});
		});
	</script>
</div>
</body>
</html>