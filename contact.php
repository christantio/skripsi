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

if($act=="" or $act==null) {
  //View
	include "view/header.php";
	include "view/contact.php";
	include "view/footer.php";
}
else if($act=="do_add"){
	$insert_data = array();
    $insert_data['nama']            	= addslashes($_POST['nama']);
    $insert_data['email']               = addslashes($_POST['email']);
    $insert_data['no_hp']               = addslashes($_POST['contact']);
    $insert_data['pesan']               = addslashes($_POST['pesan']);
    $insert_data['created_date']        = $date_now_indo_full;

    if($insert_data['nama']!=""){
        echo $gen_model->Insert('kritik_saran',$insert_data);
    }
    else {
        echo 'Terjadi kesalahan';
    }
}
?>