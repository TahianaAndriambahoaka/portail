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
            @if ($message = Session::get('success'))
              <p class="text-center alert alert-success animate__animated animate__bounceInRight" style="margin-left: auto; margin-right: auto">{{$message}}</p>
            @endif
            @if ($message = Session::get('error'))
              <br>
              <p class="text-center alert alert-danger animate__animated animate__bounceInRight" style="margin-left: auto; margin-right: auto">{{$message}}</p>
            @endif







            <div class="col-lg-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div style="margin-left:auto; margin-right:auto; text-align:center">
                      <div id="profile-container">
                        <image id="profileImage" src="{{asset('images/photo_de_profil/'.$monProfil->photo_de_profil)}}" style="width: 200px; border-radius: 50%;" />
                        <div>Changer la photo de profil</div>
                      </div>
                      <input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" capture style="display: none;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-9 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row" style="margin: 3%">
                    <form action="/administrateur/inscription-utilisateur" method="POST" id="formAjout">
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
                      </div>
                      <div class="form-group row">
                        <div class="col">
                          <label>Fonction</label>
                          <div id="the-basics">
                            <select class="typeahead" name="id_fonction" required>
                              <option value="">Fonction</option>
                              @for ($i = 0; $i < count($allFonctions); $i++)
                                @if ($allFonctions[$i]->nom == 'ATR')
                                  <option value="{{ $allFonctions[$i]->id }}" selected>{{ $allFonctions[$i]->nom }}</option>
                                @else
                                  <option value="{{ $allFonctions[$i]->id }}">{{ $allFonctions[$i]->nom }}</option>
                                @endif
                              @endfor
                            </select>
                          </div>
                        </div>
                        <div class="col">
                          <label>Région</label>
                          <div id="bloodhound">
                            <select class="typeahead" name="id_region" id="id_regionAjout" onchange="showDistricts()" required>
                              <option value="">Région</option>
                              @for ($i = 0; $i < count($allRegions); $i++)
                                @if ($monProfil->id_region == $allRegions[$i]->id)
                                  <option value="{{ $allRegions[$i]->id }}" selected>{{ $allRegions[$i]->nom }}</option>
                                @else
                                  <option value="{{ $allRegions[$i]->id }}">{{ $allRegions[$i]->nom }}</option>
                                @endif
                              @endfor
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col">
                          <label>District</label>
                          <div id="the-basics">
                            <select class="typeahead" name="id_district" id="id_districtAjout" required>
                              <option value="">District</option>
                            </select>
                          </div>
                        </div>
                        <div class="col">
                          <label>Ministère</label>
                          <div id="bloodhound">
                            <select class="typeahead" name="ministere" required>
                              <option value="{{ $monProfil->ministere }}">{{ $monProfil->ministere }}</option>
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
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col">
                          <label>Direction</label>
                          <div id="the-basics">
                            <input class="typeahead" type="text" name="direction" value="{{ $monProfil->direction }}" required>
                          </div>
                        </div>
                        <div class="col">
                          <label>Lieu de travail</label>
                          <div id="bloodhound">
                            <input class="typeahead" type="text" name="lieu_de_travail" value="{{ $monProfil->lieu_de_travail }}" required>
                          </div>
                        </div>
                      </div>
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
                        <div class="col-md-6">
                          <label>Adresse mail</label>
                          <div id="bloodhound">
                            <input class="typeahead" type="email" name="email" value="{{ $monProfil->email }}" required>
                          </div>
                        </div>
                      </div>
                      <input type="submit" value="Insérer" style="display: none" id="idFormAjout">
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
    $("#profile-container").click(function(e) {
			$("#imageUpload").click();
		});

    $(document).ready(function(){
      $("#formSuppression").submit(function(){
        $("#loader").removeClass("visible");
        $("#container").addClass("opacity");
      });
      $("#formModification").submit(function(){
        $("#loader").removeClass("visible");
        $("#container").addClass("opacity");
      });
      $("#formAjout").submit(function(){
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

    function showDistricts() {
			const districts = <?php echo json_encode($allDistricts); ?>;
			var districts_aff = "<option value=''>District</option>";
			for (let i = 0; i < districts.length; i++) {
				if (districts[i]['id_region'] == document.getElementById('id_regionAjout').value) {
					districts_aff += "<option value='"+districts[i]['id']+"'>"+districts[i]['nom']+"</option>";
				}
			}
			document.getElementById('id_districtAjout').innerHTML = districts_aff;
		}

    const districts = <?php echo json_encode($allDistricts); ?>;
    var districts_aff = "<option value=''>District</option>";
    for (let i = 0; i < districts.length; i++) {
      if (districts[i]['id_region'] == document.getElementById('id_regionAjout').value) {
        if (districts[i]['id'] == <?php echo json_encode($monProfil->id_district); ?>) {
          districts_aff += "<option value='"+districts[i]['id']+"' selected>"+districts[i]['nom']+"</option>";
        } else {
          districts_aff += "<option value='"+districts[i]['id']+"'>"+districts[i]['nom']+"</option>";
        }
      }
    }
    document.getElementById('id_districtAjout').innerHTML = districts_aff;
	</script>
</body>
</html>