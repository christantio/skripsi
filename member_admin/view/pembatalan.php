        <!-- Begin Page Content -->
        <div class="container-fluid">
			 <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">List Pembatalan</h1>
            <a href="pembatalan?act=export" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>	
            <!-- Content Column -->
            <div class="container-fluid">
			<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No Invoice</th>
                      <th>No Pesanan</th>
                      <th>Produk</th>
                      <th>Jumlah</th>
                      <th>Tanggal Claim</th>
                      <th>Status</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
					   $sql = "SELECT * FROM claim where email = '".$_SESSION['email']."'";		
					   $rs  = $db->Execute($sql);
					   $no = 0;
					   while($aRow = $rs->FetchRow()){
						   foreach ($aRow as $key=>$val) {
								$key = strtolower($key);
								$$key = $val;
							}
							
							$nama_produk=$db->getOne("SELECT c.nama_produk FROM `pesanan` as a left join pesanan_detail b on a.no_pesanan = b.no_pesanan left join produk c on b.id_produk = c.id_produk where a.no_pesanan = '$no_pesan'");
							
							if ($status == "1"){
								$nm_status = "Pending";
							}else if ($status == "2"){
								$nm_status = "Sukses";
							}else if ($status == "3"){
								$nm_status = "Ditolak";
							}else {
								$nm_status = "";
							}	
							
						 echo "<tr>
							<td>".++$no."</td>
							<td>".$no_invoice."</td>
							<td>".$no_pesan."</td>
							<td>".$nama_produk."</td>
							<td>".$gen_controller->ribuan($jumlah_claim)."</td>
							<td>".$created_date."</td>
							<td>".$nm_status."</td>
							<td>".$keterangan."</td>
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