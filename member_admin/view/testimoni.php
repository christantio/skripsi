        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Content Row -->
		  <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">List Testimoni</h1>
            <a href="testimoni?act=export" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>	
            <!-- Content Column -->
            <div class="container-fluid">
			<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <!--<h6 class="m-0 font-weight-bold text-primary" align=right><a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a></h6>-->
            </div>			
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Isi</th>
                      <th>Email</th>
                      <th>Produk</th>
                      <th>Created Date</th>
                      <th>Last Update</th>
                      <th>Fungsi</th>
                    </tr>
                  </thead>
                  <tbody>
				   <?php 
				   $sql = "SELECT * FROM testimoni where email = '".$_SESSION['email']."'";		
				   $rs  = $db->Execute($sql);
				   $no=0;
				   while($aRow = $rs->FetchRow()){
					   foreach ($aRow as $key=>$val) {
							$key = strtolower($key);
							$$key = $val;
						}
						$produk = $gen_model->GetOne("Nama_Produk","produk",array('id_produk'=>$produk)); 
						echo "<tr>
							<td>".++$no."</td>
							<td>$nama</td>
							<td>$isi</td>
							<td>$email</td>
							<td>$produk</td>
							<td>".$gen_controller->get_date_indonesia($created_date)."</td>
							<td>".$gen_controller->get_date_indonesia($last_update)."</td>
							<td>
							<center><button data-toggle='modal' type='button' class='btn btn-gradient-primary btn-rounded btn-icon' onClick=location.href='testimoni?act=edit&id_parameter=$id_testi'><i class='mdi mdi-pencil'></i></button> 
							&nbsp; <button  type='button' class='btn btn-gradient-danger btn-rounded btn-icon'><i class='mdi mdi-delete'></i></button>
							</center></td>
					   </tr>";
				   }
				   ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
            </div>

        </div>
        <!-- /.container-fluid -->
		
		

      </div>
      <!-- End of Main Content -->