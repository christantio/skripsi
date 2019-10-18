<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sign In | <?php echo $web['judul_web'] ?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo $basepath_admin ?>assets/plugin/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo $basepath_admin ?>assets/plugin/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo $basepath_admin ?>assets/plugin/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo $basepath_admin ?>assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo $basepath ?>assets/images/<?php echo $web['favicon']?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $basepath ?>assets/js/sweetalert2/dist/sweetalert2.min.css">
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="<?php echo $basepath ?>assets/images/<?php echo $web['logo']?>" alt="logo">
              </div>
              <form class="pt-3" autocomplete="off" action="#" method="POST" id="f1">
                <div class="form-group">
                  <label for="exampleInputEmail">Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="text" name="username" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="Username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="password" name="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Password">                        
                  </div>
                </div>
                <div class="my-3">
                  <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit">LOGIN</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; <?php echo date("Y") ?>  All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?php echo $basepath_admin ?>assets/plugin/js/vendor.bundle.base.js"></script>
  <script src="<?php echo $basepath_admin ?>assets/plugin/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?php echo $basepath_admin ?>assets/js/off-canvas.js"></script>
  <script src="<?php echo $basepath_admin ?>assets/js/hoverable-collapse.js"></script>
  <script src="<?php echo $basepath_admin ?>assets/js/misc.js"></script>
  <script src="<?php echo $basepath_admin ?>assets/js/settings.js"></script>
  <script src="<?php echo $basepath_admin ?>assets/js/todolist.js"></script>
  <!-- endinject -->

  <script type="text/javascript" src="<?php echo $basepath ?>assets/js/sweetalert2/dist/sweetalert2.min.js"></script>
        <script type="text/javascript">
          $("#f1").on("submit", function (event) {
        event.preventDefault();
        do_proses('f1','auth','home');
      });
    function do_proses(form_id,act_controller,after_controller){
      $.ajax({
        url: act_controller, 
        type: 'POST',
        data: new FormData($('#'+form_id)[0]),  // Form ID
        processData: false,
        contentType: false,
        success: function(data) {
          var data_trim = $.trim(data);
          if(data_trim=="OK"){
            swal({
              title: 'Success',
              type: 'success',
              showCancelButton: false,
              showLoaderOnConfirm: false,
              }).then(function() {
                 if(after_controller!=''){
                  window.location = '<?php echo $basepath_admin ?>'+after_controller;
                 }
                else {
                  location.reload();
                } 
             });
          } 
          else {
              swal({
              title: 'Error',
              text: "Username / Password Salah",
              type: 'error',
              showCancelButton: false,
              showLoaderOnConfirm: false,
              });
          }
        }
      });
    }
        </script>
</body>


</html>
