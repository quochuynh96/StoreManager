<!DOCTYPE html>
<html lang="en">
<head>
	<title>Hệ thống Quản lý cửa hàng bán lẻ - Login</title>
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
						ACCOUNT LOGIN
					</span>

                    <input id="_token" name="_token" type="hidden" value="{{ csrf_token() }}"/>

					<div class="wrap-input100" data-validate = "Username is required">
						<input id="username" class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input id="password" class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button id="loginbutton" class="login100-form-btn">
							Login
						</button>
					</div>
					<br>
					<center><div id="notification"></div></center>
					<!-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a id="forgot-pass" class="txt2" href="#">
							Username / Password?
						</a>
					</div> -->

					<div class="text-center p-t-50">
						<!-- <a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a> -->
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

	<!-- click button Login script -->
	<script>
      $(document).ready(function(){

        $(document).keypress(function(e) {
            if(e.which == 13) {
                 $('#loginbutton').click();
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

        $('#loginbutton').click(function(){
          {
            var username = $('#username').val();
				var password = $('#password').val();
				var _token = $('#_token').val();
				$.get("{{ route('getLogin') }}", 
				{
					username : username,
					password : password,
					_token : _token
				}
				,function (data, textStatus, jqXHR) {
						$('#notification').html(data);
                        $("#notification").slideDown();
                        if(data.indexOf("thành công") != -1)
                  	    setTimeout(function(){ window.location = "{{ route('getIndex') }}";}, 3000)
					}
				);
          }
          });
      });
    </script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>