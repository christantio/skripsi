  <!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        
						<div class="simpleLens-big-image-container"><a data-lens-image="<?php echo $basepath.'assets/img/produk/'.$gambar.'' ?>" class="simpleLens-lens-image"><img src="<?php echo $basepath.'assets/img/produk/'.$gambar.'' ?>" class="simpleLens-big-image" width='250px' height='300px' ></a></div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3><?php echo $nama_produk; ?></h3>
                    <div class="aa-price-block">
                      <span class="aa-product-view-price">Rp. <?php echo $ribuan = $gen_controller->ribuan($harga); ?> </span>
                      <p class="aa-product-avilability">
					  <?php
							if ($bulan == "1"){
								$bulan = "Januari";
							}else if ($bulan == "2"){
								$bulan = "Februari";
							}else if ($bulan == "3"){
								$bulan = "Maret";
							}else if ($bulan == "4"){
								$bulan = "April";
							}else if ($bulan == "5"){
								$bulan = "Mei";
							}else if ($bulan == "6"){
								$bulan = "Juni";
							}else if ($bulan == "7"){
								$bulan = "Juli";
							}else if ($bulan == "8"){
								$bulan = "Agustus";
							}else if ($bulan == "9"){
								$bulan = "September";
							}else if ($bulan == "10"){
								$bulan = "Oktober";
							}else if ($bulan == "11"){
								$bulan = "November";
							}else if ($bulan == "12"){
								$bulan = "Desember";
							}
							if ($kategori == "1"){
								echo "Periode Hotel <span> $bulan $tahun </span>";	
							}else{
								echo "Sisa Stock: <span> $stock; </span>";
							}
							
					  ?>
					  </p>
                    </div>
                    <p><?php echo substr($keterangan,0,100); ?></p>
                    <!--<h4>Size</h4>
                    <div class="aa-prod-view-size">
                      <a href="#">S</a>
                      <a href="#">M</a>
                      <a href="#">L</a>
                      <a href="#">XL</a>
                    </div>-->
                    <!--<h4>Color</h4>
                    <div class="aa-color-tag">
                      <a href="#" class="aa-color-green"></a>
                      <a href="#" class="aa-color-yellow"></a>
                      <a href="#" class="aa-color-pink"></a>                      
                      <a href="#" class="aa-color-black"></a>
                      <a href="#" class="aa-color-white"></a>                      
                    </div>
                    <div class="aa-prod-quantity">
                      <form action="">
                        <select id="" name="">
                          <option selected="1" value="0">1</option>
                          <option value="1">2</option>
                          <option value="2">3</option>
                          <option value="3">4</option>
                          <option value="4">5</option>
                          <option value="5">6</option>
                        </select>
                      </form>
                      <p class="aa-prod-category">
                        Category: <a href="#">Polo T-Shirt</a>
                      </p>
                    </div>-->
                    <div class="aa-prod-view-bottom">
                      <a class="aa-add-to-cart-btn1" href="product_detail?act=do_add&id_parameter=<?php echo $id_produk; ?>">Mulai Nabung</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           <div class="aa-product-details-bottom"></div>
           <!--   <ul class="nav nav-tabs" id="myTab2">
                <li><a href="description">Deskripsi</a></li>
                <li><a href="review">Reviews</a></li>                
              </ul>

              Tab panes
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  <p><?php echo $keterangan; ?></p>
                </div>
                <div class="tab-pane fade in active" id="review">
                 <div class="aa-product-review-area">
                   <h4>2 Reviews for T-Shirt</h4> 
                   <ul class="aa-review-nav">
                     <li>
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                            </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                            <div class="aa-product-rating">
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                            </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                            <div class="aa-product-rating">
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                          </div>
                        </div>
                      </li>
                   </ul>
                   <h4>Add a review</h4>
                   <div class="aa-your-rating">
                     <p>Your Rating</p>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                   </div>
                   <form action="" class="aa-review-form">
                      <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control" rows="3" id="message"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name">
                      </div>  
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                      </div>

                      <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                   </form>
                 </div>
                </div>            
              </div>
            </div>-->
            <!-- Related product -->
            <div class="aa-product-related-item">
              <h3>Produk Lainnya</h3>
              <ul class="aa-product-catg aa-related-item-slider">
                 <?php 
							$sql_produk = "SELECT id_produk,nama_produk,gambar,harga FROM produk ";
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
              <!-- quick view modal -->                  
              <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <div class="row">
                        <!-- Modal view slider -->
                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                          <div class="aa-product-view-slider">                                
                            <div class="simpleLens-gallery-container" id="demo-1">
                              <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container">
                                      <a class="simpleLens-lens-image" data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                          <img src="img/view-slider/medium/polo-shirt-1.png" class="simpleLens-big-image">
                                      </a>
                                  </div>
                              </div>
                              <div class="simpleLens-thumbnails-container">
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                                  </a>                                    
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                                  </a>

                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-4.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                                  </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3>T-Shirt</h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price">$34.99</span>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                              <a href="#">S</a>
                              <a href="#">M</a>
                              <a href="#">L</a>
                              <a href="#">XL</a>
                            </div>
                            <div class="aa-prod-quantity">
                              <form action="">
                                <select name="" id="">
                                  <option value="0" selected="1">1</option>
                                  <option value="1">2</option>
                                  <option value="2">3</option>
                                  <option value="3">4</option>
                                  <option value="4">5</option>
                                  <option value="5">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#">Polo T-Shirt</a>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <a href="#" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div>
              <!-- / quick view modal -->   
            </div>  
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / product category -->