        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Content Column -->
            <div class="container-fluid">
			<!-- DataTales Example -->
          <div class="card shadow mb-4">
			
            <div class="card-body">
              <div class="table-responsive">
					<h4>Pembayaran</h4>
					<br>
					<?php 
						$no_pesanan = $_GET['no_pesanan'];
						$sql = "SELECT b.nama,b.no_rek,b.keterangan FROM pesanan a left join bank b on a.jns_pembayaran = b.id_bank
							where a.no_pesanan='".$no_pesanan."'";
							$result = $db->Execute($sql);
							while($aRow = $result->FetchRow()){
							   foreach ($aRow as $key=>$val) {
									$key = strtolower($key);
									$$key = $val;
								}
							}
						echo "<small> Rekening Pembayaran :<br> <i> $nama : $no_rek </i></small>";	
					?>	
					
					 <form action="pembayaran?act=do_bayar" method=POST class="aa-login-form" enctype="multipart/form-data" >
						
						<?php 
							
							$sql = "SELECT a.no_pesanan,a.total_biaya,a.jml_cicilan,b.id_produk,c.nama_produk FROM pesanan a 
							left join pesanan_detail b on a.no_pesanan = b.no_pesanan 
							left join produk c on b.id_produk = c.id_produk 
							where a.no_pesanan='".$no_pesanan."'";
							$result = $db->Execute($sql);
							while($aRow = $result->FetchRow()){
							   foreach ($aRow as $key=>$val) {
									$key = strtolower($key);
									$$key = $val;
								}
							}	
							
						?>	
						<label for="">No Pesanan <span>*</span></label>
						<input type="text" name="no_pesan" placeholder="No Pesanan" value='<?=$no_pesanan ?>' readOnly>
						<label for="">Nama Produk <span>*</span></label>
						<input type="text" name="nama_produk" placeholder="Nama Produk" value='<?=$nama_produk ?>' disabled>						
						<label for="">Harga Barang<span>*</span></label>
						<input type="text" name="total_biaya" placeholder="alamat" value='<?=$gen_controller->ribuan($total_biaya); ?>' disabled>
						<label for="">Jumlah Cicilan<span>*</span></label>
						<input type="text" name="jml_cicilan" placeholder="Jumlah Cicilan" value='<?=$gen_controller->ribuan($jml_cicilan); ?>' disabled>
						<label for="">Jumlah Bayar<span>*</span></label>
						<input type="text" name="jml_bayar" placeholder="Jumlah Bayar" maxlength="4" onkeydown="return numbersonly(this, event);" value='' required />
						<label for="">Unggah Foto<span>*</span></label>
						<input type="file" class="form-control-file" id="gambar" name="gambar"><br/><br/>
						<button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Bayar</button>                    
					  </form>
              </div>
            </div>
          </div>
            </div>

        </div>
        <!-- /.container-fluid -->
		
		

      </div>
      <!-- End of Main Content -->