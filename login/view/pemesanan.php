<title>List Pemesanan - <?php echo $web['judul_web']?></title>
<style>
    #order-listing th {
       text-align: center;   
       font-weight:bold;
    }
    #order-listing>tbody>tr>td
    {
      white-space: nowrap;
    }
  </style>
<div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Data List Pemesanan
            </h3>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th><b>No. Pesanan</b></th>
                            <th><b>Tipe</b></th>
                            <th><b>Status</b></th>
                            <th><b>Nama</b></th>
                            <th><b>No Tlp</b></th>
                            <th><b>Email</b></th>
                            <th><b>Unit</b></th>
                            <th><b>Biaya</b></th>
                            <th><b>Jadwal Service</b></th>
                            <th><b>Tanggal dibuat</b></th>
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

       

        <div class="modal fade" id="status_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="width:350px;overflow-x:hidden;overflow-y:auto; max-height:400px;">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ganti Status Pesanan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" id="form_status" method="POST" autocomplete="off">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Status <span class="text-danger">*</span></label>
                          <input  id="id_parameter" name="id_parameter"  type="hidden" required>
                          <select style="color:black" class="form-control" id="mystatus" name="status" required>
                              <option value="">Pilih Status</option>
                              <option value="Cancel">Cancel</option>
                              <option value="Sukses">Sukses</option>
                          </select>
                        </div>
                      </div> 
                    </div>
                    <div class="modal-footer">
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Update Status</button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
             </div>
          </div>

          <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="width: 850px;overflow-x:hidden;overflow-y:auto; max-height:400px;">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" id="form_edit" method="POST" autocomplete="off">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1"><b>No.Pesanan</b></label>
                          <br><span id="no_order"></span>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1"><b>Status</b></label>
                          <br><span id="status"></span>
                        </div>
                      </div> 
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1"><b>Nama</b></label>
                          <br><span id="nama"></span>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1"><b>No.Telp</b></label>
                          <br><span id="tlp"></span>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1"><b>Email</b></label>
                          <br><span id="email"></span>
                        </div>
                      </div>
                       <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1"><b>Alamat</b></label>
                          <br><span id="alamat"></span>
                        </div>
                      </div> 
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1"><b>Jasa</b></label>
                          <br><span id="jasa"></span>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1"><b>Unit</b></label>
                          <br><span id="unit"></span>
                        </div>
                      </div>

                      <div id="detail_data" style="margin-left: 4%;">
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1"><b>Total Biaya</b></label>
                          <br><span id="biaya"></span>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1"><b>Jadwal Service</b></label>
                          <br><span id="jadwal"></span>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1"><b>Tanggal Pesan</b></label>
                          <br><span id="tgl_pesan"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  </form>
                </div>
             </div>
          </div>

  <script type="text/javascript">
  $("#form_status").on("submit", function (event) {
    event.preventDefault();
      do_act('form_status','pemesanan/update_status','','Ubah Status','Anda ingin mengubah status pemesanan ini ?','warning');
  });  
  function do_status(id){
    $.ajax({
          url: '<?php echo $basepath_admin ?>pemesanan/edit/'+id,
          type: 'POST',
          dataType: 'JSON',
          success: function(data) {
              $("#id_parameter").val(data.id_pesanan);
              $("#mystatus").val(data.status2);

              if(data.status2=="Pending"){
                $("#mystatus").val("");
              }
              // else if(data.status2=="Sukses"){
              //   $("#mystatus").removeAttr('disabled');
              // }

          }
      });
  }
  function do_edit(id){
    $.ajax({
          url: '<?php echo $basepath_admin ?>pemesanan/edit/'+id,
          type: 'POST',
          dataType: 'JSON',
          success: function(data) {
              $("#no_order").html(data.no_order);
              $("#unit").html(data.unit);
              $("#jasa").html(data.tipe);
              $("#nama").html(data.nama);
              $("#email").html(data.email);
              $("#status").html(data.status);
              $("#tlp").html(data.tlp);
              $("#alamat").html(data.alamat);
              $("#jadwal").html(data.jadwal);
              $("#biaya").html(data.biaya);
              $("#tgl_pesan").html(data.tgl_pesan);
              $("#unit").html(data.unit);

              do_detail(data.no_order);
          }
      });
  }

  function do_detail(no_pesanan){
    $.ajax({
          url: '<?php echo $basepath_admin ?>pemesanan/detail/'+no_pesanan,
          type: 'POST',
          dataType: 'html',
          success: function(data) {
              $("#detail_data").html(data);
          }
      });
  }

  
   function do_delete(id){
          swal({
            title: 'Hapus Kritik & Saran',
            text: 'Anda ingin menghapus Kritik & Saran ? ',
            type: 'error',      // warning,info,success,error
            showCancelButton: true,
            showLoaderOnConfirm: true,
            preConfirm: function(){
              $.ajax({
                  url: '<?php echo $basepath_admin ?>kritik_saran/do_delete',
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
          "order": [[ 9, "desc" ]],
          "columnDefs": [
          { "orderable": true, "targets": 0, "searchable": true},
          { "orderable": true, "targets": 1, "searchable": true,"width":120 },
          { "orderable": true, "targets": 2, "searchable": true,"width":120 },
          { "orderable": true, "targets": 3, "searchable": true,"width":120 },
          { "orderable": true, "targets": 4, "searchable": true,"width":120 },
          { "orderable": true, "targets": 5, "searchable": true,"width":120 },
          { "orderable": false, "targets": 6, "searchable": false,"width":120 },
          { "orderable": true, "targets": 7, "searchable": true,"width":120 },
          { "orderable": true, "targets": 8, "searchable": true,"width":120 },
          { "orderable": true, "targets": 9, "searchable": true,"width":120 },
          { "orderable": false, "targets": 10, "searchable": false,"width":140 }
          ]
      });
});

 function report(no_pesanan){
         window.open("<?php echo $basepath ?>report/"+no_pesanan, '_blank');
      }
</script>