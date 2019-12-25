        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Content Row -->	
            <!-- Content Column -->
            <div class="container-fluid">
			<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
					<h4>Profile</h4>
					 <form action="profile?act=do_update" method=POST class="aa-login-form" enctype="multipart/form-data" >
						
						<?php 
							$sql = "select * from login where email='".$_SESSION['email']."'";
							$result = $db->Execute($sql);
							while($aRow = $result->FetchRow()){
							   foreach ($aRow as $key=>$val) {
									$key = strtolower($key);
									$$key = $val;
								}
							}	
							
						?>	
						<label for="">Nama<span>*</span></label>
						<input type="text" name=nama placeholder="Nama" value='<?=$nama_lengkap ?>' required>
						<label for="">Alamat<span>*</span></label>
						<input type="text" name=alamat placeholder="alamat" value='<?=$alamat ?>' required>
						<label for="">Tanggal Lahir<span>*</span></label>
						<input type="date" style="background-color:white;color:black;margin-right: -4%;height:38px;"  data-date="" data-date-format="DD MMMM YYYY" class="form-control" name="tgl_lahir" id="tgl_lahir" value='<?=$tgl_lahir ?>'  required>
						<label for="">Unggah Foto<span>*</span></label>
						<input type="file" class="form-control-file" id="gambar" name="gambar"><br/><br/>
						<center><img style="width:600px;" src="<?=$basepath."assets/img/man/".$gambar ?>" id="gambar_edit"></center>
						<button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Daftar</button>                    
					  </form>
              </div>
            </div>
          </div>
            </div>

        </div>
        <!-- /.container-fluid -->
		
		

      </div>
      <!-- End of Main Content -->