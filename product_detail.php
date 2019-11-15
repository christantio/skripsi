<?php 
//General Controller
include "General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "model/General_Model.php";
$gen_model      = new General_Model();
$act="";
if(isset($_GET['act'])){
    $act = $_GET['act'];
}

$id_parameter="";
if(isset($_GET['id_parameter'])){
     $id_parameter =$_GET['id_parameter'];
}

if ($act==""){
	
}else {
	
$web = $gen_model->GetOneRow('produk',array('Id_Produk'=>$id_parameter));
foreach($web as $key=>$val){
  $key=strtolower($key);
  $$key=$val;
}

//View
include "view/header.php";
include "view/product_detail.php";
include "view/footer.php";
}
?>