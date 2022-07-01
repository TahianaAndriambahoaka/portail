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
      pointer-events: none;
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
                  <h3>Demandes de réinitialisation de mot de passe (mot de passe oublié)</h3>
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
                          <th>Nom</th>
                          <th>Prénom(s)</th>
                          <th>Adresse éléctronique</th>
                          <th>Date de la demande</th>
                          <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      @for ($i = 0; $i < count($mot_de_passe_oublie); $i++)
                        <tr>
                          <td>{{ $mot_de_passe_oublie[$i]->nom }}</td>
                          <td>{{ $mot_de_passe_oublie[$i]->prenom }}</td>
                          <td>{{ $mot_de_passe_oublie[$i]->email }}</td>
                          <td>{{ utf8_encode(strftime("%A %d %B %G", strtotime($mot_de_passe_oublie[$i]->date))) }}</td>
                          <td style="text-align: center">
                            <button class="btn btn-inverse-info btn-fw" onclick="valider({{ $mot_de_passe_oublie[$i]->id }})">Réinitialiser le mot de passe</button>
                            <button class="btn btn-inverse-danger btn-fw" onclick="refuser({{ $mot_de_passe_oublie[$i]->id }})">Refuser</button>
                            <button data-bs-toggle="modal" data-bs-target="#modal{{ $mot_de_passe_oublie[$i]->id }}" class="btn btn-inverse-warning btn-fw">Détails</button>
                          </td>
                        </tr>
                      @endfor
                    </tbody>
                    </table>
                    <br>
                    {!! $mot_de_passe_oublie->withQueryString()->links('pagination::bootstrap-4') !!}
                  </div>
                </div>
              </div>
            </div>
          </div>


          @for ($i = 0; $i < count($mot_de_passe_oublie); $i++)
            <div class="modal fade" id="modal{{ $mot_de_passe_oublie[$i]->id }}" style="border-radius: 10%">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Informations concernant cet utilisateur qui correspondent  dans la base de données</h5>
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
                              <p>
                                  <b>Date de la demande : </b>
                                  {{ utf8_encode(strftime("%A %d %B %G", strtotime($mot_de_passe_oublie[$i]->date))) }}
                              </p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-inverse-info btn-fw" onclick="valider({{ $mot_de_passe_oublie[$i]->id }})">Valider</button>
                            <button type="submit" class="btn btn-inverse-danger btn-fw" onclick="refuser({{ $mot_de_passe_oublie[$i]->id }})">Refuser</button>
                        </div>
                    </div>
                </div>
            </div>
          @endfor


          {{-- @for ($i = 0; $i < count($demandes_inscription); $i++)
            <div style="display: none">
              <form action="{{asset('/administrateur/demande-inscription')}}" method="post" id="form">
                @csrf
                <input type="hidden" name="id_demande_inscription" value="{{ $demandes_inscription[$i]->id }}">
                <input type="submit" value="{{ $demandes_inscription[$i]->id }}" name="valider" id="valider-{{ $demandes_inscription[$i]->id }}">
                <input type="submit" value="{{ $demandes_inscription[$i]->id }}" name="refuser" id="refuser-{{ $demandes_inscription[$i]->id }}">
              </form>
            </div>
          @endfor --}}



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
  </script>
</body>
</html>