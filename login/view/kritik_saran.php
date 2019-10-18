<title>Kritik & Saran - <?php echo $web['judul_web']?></title>
<div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Data Kritik & Saran
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
                            <th><b>Nama</b></th>
                            <th><b>Email</b></th>
                            <th><b>No Hp</b></th>
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

       

        <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="width: 850px;">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Detail Kritik & Saran</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" id="form_edit" method="POST" autocomplete="off">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1"><b>Nama</b></label>
                          <br><span id="nama"></span>
                        </div>
                      </div> 
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1"><b>No Hp</b></label>
                          <br><span id="no_hp"></span>
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
                          <label for="exampleInputName1"><b>Pesan</b></label>
                          <br><span id="pesan"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  </form>
                </div>
             </div>
          </div>
  <script type="text/javascript">
  function do_edit(id){
    $.ajax({
          url: '<?php echo $basepath_admin ?>kritik_saran/edit/'+id,
          type: 'POST',
          dataType: 'JSON',
          success: function(data) {
            console.log(data);
              $("#nama").html(data.nama);
              $("#no_hp").html(data.no_hp);
              $("#email").html(data.email);
              $("#pesan").html(data.pesan);
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
          "sAjaxSource": "<?php echo $basepath_admin ?>kritik_saran/list_rest", 
          "sServerMethod": "POST",
          "scrollX": true,
          // "scrollY": "350px",
          "scrollCollapse": true,
          "order": [[ 3, "desc" ]],
          "columnDefs": [
          { "orderable": true, "targets": 0, "searchable": true},
          { "orderable": true, "targets": 1, "searchable": true,"width":120 },
          { "orderable": true, "targets": 2, "searchable": true,"width":120 },
          { "orderable": true, "targets": 3, "searchable": true,"width":120 },
          { "orderable": false, "targets": 4, "searchable": false, "width":100}
          ]
      });
});
</script>