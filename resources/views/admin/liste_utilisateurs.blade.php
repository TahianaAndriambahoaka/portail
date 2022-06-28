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
  </style>
</head>
<body>
  <div class="container-scroller" id="container">
    @include('admin.header')
    <div class="container-fluid page-body-wrapper">
      @include('admin/nav-gauche')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h3>Liste des utilisateurs</h3><br>
                  <div class="row" style="text-align: center">
                    <div class="col-md-3">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <button class="btn btn-sm btn-primary" type="button">Fonction</button>
                          </div>
                          <select class="form-control" id="fonctionAff" onchange="window.location.href = '?fonction='+document.getElementById('fonctionAff').value">
                            <option value="tous" selected>Tous</option>
                            @for ($i = 0; $i < count($allFonctions); $i++)
                              @if ($allFonctions[$i]->id == $_GET['fonction'])
                                <option value="{{ $allFonctions[$i]->id }}" selected>{{ $allFonctions[$i]->nom }}</option>
                              @else
                                <option value="{{ $allFonctions[$i]->id }}">{{ $allFonctions[$i]->nom }}</option>
                              @endif
                            @endfor
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <button type="button" class="btn btn-inverse-success btn-fw" data-bs-toggle="modal" data-bs-target="#modalAjoutUtilisateur">Ajouter un nouvel utilisateur</button>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group">
                          @if ($_GET['fonction'] == 'tous')
                            <input type="text" class="form-control" placeholder="Rechercher les utilisateurs avec tous les profils" id="search">
                          @else
                            @for ($i = 0; $i < count($allFonctions); $i++)
                                @if ($allFonctions[$i]->id == $_GET['fonction'])
                                  <input type="text" class="form-control" placeholder="Rechercher les utilisateurs avec le profil {{ $allFonctions[$i]->nom }}" id="search">
                                @endif
                            @endfor
                          @endif
                          <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" type="button" id="searchButton">Rechercher</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
                  @if ($message = Session::get('success'))
                    <p class="text-center alert alert-success animate__animated animate__bounceInRight" style="margin-left: auto; margin-right: auto">{{$message}}</p>
                  @endif
                  @if ($message = Session::get('error'))
                    <br>
                    <p class="text-center alert alert-danger animate__animated animate__bounceInRight" style="margin-left: auto; margin-right: auto">{{$message}}</p>
                  @endif
                  <br>
                  <div class="table-responsive">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                          <th style="text-align: center">Photo</th>
                          <th>Nom</th>
                          <th>Prénom(s)</th>
                          <th style="text-align: center">Fonction</th>
                          <th></th>
                        </tr>
                    </thead>
                    <tbody id="listeUtilisateurs">
                      @for ($i = 0; $i < count($utilisateurs); $i++)
                        <tr>
                          <td style="text-align: center"><image src="{{asset('images/photo_de_profil/'.$utilisateurs[$i]->photo_de_profil)}}" alt="Photo_de_profil" style="height: 75px; width: 75px;"/></td>
                          <td>{{ $utilisateurs[$i]->nom }}</td>
                          <td>{{ $utilisateurs[$i]->prenom }}</td>
                          <td style="text-align: center">{{ $fonctions[$i]->nom }}</td>
                          <td>
                            <button type="button" class="btn btn-inverse-warning btn-fw" data-bs-toggle="modal" data-bs-target="#modal{{ $utilisateurs[$i]->id }}">Plus</button>
                          </td>
                        </tr>
                      @endfor
                    </tbody>
                    </table>
                    <br>
                    {!! $utilisateurs->withQueryString()->links('pagination::bootstrap-4') !!}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4"></div>
          </div>
          @include('admin.modals_liste_utilisateurs')
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
    $('#searchButton').on('click', function() {
      var value = $('#search').val().replace(/^\s+|\s+$/gm,'');
      if (value!='') {
        $('table tbody tr').hide();
      } else {
        $('table tbody tr').show();        
      }
      $('table tbody tr td:contains("'+value+'")').parent('tr').show();

      var xhr = new XMLHttpRequest();
      const fonc = <?php echo json_encode($_GET['fonction']); ?>;
      xhr.open('GET', `<?php echo asset('/administrateur/utilisateursWS?fonction=')?>${fonc}`);
      var utilisateurs = [];
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4) {
              const reponse = JSON.parse(xhr.responseText);
              for (let i = 0; i < reponse.length; i++)  {
                  utilisateurs.push(reponse[i]);
              }
              var utilisateursAff = [];
              for (i = 0; i < utilisateurs.length; i++) {
                const nom = utilisateurs[i].nom;
                const prenom = utilisateurs[i].prenom;
                if (nom.includes(value)) {
                  utilisateursAff.push(utilisateurs[i]);
                }
                if (prenom.includes(value)) {
                  utilisateursAff.push(utilisateurs[i]);
                }
              }
              const allFonctions = <?php echo json_encode($allFonctions); ?>;
              var element = "";
              for (let i = 0; i < utilisateursAff.length; i++) {
                element += '<tr>';
                  element += `<td style="text-align: center"><image src="{{asset('images/photo_de_profil/${utilisateursAff[i].photo_de_profil}')}}" alt="Photo_de_profil" style="height: 75px; width: 75px;"/></td>`;
                  element += `<td>${utilisateursAff[i].nom}</td>`;
                  element += `<td>${utilisateursAff[i].prenom}</td>`;
                  element += `<td style="text-align: center">${allFonctions[i].nom}</td>`;
                  // element += `<td><button type="button" class="btn btn-inverse-warning btn-fw" data-bs-toggle="modal" data-bs-target="#modal${utilisateursAff[i].id}">Plus</button></td>`;
                element += '</tr>';
              }
              document.getElementById('listeUtilisateurs').innerHTML = element;
          }
      };
      xhr.send();

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
	</script>
</body>
</html>