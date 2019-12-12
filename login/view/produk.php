<title>Produk - <?php echo $web['judul_web']?></title>
<div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Data Produk
            </h3>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-4 col-xs-3">
                </div>
                <div class="col-sm-8 col-xs-9 text-right m-b-20">
                  <a href="#" class="btn btn-gradient-success btn-fw" data-toggle="modal" data-target="#add_modal"><i class="mdi mdi-plus"></i> Tambah Produk</a>
                </div>
              </div><br/>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th><b>Nama Produk</b></th>
                            <th><b>Kategori</b></th>
                            <th><b>Stock</b></th>
                            <th><b>Harga</b></th>
                            <th><b>Keterangan</b></th>
                            <th><b>Gambar</b></th>
							<th><b>Tanggal dibuat</b></th>
                            <th><b>Tanggal diubah</b></th>
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
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" id="form_add" method="POST" autocomplete="off">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
							<label for="exampleInputName1">Produk <span class="text-danger">*</span></label>
							<input class="form-control" id="Produk" name="nama_produk" placeholder="Produk" type="text" required>
							
						</div>
					  </div>
					  <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Kategori <span class="text-danger">*</span></label>
                          <select class="form-control" id="exampleFormControlSelect1"  name="Kategori" onChange=hide(this.value); required>
							<option value=""></option>
								  <?php 
								  $sql = "SELECT  id_kategori,kategori FROM kategori order by id_kategori asc";
								  $rs  = $db->Execute($sql);
								  while($list = $rs->FetchRow()){
									foreach($list as $key=>$val){
										$key=strtolower($key);
										$$key=$val;
									}
									echo "<option value=".$id_kategori.">$kategori</option>";
								  }
								  
								  ?>
							</select>
                        </div>
                      </div>
                      <div id="stock1" class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputName1">Stock <span class="text-danger">*</span></label>
                          <input class="form-control" id="stock" name="stock" onkeydown="return numbersonly(this, event);" placeholder="stock" type="text" required>
                        </div>
                      </div>
					  <div id="tahun1" class="col-md-6" style="display:none">
					  <div class="form-group">
                        <label for="exampleInputName1">Tahun <span class="text-danger">*</span></label>
                         <table width=100% border=0px>
						 <tr>
						 <td> 
							<select class="form-control" style="width:120px!important" id="vendor"  name="vendor" required>
								  <option value=""></option>
								  <?php 
								  for ($i=2019;$i<=2030;$i++){
									echo "<option value=".$i.">$i</option>";
									  
								  }
								  
								  ?>
							</select>
						 </td>
						 <td>  
						 <select class="form-control" style="width:120px!important" id="vendor"  name="vendor" required>
								  <option value=""></option>
								  <?php 
								  $arr_periode = array(1=>"Januari",2=>"Februari",3=>"Maret",4=>"April",5=>"Mei",6=>"Juni",7=>"Juli",8=>"Agustus",9=>"September",10=>"Oktober",11=>"November",12=>"Desember");
								  foreach($arr_periode as $value=>$text){
										echo "<option value=\"$value\">$text</option>";
								}
								  
								  ?>
						 </select>
						 </td>
						 </tr>
						 </table>
                      </div>
					  </div>
					  <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputName1">Harga <span class="text-danger">*</span></label>
                          <input class="form-control" id="harga" name="harga" onkeydown="return numbersonly(this, event);" placeholder="harga" type="text" required>			
                        </div>
                      </div>
					  <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputName1">Vendor <span class="text-danger">*</span></label>
                          <select class="form-control" id="vendor"  name="vendor" required>
								  <option value=""></option>
								  <?php 
								  $sql = "SELECT  id_vendor,nama_vendor FROM vendor order by id_vendor asc";
								  $rs  = $db->Execute($sql);
								  while($list = $rs->FetchRow()){
									foreach($list as $key=>$val){
										$key=strtolower($key);
										$$key=$val;
									}
									echo "<option value=".$id_vendor.">$nama_vendor</option>";
								}
								  
								  ?>
								</select>
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
                  <h5 class="modal-title" id="exampleModalLabel">Ubah Produk</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="forms-sample" id="form_edit" method="POST" autocomplete="off">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
							<label for="exampleInputName1">Produk <span class="text-danger">*</span></label>
							<input class="form-control" id="nama_produk" name="nama_produk" placeholder="Produk" type="text" required>
							<input id="id_parameter" name="id_parameter" type="hidden" required>
						</div>
					  </div>
					  <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Kategori <span class="text-danger">*</span></label>
                          <select class="form-control" id="kategori1"  name="kategori" onChange=hide2(this.value); required>
								  <option value=""></option>
								  <?php 
								  $sql = "SELECT  id_kategori,kategori FROM kategori order by id_kategori asc";
								  $rs  = $db->Execute($sql);
								  while($list = $rs->FetchRow()){
									foreach($list as $key=>$val){
										$key=strtolower($key);
										$$key=$val;
									}
									echo "<option value=".$id_kategori.">$kategori</option>";
								}
								  
								  ?>
								</select>
                        </div>
                      </div>
                      <div class="col-md-6" id="stock2">
                        <div class="form-group">
                          <label for="exampleInputName1">Stock <span class="text-danger">*</span></label>
                          <input class="form-control" id="stock3" name="stock" onkeydown="return numbersonly(this, event);" placeholder="stock" type="text" required>
                        </div>
                      </div>
					  <div id="tahun2" class="col-md-6" style="display:none">
					  <div class="form-group">
                        <label for="exampleInputName1">Tahun <span class="text-danger">*</span></label>
                         <table width=100% border=0px>
						 <tr>
						 <td> 
							<select class="form-control" style="width:120px!important" id="tahun"  name="tahun" required>
								  <option value=""></option>
								  <?php 
								  for ($i=2019;$i<=2030;$i++){
									echo "<option value=".$i.">$i</option>";
									  
								  }
								  
								  ?>
							</select>
						 </td>
						 <td>  
						 <select class="form-control" style="width:120px!important" id="bulan"  name="bulan" required>
								  <option value=""></option>
								  <?php 
								  $arr_periode = array(1=>"Januari",2=>"Februari",3=>"Maret",4=>"April",5=>"Mei",6=>"Juni",7=>"Juli",8=>"Agustus",9=>"September",10=>"Oktober",11=>"November",12=>"Desember");
								  foreach($arr_periode as $value=>$text){
										echo "<option value=\"$value\">$text</option>";
								}
								  
								  ?>
						 </select>
						 </td>
						 </tr>
						 </table>
                      </div>
					  </div>
					  <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputName1">Harga <span class="text-danger">*</span></label>
                          <input class="form-control" id="harga1" name="harga" onkeydown="return numbersonly(this, event);" placeholder="harga" type="text" required>			
                        </div>
                      </div>
					  <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputName1">Vendor <span class="text-danger">*</span></label>
                          <select class="form-control" id="vendor1"  name="vendor" required>
								  <option value=""></option>
								  <?php 
								  $sql = "SELECT  id_vendor,nama_vendor FROM vendor order by id_vendor asc";
								  $rs  = $db->Execute($sql);
								  while($list = $rs->FetchRow()){
									foreach($list as $key=>$val){
										$key=strtolower($key);
										$$key=$val;
									}
									echo "<option value=".$id_vendor.">$nama_vendor</option>";
								}
								  
								  ?>
								</select>
                        </div>
                      </div>
					  <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputName1">Keterangan <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="keterangan1" name="keterangan" rows="3" required></textarea>
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
            do_act('form_add','produk/do_add','','Tambah Produk','Anda ingin tambah Produk ?','info');
          });

  $("#form_edit").on("submit", function (event) {
    event.preventDefault();
      do_act('form_edit','produk/do_update','','Ubah Produk','Anda ingin mengubah Produk ?','warning');
  });

 

  function do_edit(id){
    $.ajax({
          url: '<?php echo $basepath_admin ?>produk/edit/'+id,
          type: 'POST',
          dataType: 'JSON',
          success: function(data) {
            console.log(data);
			  
			  $("#id_parameter").val(data.id_parameter);
              $("#nama_produk").val(data.nama_produk);
              $("#stock2").val(data.stock);
              $("#harga1").val(data.harga);
              $("#kategori1").val(data.kategori);
              $("#vendor1").val(data.vendor);
              $("#keterangan1").val(data.keterangan);
			  $("#gambar_edit").attr("src",data.gambar);
          }
      });
  }

  
   function do_delete(id){
          swal({
            title: 'Hapus Produk',
            text: 'Anda ingin menghapus Produk ?',
            type: 'error',      // warning,info,success,error
            showCancelButton: true,
            showLoaderOnConfirm: true,
            preConfirm: function(){
              $.ajax({
                  url: '<?php echo $basepath_admin ?>produk/do_delete',
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
          "sAjaxSource": "<?php echo $basepath_admin ?>produk/list_rest", 
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
	   document.getElementById('tahun1').style.display = 'none';
  }
}

function hide2(value) {
  if (value == "1"){
	  document.getElementById('stock2').style.display = 'none';    
	  document.getElementById('tahun2').style.display = 'block';	  
  }else{
	  document.getElementById('stock2').style.display = 'block';
	   document.getElementById('tahun2').style.display = 'none';
  }
}
</script>