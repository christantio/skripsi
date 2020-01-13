<title>Bank - <?php echo $web['judul_web']?></title>
<div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Data Bank
            </h3>
			<div class="col-sm-8 col-xs-9 text-right m-b-20">
                  <a href="bank/cetak/" class="btn btn-gradient-success btn-fw"><i class="mdi mdi-printer"></i> Cetak Bank</a>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-4 col-xs-3">
                </div>
                <div class="col-sm-8 col-xs-9 text-right m-b-20">
                  <a href="#" class="btn btn-gradient-success btn-fw" data-toggle="modal" data-target="#add_modal"><i class="mdi mdi-plus"></i> Tambah Bank</a>
                </div>
              </div><br/>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th><b>Nama Bank</b></th>
                            <th><b>No Rekening</b></th>
                            <th><b>Keterangan</b></th>
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

        <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="width: 650px;">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Bank</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" id="form_add" method="POST" autocomplete="off">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
							<label for="exampleInputName1">Bank <span class="text-danger">*</span></label>
							<input class="form-control" id="nama" name="nama" placeholder="Bank" type="text" required>
						</div>
					  </div>
					  <div class="col-md-12">
                        <div class="form-group">
							<label for="exampleInputName1">No Rekening <span class="text-danger">*</span></label>
							<input class="form-control" id="no_rek" name="no_rek" maxlength=15 placeholder="no rekening" type="text" required>
							
						</div>
					  </div>
					  <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Keterangan <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                        </div>
                      </div>	  
					  <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Upload File </label><br/>
                          <input type="file" class="form-control-file" id="gambar" name="gambar"><br/><br/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                  </div>
                  </form>
                </div>
             </div>
          </div>

        <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="width: 650px;">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah Bank</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" id="form_edit" method="POST" autocomplete="off">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
							<label for="exampleInputName1">Bank <span class="text-danger">*</span></label>
							<input class="form-control" id="nama" name="nama" placeholder="Bank" type="text" required>
						</div>
					  </div>
                      <div class="col-md-12">
                        <div class="form-group">
							<label for="exampleInputName1">No Rekening <span class="text-danger">*</span></label>
							<input class="form-control" id="no_rek" name="no_rek" maxlength=15 placeholder="no rekening" type="text" required>
							
						</div>
					  </div>
					 <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Keterangan <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
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

   $("#form_add").on("submit", function (event) {
          event.preventDefault();
            do_act('form_add','bank/do_add','','Tambah Bank','Anda ingin tambah Bank ?','info');
          });

  $("#form_edit").on("submit", function (event) {
    event.preventDefault();
      do_act('form_edit','bank/do_update','','Ubah Bank','Anda ingin mengubah Bank ?','warning');
  });

 

  function do_edit(id){
    $.ajax({
          url: '<?php echo $basepath_admin ?>bank/edit/'+id,
          type: 'POST',
          dataType: 'JSON',
          success: function(data) {
            console.log(data);
			  $("#id_parameter").val(data.id_bank);
              $("#nama").val(data.nama);
              $("#no_rek").val(data.no_rek);
              $("#keterangan1").val(data.keterangan);
			  $("#gambar_edit").attr("src",data.gambar);
          }
      });
  }

  
   function do_delete(id){
          swal({
            title: 'Hapus Bank',
            text: 'Anda ingin menghapus Bank ?',
            type: 'error',      // warning,info,success,error
            showCancelButton: true,
            showLoaderOnConfirm: true,
            preConfirm: function(){
              $.ajax({
                  url: '<?php echo $basepath_admin ?>bank/do_delete',
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
          "sAjaxSource": "<?php echo $basepath_admin ?>bank/list_rest", 
          "sServerMethod": "POST",
          "scrollX": true,
          // "scrollY": "350px",
          "scrollCollapse": true,
          "order": [[ 2, "desc" ]],
          "columnDefs": [
          { "orderable": true, "targets": 0, "searchable": true},
          { "orderable": true, "targets": 1, "searchable": true,"width":120 },
          { "orderable": true, "targets": 2, "searchable": true,"width":120},
          { "orderable": false, "targets": 3, "searchable": false, "width":100}
          ]
      });
});

function hide(value) {
  if (value == "1"){
	  document.getElementById('stock1').style.display = 'none';
	  document.getElementById('tahun1').style.display = 'block';	
  }else{
	  document.getElementById('stock1').style.display = 'block';
  }
}
</script>