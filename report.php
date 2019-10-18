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

if($id_parameter!=""){
	//View
	include "view/report.php";
}else {
    $gen_controller->redirect('.');
}
?>