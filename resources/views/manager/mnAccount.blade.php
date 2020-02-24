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
				<li class="nav-item active">
				<a class="nav-link" href="{{route('getManager')}}">Tài khoản</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('getStatistical')}}">Thống kê</a>
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
	<div class="p-3 mb-2 bg-primary text-white"><center style="font-family: 'Josefin Sans', sans-serif;"><b>QUẢN LÝ TÀI KHOẢN</b></center></div>
	{{-- Content --}}
	<div class="row">
		<div class="col-md-3 col-sm-12 col-12">
			<div class="p-3 mb-2 bg-success text-white"><center style="font-family: 'Josefin Sans', sans-serif;">THÊM TÀI KHOẢN</center></div>
			
			<br><b>Tên tài khoản : </b><input type="text" name="username" id="username" placeholder=" Tên tài khoản...">
			<br><b>Mật khẩu : </b><input type="text" name="password" id="password" placeholder=" Mật khẩu...">
			<br><b>Tên hiển thị : </b><input type="text" name="displayname" id="displayname" placeholder=" Tên hiển thị...">
			<br><br><b style="padding-right: 0px;">Quyền : </b> <select name="role" id="role"><option value="1">Nhân viên bán hàng</option><option value="2">Nhân viên thủ kho</option></select>
			<br><br><center>
			<button id='addAccount' type="button" class="btn btn-success">Thêm tài khoản</button></center>
			<br>
			<center><div id="notification"></div></center>
		</div>
		<div class="col-md-9 col-sm-12 col-12">
			<div class="p-3 mb-2 bg-success text-white"><center style="font-family: 'Josefin Sans', sans-serif;">DANH SÁCH TÀI KHOẢN</center></div>
			<br>
			<table class="table table-striped">
				<thead class="thead-light">
				  <tr>
					<th scope="col">Tên tài khoản</th>
					<th scope="col">Mật khẩu</th>
					<th scope="col">Tên hiển thị</th>
					<th scope="col">Quyền truy cập</th>
					<th scope="col">Thao tác</th>
				  </tr>
				</thead>
				<tbody>
					@if(count($listAcc) > 0)
					@foreach ($listAcc as $users)
						<tr>
						<th scope="row">{{$users->username}}</th>
							<td>{{$users->password}}</td>
							<td>{{$users->displayname}}</td>
							<td>
								@if ($users->role === 1)
									Nhân viên bán hàng
								@elseif ($users->role == 2)
									Nhân viên thủ kho
								@else
									Không thể nhận diện quyền !
								@endif
							</td>
							<td>
								<button id="del{{$users->id}}" type="button" class="btn btn-danger">Xóa</button>
							</td>
						</tr>
						<script>
							$(document).ready(function () {
								$('#del{{$users->id}}').click(function (e) { 
								$.get("{{ route('delAccount') }}", 
								{
									id : {{$users->id}}
								}
								,function (data, textStatus, jqXHR) {
										$('#notification').html(data);
										$("#notification").slideDown();
										if(data.indexOf("thành công") != -1)
										setTimeout(function(){ window.location = "{{ route('getManager') }}";}, 3000)
									}
								);
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
	</div>
	<script src="js/main.js"></script>
	<script>
		$(document).ready(function () {
		
		$(document).keypress(function(e) {
            if(e.which == 13) {
                 $('#addAccount').click();
            }
        });

        $('#username').on('input',function(e){
             $("#notification").slideUp("slow");
             $("#notification").html("");
        });
        $('#password').on('input',function(e){
             $("#notification").slideUp("slow");
             $("#notification").html("");
        });
		$('#displayname').on('input',function(e){
             $("#notification").slideUp("slow");
             $("#notification").html("");
        });

		$('#addAccount').click(function (e) { 
				var username = $('#username').val();
				var password = $('#password').val();
				var displayname = $('#displayname').val();
				var role = $('#role').val();
				$.get("{{ route('addAccount') }}", 
				{
					username : username,
					password : password,
					displayname : displayname,
					role : role
				}
				,function (data, textStatus, jqXHR) {
						$('#notification').html(data);
                        $("#notification").slideDown();
                        if(data.indexOf("thành công") != -1)
                  	    setTimeout(function(){ window.location = "{{ route('getManager') }}";}, 3000)
					}
				);
			});
		});
	</script>
</div>
</body>
</html>