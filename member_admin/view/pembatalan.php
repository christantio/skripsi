        <!-- Begin Page Content -->
        <div class="container-fluid">
			 <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>	
            <!-- Content Column -->
            <div class="container-fluid">
			<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List Pembatalan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Age</th>
                      <th>Start date</th>
                      <th>Salary</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
					   $sql = "SELECT * FROM pembayaran where email = '".$_SESSION['email']."' and status = '3'";		
					   $rs  = $db->Execute($sql);
					   while($aRow = $rs->FetchRow()){
						   foreach ($aRow as $key=>$val) {
								$key = strtolower($key);
								$$key = $val;
							}
							
						 echo "<tr>
							<td>$id_pembayaran</td>
							<td>$no_invoice</td>
							<td>$jumlah_bayar</td>
							<td>$no_pesan</td>
							<td>$created_date</td>
							<td>$last_update</td>
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