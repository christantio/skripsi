<title>List Pemesanan - <?php echo $web['judul_web']?></title>
<div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Data List Pemesanan
            </h3>
			<div class="col-sm-8 col-xs-9 text-right m-b-20">
                  <a href="pemesanan/cetak/" class="btn btn-gradient-success btn-fw"><i class="mdi mdi-printer"></i> Cetak Pemesanan</a>
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
                            <th><b>No. Pesanan</b></th>
                            <th><b>Nama</b></th>
                            <th><b>Email</b></th>
                            <th><b>Unit</b></th>
                            <th><b>Biaya</b></th>
                            <th><b>Tanggal dibuat</b></th>
                            <th><b>Status</b></th>
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
                  <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" id="form_edit" method="POST" autocomplete="off">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
							<label for="exampleInputName1">No Pesanan <span class="text-danger">*</span></label>
							<input class="form-control" id="no_pesanan" name="no_pesanan" placeholder="No Pesanan" type="text" required readOnly>
							 <input id="id_parameter" name="id_parameter" type="hidden" required>
						</div>
					  </div>
                      <div class="col-md-12">
                        <div class="form-group">
							<label for="exampleInputName1">Nama <span class="text-danger">*</span></label>
							<input class="form-control" id="nama" name="nama" maxlength=15 placeholder="Nama" type="text" required disabled style='background-color:#ddd'>
						</div>
					  </div>
					  <div class="col-md-12">
                        <div class="form-group">
							<label for="exampleInputName1">Email<span class="text-danger">*</span></label>
							<input class="form-control" id="email" name="email" maxlength=15 placeholder="email" type="text" required disabled style='background-color:#ddd'>
						</div>
					  </div>
					 <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Unit <span class="text-danger">*</span></label>
						  <input class="form-control" id="unit" name="unit" maxlength=15 placeholder="Unit" type="text" required disabled style='background-color:#ddd'>
                        </div>
                      </div>	
					 <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Jumlah bayar <span class="text-danger">*</span></label>
						  <input class="form-control" id="jumlah_bayar" name="jumlah_bayar" maxlength=15 placeholder="jumlah bayar" type="text" required disabled style='background-color:#ddd'>
                        </div>
                      </div>	  
					  <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Status <span class="text-danger">*</span></label>
                          <select style="color:black" class="form-control" id="status1" name="status1" required>
                              <option value="">Pilih Status</option>
                              <option value="1">Pending</option>
                              <option value="2">Sukses</option>
                              <option value="3">Tolak</option>
                          </select>
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
	  do_act('form_edit','pemesanan/do_update','','Ubah Pemesanan','Anda ingin mengubah Pemesanan ?','warning');
  });

 
  function do_edit(id){
    $.ajax({
          url: '<?php echo $basepath_admin ?>pemesanan/edit/'+id,
          type: 'POST',
          dataType: 'JSON',
          success: function(data) {
            $("#id_parameter").val(data.id_pesanan);
              $("#no_pesanan").val(data.no_pesanan);
              $("#nama").val(data.nama);
              $("#email").val(data.email);
              $("#unit").val(data.kuantitas);
              $("#jumlah_bayar").val(data.total_biaya);
              $("#status1").val(data.status);
          }
      });
  }

  
   function do_delete(id){
          swal({
            title: 'Hapus Pemesanan',
            text: 'Anda ingin menghapus Pemesanan ?',
            type: 'error',      // warning,info,success,error
            showCancelButton: true,
            showLoaderOnConfirm: true,
            preConfirm: function(){
              $.ajax({
                  url: '<?php echo $basepath_admin ?>pemesanan/do_delete',
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
          "sAjaxSource": "<?php echo $basepath_admin ?>pemesanan/list_rest", 
          "sServerMethod": "POST",
          "scrollX": true,
          // "scrollY": "350px",
          "scrollCollapse": true,
          "order": [[ 6, "desc" ]],
          "columnDefs": [
          { "orderable": true, "targets": 0, "searchable": true},
          { "orderable": true, "targets": 1, "searchable": true,"width":120 },
          { "orderable": true, "targets": 2, "searchable": true,"width":120 },
          { "orderable": true, "targets": 3, "searchable": true,"width":120 },
          { "orderable": true, "targets": 4, "searchable": true,"width":120 },
          { "orderable": true, "targets": 5, "searchable": true,"width":120 },
          { "orderable": true, "targets": 6, "searchable": true,"width":120 }
          ]
      });
});

</script>