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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
<style>
	select {
		appearance: none;
	}
	#profile-container:hover {
		opacity: 0.5;
	}
</style>
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
			<div class="wrap-login100">
				<form style="margin-left: auto; margin-right: auto;" action="inscription" method="POST" enctype="multipart/form-data" id="form">
					@csrf
					<span class="login100-form-title" style="margin-top: -15%;">
						Formulaire de demande d'inscription
					</span>

					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4" style="margin-left:auto; margin-right:auto; text-align:center">
							<div id="profile-container">
								<image id="profileImage" src="{{asset('images/photo_de_profil/default_profile_picture.jpg')}}" style="width: 200px; border-radius: 50%;" />
								<div>Changer la photo de profil</div>
							</div>
							<input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" capture style="display: none;">
						</div>
						<div class="col-md-4"></div>
					</div><br><br>

					<div class="row">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Veuillez entrer votre nom!">
								<input class="input100" type="text" name="nom" placeholder="Nom" required>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<!-- <i class="fa fa-info" aria-hidden="true"></i> -->
									<img style="margin-left: -0.7%; width: 1.2em;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABmJLR0QA/wD/AP+gvaeTAAABF0lEQVQ4jdXUvUoDQRTF8Z/xo0xiYaGCtQ8gpNHKWkvfxsrGp/EJLLQMAYVUNloIYqHgZ2VMtMhsWDazkzXEIgcWZs+Z+2eYvXuZNy1EvGU0sViR0ccreinwFlpY+uMBv9HGfWbUCiedBirUtAJjZGRqJKB17IR1Bx8l8Aaei+BaZDOs4STA4QjHeIrsrY0tEjrMQYX1waSiKuBGxGvOAnwd8a4mFVXpgAusYj+8n+NyFuAfnIWnsiaBV7Bu/MoGeMTXNOBNw7aql+Tvhm34EAtTH28vARWy3bIwBb5NZJnuyoL8VQwKWQen2DY+6fq4Qbfgjxh58JvhlMp73UhxmXqBQeEkA3xiQ7Ufpwht4yUz/m3Qz59+AWN2Lz/EecxuAAAAAElFTkSuQmCC"/>
								</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Veuillez entrer votre prénom!">
								<input class="input100" type="text" name="prenom" placeholder="Prénom" required>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<!-- <i class="fa fa-info" aria-hidden="true"></i> -->
									<img style="margin-left: -0.7%; width: 1.2em;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABmJLR0QA/wD/AP+gvaeTAAABF0lEQVQ4jdXUvUoDQRTF8Z/xo0xiYaGCtQ8gpNHKWkvfxsrGp/EJLLQMAYVUNloIYqHgZ2VMtMhsWDazkzXEIgcWZs+Z+2eYvXuZNy1EvGU0sViR0ccreinwFlpY+uMBv9HGfWbUCiedBirUtAJjZGRqJKB17IR1Bx8l8Aaei+BaZDOs4STA4QjHeIrsrY0tEjrMQYX1waSiKuBGxGvOAnwd8a4mFVXpgAusYj+8n+NyFuAfnIWnsiaBV7Bu/MoGeMTXNOBNw7aql+Tvhm34EAtTH28vARWy3bIwBb5NZJnuyoL8VQwKWQen2DY+6fq4Qbfgjxh58JvhlMp73UhxmXqBQeEkA3xiQ7Ufpwht4yUz/m3Qz59+AWN2Lz/EecxuAAAAAElFTkSuQmCC"/>
								</span>
							</div>
						</div>
					</div>

					
					<div class="row">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Entrer une adrese mail valide!">
								<input class="input100" type="email" name="email" placeholder="Adresse mail" required>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-envelope" aria-hidden="true"></i>
								</span>
							</div>
						</div>
						<div class="col-md-6">
							<select class="input100" style="border: none;" name="id_fonction" required>
							<option value="">Fonction</option>
							@for ($i = 0; $i < count($fonction); $i++)
								<option value="{{ $fonction[$i]->id }}">{{ $fonction[$i]->nom }}</option>
							@endfor
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input">
								<select class="input100" style="border: none;" name="id_region" onchange="showDistricts()" id="id_region" required>
									<option value="">Région</option>
									@for ($i = 0; $i < count($region); $i++)
										<option value="{{ $region[$i]->id }}">{{ $region[$i]->nom }}</option>
									@endfor
								</select>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<!-- <i class="fa fa-location-arrow" aria-hidden="true"></i> -->
									<img style="margin-left: -0.7%; width: 1.2em;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABxElEQVRIibXVv2pVQRAG8F9UkBv/YIwRRTCWCiIq2mgpaJfOJ0glWIj4KJY+gNjaWSuoRbAIiCkiCmpijKaIBr1iLHZusuw9e+69QT84zGFm5/tmz5md5T9jbIg1R3EybCd8G/iM92F3JLAfl3FsQAFLeInvTcHdlaRJXMOhAeS9Qk5JO9kYRmBfkO8dgryHPTghfbLuIIGrUuVncBPr+FIhPp2tWcMBvCuVcxzB8RC4J/3Uc7hVEbiDg7iEu+GbxGpvwa4iYTrsDdsd87VCnsc6uF5wNApMhb2Y+R6HvYD78ZwvYnnOVObrExgPm7fmfNhZHI5ntojlOeOZr09gs7CjoDG3FOj18VLmOxv2gfTNV+M9j8FywYH+LlrBBOak8QAzeI5XuF2sn8ne5zKO6g4+hH2SVdJ2mifC/oicnAP9B23dduVv8BuPZH1dYCHWPAziNWmnW2gadtO40lJ1G55J42IL5SciHfXlBv8grJTkNQF4gZ8jkP+SGqEPtXHdxTdpDA+6lDbxVGWk1ARIP3xMusnaMI/FWrBNgHSJdKTx0IRFRdeMKgAfKyJvpauydawMIwCf8Ee6ULp4LVW+k5n1b/EX2vZbS5DHKpMAAAAASUVORK5CYII="/>
								</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input">
								<select class="input100" style="border: none;" name="id_district" id="id_district" required>
									<option value="">District</option>
									{{-- @for ($i = 0; $i < count($district); $i++)
										<option value="{{ $district[$i]->id }}">{{ $district[$i]->nom }}</option>
									@endfor --}}
								</select>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<!-- <i class="fa fa-location-arrow" aria-hidden="true"></i> -->
									<img style="margin-left: -0.7%; width: 1.2em;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABxElEQVRIibXVv2pVQRAG8F9UkBv/YIwRRTCWCiIq2mgpaJfOJ0glWIj4KJY+gNjaWSuoRbAIiCkiCmpijKaIBr1iLHZusuw9e+69QT84zGFm5/tmz5md5T9jbIg1R3EybCd8G/iM92F3JLAfl3FsQAFLeInvTcHdlaRJXMOhAeS9Qk5JO9kYRmBfkO8dgryHPTghfbLuIIGrUuVncBPr+FIhPp2tWcMBvCuVcxzB8RC4J/3Uc7hVEbiDg7iEu+GbxGpvwa4iYTrsDdsd87VCnsc6uF5wNApMhb2Y+R6HvYD78ZwvYnnOVObrExgPm7fmfNhZHI5ntojlOeOZr09gs7CjoDG3FOj18VLmOxv2gfTNV+M9j8FywYH+LlrBBOak8QAzeI5XuF2sn8ne5zKO6g4+hH2SVdJ2mifC/oicnAP9B23dduVv8BuPZH1dYCHWPAziNWmnW2gadtO40lJ1G55J42IL5SciHfXlBv8grJTkNQF4gZ8jkP+SGqEPtXHdxTdpDA+6lDbxVGWk1ARIP3xMusnaMI/FWrBNgHSJdKTx0IRFRdeMKgAfKyJvpauydawMIwCf8Ee6ULp4LVW+k5n1b/EX2vZbS5DHKpMAAAAASUVORK5CYII="/>
								</span>
							</div>
						</div>
					</div>
					
					
					
					
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<select class="input100" style="border: none;" name="ministere" required>
							<option value="">Ministère</option>
							<option value="Ministère de la santé publique">Ministère de la santé publique</option>
							<option value="Ministère de la sécurité publique">Ministère de la sécurité publique</option>
							<option value="Ministère de la Population, de la Protection Sociale et de la Promotion de la Femme">Ministère de la Population, de la Protection Sociale et de la Promotion de la Femme</option>
							<option value="Ministère du Développement Numérique, Transformation Digitale, des Postes et des Télécommunications">Ministère du Développement Numérique, Transformation Digitale, des Postes et des Télécommunications</option>
							<option value="Ministère des Mines et des Ressources Stratégiques">Ministère des Mines et des Ressources Stratégiques</option>
							<option value="Ministère de la Justice">Ministère de la Justice</option>
							<option value="Ministère de l'enseignement supérieur et de la recherche scientifique">Ministère de l'enseignement supérieur et de la recherche scientifique</option>
							<option value="Ministère de l'Environnement et du Développement Durable">Ministère de l'Environnement et du Développement Durable</option>
							<option value="Ministère de la Défense Nationale">Ministère de la Défense Nationale</option>
							<option value="Ministère des Affaires Etrangères">Ministère des Affaires Etrangères</option>
						</select>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<!-- <i class="fa fa-location-arrow" aria-hidden="true"></i> -->
							<img style="margin-left: -0.7%; width: 1.2em;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAAC1UlEQVQ4jaWUzW8bRRiHn52d/XDWH2k+2rhbt27axBSkAgFxICUSEqrECThwoIceirhUlXqoKrUSQlFPSCBxibjxB3DhBOKIEkQJghCUOgkNSEDaaAly4zhkN7v2epZDqBNE7Frwu4zmmff9vfPOjEajC71+4eJzcbRzwbYto/9Q7/tTU1O/tIuV3RhWNzZek4I3fH/7sKEbM8D/MwQoL95Z0+Az70Hl225z2qkwMFQoDwwVykDhUcGddpg2enrfNVPZVzPFcVfTBJH65nb45x/TjZ2tK8DmQUma4zgvHcnnJzWhK4BENUUYxdkoFkMZd6zfTPcJvbYEaDRzZwiqa8nmWrmetvi1J2VU9uete96kjEEWh0fGRh87kwqCgJmZr5ADx0nn3FZVhU4URRDUENLS+k48Y4Vb66Ut//fS+fMTZLMZVn5c3lnzPCkj358VidInzo0zMz1N2NCQQYUwrBLHMc1mkziOd9sJVlpFEqWIlcA2JBPnxvl5eVGPfH9WA3qPFY57Z58es+NGg+9+WMIwTW7degfLsoiiiJs33j6YGQZPPjGCNAwW5r8P799bzUuA4ZFS5eJbl48B3L12HYBc3yAAtgOZTLYtu3T5KgAffvBe5f691b1b/vSTjxktPd5qaWXxDre//ILnX3jxkWzl7tK/n81TY88ymN+7CNtJUzw1iu2kO7ITp0focXpY/W0VAPFwYWF+jsDfbgUulxcgru+OHVjgb7MwP9eatwwP0lHX7YrtV0fD/6KWYaE4jGmaqEShEkWSKACSv+ftmGmaFIrDLUNN1/VXUuncR4cG8qFqxqK2VesFsA0Z5fNHLM9bj8JGbLVjuWxuU+hSVSuevbNde1MmQrqOe7ZfZA8jgNNHN0hUEyAF4J7MpvZ19A+mCZ2q6ksBONYgwU9fuxKg7lchSQB4oCsg6fLEYurNdQDqwe7nowElYVgvd+nQUaoRff4XEmI6/6lHW5wAAAAASUVORK5CYII="/>
						</span>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Entrer votre direction!">
								<input class="input100" type="text" name="direction" placeholder="Direction" required>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<!-- <i class="fa fa-lock" aria-hidden="true"></i> -->
									<img style="margin-left: -0.7%; width: 1.2em;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAACkklEQVRoge3ZTagNcRjH8Y97vd3jkli4kiJSpLtRys7CRkmxQbGUHSshNpSVbOywFqVYuWwohLxEEYq8hVKEhXdxLaaTuac598ycZ5yxON96Nmfmef6/35mZ//+Z/9ClS5cqqGEdjuIG3uI7NlQpqgj92IcPGM6Ih+itTF1OBvFYtoF0vMR5bEVfJUpHYRDvtTbRGPcwuwK9mdTwSHET9biDcR1XncFu7Zuox5aOq26gF6/FjVzvtPBGloibqMdAREhPJBmLg/lpFkaSo0YmBvPTzIokR418COan+RVJjhp5E8xP867EWoUZj4/iD/pvTIsIiV6RHzgTrAGnJZ1BZUzGE/Erch8TOqx9BKsyRLUbSyNCorfW12B+mtCsFaUfn8WvxlflrkltsVPcyP6Oq27CXu2b2FGB3qas0L6ReRXobcpYvFLcxLUqxLZiu+JG1leitAXjcVt+ExcxphKlORiU30iobW8kuiA28qnAud/LHLhsI1MLnFsrc+CyjRTplxaVPHZp1PBc/mfkgf9wp7HOFGzDU80NfMRhycTwXzBOsrt+FcexLHWsF2twwV8Dl7DRyOZwpmSD7xiW/3vJI5mOXbJX8pvYZPSXpB6sxCn8bMi/J9l1nPSPtIM5OIIvWt//bySNZHpmqmGPfM/RexwQ3LRrpA8H8S2HgMbYnKqzuY38T5LvLeHX4AW424aAetxK1boVqHMTc9s1MYAXgcGHJZ8b6uT5CDRaPMOMoiZ6JLNRZOBhHErVPFRCvcKN5toSBh2WzE51VpZUc3URIydLGPCLkSt3n3wzXqs4UcRIkVajWQxl1B0qoe6zLMHNmsYy5u+zGb+dK6HuzCInXxb/5+Zn1J1fQt0rRYx06dIl4Q+nymZmfnVoiQAAAABJRU5ErkJggg=="/>
								</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Entrer votre lieu de travail!">
								<input class="input100" type="text" name="lieu_de_travail" placeholder="Lieu de travail" required>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<!-- <i class="fa fa-location-arrow" aria-hidden="true"></i> -->
									<img style="margin-left: -0.7%; width: 1.2em;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAAgklEQVRIiWNgGAUEACOR6v6Tq58Jie3FwMDwGGoYOsZnMTp+zMDA4IlNMS7DycGPsHkR5lJfPC4mBmxGNpsJj0KqgJFnQRcDA0MnLS0glGwxAAuJFpSTqJ72cYAtH1DVbJr7AFscUCsnMzAw0MEHyIAmhR0y8IRKUMNwD+r5exRQCgAXo06gquMZ2AAAAABJRU5ErkJggg=="/>
								</span>
							</div>
						</div>
					</div>
					
					



					<div class="row">
						<div class="col-md-4">
							<div class="wrap-input100 validate-input" data-validate = "Numero de téléphone obligatoire!">
								<input class="input100" type="tel" name="telephone1" id="phone1" onchange="process1()" required>
								<div class="alert alert-info animate__animated animate__fadeInDown mt-1" style="display: none;"></div>
								<span class="focus-input100"></span>
								{{-- <span class="symbol-input100">
									<i class="fa fa-phone" aria-hidden="true"></i>
								</span> --}}
							</div>
						</div>
						<div class="col-md-4">
							<div class="wrap-input100 validate-input" data-validate = "Numero de téléphone obligatoire!">
								<input class="input100" type="tel" name="telephone2" id="phone2" onchange="process2()" required>
								<div class="alert alert-info animate__animated animate__fadeInDown mt-1" style="display: none;"></div>
								<span class="focus-input100"></span>
								{{-- <span class="symbol-input100">
									<i class="fa fa-phone" aria-hidden="true"></i>
								</span> --}}
							</div>
						</div>
						<div class="col-md-4">
							<div class="wrap-input100 validate-input" data-validate = "Numero de téléphone obligatoire!">
								<input class="input100" type="tel" name="telephone3" id="phone3" onchange="process3()" required>
								<div class="alert alert-info animate__animated animate__fadeInDown mt-1" style="display: none;"></div>
								<span class="focus-input100"></span>
								{{-- <span class="symbol-input100">
									<i class="fa fa-phone" aria-hidden="true"></i>
								</span> --}}
							</div>
						</div>
					</div>


					
					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit" value="Envoyer la demande d'inscription">
					</div>

					@if ($message = Session::get('success'))
						<br>
						<p class="text-center alert alert-success animate__animated animate__bounceInRight" style="margin-left: auto; margin-right: auto">{{$message}}</p>
					@endif
					@if ($message = Session::get('error'))
						<br>
						<p class="text-center alert alert-danger animate__animated animate__bounceInRight" style="margin-left: auto; margin-right: auto">{{$message}}</p>
					@endif

					<div class="text-center p-t-70">
						<a class="txt2" href="/">
							Se connecter
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>


	<script>
		function getIp(callback) {
			fetch('https://ipinfo.io/json?token=662221c0429e7f', { headers: { 'Accept': 'application/json' }})
			.then((resp) => resp.json())
			.catch(() => {
				return {
				country: 'mg',
				};
			})
			.then((resp) => callback(resp.country));
		}		

		const phoneInputField1 = document.querySelector("#phone1");
		const phoneInput1 = window.intlTelInput(phoneInputField1, {
			initialCountry: "auto",
			geoIpLookup: getIp,
			utilsScript:
			"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
		});
		function process1() {
			const phoneNumber = phoneInput1.getNumber();
			document.getElementById('phone1').value = phoneNumber;
		}

		const phoneInputField2 = document.querySelector("#phone2");
		const phoneInput2 = window.intlTelInput(phoneInputField2, {
			initialCountry: "auto",
			geoIpLookup: getIp,
			utilsScript:
			"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
		});
		function process2() {
			const phoneNumber = phoneInput2.getNumber();
			document.getElementById('phone2').value = phoneNumber;
		}

		const phoneInputField3 = document.querySelector("#phone3");
		const phoneInput3 = window.intlTelInput(phoneInputField3, {
			initialCountry: "auto",
			geoIpLookup: getIp,
			utilsScript:
			"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
		});
		function process3() {
			const phoneNumber = phoneInput3.getNumber();
			document.getElementById('phone3').value = phoneNumber;
		}
	</script>
	
	<script>
		$("#profile-container").click(function(e) {
			$("#imageUpload").click();
		});
		
		function fasterPreview( uploader ) {
			if ( uploader.files && uploader.files[0] ){
				$('#profileImage').attr('src', 
					window.URL.createObjectURL(uploader.files[0]) );
			}
		}
		
		$("#imageUpload").change(function(){
			fasterPreview( this );
		});

		function showDistricts() {
			const id_region = document.getElementById('id_region').value;
			const districts = <?php echo json_encode($district); ?>;
			var districts_aff = "<option value=''>District</option>";
			for (let i = 0; i < districts.length; i++) {
				if (districts[i]['id_region'] == id_region) {
					districts_aff += "<option value='"+districts[i]['id']+"'>"+districts[i]['nom']+"</option>";
				}
			}
			document.getElementById('id_district').innerHTML = districts_aff;
		}

		$(document).ready(function(){
			$("#form").submit(function(){
				$("#loader").removeClass("visible");
				$("#container").addClass("opacity");
			});
		});

	</script>

</body>
</html>