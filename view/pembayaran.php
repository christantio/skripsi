  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <img src="<?php echo $basepath ?>assets/img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Billing Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Billing</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
         <form name=f1 method=post action='pembayaran?act=do_add'  enctype=\"multipart/form-data\">
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    <!-- Coupon section -->
                    <div class="panel panel-default aa-checkout-coupon">
                      <div class="panel-heading">
                        <h4 class="panel-title_a">
                         Ringkasan Pemesanan
                         </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                           <?php 
							   $sql = "select b.* from pesanan_detail a left join produk b on a.id_produk = b.Id_Produk where email='$email' and status='1'";
							   $result = $db->execute($sql); 
							   while($rl = $result->FetchRow()){
									foreach($rl as $key=>$val){
										$key=strtolower($key);
										$$key=$val;
									}
									
									echo "<h4>$nama_produk</h4> 
									<p> 
									 ".substr($keterangan,0,100)."
									</p>
									
									"; 
							   }
						   ?>
                        </div>
                      </div>
                    </div>
                    <!-- Login section 
                    <div class="panel panel-default aa-checkout-login">
                      <div class="panel-heading">
                        <h4 class="panel-title_a">
                           Metode Pembayaran 
                        </h4>
                      </div>
					  <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
							<div class="col-md-2 col-sm-3 col-xs-12">
							<div class="thumbnail" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="PHP">
							<a href="integration_php.html"><img src="<?php echo $basepath ?>assets/img/bank/bca.jpg"></a>
							</div>
						  </div>
						  <div class="col-md-2 col-sm-3 col-xs-12">
							<div class="thumbnail" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="PHP">
							<a href="integration_php.html"><img src="<?php echo $basepath ?>assets/img/bank/bni.png"></a>
							</div>
						  </div>
						  <div class="col-md-2 col-sm-3 col-xs-12">
							<div class="thumbnail" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="PHP">
							<a href="integration_php.html"><img src="<?php echo $basepath ?>assets/img/bank/mandiri.png"></a>
							</div>
						  </div>
                        </div>
                      </div>
					  </div>-->
                    <!-- Billing Details -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title_a">
                          Identitas Penumpang Lain
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="nama" placeholder="Nama" >
                              </div>                             
                            </div>
                          </div>   
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="email" name="email" placeholder="Email" >
                              </div>                             
                            </div>
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" name="phone" placeholder="Phone" >
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" rows="3" name="alamat" >Alamat*</textarea>
                              </div>                             
                            </div>                            
                          </div>   
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Keterangan" name="keterangan" >
                              </div>                             
                            </div>
                          </div>                                    
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="checkout-right">
                  <h4>Order Summary</h4>
                  <div class="aa-order-summary-area">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
						$sql = "select a.no_pesanan,a.kuantitas,a.harga_list,b.nama_produk,b.harga from pesanan_detail a left join produk b on a.id_produk = b.Id_Produk where email='$email' and status='1'";
						$result = $db->execute($sql);
							$total_keselurahan = 0;
							while($rl = $result->FetchRow()){
								foreach($rl as $key=>$val){
									$key=strtolower($key);
									$$key=$val;
								}
							echo "	
								<tr>
								  <td>$nama_produk <strong> x  $kuantitas</strong></td>
								  <td>".$gen_controller->ribuan($harga)."</td>
								</tr>";
							$total_keselurahan +=$harga_list;	
						}
						?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Total</th>
                          <td><?=$gen_controller->ribuan($total_keselurahan)?></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <h4>Payment Method</h4>
                  <div class="aa-payment-method">                    
                    <label for="cashdelivery"><input type="radio" id="cashdelivery" name="radio1" value = "1" onChange='radio(this.value);'> Dengan Dp </label>
                    <label><input type="text" id="jml_cicilan1" name="jml_cicilan1" onKeyUp='calculateEndPeriod(this);formatangka(this);' maxlength=16 required>
					<input type="hidden" id="jml_pinjaman" name="jml_pinjaman" value="<?php echo $total_keselurahan; ?>"> 
					<input type="hidden" id="sisa_pinjaman" name="sisa_pinjaman" value=""> <br><br>
					<label><input type='text' name='jml_cicilan_dp' id='jml_cicilan_dp' value='' size='20' class='ratakanan' readOnly required> / 
					<select name="jml_bln_dp" id="jml_bln_dp" onChange='jns_bulan_change(this.value);' >
					  <option value=""></option>
					  <option value="6">6</option>
					  <option value="12">12</option>
					</select>
					</label>
					<label for="paypal"><input type="radio" id="paypal" name="radio1" value = "2" onChange='radio(this.value);'> Tanpa Dp </label> 
					<label><input type='text' name='jml_cicilan' id='jml_cicilan' value='' onkeyup='formatangka(this);'  size='20' class='ratakanan' readOnly required> / 
					<select name="jml_bln_tnpa_dp" id="jml_bln_tnpa_dp" onChange='jns_bulan_change1(this.value);' required>
					  <option value=""></option>
					  <option value="6">6</option>
					  <option value="12">12</option>
					</select>
					
					Bulan</label>		
					<select name="metode_pembayaran" id="metode_pembayaran" required>
					  <option value=""></option>
					  <option value="1">BCA                                               </option>
					  <option value="2">MANDIRI                                           </option>
					  <option value="3">BNI</option>
					</select>
					<input type="submit" value="Bayar Sekarang" class="aa-browse-btn">                
                  </div>
                </div>
              </div>
            </div>
          </form>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
 <style>
 #metode_pembayaran{
	 width:325px;   
 }
 </style>
 <script>
 
	function radio(objek){
		if (objek == "1"){
			var jml_pinjaman = document.getElementById('jml_cicilan').value=''; 
			var jml_bln_tnpa_dp = document.getElementById('jml_bln_tnpa_dp').value=''; 
			var jml_pinjaman = document.getElementById('jml_cicilan').disabled=true;
			var jml_bln_tnpa_dp = document.getElementById('jml_bln_tnpa_dp').disabled=true; 
			var jml_cicilan1 = document.getElementById('jml_cicilan1').disabled=false;
			var jml_cicilan_dp = document.getElementById('jml_cicilan_dp').disabled=false;
			var jml_bln_dp = document.getElementById('jml_bln_dp').disabled=false;
		}else if (objek == "2"){
			var jml_cicilan1 = document.getElementById('jml_cicilan1').value=''; 
			var jml_cicilan_dp = document.getElementById('jml_cicilan_dp').value=''; 
			var jml_bln_dp = document.getElementById('jml_bln_dp').value=''; 
			var jml_cicilan1 = document.getElementById('jml_cicilan1').disabled=true;
			var jml_cicilan_dp = document.getElementById('jml_cicilan_dp').disabled=true;
			var jml_bln_dp = document.getElementById('jml_bln_dp').disabled=true;
			var jml_pinjaman = document.getElementById('jml_cicilan').disabled=false;
			var jml_bln_tnpa_dp = document.getElementById('jml_bln_tnpa_dp').disabled=false;
		}	
	}
	
	function calculateEndPeriod(objek){
		var a = objek.value.split('.').join('');
		var jml_pinjaman = document.getElementById('jml_pinjaman').value; 
		var tot = parseInt (jml_pinjaman-a);
		var sisa_pinjaman = document.getElementById('sisa_pinjaman').value = tot;	
	}
	
	function jns_bulan_change(bulan) {
	   var bln = bulan;
	   if (bln ==''){
		   bln=0;
	   }
	   var dp = document.getElementById("sisa_pinjaman").value;
	   var kosong ="";
	   var dp1 = dp.split('.').join(kosong);
	   if (bln == 0){				   
			var jumlah  = Math.ceil(parseFloat(dp1)*parseInt(bln));
	   }else{
			var jumlah  = Math.ceil(parseFloat(dp1)/parseInt(bln));
	   }
	   document.getElementById("jml_cicilan_dp").value= formatangka1(jumlah);
	}
	
	function jns_bulan_change1(bulan) {
	   var bln = bulan;
	   if (bln ==''){
		   bln=0;
	   }
	   var dp = document.getElementById("jml_pinjaman").value;
	   var kosong ="";
	   var dp1 = dp.split('.').join(kosong);
	   if (bln == 0){				   
			var jumlah  = Math.ceil(parseFloat(dp1)*parseInt(bln));
	   }else{
			var jumlah  = Math.ceil(parseFloat(dp1)/parseInt(bln));
	   }
	   document.getElementById("jml_cicilan").value= formatangka1(jumlah);
	}
	
	function formatangka(objek) {

	   a = objek.value;
	   b = a.replace(/[^\d]/g,"");
	   c = "";
	   panjang = b.length;
	   j = 0;
	   for (i = panjang; i > 0; i--) {
		 j = j + 1;
		 if (((j % 3) == 1) && (j != 1)) {
		   c = b.substr(i-1,1) + "." + c;
		 } else {
		   c = b.substr(i-1,1) + c;
		 }
	   }
	   objek.value = c;
	}
	
	function formatangka1(val) {
	   b = val.toString().replace(/[^\d]/g,"");
	   c = "";
	   panjang = b.length;
	   j = 0;
	   for (i = panjang; i > 0; i--) {
		 j = j + 1;
		 if (((j % 3) == 1) && (j != 1)) {
		   c = b.substr(i-1,1) + "." + c;
		 } else {
		   c = b.substr(i-1,1) + c;
		 }
	   }
	   return c;
	}
			
 </script>
 
 