<title>Data User - <?php echo $web['judul_web']?></title>
<div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Data User
            </h3>
			<div class="col-sm-8 col-xs-9 text-right m-b-20">
                  <a href="customer/cetak/" class="btn btn-gradient-success btn-fw"><i class="mdi mdi-printer"></i> Cetak Customer</a>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-4 col-xs-3">
                </div>
              </div><br/>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th><b>Username</b></th>
                            <th><b>Email</b></th>
                            <th><b>Nama Lengkap</b></th>
                            <th><b>Tanggal Lahir</b></th>
                            <th><b>Alamat</b></th>
                            <th><b>Tanggal dibuat</b></th>
                            <th><b>Gambar</b></th>
                            <th><b>Aksi</b></th>
                        </tr>
                      </thead>
                      <tbody> </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="width: 650px;">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah Customer</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" id="form_edit" method="POST" autocomplete="off">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Username <span class="text-danger">*</span></label>
                          <input class="form-control" id="username_edit" name="username" value="" placeholder="Username" type="text" required>
                          <input id="id_parameter" name="id_parameter" type="hidden" required>
                        </div>
                      </div>
					  <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Email <span class="text-danger">*</span></label>
                          <input class="form-control" id="email_edit" name="email" value="" placeholder="Email" type="text" required>
                        </div>
                      </div>
					  <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Nama Lengkap <span class="text-danger">*</span></label>
                          <input class="form-control" id="nama_lengkap_edit" name="nama_lengkap" value="" placeholder="Nama lengkap" type="text" required>
                        </div>
                      </div>
					  <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Tanggal Lahir <span class="text-danger">*</span></label>
                          <input type="date" style="background-color:white;color:black;margin-right: -4%;height:38px;"  data-date="" data-date-format="DD MMMM YYYY" class="form-control" name="tgl_lahir" id="tgl_lahir_edit" value=''  required>
						  </div>
                      </div>
					  <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Alamat <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="alamat_edit" name="alamat" rows="3" required></textarea>
						 </div>
                      </div>
					  <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Upload File </label><br/>
                          <input type="file" class="form-control-file" id="gambar" name="gambar"><br/><br/>
                          <center><img style="width:600px" src="#" id="gambar_edit"></center>
                        </div>
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
  <script type="text/javascript">


  $("#form_edit").on("submit", function (event) {
    event.preventDefault();
      do_act('form_edit','customer/do_update','','Ubah Customer','Anda ingin mengubah Customer ?','warning');
  });

 

  function do_edit(id){
    $.ajax({
          url: '<?php echo $basepath_admin ?>customer/edit/'+id,
          type: 'POST',
          dataType: 'JSON',
          success: function(data) {
            console.log(data);
              $("#id_parameter").val(data.id_user);
              $("#username_edit").val(data.username);
              $("#email_edit").val(data.email);
              $("#nama_lengkap_edit").val(data.nama_lengkap);
              $("#tgl_lahir_edit").val(data.tgl_lahir);
              $("#alamat_edit").val(data.alamat);
			  $("#gambar_edit").attr("src",data.gambar);
          }
      });
  }

  
   function do_delete(id){
          swal({
            title: 'Hapus Customer',
            text: 'Anda ingin menghapus Customer ?',
            type: 'error',      // warning,info,success,error
            showCancelButton: true,
            showLoaderOnConfirm: true,
            preConfirm: function(){
              $.ajax({
                  url: '<?php echo $basepath_admin ?>customer/do_delete',
                  type: 'POST',
                  data: 'id_parameter='+id,
                  success: function(data) {
                    if(data=="OK"){
                      swal({
                        title: 'Success',
                        type: 'success',
                        showCancelButton: false,
                        showLoaderOnConfirm: false,
                      }).then(function() {
                        location.reload();      
                      });
                    }
                    else if(data=="NOT_LOGIN"){
                      swal({
                        title: 'Error',
                        text: "You Must Login Again",
                        type: 'error',
                        showCancelButton: false,
                        showLoaderOnConfirm: false,
                      },function(){
                            location.reload();
                      });
                    }
                    else{
                      swal({
                          title: 'Error',
                          html: data,
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

 $(document).ready(function() {
      $('#order-listing').DataTable({
          "bProcessing": true,
          "bServerSide": true,
          "bJQueryUI": false,
          "responsive": false,
          "autoWidth": false,
          "sAjaxSource": "<?php echo $basepath_admin ?>customer/list_rest", 
          "sServerMethod": "POST",
          "scrollX": true,
          // "scrollY": "350px",
          "scrollCollapse": true,
          "order": [[ 2, "desc" ]],
          "columnDefs": [
          { "orderable": true, "targets": 0, "searchable": true},
          { "orderable": true, "targets": 1, "searchable": true,"width":120 },
          { "orderable": true, "targets": 2, "searchable": true,"width":120},
          { "orderable": false, "targets": 3, "searchable": false, "width":100},
          { "orderable": true, "targets": 4, "searchable": true,"width":120},
          { "orderable": false, "targets": 5, "searchable": false, "width":100},
		  { "orderable": true, "targets": 6, "searchable": true,"width":120},
          { "orderable": false, "targets": 7, "searchable": false, "width":100}
          ]
      });
});
</script>