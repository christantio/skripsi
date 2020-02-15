        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Content Column -->
            <div class="container-fluid">
			<!-- DataTales Example -->
          <div class="card shadow mb-4">
			
            <div class="card-body">
              <div class="table-responsive">
					<h4>Testimoni</h4>
					<br>
					 <form action="pembayaran?act=do_claim" method=POST class="aa-login-form" enctype="multipart/form-data" onsubmit=\"return validation()\">
						
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
							
							$total_bayar = $db->getOne("select sum(jumlah_bayar) from pembayaran where no_pesan = '".$no_pesanan."'");	
							
						?>	
						<label for="">No Pesanan <span>*</span></label>
						<input type="text" name="no_pesan" placeholder="No Pesanan" value='<?=$no_pesanan ?>' readOnly>
						<label for="">Nama Produk <span>*</span></label>
						<input type="text" name="nama_produk" placeholder="Nama Produk" value='<?=$nama_produk ?>' disabled>						
						<label for="">Harga Barang<span>*</span></label>
						<input type="text" name="total_biaya" placeholder="Total Biaya" value='<?=$gen_controller->ribuan($total_biaya); ?>' disabled>
						<label for="">Jumlah Claim<span>*</span></label>
						<input type="text" name="jml_bayar" placeholder="Jumlah Bayar" maxlength="4" onkeydown="return numbersonly(this, event);" value='<?=$gen_controller->ribuan($total_bayar); ?>' required />
						<label for="">Keterangan<span>*</span></label>
						<textarea id="keterangan" name="keterangan" class="form-control"> </textarea>
						<button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Claim</button>                    
					  </form>
              </div>
			  </div>
			  </div>
            </div>

        </div>
        <!-- /.container-fluid -->
		
		

      </div>
      <!-- End of Main Content -->
