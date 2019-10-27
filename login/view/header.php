<?php 
$web = $gen_model->GetOneRow('web'); 
$data_my_usr = $md_user->getDetailDataUser('id_user',$_SESSION['user_id']);
$my_usr = array();
while($list_usr = $data_my_usr->FetchRow()){
    foreach($list_usr as $key=>$val){
        $key=strtolower($key);
        $$key=$val;
        $my_usr[$key]=$val;
      }  

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="<?php echo $basepath_admin ?>assets/plugin/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo $basepath_admin ?>assets/plugin/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?php echo $basepath_admin ?>assets/plugin/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="<?php echo $basepath_admin ?>assets/css/style.css">
    <link rel="shortcut icon" href="<?php echo $basepath ?>assets/images/<?php echo $web['favicon']?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo $basepath ?>assets/js/sweetalert2/dist/sweetalert2.min.css">
    <script src="<?php echo $basepath_admin ?>assets/plugin/js/vendor.bundle.base.js"></script>
    <script src="<?php echo $basepath_admin ?>assets/plugin/js/vendor.bundle.addons.js"></script>
    <script src="<?php echo $basepath ?>assets/js/rupiah.js"></script>

    
   
</head>
<body>
<div class="container-scroller">
        <?php  include "view/navbar.php"; ?>
    <div class="container-fluid page-body-wrapper">
        <?php include "view/menu.php"; ?>
        <div class="main-panel">
            