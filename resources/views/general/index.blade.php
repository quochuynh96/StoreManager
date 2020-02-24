<!DOCTYPE html>
<html lang="en">
<head>
	<title>Hệ thống Quản lý cửa hàng bán lẻ - Index</title>
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
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<div class="login100-form validate-form">
					<span class="login100-form-title">
						LOGIN SUCCESSFULLY !
					</span>
					<b class="text-success">
					Welcome : {{ $account->displayname }}
					@if ($account->role == 0)
					<br>Vai trò đăng nhập : Quản trị viên<br>
					<a href="{{ route('getManager') }}">
						<div class="container-login100-form-btn">
							<button class="login100-form-btn">
								Quản lý Tài khoản
							</button>
						</div>
					</a>
					<a href="{{ route('getStatistical') }}">
						<div class="container-login100-form-btn">
							<button class="login100-form-btn">
								Thống kê doanh số
							</button>
						</div>
					</a>
					@elseif ($account->role == 1)
					<br>Vai trò đăng nhập : Nhân viên Bán hàng<br>
					<a href="{{ route('getManager') }}">
						<div class="container-login100-form-btn">
							<button class="login100-form-btn">
								Quản lý Bán hàng
							</button>
						</div>
					</a>
					<a href="{{ route('locationGuestManager') }}">
						<div class="container-login100-form-btn">
							<button class="login100-form-btn">
								Quản lý Khách hàng
							</button>
						</div>
					</a>
					<a href="{{ route('locationOrder') }}">
							<div class="container-login100-form-btn">
								<button class="login100-form-btn">
									Quản lý Hóa đơn
								</button>
							</div>
						</a>
					@else
					<br>Vai trò đăng nhập : Nhân viên Quản lý kho<br>
					<a href="{{ route('getManager') }}">
						<div class="container-login100-form-btn">
							<button class="login100-form-btn">
								Quản lý Kho hàng
							</button>
						</div>
					</a>
					@endif
					</b>
					<a href="{{ route('getLogout') }}">
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Logout
						</button>
					</div>
					</a>
					<br>
						<hr>
						<br>
						<a class="txt2" href="https://colorlib.com/">
							 UI Design by Colorlib.com
						</a>
						<br>
						<a class="txt2" href="https://fb.com/qh273">
							Source code by Quoc Huynh
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>