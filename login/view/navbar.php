<!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="home"><img src="<?php echo $basepath ?>assets/images/<?php echo $web['logo']?>" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="home"><img src="<?php echo $basepath ?>assets/images/<?php echo $web['logo']?>" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <span class="d-none d-md-inline">Admin Area</span>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile">
            <a class="nav-link">
                <p class="mb-0"><?php echo $my_usr['nama_lengkap'] ?></p>
             
               <!-- <div class="nav-profile-img">
               <img src="<?php //echo $basepath_admin ?>assets/images/faces/face7.jpg" alt="image">
                <span class="availability-status online"></span>            
              </div> -->
            </a>
          </li>
          <li class="nav-item nav-logout d-none d-lg-block">
            <a class="nav-link" href="<?php echo $basepath_admin ?>auth/logout">
              Keluar
              <i class="mdi mdi-power"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->