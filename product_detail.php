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

if ($act=="do_add"){
	
	$strSQL	= "select cast(substr(no_pesanan,1,4) as int)+1 as nomerurut from pesanan_detail where id_pesanan_detail is not null and year(created_date)=year(CURRENT_DATE()) order by cast(substr(no_pesanan,1,4) as int) desc ";
	$result	= $db->SelectLimit($strSQL,1,0);
	if (!$result) echo $db->ErrorMsg();
	$row = $result->FetchRow();
	$nomor = $row["nomerurut"];
	if(empty($nomor)) $nomor="1";
	//26 aug 2010. kalau primary key-nya lebih dari 999 ganti prefix incremental 1 letter
	$nomor=sprintf("%04d",$nomor);
	$curYear = date('Y');
	$no_pesanan = "PSN-".$nomor."";	
	//$qry = "INSERT INTO pesanan_detail (no_pesanan,id_produk,email,kuantitas,harga_list) Values ('".$no_pesanan."','".$id_parameter."')";
	$qry = "INSERT INTO pesanan_detail (no_pesanan,id_produk,email) Values ('".$no_pesanan."','".$id_parameter."','cristantio123@gmail.com')";
	$result=$db->execute($qry);
	
	$gen_controller->redirect('checkout');
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