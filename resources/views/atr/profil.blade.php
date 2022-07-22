<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UCP : Unité Coordination Projets</title>
  <link rel="icon" type="image/png" href="{{asset('images/ucp_logo.ico')}}"/>
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('admin/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('admin/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/vertical-layout-light/style.css')}}">
  <link rel="stylesheet" href="{{asset('admin/vendors/mdi/css/materialdesignicons.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
  <style>
    .visible {
      /* visibility: visible !important; */
      display: none;
    }
    .opacity {
      opacity: 0.5;
    }
    #profile-container:hover {
      opacity: 0.5;
    }
  </style>
</head>
<body>
  <div class="container-scroller" id="container">
    @include('atr.header')
    <div class="container-fluid page-body-wrapper">
      @include('atr.nav-gauche')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div style="margin-left:auto; margin-right:auto; text-align:center">
                      <form action="{{asset('/ATR/profil/changer-photo-de-profil')}}" method="POST" enctype="multipart/form-data" id="form_changer_photo_de_profil">
                        @csrf
                        <div id="profile-container">
                          <image id="profileImage" src="{{asset('images/photo_de_profil/'.$monProfil->photo_de_profil)}}" style="width: 200px; border-radius: 50%;" />
                        </div>
                        <input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" capture style="display: none;" onchange="document.getElementById('changer_photo_de_profil').removeAttribute('style')">
                        <div class="mt-2" style="font-weight: bold">{{ $monProfil->prenom }}<br>{{ $monProfil->nom }}</div>
                        <div class="mt-2" style="font-weight: lighter">ATR (Assistant Technique Régional)</div>
                        <div class="mt-3" style="display: none" id="changer_photo_de_profil">
                          <input type="submit" value="Changer la photo de profil" class="btn btn-inverse-warning btn-fw">
                        </div>
                      </form>
                      <div class="mt-3"><button class="btn btn-inverse-warning btn-fw" data-bs-toggle="modal" data-bs-target="#modalAncienMdp">Changer de mot de passe</button></div>
                      @if ($message = Session::get('successMDP'))
                        <p class="text-center alert alert-success animate__animated animate__bounceInRight mt-5" style="margin-left: auto; margin-right: auto">{{$message}}</p>
                      @endif
                      @if ($message = Session::get('errorMDP'))
                        <br>
                        <p class="text-center alert alert-danger animate__animated animate__bounceInRight mt-5" style="margin-left: auto; margin-right: auto">{{$message}}</p>
                      @endif
                      @if ($message = Session::get('successPDP'))
                        <p class="text-center alert alert-success animate__animated animate__bounceInRight mt-5" style="margin-left: auto; margin-right: auto">{{$message}}</p>
                      @endif
                      @if ($message = Session::get('errorPDP'))
                        <br>
                        <p class="text-center alert alert-danger animate__animated animate__bounceInRight mt-5" style="margin-left: auto; margin-right: auto">{{$message}}</p>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-9 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row" style="margin: 3%">
                    <h3>Modification de profil</h3>
                      @if ($message = Session::get('successProfil'))
                        <p id="test" class="text-center alert alert-success animate__animated animate__bounceInRight mt-5" style="margin-left: auto; margin-right: auto">{{$message}}</p>
                        <script>window.setTimeout(function(){ document.getElementById("test").classList.remove('animate__bounceInRight'); document.getElementById("test").classList.add('animate__fadeOutLeftBig'); }, 3000);window.setTimeout(function(){ document.getElementById("test").style.display='none'; }, 3400);</script>
                      @endif
                      @if ($message = Session::get('errorProfil'))
                        <br>
                        <p class="text-center alert alert-danger animate__animated animate__bounceInRight mt-5" style="margin-left: auto; margin-right: auto">{{$message}}</p>
                      @endif
                    <form action="{{asset('/ATR/modification-de-profil')}}" method="POST" id="formChangementDeProfil" class="mt-4">
                      @csrf
                      <div class="form-group row">
                        <div class="col">
                          <label>Nom</label>
                          <div id="the-basics">
                            <input class="typeahead" type="text" name="nom" value="{{ $monProfil->nom }}" required>
                          </div>
                        </div>
                        <div class="col">
                          <label>Prénom(s)</label>
                          <div id="bloodhound">
                            <input class="typeahead" type="text" name="prenom" value="{{ $monProfil->prenom }}" required>
                          </div>
                        </div>
                      </div><br>
                      <div class="form-group row">
                        <div class="col-md-2">
                          <label>Téléphone 1</label>
                          <div id="the-basics">
                            <input class="typeahead" type="tel" name="telephone1" id="phone1" onchange="document.getElementById('phone1').value = phoneInput1.getNumber()" value="{{ $monProfil->telephone1 }}" required>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <label>Téléphone 2</label>
                          <div id="bloodhound">
                            <input class="typeahead" type="tel" name="telephone2" id="phone2" onchange="document.getElementById('phone2').value = phoneInput2.getNumber()" value="{{ $monProfil->telephone2 }}" required>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <label>Téléphone 3</label>
                          <div id="the-basics">
                            <input class="typeahead" type="tel" name="telephone3" id="phone3" onchange="document.getElementById('phone3').value = phoneInput3.getNumber()" value="{{ $monProfil->telephone3 }}" required>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label>Adresse mail</label>
                          <div id="bloodhound">
                            <input class="typeahead" type="email" name="email" value="{{ $monProfil->email }}" required>
                            <input type="hidden" name="mot_de_passe" id="monMotDePasse">
                          </div>
                        </div>
                        <div class="col-md-2" style="text-align: right">
                          <label style="font-size: 0%">.</label>
                          <div id="bloodhound">
                            <input class="btn btn-inverse-warning btn-fw" type="submit" value="Modifier le profil" id="bouttonConfirmationChangementDeProfil" style="display: none">
                            <button type="button" class="btn btn-inverse-warning btn-fw" data-bs-toggle="modal" data-bs-target="#modalConfirmationChangementDeProfil">Modifier le profil</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- modals --}}
    <div class="modal fade" id="modalConfirmationChangementDeProfil" style="border-radius: 10%">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title">Veuillez écrire votre mot de passe actuel</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
              <h6>Veuillez écrire votre mot de passe actuel ci-dessous:</h6>
              <p>
                <input class="typeahead" type="password" name="mot_de_passeConfirmationChangementDeProfil" id="mot_de_passeConfirmationChangementDeProfil">
              </p>
              <div id="errorConfirmationChangementDeProfil"></div>
              </div>
              <div class="modal-footer">
              <button type="submit" class="btn btn-inverse-success btn-fw" onclick="confirmationChangementDeProfil()" id="validerConfirmationChangementDeProfil">Valider</button>
              <button type="submit" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal">Annuler</button>
              </div>
          </div>
      </div>
    </div>
    <div class="modal fade" id="modalAncienMdp" style="border-radius: 10%">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title">Veuillez écrire votre mot de passe actuel</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
              <h6>Veuillez écrire votre mot de passe actuel ci-dessous:</h6>
              <p>
                <input class="typeahead" type="password" name="ancien_mot_de_passe" id="ancien_mot_de_passe">
              </p>
              <div id="errorAncienMotDePasse"></div>
              </div>
              <div class="modal-footer">
              <button type="submit" class="btn btn-inverse-success btn-fw" onclick="ancienMot_de_passe()" id="validerModalAncienMdp">Valider</button>
              <button type="submit" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal">Annuler</button>
              </div>
          </div>
      </div>
    </div>
    <div class="modal fade" id="modalNouveauMdp" style="border-radius: 10%">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title">Veuillez écrire votre nouveau mot de passe</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
              <h6>Veuillez écrire votre nouveau mot de passe ci-dessous:</h6>
              <div class="form-group row">
                <div class="col">
                  <label>Nouveau mot de passe</label>
                  <div id="the-basics">
                    <input class="typeahead" type="password" name="nouveau_mot_de_passe1" id="nouveau_mot_de_passe1" onkeyup="nouveau_mot_de_passe()" required>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col">
                  <label>Confirmer votre nouveau mot de passe</label>
                  <div id="the-basics">
                    <input class="typeahead" type="password" name="nouveau_mot_de_passe2" id="nouveau_mot_de_passe2" onkeyup="nouveau_mot_de_passe()" required>
                  </div>
                </div>
              </div>
              <div id="errorNouveauMotDePasse"></div>
              </div>
              <div class="modal-footer">
              <button type="submit" class="btn btn-inverse-success btn-fw" data-bs-dismiss="modal" onclick="$('#validerChangementMDP').click()" id="validerModalNouveauMdp" style="display: none">Valider</button>
              <button type="submit" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal">Annuler</button>
              </div>
          </div>
      </div>
    </div>
  {{-- fin modals --}}

  {{-- changement de mot de passe --}}
  <form action="{{asset('/ATR/profil/changer-mot-de-passe')}}" method="POST" id="formChangementMotDePasse">
    @csrf
    <input type="hidden" name="ancienMdp" id="ancienMdp">
    <input type="hidden" name="nouveauMdp1" id="nouveauMdp1">
    <input type="hidden" name="nouveauMdp2" id="nouveauMdp2">
    <input type="submit" value="valider" id="validerChangementMDP" style="display: none">
  </form>
  {{-- fin changement de mot de passe --}}

  <div id="loader" class="visible" style="position: fixed; top:40%; left:45%;">
    <img src = "{{asset('images/loader.svg')}}" alt="Chargement..."/>
  </div>


  <script src="{{asset('admin/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('admin/js/off-canvas.js')}}"></script>
  <script src="{{asset('admin/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('admin/js/template.js')}}"></script>
  <script src="{{asset('admin/js/settings.js')}}"></script>
  <script src="{{asset('admin/js/todolist.js')}}"></script>
  <script src="{{asset('js/bootstrap-animate-css.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <script>
    // function delaiRedirection() {
    //   console.log('redirection');
    //   setTimeout(redirectionVersLogin, 5000);
    // }
    // function redirectionVersLogin() {
    //   window.location.href = '/utilisateur/deconnexion';
    // }
    async function sha256(message) {
        // encode as UTF-8
        const msgBuffer = new TextEncoder().encode(message);                    

        // hash the message
        const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer);

        // convert ArrayBuffer to Array
        const hashArray = Array.from(new Uint8Array(hashBuffer));

        // convert bytes to hex string                  
        const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
        return hashHex;
    }
    
    function ancienMot_de_passe() {
      const mdp = document.getElementById('ancien_mot_de_passe').value;
      const monMdp = <?php echo json_encode(request()->session()->get('login')->mot_de_passe) ?>;
      sha256(mdp).then(res => {
          if (res == monMdp) {
            document.getElementById('validerModalAncienMdp').setAttribute('data-bs-dismiss', 'modal');
            document.getElementById('validerModalAncienMdp').setAttribute('data-bs-target', '#modalNouveauMdp');
            document.getElementById('validerModalAncienMdp').setAttribute('data-bs-toggle', 'modal');
            document.getElementById('validerModalAncienMdp').removeAttribute('onclick');
            $('#validerModalAncienMdp').click();
          } else {
            document.getElementById('errorAncienMotDePasse').innerHTML = `<br><p class="text-center alert alert-danger animate__animated animate__bounceInRight" style="margin-left: auto; margin-right: auto">Mot de passe incorrect!</p>`;
          }
        }
      );
    }
    function confirmationChangementDeProfil() {
      const mdp = document.getElementById('mot_de_passeConfirmationChangementDeProfil').value;
      const monMdp = <?php echo json_encode(request()->session()->get('login')->mot_de_passe) ?>;
      sha256(mdp).then(res => {
          if (res == monMdp) {
            document.getElementById('validerConfirmationChangementDeProfil').setAttribute('data-bs-dismiss', 'modal');
            document.getElementById('validerConfirmationChangementDeProfil').removeAttribute('onclick');
            document.getElementById('monMotDePasse').setAttribute('value', mdp);
            $('#validerConfirmationChangementDeProfil').click();
            $('#bouttonConfirmationChangementDeProfil').click();
          } else {
            document.getElementById('errorConfirmationChangementDeProfil').innerHTML = `<br><p class="text-center alert alert-danger animate__animated animate__bounceInRight" style="margin-left: auto; margin-right: auto">Mot de passe incorrect!</p>`;
          }
        }
      );
    }

    function nouveau_mot_de_passe() {
      const ancien_mdp = document.getElementById('ancien_mot_de_passe').value;
      const nouveau_mdp1 = document.getElementById('nouveau_mot_de_passe1').value;
      const nouveau_mdp2 = document.getElementById('nouveau_mot_de_passe2').value;
      if (ancien_mdp == nouveau_mdp1) {
        document.getElementById('errorNouveauMotDePasse').innerHTML = `<p style="color: red">Votre nouveau mot de passe ne peut pas être votre ancien mot de passe!</p>`;
        document.getElementById('validerModalNouveauMdp').setAttribute('style', 'display:none');
      } else {
        if (nouveau_mdp1 != nouveau_mdp2) {
          document.getElementById('errorNouveauMotDePasse').innerHTML = `<p style="color: red">Les 2 mots de passe ne sont pas identiques!</p>`;
          document.getElementById('validerModalNouveauMdp').setAttribute('style', 'display:none');
        } else {
          document.getElementById('errorNouveauMotDePasse').innerHTML = ``;
          document.getElementById('validerModalNouveauMdp').removeAttribute('style');
          document.getElementById('ancienMdp').value = ancien_mdp;
          document.getElementById('nouveauMdp1').value = nouveau_mdp1;
          document.getElementById('nouveauMdp2').value = nouveau_mdp2;
        }
      }
    }

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

    $(document).ready(function(){
      $("#formChangementMotDePasse").submit(function(){
        $("#loader").removeClass("visible");
        $("#container").addClass("opacity");
      });
      $("#form_changer_photo_de_profil").submit(function(){
        $("#loader").removeClass("visible");
        $("#container").addClass("opacity");
      });
      $("#formChangementDeProfil").submit(function(){
        $("#loader").removeClass("visible");
        $("#container").addClass("opacity");
      });
    });

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

		const phoneInputField2 = document.querySelector("#phone2");
		const phoneInput2 = window.intlTelInput(phoneInputField2, {
			initialCountry: "auto",
			geoIpLookup: getIp,
			utilsScript:
			"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
		});

		const phoneInputField3 = document.querySelector("#phone3");
		const phoneInput3 = window.intlTelInput(phoneInputField3, {
			initialCountry: "auto",
			geoIpLookup: getIp,
			utilsScript:
			"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
		});
	</script>
</body>
</html>