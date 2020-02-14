        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total tabungan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
					  <?php 
							//$jumlah = $gen_model->getOne("select sum (jumlah_bayar) as jumlah from pembayaran where email='".$_SESSION['email']."' and status = '2'");
							$jumlah = $gen_model->GetOne('sum(jumlah_bayar)','pembayaran',array('email'=>"".$_SESSION['email']."",'status'=>'2'));
							echo "Rp. ";
							echo $gen_controller->ribuan($jumlah);
					  ?>
					  </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah claim</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
					  <?php 
							$claim = $gen_model->GetOne('sum(jumlah_bayar)','pembayaran',array('email'=>"".$_SESSION['email']."",'status'=>'4'));	
							//$claim = $db->getOne("select sum (jumlah_bayar) from pembayaran where email='".$_SESSION['email']."' and status = '4'");
							echo "Rp. ";
							echo $gen_controller->ribuan($claim);
					  ?>
					  </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>-->

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Transaksi</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
					  <?php 
							$ttl = $gen_model->GetOne('count(1)','pesanan',array('email'=>"".$_SESSION['email'].""));
							//$ttl = $db->getOne("select count (1) from pesanan where email='".$_SESSION['email']."' and status = '1'");
							echo $gen_controller->ribuan($ttl);
					  ?>
					  </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <!-- Content Column -->
            <div class="container-fluid">
			<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List Pesanan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="order-listing" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No Pesanan</th>
                      <th>Nama Barang</th>
                      <th>Harga</th>
                      <th>Total Bayar</th>
                      <th>Fungsi</th>
                    </tr>
                  </thead>
                  <tbody>
					 <?php 
							
							$sql_pesan = "SELECT a.no_pesanan,a.total_biaya,b.id_produk FROM pesanan a left join pesanan_detail b on a.no_pesanan = b.no_pesanan where a.email='".$_SESSION['email']."' order by a.id_pesanan asc";
							$rs_pesan  = $db->Execute($sql_pesan);
							$no = 0;
							while($list_pesan = $rs_pesan->FetchRow()){
								foreach($list_pesan as $key1=>$val1){
									$key1=strtolower($key1);
									$$key1=$val1;
								}
								$nm_barang = $db->getOne("select Nama_Produk from produk where id_produk = '$id_produk'");
								$jml_bayar = $db->getOne("select sum(jumlah_bayar) from pembayaran where no_pesan = '$no_pesanan'");
								
									echo "
									 <tr>
										<td>$no_pesanan</td>
										<td>$nm_barang</td>
										<td>".$gen_controller->ribuan($total_biaya)."</td>
										<td>".$gen_controller->ribuan($jml_bayar)."</td>
										<td>
										<center>
											<a class='btn btn-sm btn-primary' href='pembayaran?act=bayar&no_pesanan=$no_pesanan' style='width:100px;margin-bottom:2pt;'> Bayar </a><br>
											<a class='btn btn-sm btn-danger'  href='pembayaran?act=claim&no_pesanan=$no_pesanan' style=\"width:100px;margin-bottom:2pt;color:white;\"> Claim </a><br/>	
										</center>
										</td>
									</tr>";
								$no++;
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
 <script type="text/javascript">

 $(document).ready(function() {
      $('#order-listing').DataTable({
          "bProcessing": true,
          "bServerSide": true,
          "bJQueryUI": false,
          "responsive": false,
          "autoWidth": false,
          "sAjaxSource": "<?php echo $basepath_admin ?>index/list_rest", 
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
</script>
