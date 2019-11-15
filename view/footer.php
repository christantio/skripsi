  <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <!--<h3>Berlangganan Berita</h3>
            <p>Silahkan berlangganan untuk mendapatkan informasi terbaru!</p>
            <form action="" class="aa-subscribe-form">
              <input type="email" name="" id="" placeholder="Enter your Email">
              <input type="submit" value="Subscribe" style='background-color:#000;'>
            </form>-->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Subscribe section -->
	<!-- footer -->  
  <footer id="aa-footer">
    <!-- footer bottom -->
    <div class="aa-footer-top">
     <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-top-area">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <img src="<?php echo $basepath ?>assets/img/man/ojk.png" width=230px height=150px></img>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                   <img src="<?php echo $basepath ?>assets/img/man/wi.png" width=230px height=180px></img>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Links</h3>
                    <ul class="aa-footer-nav">
					<li>
                      <li><a href="#">Paket Tour Promo</a></li>
                      <li><a href="#">Paket Tour Low Season</a></li>
                      <li><a href="#">Paket Natal dan Tahun Baru</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Hubungi Kami</h3>
                    <address>
                      <p> My Plan Corp, INDONESIA</p>
                      <p><span class="fa fa-phone"></span>+089999999999999999</p>
                      <p><span class="fa fa-envelope"></span>my_plan@gmail.com</p>
                    </address>
                    <div class="aa-footer-social">
                      <a href="#"><span class="fa fa-facebook"></span></a>
                      <a href="#"><span class="fa fa-twitter"></span></a>
                      <a href="#"><span class="fa fa-google-plus"></span></a>
                      <a href="#"><span class="fa fa-youtube"></span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </div>
    <!-- footer-bottom -->
    <div class="aa-footer-bottom">
      <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-bottom-area">
          </div>
        </div>
      </div>
      </div>
    </div>
  </footer>
  <!-- / footer -->
   <!-- Login Modal -->  
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Masuk</h4>
          <form class="aa-login-form" autocomplete="off" action="#" method="POST" id="f1">
            <label for="">Email<span>*</span></label>
            <input type="text" name=email placeholder="Email">
            <label for="">Password<span>*</span></label>
            <input type="password" password=password placeholder="Password">
            <button class="aa-browse-btn" type="submit">Masuk</button>
            <p class="aa-lost-password"><a href="#">Lupa Password</a></p>
            <div class="aa-register-now">
              Sudah Punya Akun?<a href="account">Daftar Sekarang!</a>
            </div>
          </form>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  
  <script type="text/javascript">
     $("#f1").on("submit", function (event) {
        event.preventDefault();
        do_proses('f1','member','index');
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
          console.log(data_trim);
		  if(data_trim=="OK"){
            swal({
              title: 'Success',
              type: 'success',
              showCancelButton: false,
              showLoaderOnConfirm: false,
              }).then(function() {
                 if(after_controller!=''){
                  window.location = '<?php echo $basepath ?>'+after_controller;
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
	<!-- jQuery library -->
  <script src="<?php echo $basepath ?>assets/js/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="<?php echo $basepath ?>assets/js/bootstrap.js"></script>  
  <!-- SmartMenus jQuery plugin -->
  <script type="text/javascript" src="<?php echo $basepath ?>assets/js/jquery.smartmenus.js"></script>
  <!-- SmartMenus jQuery Bootstrap Addon -->
  <script type="text/javascript" src="<?php echo $basepath ?>assets/js/jquery.smartmenus.bootstrap.js"></script>  
  <!-- To Slider JS -->
  <script src="<?php echo $basepath ?>assets/js/sequence.js"></script>
  <script src="<?php echo $basepath ?>assets/js/sequence-theme.modern-slide-in.js"></script>  
  <!-- Product view slider -->
  <script type="text/javascript" src="<?php echo $basepath ?>assets/js/jquery.simpleGallery.js"></script>
  <script type="text/javascript" src="<?php echo $basepath ?>assets/js/jquery.simpleLens.js"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="<?php echo $basepath ?>assets/js/slick.js"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="<?php echo $basepath ?>assets/js/nouislider.js"></script>
  <!-- Custom js -->
  <script src="<?php echo $basepath ?>assets/js/custom.js"></script>
  </body>
</html>