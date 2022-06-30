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
<style>
	.visible {
		/* visibility: visible !important; */
		display: none;
	}
	.opacity {
		opacity: 0.5;
		pointer-events: none;
	}
</style>
</head>
<body>
	
	<div class="limiter" id="container">
		<div class="container-login100">
			<div>
				<div class="wrap-login100">
					{{-- <div class="login100-pic js-tilt" data-tilt>
						<img src="{{asset('login_inscription/images/mot_passe_oublie.png')}}" alt="IMG">
					</div> --}}
					<div class="login100-pic js-tilt" data-tilt>
						<img src="{{asset('login_inscription/images/mot_passe_oublie.png')}}" alt="IMG">
					</div>
	
					<form class="login100-form validate-form" action="{{asset('/oublie-de-mot-de-passe')}}" method="POST" id=form>
						@csrf
						<span class="login100-form-title">
							Vous avez oublié votre mot de passe?
						</span>
	
						<div class="wrap-input100 validate-input" data-validate = "Entrer une adrese mail valide!">
							<input class="input100" type="text" name="nom" placeholder="Votre nom" required>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<img style="margin-left: -0.7%; width: 1.2em;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAACkklEQVRoge3ZTagNcRjH8Y97vd3jkli4kiJSpLtRys7CRkmxQbGUHSshNpSVbOywFqVYuWwohLxEEYq8hVKEhXdxLaaTuac598ycZ5yxON96Nmfmef6/35mZ//+Z/9ClS5cqqGEdjuIG3uI7NlQpqgj92IcPGM6Ih+itTF1OBvFYtoF0vMR5bEVfJUpHYRDvtTbRGPcwuwK9mdTwSHET9biDcR1XncFu7Zuox5aOq26gF6/FjVzvtPBGloibqMdAREhPJBmLg/lpFkaSo0YmBvPTzIokR418COan+RVJjhp5E8xP867EWoUZj4/iD/pvTIsIiV6RHzgTrAGnJZ1BZUzGE/Erch8TOqx9BKsyRLUbSyNCorfW12B+mtCsFaUfn8WvxlflrkltsVPcyP6Oq27CXu2b2FGB3qas0L6ReRXobcpYvFLcxLUqxLZiu+JG1leitAXjcVt+ExcxphKlORiU30iobW8kuiA28qnAud/LHLhsI1MLnFsrc+CyjRTplxaVPHZp1PBc/mfkgf9wp7HOFGzDU80NfMRhycTwXzBOsrt+FcexLHWsF2twwV8Dl7DRyOZwpmSD7xiW/3vJI5mOXbJX8pvYZPSXpB6sxCn8bMi/J9l1nPSPtIM5OIIvWt//bySNZHpmqmGPfM/RexwQ3LRrpA8H8S2HgMbYnKqzuY38T5LvLeHX4AW424aAetxK1boVqHMTc9s1MYAXgcGHJZ8b6uT5CDRaPMOMoiZ6JLNRZOBhHErVPFRCvcKN5toSBh2WzE51VpZUc3URIydLGPCLkSt3n3wzXqs4UcRIkVajWQxl1B0qoe6zLMHNmsYy5u+zGb+dK6HuzCInXxb/5+Zn1J1fQt0rRYx06dIl4Q+nymZmfnVoiQAAAABJRU5ErkJggg=="/>
							</span>
						</div>
	
						<div class="wrap-input100 validate-input" data-validate = "Mot de passe requis!">
							<input class="input100" type="text" name="prenom" placeholder="Votre prénom" required>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<img style="margin-left: -0.7%; width: 1.2em;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAACkklEQVRoge3ZTagNcRjH8Y97vd3jkli4kiJSpLtRys7CRkmxQbGUHSshNpSVbOywFqVYuWwohLxEEYq8hVKEhXdxLaaTuac598ycZ5yxON96Nmfmef6/35mZ//+Z/9ClS5cqqGEdjuIG3uI7NlQpqgj92IcPGM6Ih+itTF1OBvFYtoF0vMR5bEVfJUpHYRDvtTbRGPcwuwK9mdTwSHET9biDcR1XncFu7Zuox5aOq26gF6/FjVzvtPBGloibqMdAREhPJBmLg/lpFkaSo0YmBvPTzIokR418COan+RVJjhp5E8xP867EWoUZj4/iD/pvTIsIiV6RHzgTrAGnJZ1BZUzGE/Erch8TOqx9BKsyRLUbSyNCorfW12B+mtCsFaUfn8WvxlflrkltsVPcyP6Oq27CXu2b2FGB3qas0L6ReRXobcpYvFLcxLUqxLZiu+JG1leitAXjcVt+ExcxphKlORiU30iobW8kuiA28qnAud/LHLhsI1MLnFsrc+CyjRTplxaVPHZp1PBc/mfkgf9wp7HOFGzDU80NfMRhycTwXzBOsrt+FcexLHWsF2twwV8Dl7DRyOZwpmSD7xiW/3vJI5mOXbJX8pvYZPSXpB6sxCn8bMi/J9l1nPSPtIM5OIIvWt//bySNZHpmqmGPfM/RexwQ3LRrpA8H8S2HgMbYnKqzuY38T5LvLeHX4AW424aAetxK1boVqHMTc9s1MYAXgcGHJZ8b6uT5CDRaPMOMoiZ6JLNRZOBhHErVPFRCvcKN5toSBh2WzE51VpZUc3URIydLGPCLkSt3n3wzXqs4UcRIkVajWQxl1B0qoe6zLMHNmsYy5u+zGb+dK6HuzCInXxb/5+Zn1J1fQt0rRYx06dIl4Q+nymZmfnVoiQAAAABJRU5ErkJggg=="/>
							</span>
						</div>

						<div class="wrap-input100 validate-input" data-validate = "Entrer une adrese mail valide!">
							<input class="input100" type="email" name="email" placeholder="Votre adresse mail" required>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span>
						</div>

						<div class="container-login100-form-btn">
							<button class="login100-form-btn">
								Envoyer chez l'administration
							</button>
						</div>
	
						
						@if ($message = Session::get('success'))
							<br>
							<p class="text-center alert alert-success animate__animated animate__bounceInRight" style="margin-left: auto; margin-right: auto">{{$message}}</p>
						@endif
						@if ($message = Session::get('error'))
							<br>
							<p class="text-center alert alert-danger animate__animated animate__bounceInRight" style="margin-left: auto; margin-right: auto">{{$message}}</p>
						@endif
						<div class="text-center p-t-100">
							<a class="txt2" href="{{asset('/')}}">
								<i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
								Se connecter
							</a>
						</div>
	
						
					</form>
				</div>
			</div>
		</div>
	</div>
	<div id="loader" class="visible" style="position: fixed; top:40%; left:45%;">
		<img src = "{{asset('images/loader.svg')}}" alt="Chargement..."/>
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
	<script>
		$(document).ready(function(){
			$("#form").submit(function(){
				$("#loader").removeClass("visible");
				$("#container").addClass("opacity");
			});
		});
	</script>
</body>
</html>