<!DOCTYPE html>
<html lang="en">
<head>
	<title>UCP : Unité Coordination Projets</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('images/ucp_logo.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login_inscription/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login_inscription/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login_inscription/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('login_inscription/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login_inscription/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login_inscription/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login_inscription/css/main.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/animate.min.css')}}">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('login_inscription/images/ucp_logo.png')}}" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="{{asset('/login')}}" method="POST">
					@csrf
					<span class="login100-form-title">
						Veuillez vous connecter
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Entrer une adrese mail valide!">
						<input class="input100" type="email" name="adresse_mail" placeholder="Adresse mail" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Mot de passe requis!">
						<input class="input100" type="password" name="mot_de_passe" placeholder="Mot de passe" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Se connecter
						</button>
					</div>

					<div class="text-center p-t-12">
						<a class="txt1" href="{{asset('/oublie-de-mot-de-passe')}}">
							J'ai oublié mon mot de passe
						</a>
					</div>
					
					@if ($message = Session::get('error'))
						<br>
						<p class="text-center alert alert-danger animate__animated animate__bounceInRight" style="margin-left: auto; margin-right: auto">{{$message}}</p>
						<div class="text-center">
							<a class="txt2" href="{{asset('/inscription')}}">
								Faire une demande d'inscription
								<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
							</a>
						</div>
					@else
						<div class="text-center p-t-100">
							<a class="txt2" href="{{asset('/inscription')}}">
								Faire une demande d'inscription
								<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
							</a>
						</div>
					@endif

					
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="{{asset('login_inscription/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login_inscription/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('login_inscription/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login_inscription/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login_inscription/vendor/tilt/tilt.jquery.min.js')}}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('login_inscription/js/main.js')}}"></script>
	<script src="{{asset('js/bootstrap-animate-css.js')}}"></script>

</body>
</html>