<!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="<?php echo $basepath ?>assets/img/2.jpeg" alt="fashion img" width=100% height=50%>
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Produk</h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home</a></li>         
          <li class="active">Produk</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            
            <div class="aa-product-catg-body">
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
											<a class='aa-product-img' href='product_detail?act=view&id_parameter=$id_produk'><img src='".$basepath."assets/img/produk/$gambar' width='100%' height='100%' auto alt='polo shirt img'></a>
											<a class='aa-add-card-btn' href='product_detail?act=view&id_parameter=$id_produk'><span class='fa fa-shopping-cart'></span>Nabung</a>
											  <figcaption>
											  <h4 class='aa-product-title'><a href='product_detail?act=view&id_parameter=$id_produk'>$nama_produk</a></h4>
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
              <!-- / quick view modal -->   
            </div>
            <div class="aa-product-catg-pagination">
              <nav>
                <ul class="pagination">
                  <li>
                    <a href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li>
                    <a href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Category</h3>
              <ul class="aa-catg-nav_tio">	
		 	    <?php 
				  $sql = "SELECT  id_kategori,kategori,link FROM kategori order by id_kategori asc";
				  $rs  = $db->Execute($sql);
				  while($list = $rs->FetchRow()){
					foreach($list as $key=>$val){
						$key=strtolower($key);
						$$key=$val;
					}
					echo "<li><a href='$link'>$kategori </a></li>";
				  }
				  
				?>
              </ul>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Recently Views</h3>
              <div class="aa-recently-views">
                <ul>
                 <?php 
				  $sql = "SELECT * FROM produk Orders LIMIT 5 ";
				  $rs  = $db->Execute($sql);
				  while($list = $rs->FetchRow()){
					foreach($list as $key=>$val){
						$key=strtolower($key);
						$$key=$val;
					}
					echo "<li>
                    <a href='product_detail?act=view&id_parameter=$id_produk' class='aa-cartbox-img'><img alt='img' src='".$basepath."assets/img/produk/$gambar'></a>
                    <div class='aa-cartbox-info'>
                      <h4><a href='product_detail?act=view&id_parameter=$id_produk'>$nama_produk</a></h4>
                      <p>".$stock." x ".$harga."</p>
                    </div>                    
                  </li>";
				  }
				  
				?> 
                </ul>
              </div>                            
            </div>
          </aside>
        </div>
       
      </div>
    </div>
  </section>
  <!-- / product category -->