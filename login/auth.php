<?php
//General Controller
include "../General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "../model/General_Model.php";
$gen_model      = new General_Model();

//Model User
include "model/user.php";
$md_user      = new user();

$act="";
if(isset($_GET['do_act'])){
    $act = $_GET['do_act'];
}

$id_parameter="";
if(isset($_GET['id_parameter'])){
        $id_parameter =$_GET['id_parameter'];
}

if($act=="" or $act==null) {
  $pwd  = hash('crc32b',$_POST['password']);

  $usr = $md_user->login($_POST['username'],$pwd);
  if(!empty($usr['username'])){
    session_start();
    $_SESSION['user_id']      = $usr['id_user'];
    $_SESSION['username']     = $usr['username'];
    $_SESSION['email']        = $usr['email']; 
    $_SESSION['nama_lengkap'] = $usr['nama_lengkap']; 
    echo "OK";
  }
  else {
    session_start();
    session_destroy();
    echo 'Username / Email / Password Salah';
  }
}
else if($act=="logout"){
  session_start();
  session_destroy();
  $gen_controller->redirect('login');
}
else {
	$gen_controller->response_code(http_response_code());
}
?>