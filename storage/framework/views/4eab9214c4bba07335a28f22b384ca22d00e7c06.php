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
                  <h3>Liste des demandes d'inscription</h3>
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
                          <th>Date de la demande</th>
                          <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php for($i = 0; $i < count($demandes_inscription); $i++): ?>
                        <tr class='clickable-row' data-href="/administrateur/liste-demandes-inscription-<?php echo e($demandes_inscription[$i]->id); ?>">
                          <td style="text-align: center">
                            <image src="<?php echo e(asset('images/photo_de_profil/'.$demandes_inscription[$i]->photo_de_profil)); ?>" alt="Photo_de_profil" style="height: 75px; width: 75px"/>
                          </td>
                          <td><?php echo e($demandes_inscription[$i]->nom); ?></td>
                          <td><?php echo e($demandes_inscription[$i]->prenom); ?></td>
                          <td style="text-align: center"><?php echo e($fonctions[$i]->nom); ?></td>
                          <td><?php echo e(utf8_encode(strftime("%A %d %B %G", strtotime($demandes_inscription[$i]->date)))); ?></td>
                          <td style="text-align: center">
                            <button class="btn btn-inverse-info btn-fw" onclick="valider(<?php echo e($demandes_inscription[$i]->id); ?>)">Valider</button>
                            <button class="btn btn-inverse-danger btn-fw" onclick="refuser(<?php echo e($demandes_inscription[$i]->id); ?>)">Refuser</button>
                            <button data-bs-toggle="modal" data-bs-target="#modal<?php echo e($demandes_inscription[$i]->id); ?>" class="btn btn-inverse-warning btn-fw">Détails</button>
                          </td>
                        </tr>
                      <?php endfor; ?>
                    </tbody>
                    </table>
                    <?php echo $demandes_inscription->withQueryString()->links('pagination::bootstrap-5'); ?>

                  </div>
                </div>
              </div>
            </div>
          </div>


          <?php for($i = 0; $i < count($demandes_inscription); $i++): ?>
            <div class="modal fade" id="modal<?php echo e($demandes_inscription[$i]->id); ?>" style="border-radius: 10%">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Plus d'informations sur la demande d'inscription</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                              <p>
                                  <image src="<?php echo e(asset('images/photo_de_profil/'.$demandes_inscription[$i]->photo_de_profil)); ?>" alt="Photo_de_profil" style="height: 150px; width: 150px; float: right"/>
                              </p>
                              <p>
                                  <b>Nom : </b>
                                  <?php echo e($demandes_inscription[$i]->nom); ?>

                              </p>
                              <p>
                                  <b>Prénom(s) : </b>
                                  <?php echo e($demandes_inscription[$i]->prenom); ?>

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
                                  <?php echo e($demandes_inscription[$i]->ministere); ?>

                              </p>
                              <p>
                                  <b>Direction : </b>
                                  <?php echo e($demandes_inscription[$i]->direction); ?>

                              </p>
                              <p>
                                  <b>Lieu de travail : </b>
                                  <?php echo e($demandes_inscription[$i]->lieu_de_travail); ?>

                              </p>
                              <p>
                                  <b>Téléphone 1 : </b>
                                  <a href="tel:<?php echo e($demandes_inscription[$i]->telephone1); ?>"><?php echo e($demandes_inscription[$i]->telephone1); ?></a>
                              </p>
                              <p>
                                  <b>Téléphone 2 : </b>
                                  <a href="tel:<?php echo e($demandes_inscription[$i]->telephone2); ?>"><?php echo e($demandes_inscription[$i]->telephone2); ?></a>
                              </p>
                              <p>
                                  <b>Téléphone 3 : </b>
                                  <a href="tel:<?php echo e($demandes_inscription[$i]->telephone3); ?>"><?php echo e($demandes_inscription[$i]->telephone3); ?></a>
                              </p>
                              <p>
                                  <b>Adresse mail : </b>
                                  <a href="mailto:<?php echo e($demandes_inscription[$i]->email); ?>"><?php echo e($demandes_inscription[$i]->email); ?></a>
                              </p>
                              <p>
                                  <b>Date de la demande : </b>
                                  <?php echo e(utf8_encode(strftime("%A %d %B %G", strtotime($demandes_inscription[$i]->date)))); ?>

                              </p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-inverse-info btn-fw" onclick="valider(<?php echo e($demandes_inscription[$i]->id); ?>)">Valider</button>
                            <button type="submit" class="btn btn-inverse-danger btn-fw" onclick="refuser(<?php echo e($demandes_inscription[$i]->id); ?>)">Refuser</button>
                        </div>
                    </div>
                </div>
            </div>
          <?php endfor; ?>


          <?php for($i = 0; $i < count($demandes_inscription); $i++): ?>
            <div style="display: none">
              <form action="/administrateur/demande-inscription" method="post" id="form">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id_demande_inscription" value="<?php echo e($demandes_inscription[$i]->id); ?>">
                <input type="submit" value="<?php echo e($demandes_inscription[$i]->id); ?>" name="valider" id="valider-<?php echo e($demandes_inscription[$i]->id); ?>">
                <input type="submit" value="<?php echo e($demandes_inscription[$i]->id); ?>" name="refuser" id="refuser-<?php echo e($demandes_inscription[$i]->id); ?>">
              </form>
            </div>
          <?php endfor; ?>



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
</html><?php /**PATH D:\stage\portail\resources\views/admin/demandes_inscription.blade.php ENDPATH**/ ?>