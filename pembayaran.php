<?php 
//General Controller
include "General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "model/General_Model.php";
$gen_model      = new General_Model();


$web = $gen_model->GetOneRow('web');



$act="";
if(isset($_GET['do_act'])){
    $act = $_GET['do_act'];
}

$id_parameter="";
if(isset($_GET['id_parameter'])){
        $id_parameter =$_GET['id_parameter'];
}
if($act=="do_add"){
	$insert_data = array();
    $insert_data['nama']            	= addslashes($_POST['nama']);
    $insert_data['email']               = addslashes($_POST['email']);
    $insert_data['phone']               = addslashes($_POST['phone']);
    $insert_data['alamat']              = addslashes($_POST['alamat']);
    $insert_data['keterangan']          = addslashes($_POST['keterangan']);

    if($insert_data['nama']!=""){
        echo $gen_model->Insert('anggota_lain',$insert_data);
    }
    else {
        echo 'Terjadi kesalahan';
    }
}else {
	//View
	include "view/header.php";
	include "view/pembayaran.php";
	include "view/footer.php";
}
?>