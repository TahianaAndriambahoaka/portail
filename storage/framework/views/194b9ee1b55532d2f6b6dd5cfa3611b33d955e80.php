<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UCP : Unité Coordination Projets</title>
  <link rel="icon" type="image/png" href="<?php echo e(asset('images/ucp_logo.ico')); ?>"/>
  <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/animate.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/vendors/feather/feather.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/vendors/ti-icons/css/themify-icons.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/vendors/css/vendor.bundle.base.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/css/vertical-layout-light/style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/vendors/mdi/css/materialdesignicons.min.css')); ?>">
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
    <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid page-body-wrapper">
      <?php echo $__env->make('admin/nav-gauche', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h3>Liste des utilisateurs</h3><br>
                  <h5>Afficher par fonction :
                      <select class="input100" style="border-color: rgba(0, 0, 0, 0.178);" id="fonctionAff" onchange="changeFonctionAff()">
                        <option value="tous" selected>Tous</option>
                        <?php for($i = 0; $i < count($allFonctions); $i++): ?>
                          <?php if($allFonctions[$i]->id == $_GET['fonction']): ?>
                            <option value="<?php echo e($allFonctions[$i]->id); ?>" selected><?php echo e($allFonctions[$i]->nom); ?></option>
                          <?php else: ?>
                            <option value="<?php echo e($allFonctions[$i]->id); ?>"><?php echo e($allFonctions[$i]->nom); ?></option>
                          <?php endif; ?>
                        <?php endfor; ?>
                      </select>
                  </h5>
                  <button type="button" class="btn btn-inverse-success btn-fw" data-bs-toggle="modal" data-bs-target="#modalAjoutUtilisateur">Ajouter un nouvel utilisateur</button>
                  <br>
                  <?php if($message = Session::get('success')): ?>
                    <p class="text-center alert alert-success animate__animated animate__bounceInRight" style="margin-left: auto; margin-right: auto"><?php echo e($message); ?></p>
                  <?php endif; ?>
                  <?php if($message = Session::get('error')): ?>
                    <br>
                    <p class="text-center alert alert-danger animate__animated animate__bounceInRight" style="margin-left: auto; margin-right: auto"><?php echo e($message); ?></p>
                  <?php endif; ?>
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
                      <?php for($i = 0; $i < count($utilisateurs); $i++): ?>
                        <tr>
                          <td style="text-align: center"><image src="<?php echo e(asset('images/photo_de_profil/'.$utilisateurs[$i]->photo_de_profil)); ?>" alt="Photo_de_profil" style="height: 75px; width: 75px;"/></td>
                          <td><?php echo e($utilisateurs[$i]->nom); ?></td>
                          <td><?php echo e($utilisateurs[$i]->prenom); ?></td>
                          <td style="text-align: center"><?php echo e($fonctions[$i]->nom); ?></td>
                          <td>
                            <button type="button" class="btn btn-inverse-warning btn-fw" data-bs-toggle="modal" data-bs-target="#modal<?php echo e($utilisateurs[$i]->id); ?>">Plus</button>
                          </td>
                        </tr>
                      <?php endfor; ?>
                    </tbody>
                    </table>
                    <?php echo $utilisateurs->withQueryString()->links('pagination::bootstrap-5'); ?>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4"></div>
          </div>



          <?php for($i = 0; $i < count($utilisateurs); $i++): ?>
            <div class="modal fade" id="modal<?php echo e($utilisateurs[$i]->id); ?>" style="border-radius: 10%">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Plus d'informations sur l'utilisateur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                              <p>
                                  <image src="<?php echo e(asset('images/photo_de_profil/'.$utilisateurs[$i]->photo_de_profil)); ?>" alt="Photo_de_profil" style="height: 150px; width: 150px; float: right"/>
                              </p>
                              <p>
                                  <b>Nom : </b>
                                  <?php echo e($utilisateurs[$i]->nom); ?>

                              </p>
                              <p>
                                  <b>Prénom(s) : </b>
                                  <?php echo e($utilisateurs[$i]->prenom); ?>

                              </p>
                              <p>
                                  <b>Fonction : </b>
                                  
                                  <e class="badge badge-warning"><?php echo e($fonctions[$i]->nom); ?></e>
                              </p>
                              <p>
                                  <b>Région : </b>
                                  <?php echo e($regions[$i]->nom); ?>

                              </p>
                              <p>
                                  <b>District : </b>
                                  <?php echo e($districts[$i]->nom); ?>

                              </p>
                              <p>
                                  <b>Ministère : </b>
                                  <?php echo e($utilisateurs[$i]->ministere); ?>

                              </p>
                              <p>
                                  <b>Direction : </b>
                                  <?php echo e($utilisateurs[$i]->direction); ?>

                              </p>
                              <p>
                                  <b>Lieu de travail : </b>
                                  <?php echo e($utilisateurs[$i]->lieu_de_travail); ?>

                              </p>
                              <p>
                                  <b>Téléphone 1 : </b>
                                  <a href="tel:<?php echo e($utilisateurs[$i]->telephone1); ?>"><?php echo e($utilisateurs[$i]->telephone1); ?></a>
                              </p>
                              <p>
                                  <b>Téléphone 2 : </b>
                                  <a href="tel:<?php echo e($utilisateurs[$i]->telephone2); ?>"><?php echo e($utilisateurs[$i]->telephone2); ?></a>
                              </p>
                              <p>
                                  <b>Téléphone 3 : </b>
                                  <a href="tel:<?php echo e($utilisateurs[$i]->telephone3); ?>"><?php echo e($utilisateurs[$i]->telephone3); ?></a>
                              </p>
                              <p>
                                  <b>Adresse mail : </b>
                                  <a href="mailto:<?php echo e($utilisateurs[$i]->email); ?>"><?php echo e($utilisateurs[$i]->email); ?></a>
                              </p>
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-inverse-danger btn-fw" data-bs-toggle="modal" data-bs-target="#modalValiderSuppression<?php echo e($utilisateurs[$i]->id); ?>" data-bs-dismiss="modal">Supprimer</button>
                          <button type="submit" class="btn btn-inverse-warning btn-fw" data-bs-toggle="modal" data-bs-target="#modalModif<?php echo e($utilisateurs[$i]->id); ?>" data-bs-dismiss="modal">Modifier sa fonction</button>
                          <button type="submit" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
          <?php endfor; ?>
          <?php for($i = 0; $i < count($utilisateurs); $i++): ?>
            <div class="modal fade" id="modalModif<?php echo e($utilisateurs[$i]->id); ?>" style="border-radius: 10%">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Formulaire de modification de profil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                              <p>
                                  <image src="<?php echo e(asset('images/photo_de_profil/'.$utilisateurs[$i]->photo_de_profil)); ?>" alt="Photo_de_profil" style="height: 150px; width: 150px; float: right"/>
                              </p>
                              <p>
                                  <b>Nom : </b>
                                  <?php echo e($utilisateurs[$i]->nom); ?>

                              </p>
                              <p>
                                  <b>Prénom(s) : </b>
                                  <?php echo e($utilisateurs[$i]->prenom); ?>

                              </p>
                              <p>
                                  <b>Fonction : </b>
                                  <select class="input100" style="border-color: rgba(0, 0, 0, 0.178);" id="fonctionModif<?php echo e($utilisateurs[$i]->id); ?>">
                                    <?php for($j = 0; $j < count($allFonctions); $j++): ?>
                                      <?php if($fonctions[$i]->id ==  $allFonctions[$j]->id): ?>
                                        <option value="<?php echo e($allFonctions[$j]->id); ?>" selected><?php echo e($allFonctions[$j]->nom); ?></option>
                                      <?php else: ?>
                                        <option value="<?php echo e($allFonctions[$j]->id); ?>"><?php echo e($allFonctions[$j]->nom); ?></option>
                                      <?php endif; ?>
                                    <?php endfor; ?>
                                  </select>
                              </p>
                              <p>
                                  <b>Région : </b>
                                  <?php echo e($regions[$i]->nom); ?>

                              </p>
                              <p>
                                  <b>District : </b>
                                  <?php echo e($districts[$i]->nom); ?>

                              </p>
                              <p>
                                  <b>Ministère : </b>
                                  <?php echo e($utilisateurs[$i]->ministere); ?>

                              </p>
                              <p>
                                  <b>Direction : </b>
                                  <?php echo e($utilisateurs[$i]->direction); ?>

                              </p>
                              <p>
                                  <b>Lieu de travail : </b>
                                  <?php echo e($utilisateurs[$i]->lieu_de_travail); ?>

                              </p>
                              <p>
                                  <b>Téléphone 1 : </b>
                                  <a href="tel:<?php echo e($utilisateurs[$i]->telephone1); ?>"><?php echo e($utilisateurs[$i]->telephone1); ?></a>
                              </p>
                              <p>
                                  <b>Téléphone 2 : </b>
                                  <a href="tel:<?php echo e($utilisateurs[$i]->telephone2); ?>"><?php echo e($utilisateurs[$i]->telephone2); ?></a>
                              </p>
                              <p>
                                  <b>Téléphone 3 : </b>
                                  <a href="tel:<?php echo e($utilisateurs[$i]->telephone3); ?>"><?php echo e($utilisateurs[$i]->telephone3); ?></a>
                              </p>
                              <p>
                                  <b>Adresse mail : </b>
                                  <a href="mailto:<?php echo e($utilisateurs[$i]->email); ?>"><?php echo e($utilisateurs[$i]->email); ?></a>
                              </p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-inverse-warning btn-fw" data-bs-toggle="modal" data-bs-target="#modalValiderMofification<?php echo e($utilisateurs[$i]->id); ?>" data-bs-dismiss="modal">Modifier</button>
                            <button type="submit" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
          <?php endfor; ?>
          <?php for($i = 0; $i < count($utilisateurs); $i++): ?>
            <div class="modal fade" id="modalValiderMofification<?php echo e($utilisateurs[$i]->id); ?>" style="border-radius: 10%">
                <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Confirmation de modification de profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <h4>Voulez-vous vraiment modifier la fonction de l'utilisateur?</h4>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-inverse-warning btn-fw" onclick="modifierFonction(<?php echo e($utilisateurs[$i]->id); ?>)" data-bs-dismiss="modal">Oui</button>
                        <button type="submit" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal">Non</button>
                      </div>
                    </div>
                </div>
            </div>
          <?php endfor; ?>
          <?php for($i = 0; $i < count($utilisateurs); $i++): ?>
            <div class="modal fade" id="modalValiderSuppression<?php echo e($utilisateurs[$i]->id); ?>" style="border-radius: 10%">
                <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Confirmation de suppression d'utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <h6>Voulez-vous vraiment supprimer cet utilisateur?</h6>
                        <h6>Veuillez écrire le motif ci-dessous:</h6>
                        <p>
                          <textarea class="form-control" rows="4" id="motifTextarea<?php echo e($utilisateurs[$i]->id); ?>"></textarea>
                        </p>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-inverse-danger btn-fw" onclick="suppimerUtilisateur(<?php echo e($utilisateurs[$i]->id); ?>)" data-bs-dismiss="modal">Oui</button>
                        <button type="submit" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal">Non</button>
                      </div>
                    </div>
                </div>
            </div>
          <?php endfor; ?>
          <?php for($i = 0; $i < count($utilisateurs); $i++): ?>
            <form action="/administrateur/utilisateur/suppression" method="POST" id="formSuppression">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="id_utilisateur" value="<?php echo e($utilisateurs[$i]->id); ?>">
              <input type="hidden" name="motif" id="motifSuppression<?php echo e($utilisateurs[$i]->id); ?>">
              <input type="submit" value="Supprimer" id="suppression<?php echo e($utilisateurs[$i]->id); ?>" style="display: none">
            </form>
          <?php endfor; ?>
          <?php for($i = 0; $i < count($utilisateurs); $i++): ?>
            <form action="/administrateur/utilisateur/modification-fonction" method="POST" id="formModification">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="id_utilisateur" value="<?php echo e($utilisateurs[$i]->id); ?>">
              <input type="hidden" name="id_fonction" id="nouveauFonction<?php echo e($utilisateurs[$i]->id); ?>">
              <input type="submit" value="Modifier" id="modification<?php echo e($utilisateurs[$i]->id); ?>" style="display: none">
            </form>
          <?php endfor; ?>


          <div class="modal fade" id="modalAjoutUtilisateur" style="border-radius: 10%">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Formulaire d'insertion d'utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/administrateur/inscription-utilisateur" method="POST" id="formAjout">
                          <?php echo csrf_field(); ?>
                          <div class="form-group row">
                            <div class="col">
                              <label>Nom</label>
                              <div id="the-basics">
                                <input class="typeahead" type="text" name="nom" placeholder="Votre nom" required>
                              </div>
                            </div>
                            <div class="col">
                              <label>Prénom(s)</label>
                              <div id="bloodhound">
                                <input class="typeahead" type="text" name="prenom" placeholder="Votre prénom" required>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col">
                              <label>Fonction</label>
                              <div id="the-basics">
                                <select class="typeahead" name="id_fonction" required>
                                  <option value="">Fonction</option>
                                  <?php for($i = 0; $i < count($allFonctions); $i++): ?>
                                      <option value="<?php echo e($allFonctions[$i]->id); ?>"><?php echo e($allFonctions[$i]->nom); ?></option>
                                  <?php endfor; ?>
                                </select>
                              </div>
                            </div>
                            <div class="col">
                              <label>Région</label>
                              <div id="bloodhound">
                                <select class="typeahead" name="id_region" id="id_regionAjout" onchange="showDistricts()" required>
                                  <option value="">Région</option>
                                  <?php for($i = 0; $i < count($allRegions); $i++): ?>
                                      <option value="<?php echo e($allRegions[$i]->id); ?>"><?php echo e($allRegions[$i]->nom); ?></option>
                                  <?php endfor; ?>
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
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col">
                              <label>Direction</label>
                              <div id="the-basics">
                                <input class="typeahead" type="text" name="direction" placeholder="Direction" required>
                              </div>
                            </div>
                            <div class="col">
                              <label>Lieu de travail</label>
                              <div id="bloodhound">
                                <input class="typeahead" type="text" name="lieu_de_travail" placeholder="Lieu de travail" required>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col">
                              <label>Téléphone 1</label>
                              <div id="the-basics">
                                <input class="typeahead" type="tel" name="telephone1" id="phone1" onchange="process1()" required>
                              </div>
                            </div>
                            <div class="col">
                              <label>Téléphone 2</label>
                              <div id="bloodhound">
                                <input class="typeahead" type="tel" name="telephone2" id="phone2" onchange="process2()" required>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col">
                              <label>Téléphone 3</label>
                              <div id="the-basics">
                                <input class="typeahead" type="tel" name="telephone3" id="phone3" onchange="process3()" required>
                              </div>
                            </div>
                            <div class="col">
                              <label>Adresse mail</label>
                              <div id="bloodhound">
                                <input class="typeahead" type="email" name="email" placeholder="Adresse mail" required>
                              </div>
                            </div>
                          </div>
                          <input type="submit" value="Insérer" style="display: none" id="idFormAjout">
                        </form>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-inverse-success btn-fw" data-bs-dismiss="modal" onclick="ajoutUtilisateur()">Ajouter</button>
                      <button type="submit" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
          </div>



        </div>
      </div>
    </div>
  </div>


  <div id="loader" class="visible" style="position: fixed; top:40%; left:45%;">
    <img src = "<?php echo e(asset('images/loader.svg')); ?>" alt="Chargement..."/>
  </div>


  <script src="<?php echo e(asset('admin/vendors/js/vendor.bundle.base.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/js/off-canvas.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/js/hoverable-collapse.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/js/template.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/js/settings.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/js/todolist.js')); ?>"></script>
  <script src="<?php echo e(asset('js/bootstrap-animate-css.js')); ?>"></script>
  <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/jquery-3.3.1.min.js')); ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <script>
    function valider(id_demande) {
      $('#valider-'+id_demande).click();
    }
    function refuser(id_demande) {
      $('#refuser-'+id_demande).click();
    }

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

    function changeFonctionAff() {
      const id_fonction = document.getElementById('fonctionAff').value;
      window.location.href = '?fonction='+id_fonction;
    }

    function suppimerUtilisateur(id_utilisateur) {
      const motif = document.getElementById('motifTextarea'+id_utilisateur).value;
      document.getElementById('motifSuppression'+id_utilisateur).value = motif;
      $('#suppression'+id_utilisateur).click();
    }
    function modifierFonction(id_utilisateur) {
      const fonction = document.getElementById('fonctionModif'+id_utilisateur).value;
      document.getElementById('nouveauFonction'+id_utilisateur).value = fonction;
      $('#modification'+id_utilisateur).click();
    }
  </script>


	<script>
		function getIp(callback) {
			fetch('https://ipinfo.io/json?token=662221c0429e7f', { headers: { 'Accept': 'application/json' }})
			.then((resp) => resp.json())
			.catch(() => {
				return {
				country: 'us',
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

    function showDistricts() {
			const id_region = document.getElementById('id_regionAjout').value;
			const districts = <?php echo json_encode($allDistricts); ?>;
			var districts_aff = "<option value=''>District</option>";
			for (let i = 0; i < districts.length; i++) {
				if (districts[i]['id_region'] == id_region) {
					districts_aff += "<option value='"+districts[i]['id']+"'>"+districts[i]['nom']+"</option>";
				}
			}
			document.getElementById('id_districtAjout').innerHTML = districts_aff;
		}
    function ajoutUtilisateur() {
      $('#idFormAjout').click();
    }
	</script>
</body>
</html><?php /**PATH D:\stage\portail\resources\views/admin/liste_utilisateurs.blade.php ENDPATH**/ ?>