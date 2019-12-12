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
          <form action="">
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
							   $sql = "select b.* from pesanan_detail a left join produk b on a.id_produk = b.Id_Produk where email='cristantio123@gmail.com' and status='1'";
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
                    <!-- Login section -->
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
					  </div>
                    <!-- Billing Details -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title_a">
                          Billing Details
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="First Name*">
                              </div>                             
                            </div>
                          </div>   
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="email" placeholder="Email Address*">
                              </div>                             
                            </div>
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" placeholder="Phone*">
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" rows="3">Address*</textarea>
                              </div>                             
                            </div>                            
                          </div>   
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Appartment, Suite etc.">
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
                          <th>Tanggal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
						$sql = "select a.no_pesanan,a.kuantitas,a.harga_list,b.nama_produk,b.harga from pesanan_detail a left join produk b on a.id_produk = b.Id_Produk where email='cristantio123@gmail.com' and status='1'";
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
                    <label for="cashdelivery"><input type="radio" id="cashdelivery" name="optionsRadios"> Dengan Dp </label>
                    <label for="paypal"><input type="radio" id="paypal" name="optionsRadios" checked> Tanpa Dp </label>    
                    <input type="submit" value="Place Order" class="aa-browse-btn">                
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