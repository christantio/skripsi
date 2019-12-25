 <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo $basepath_member ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo $basepath_member ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo $basepath_member ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo $basepath_member ?>assets/js/sb-admin-2.min.js"></script>

 <!-- Page level plugins -->
  <script src="<?php echo $basepath_member ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo $basepath_member ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="assets/js/demo/datatables-demo.js"></script>

</body>

</html>
<script src="<?php echo $basepath_admin ?>assets/js/off-canvas.js"></script>
<script src="<?php echo $basepath_admin ?>assets/js/hoverable-collapse.js"></script>
<script src="<?php echo $basepath_admin ?>assets/js/misc.js"></script>
<script src="<?php echo $basepath_admin ?>assets/js/settings.js"></script>
<script src="<?php echo $basepath_admin ?>assets/js/todolist.js"></script>
<script type="text/javascript" src="<?php echo $basepath ?>assets/js/sweetalert2/dist/sweetalert2.min.js"></script>
<script type="text/javascript">
  function do_act(form_id,act_controller,after_controller,header_text,content_text,type_icon,fct_after){
                        swal({
                          title: header_text,
                          text: content_text,
                          type: type_icon,      // warning,info,success,error
                          showCancelButton: true,
                          showLoaderOnConfirm: true,
                          preConfirm: function(){
                            $.ajax({
                                url: act_controller, 
                                type: 'POST',
                                data: new FormData($('#'+form_id)[0]),  // Form ID
                                processData: false,
                                contentType: false,
                                success: function(data) {
                                    var data_trim = $.trim(data);
                                    if(data_trim=="OK")
                                    {
                                        swal({
                                            title: 'Success',
                                            type: 'success',
                                            showCancelButton: false,
                                            showLoaderOnConfirm: false,
                                          }).then(function() {
                                              if(after_controller=='no_refresh'){
                                                  if(fct_after){
                                                      window[fct_after](); 
                                                  }
                                              }
                                              else if(after_controller!=''){
                                                 window.location = '<?php echo $basepath_admin ?>'+after_controller;
                                              }
                                              else {
                                                location.reload();
                                              } 
                                      });
                                    } 
                                    else if(data_trim=="NOT_LOGIN")
                                    {
                                          swal({
                                            title: 'Error',
                                            text: "You Must Login Again",
                                            type: 'error',
                                            showCancelButton: false,
                                            showLoaderOnConfirm: false,
                                          },function(){
                                                window.location = '<?php echo $basepath ?>';
                                          });
                                    }
                                    else
                                    {
                                        swal({
                                            title: 'Error',
                                            html: data_trim,
                                            type: 'error',
                                            showCancelButton: false,
                                            showLoaderOnConfirm: false,
                                          });
                                    }
                                }
                            });
                         }
            });   
}
</script>