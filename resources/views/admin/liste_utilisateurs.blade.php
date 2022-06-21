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
                  <h5>Afficher par fonction :
                      <select class="input100" style="border-color: rgba(0, 0, 0, 0.178);" name="fonctionAff" id="fonctionAff" onchange="changeFonctionAff()">
                        <option value="tous" selected>Tous</option>
                        @for ($i = 0; $i < count($allFonctions); $i++)
                          <option value="{{ $allFonctions[$i]->id }}">{{ $allFonctions[$i]->nom }}</option>
                        @endfor
                      </select>
                  </h5>
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
                    <tbody>
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
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4"></div>
          </div>



          @for ($i = 0; $i < count($utilisateurs); $i++)
            <div class="modal fade" id="modal{{ $utilisateurs[$i]->id }}" style="border-radius: 10%">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Plus d'informations sur la demande d'inscription</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                              <p>
                                  <image src="{{asset('images/photo_de_profil/'.$utilisateurs[$i]->photo_de_profil)}}" alt="Photo_de_profil" style="height: 150px; width: 150px; float: right"/>
                              </p>
                              <p>
                                  <b>Nom : </b>
                                  {{ $utilisateurs[$i]->nom }}
                              </p>
                              <p>
                                  <b>Prénom(s) : </b>
                                  {{ $utilisateurs[$i]->prenom }}
                              </p>
                              <p>
                                  <b>Fonction : </b>
                                  {{-- <button class="btn btn-info" disabled><b>en tant que {{ $fonctions[$i]->nom }}</b></button> --}}
                                  <e class="badge badge-warning">{{ $fonctions[$i]->nom }}</e>
                              </p>
                              <p>
                                  <b>Région : </b>
                                  {{ $regions[$i]->nom }}
                              </p>
                              <p>
                                  <b>District : </b>
                                  {{ $districts[$i]->nom }}
                              </p>
                              <p>
                                  <b>Ministère : </b>
                                  {{ $utilisateurs[$i]->ministere }}
                              </p>
                              <p>
                                  <b>Direction : </b>
                                  {{ $utilisateurs[$i]->direction }}
                              </p>
                              <p>
                                  <b>Lieu de travail : </b>
                                  {{ $utilisateurs[$i]->lieu_de_travail }}
                              </p>
                              <p>
                                  <b>Téléphone 1 : </b>
                                  <a href="tel:{{ $utilisateurs[$i]->telephone1 }}">{{ $utilisateurs[$i]->telephone1 }}</a>
                              </p>
                              <p>
                                  <b>Téléphone 2 : </b>
                                  <a href="tel:{{ $utilisateurs[$i]->telephone2 }}">{{ $utilisateurs[$i]->telephone2 }}</a>
                              </p>
                              <p>
                                  <b>Téléphone 3 : </b>
                                  <a href="tel:{{ $utilisateurs[$i]->telephone3 }}">{{ $utilisateurs[$i]->telephone3 }}</a>
                              </p>
                              <p>
                                  <b>Adresse mail : </b>
                                  <a href="mailto:{{ $utilisateurs[$i]->email }}">{{ $utilisateurs[$i]->email }}</a>
                              </p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-inverse-warning btn-fw" data-bs-toggle="modal" data-bs-target="#modalModif{{ $utilisateurs[$i]->id }}" data-bs-dismiss="modal">Modifier sa fonction</button>
                            <button type="submit" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
          @endfor
          @for ($i = 0; $i < count($utilisateurs); $i++)
            <div class="modal fade animate__animated animate__pulse" id="modalModif{{ $utilisateurs[$i]->id }}" style="border-radius: 10%">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Plus d'informations sur la demande d'inscription</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                              <p>
                                  <image src="{{asset('images/photo_de_profil/'.$utilisateurs[$i]->photo_de_profil)}}" alt="Photo_de_profil" style="height: 150px; width: 150px; float: right"/>
                              </p>
                              <p>
                                  <b>Nom : </b>
                                  {{ $utilisateurs[$i]->nom }}
                              </p>
                              <p>
                                  <b>Prénom(s) : </b>
                                  {{ $utilisateurs[$i]->prenom }}
                              </p>
                              <p>
                                  <b>Fonction : </b>
                                  {{-- <button class="btn btn-info" disabled><b>en tant que {{ $fonctions[$i]->nom }}</b></button> --}}
                                  <e class="badge badge-warning">{{ $fonctions[$i]->nom }}</e>
                              </p>
                              <p>
                                  <b>Région : </b>
                                  {{ $regions[$i]->nom }}
                              </p>
                              <p>
                                  <b>District : </b>
                                  {{ $districts[$i]->nom }}
                              </p>
                              <p>
                                  <b>Ministère : </b>
                                  {{ $utilisateurs[$i]->ministere }}
                              </p>
                              <p>
                                  <b>Direction : </b>
                                  {{ $utilisateurs[$i]->direction }}
                              </p>
                              <p>
                                  <b>Lieu de travail : </b>
                                  {{ $utilisateurs[$i]->lieu_de_travail }}
                              </p>
                              <p>
                                  <b>Téléphone 1 : </b>
                                  <a href="tel:{{ $utilisateurs[$i]->telephone1 }}">{{ $utilisateurs[$i]->telephone1 }}</a>
                              </p>
                              <p>
                                  <b>Téléphone 2 : </b>
                                  <a href="tel:{{ $utilisateurs[$i]->telephone2 }}">{{ $utilisateurs[$i]->telephone2 }}</a>
                              </p>
                              <p>
                                  <b>Téléphone 3 : </b>
                                  <a href="tel:{{ $utilisateurs[$i]->telephone3 }}">{{ $utilisateurs[$i]->telephone3 }}</a>
                              </p>
                              <p>
                                  <b>Adresse mail : </b>
                                  <a href="mailto:{{ $utilisateurs[$i]->email }}">{{ $utilisateurs[$i]->email }}</a>
                              </p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-inverse-warning btn-fw" data-bs-target="#modal{{ $utilisateurs[$i]->id }}" data-bs-dismiss="modal">Modifier sa fonction</button>
                            <button type="submit" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
          @endfor



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
  <script>
    function valider(id_demande) {
      $('#valider-'+id_demande).click();
    }
    function refuser(id_demande) {
      $('#refuser-'+id_demande).click();
    }

    $(document).ready(function(){
      $("#form").submit(function(){
        $("#loader").removeClass("visible");
        $("#container").addClass("opacity");
      });
    });

    function changeFonctionAff() {
      const id_fonction = document.getElementById('fonctionAff').value;
      var listeId = [];
      const fonctions = <?php echo json_encode($fonctions) ?>;
      for (let i = 0; i < fonctions.length; i++) {
        if (id_fonction == 'tous') {
          listeId.push(i);
        } else {
          if (fonctions[i]['id'] == id_fonction) {
            listeId.push(i);
          }
        }
      }
      console.log(listeId);
    }
  </script>
</body>
</html>