<script src="<?php echo $basepath ?>assets/js/ckeditor/ckeditor.js"></script>
<title>Website - <?php echo $web['judul_web']?></title>
<div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Manage Website
            </h3>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                   <form class="forms-sample" id="form_edit" method="POST" autocomplete="off" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Judul Web <span class="text-danger">*</span></label>
                          <input class="form-control" id="judul_web" name="judul_web" placeholder="Judul Web" type="text" required>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Email <span class="text-danger">*</span></label>
                          <input class="form-control" id="email" name="email" placeholder="Email" type="text" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputName1">No Telepon <span class="text-danger">*</span></label>
                          <input class="form-control" id="no_tlp" name="no_tlp" placeholder="No Telepon" type="text" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputName1">No Handphone <span class="text-danger">*</span></label>
                          <input class="form-control" id="no_hp" name="no_hp" placeholder="No Telepon" type="text" required>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Alamat <span class="text-danger">*</span></label>
                          <input class="form-control" id="alamat" name="alamat" placeholder="Alamat" type="text" required>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Tentang Kami <span class="text-danger">*</span></label>
                          <textarea class="form-control ckeditor" id="tentang_kami" name="tentang_kami"></textarea>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Cara Pemesanan <span class="text-danger">*</span></label>
                          <textarea class="form-control ckeditor" id="cara_pesan" name="cara_pesan"></textarea>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Logo </label><br/>
                          <input name="logo"  type="file" ><br/><br/>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Favicon </label><br/>
                          <input name="favicon"  type="file" ><br/><br/>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Ubah</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

  <script type="text/javascript">



  $("#form_edit").on("submit", function (event) {
    event.preventDefault();
      do_act('form_edit','website/do_update','','Ubah Website','Anda ingin mengubah website ?','warning');
  });


    $.ajax({
          url: '<?php echo $basepath_admin ?>website/edit/',
          type: 'POST',
          dataType: 'JSON',
          success: function(data) {
            console.log(data);
              $("#judul_web").val(data.judul_web);
              $("#alamat").val(data.alamat);
              $("#no_tlp").val(data.no_tlp);
              $("#no_hp").val(data.no_hp);
              $("#email").val(data.email);
              $("#tentang_kami").val(data.tentang);
              $("#cara_pesan").val(data.cara_pesan);
              $("#logo").attr("src",data.logo);
              $("#favicon").attr("src",data.favicon);
          }
      });
 

  
</script>