<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Taruh Semua Script Diatas ini -->
    <!-- Font awesome -->
    <link href="<?php echo $basepath ?>assets/css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="<?php echo $basepath ?>assets/css/bootstrap.css" rel="stylesheet">
	<script src="<?php echo $basepath ?>assets/js/rupiah.js"></script>	
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="<?php echo $basepath ?>assets/css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="<?php echo $basepath ?>assets/css/jquery.simpleLens.css">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="<?php echo $basepath ?>assets/css/slick.css">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="<?php echo $basepath ?>assets/css/nouislider.css">
    <!-- Theme color -->
    <link id="switcher" href="<?php echo $basepath ?>assets/css/theme-color/default-theme.css" rel="stylesheet">
    <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
    <!-- Top Slider CSS -->
    <link href="<?php echo $basepath ?>assets/css/sequence-theme.modern-slide-in.css" rel="stylesheet" media="all">
	<!-- logo tab --> 
	<link rel="shortcut icon" href="<?php echo $basepath ?>assets/img/logo.jpg">
	<!-- plugins:css -->
	<link rel="stylesheet" href="<?php echo $basepath_admin ?>assets/plugin/iconfonts/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="<?php echo $basepath_admin ?>assets/plugin/css/vendor.bundle.base.css">
	<link rel="stylesheet" href="<?php echo $basepath_admin ?>assets/plugin/css/vendor.bundle.addons.css">	
	<link rel="stylesheet" type="text/css" href="<?php echo $basepath ?>assets/js/sweetalert2/dist/sweetalert2.min.css">
    <!-- Main style sheet -->
    <link href="<?php echo $basepath ?>assets/css/style.css" rel="stylesheet">    

    <!-- Google Font -->
    <link href='<?php echo $basepath ?>assets/css/font-awesome1.css' rel='stylesheet' type='text/css'>
	
	<title>My Plan</title>
  </head>
  <body>
  
	<!-- ini Loading Biar Keren 
	<div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div>-->
	<!-- END ini Loading Biar Keren -->
	
	<!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
	<!-- END SCROLL TOP BUTTON -->
  
 <!-- Start header section -->
  <header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                 <!-- 
                  <li class="hidden-xs"><a href="wishlist.php">Wishlist</a></li>
                  <li class="hidden-xs"><a href="cart.php">My Cart</a></li>
                  <li class="hidden-xs"><a href="checkout.php">Checkout</a></li>-->
				  <?php 
				  
				  if(!empty($_SESSION['email'])){
					  $email = $_SESSION['email'];
					  echo "
					  <li><a href='account.php'>My Account</a></li>
					  <li><a href='member?act=logout' >Keluar</a></li>";
				  }else{
					  $email = "";
					  echo "<li><a href='' data-toggle='modal' data-target='#login-modal'>Masuk</a></li>";
				  }
				  
				  ?>
                  
				  
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header top  -->
	
	<!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
                <!-- img based logo -->
                <!-- <a href="index.html"><img src="<?php echo $basepath ?>assets/img/tio_1.jpg" width="200px" alt="logo img"></a> -->
				<!-- Text based logo -->
                <a href="index.php">
                  <span class="fa fa-shopping-cart"></span>
                  <p>My Plan <span>Your Plan Solution</span></p>
                </a>
              </div>
              <!-- / logo  -->
               <!-- cart box -->
              <div class="aa-cartbox">
                <a class="aa-cart-link" href="#">
                  <span class="fa fa-shopping-basket"></span>
                  <span class="aa-cart-title">Keranjang Belanja</span>
                  <span class="aa-cart-notify"> 
				  <?php 
						$count_pemesanan = $db->getOne("select count(1) from pesanan_detail where email='$email' and status='1'");
						echo $count_pemesanan;
				  ?> 
				  </span>
                </a>
                <div class="aa-cartbox-summary">
                  <ul>
					<?php 
						$sql = "select a.kuantitas,a.harga_list,b.* from pesanan_detail a left join produk b on a.id_produk = b.Id_Produk where email='".$email."' and status='1'";
						$result = $db->execute($sql);
						$total_harga =0;
						while($rl = $result->FetchRow()){
							foreach($rl as $key=>$val){
								$key=strtolower($key);
								$$key=$val;
							}
							echo"<li>
								  <a class='aa-cartbox-img' href='#'><img src='".$basepath."assets/img/produk/$gambar' alt='img'></a>
								  <div class='aa-cartbox-info'>
									<h4><a href='#'>$nama_produk</a></h4>
									<p>$kuantitas x ".$gen_controller->ribuan($harga)."</p>
								  </div>
								  <a class='aa-remove-product' href='#'><span class='fa fa-times'></span></a>
								</li>                    
								";
							$total_harga +=$harga_list;
						}		
					?>
					<li>
								  <span class='aa-cartbox-total-title'>
									Total
								  </span>
								  <span class='aa-cartbox-total-price'>
									<?php echo $gen_controller->ribuan($total_harga); ?>
								  </span>
								</li>
                  </ul>
                  <a class="aa-cartbox-checkout aa-primary-btn" href="checkout.php">Checkout</a>
                </div>
              </div>
              <!-- / cart box -->
              <!-- search box -->
              <div class="aa-search-box">
                <form action="">
                  <input type="text" name="" id="" placeholder="Pencarian Berdasarkan Produk ">
                  <button type="submit"><span class="fa fa-search"></span></button>
                </form>
              </div>
              <!-- / search box -->             
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
  <!-- menu -->
  <section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->
            <ul class="nav navbar-nav">
              <li><a href=".">Beranda</a></li>
              <li><a href="profil">Profil</a></li>
              <li><a href="#">Layanan <span class="caret"></span></a>
                <ul class="dropdown-menu">                
                  <li><a href="product_travel">Travel</a></li>
                  <li><a href="product_furniture">Electronic & Furniture</a></li>
                  <li><a href="product_kurban">Ibadah</a></li>
                  </li>
                </ul>
              </li>
			  <li><a href="#">Bantuan  <span class="caret"></span></a>
                <ul class="dropdown-menu">                
                  <li><a href="cara_pemesanan">Cara Pemesanan</a></li>
                  <li><a href="cara_pembayaran">Syarat Dan Ketentuan</a></li>
                  </li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>       
    </div>
  </section>
  <!-- / menu -->