
  <!-- Start slider -->
  <section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            <!-- single slide item -->
            <?php 
				  $sql = "SELECT id_slide,gambar,keterangan FROM slide order by id_slide asc";
				 
					$rs  = $db->Execute($sql);
					while($list = $rs->FetchRow()){
						foreach($list as $key=>$val){
							$key=strtolower($key);
							$$key=$val;
						}
						echo "
						<li>
						  <div class='seq-model'>
							<img data-seq src='".$basepath."assets/img/slider/$gambar' alt='' />
						  </div>
						  <div class='seq-title'>
							<span data-seq>Tabungan</span>                
							<h2 data-seq>$keterangan</h2>                
							<a data-seq href='#' class='aa-shop-now-btn aa-secondary-btn'>Nabung Sekarang</a>
						  </div>
						</li>";
					}				  
			?>                   
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <!-- / slider -->
  
   <!-- Products section -->
  <section id="aa-product">
   <div style="text-align:center"><h1> -- Produk Kami -- </h1></div>
	<div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <!-- start prduct navigation -->
                 <ul class="nav nav-tabs aa-products-tab">
                    <li class="active"><a href="#men" data-toggle="tab">Travel</a></li>
                    <li><a href="#elektronik" data-toggle="tab">Electronics & Furniture</a></li>
                    <li><a href="#hewan" data-toggle="tab">Hewan Kurban</a></li>
                   <!-- <li><a href="#electronics" data-toggle="tab">Electronics</a></li> -->
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <!-- Start men product category -->
                    <div class="tab-pane fade in active" id="men">
                      <ul class="aa-product-catg">
                        <!-- start single product item -->
						<?php 
							$sql_produk = "SELECT id_produk,nama_produk,gambar,harga FROM produk where kategori='1' order by id_produk asc";
							$rs_produk  = $db->Execute($sql_produk);
							while($list_produk = $rs_produk->FetchRow()){
								foreach($list_produk as $key1=>$val1){
									$key1=strtolower($key1);
									$$key1=$val1;
								}
									echo "
									 <li>
										  <figure>
											<a class='aa-product-img' href='#'><img src='".$basepath."assets/img/produk/$gambar' width='100%' height='100%' auto alt='polo shirt img'></a>
											<a class='aa-add-card-btn' href='product_detail?act=view&id_parameter=$id_produk'><span class='fa fa-shopping-cart'></span>Nabung</a>
											  <figcaption>
											  <h4 class='aa-product-title'><a href='#'>$nama_produk</a></h4>
											  <span class='aa-product-price'>$harga</span>
											</figcaption>
										  </figure>                        
										  <div class='aa-product-hvr-content'>
											<!--<a href='#' data-toggle='tooltip' data-placement='top' title='Add to Wishlist'><span class='fa fa-heart-o'></span></a>
											<a href='#' data-toggle='tooltip' data-placement='top' title='Compare'><span class='fa fa-exchange'></span></a>
											<a href='#' data-toggle2='tooltip' data-placement='top' title='Quick View' data-toggle='modal' data-target='#quick-view-modal'><span class='fa fa-search'></span></a>-->                          
										  </div>
									</li>";
								}				  
						?>                      
                      </ul>
                    </div>
                    <!-- / Travel product category -->
                    <!-- start electronik product category -->
                    <div class="tab-pane fade in " id="elektronik">
                      <ul class="aa-product-catg">
                        <!-- start single product item -->
						<?php 
							$sql_produk = "SELECT id_produk,nama_produk,gambar,harga FROM produk where kategori='2' order by id_produk asc";
							$rs_produk  = $db->Execute($sql_produk);
							while($list_produk = $rs_produk->FetchRow()){
								foreach($list_produk as $key1=>$val1){
									$key1=strtolower($key1);
									$$key1=$val1;
								}
									echo "
									 <li>
										  <figure>
											<a class='aa-product-img' href='#'><img src='".$basepath."assets/img/produk/$gambar' width='100%' height='100%' auto alt='polo shirt img'></a>
											<a class='aa-add-card-btn' href='#'><span class='fa fa-shopping-cart'></span>Nabung</a>
											  <figcaption>
											  <h4 class='aa-product-title'><a href='#'>$nama_produk</a></h4>
											  <span class='aa-product-price'>$harga</span>
											</figcaption>
										  </figure>                        
										  <div class='aa-product-hvr-content'>
											<!--<a href='#' data-toggle='tooltip' data-placement='top' title='Add to Wishlist'><span class='fa fa-heart-o'></span></a>
											<a href='#' data-toggle='tooltip' data-placement='top' title='Compare'><span class='fa fa-exchange'></span></a>
											<a href='#' data-toggle2='tooltip' data-placement='top' title='Quick View' data-toggle='modal' data-target='#quick-view-modal'><span class='fa fa-search'></span></a>-->                          
										  </div>
									</li>";
								}				  
						?>                        
                      </ul>
                    </div>
                    <!-- / produk product category -->
                    <!-- start hewan product category -->
                    <div class="tab-pane fade" id="hewan">
                      <ul class="aa-product-catg">
                        <!-- start single product item -->
                        <?php 
							$sql_produk = "SELECT id_produk,nama_produk,gambar,harga FROM produk where kategori='3' order by id_produk asc";
							$rs_produk  = $db->Execute($sql_produk);
							while($list_produk = $rs_produk->FetchRow()){
								foreach($list_produk as $key1=>$val1){
									$key1=strtolower($key1);
									$$key1=$val1;
								}
									echo "
									 <li>
										  <figure>
											<a class='aa-product-img' href='#'><img src='".$basepath."assets/img/produk/$gambar' width='100%' height='100%' auto alt='polo shirt img'></a>
											<a class='aa-add-card-btn' href='#'><span class='fa fa-shopping-cart'></span>Nabung</a>
											  <figcaption>
											  <h4 class='aa-product-title'><a href='#'>$nama_produk</a></h4>
											  <span class='aa-product-price'>$harga</span>
											</figcaption>
										  </figure>                        
										  <div class='aa-product-hvr-content'>
											<!--<a href='#' data-toggle='tooltip' data-placement='top' title='Add to Wishlist'><span class='fa fa-heart-o'></span></a>
											<a href='#' data-toggle='tooltip' data-placement='top' title='Compare'><span class='fa fa-exchange'></span></a>
											<a href='#' data-toggle2='tooltip' data-placement='top' title='Quick View' data-toggle='modal' data-target='#quick-view-modal'><span class='fa fa-search'></span></a>-->                          
										  </div>
									</li>";
								}				  
						?>                        
                      </ul>
                    </div>
                     <div align=center> <a class="aa-browse-btn" href="product.php">Nabung Selengkapnya</a> </div>
                  </div>             
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Products section -->
   <!-- Latest Blog -->
  <section id="aa-latest-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
			<div style="text-align:center"><h1> Partner </h1></div>
			<div> <img src="<?php echo $basepath ?>assets/img/parnet.jpg" alt="img"> </div>
            </div>
          </div>
        </div>
  </section>
  <!-- / Latest Blog -->
  <div style="text-align:center"><h1> Kenapa Kami ?  </h1></div>
    <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
			  <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4 style="color:#FFF">FREE SHIPPING</h4>
                <P>Kami siap antar kemanapun dimanapun.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4 style="color:#FFF">30 Hari Tabungan Anda Kembali</h4>
                <P>Kami akan mengembalikan tabungan anda jika terjadi sesuatu yang merugikan.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4 style="color:#FFF">SUPPORT 24 Jam</h4>
                <P>Hubungi kami kapan pun.</P>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>