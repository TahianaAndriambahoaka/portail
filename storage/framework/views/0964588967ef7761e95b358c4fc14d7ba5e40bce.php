<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UCP : Unité Coordination Projets</title>
  <link rel="icon" type="image/png" href="<?php echo e(asset('images/ucp_logo.ico')); ?>"/>
  <link rel="stylesheet" href="<?php echo e(asset('admin/vendors/feather/feather.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/vendors/ti-icons/css/themify-icons.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/vendors/css/vendor.bundle.base.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/css/vertical-layout-light/style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/vendors/mdi/css/materialdesignicons.min.css')); ?>">
</head>

<body>
  <div class="container-scroller">
    <!-- partial:admin/template/partials/_navbar.html -->
    <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:admin/template/partials/_settings-panel.html -->
      <!-- partial -->
      <!-- partial:admin/template/partials/_sidebar.html -->
      <?php echo $__env->make('admin/nav-gauche', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h3>Liste des véhicules</h3>
                  <a href="/administration/vehicules"><button type="submit" class="btn btn-primary mr-2">Tous</button></a>
                  <a href="/administration/vehicules/disponibles"><button type="submit" class="btn btn-success mr-2">Disponibles</button></a>
                  <br><br>
                  <div class="table-responsive">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                        <th>Numero</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Type</th>
                        <th>Trajets</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                    </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?php echo e(asset('admin/vendors/js/vendor.bundle.base.js')); ?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?php echo e(asset('admin/js/off-canvas.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/js/hoverable-collapse.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/js/template.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/js/settings.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/js/todolist.js')); ?>"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
<?php /**PATH D:\stage\portail\resources\views/admin/demande_inscriptions.blade.php ENDPATH**/ ?>