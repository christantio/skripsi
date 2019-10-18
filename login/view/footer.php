    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright &copy; <?php echo date("Y") ?>. All rights reserved.</span>
      </div>
    </footer>
   <!-- partial -->
      </div>
      </div>
	 </div>
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