<?php 
//General Controller
include "General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "model/General_Model.php";
$gen_model      = new General_Model();

session_start();
if(!empty($_SESSION['email'])){
	$email = $_SESSION['email'];
	$username = $_SESSION['username'];
}else{
	$email = "";
	$username = "";
}

$web = $gen_model->GetOneRow('web');



$act="";
if(isset($_GET['act'])){
    $act = $_GET['act'];
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
	$insert_data['email_session']       = $email;
    
	if($insert_data['nama']!=""){
        echo $gen_model->Insert('anggota_lain',$insert_data);
    }
	
	if (isset($_POST['radio1']))   // if ANY of the options was checked
		$radio=$_POST['radio1'];    // echo the choice
	else
		$radio = "";
	
	$strSQL	= "select * from pesanan_detail where email = '$email' and status ='1' ";
	$result	= $db->Execute($strSQL);
	while($row = $result->fetchrow()){ 
	foreach($row as $key=>$val){
		$key  = strtolower($key);
		$$key = $val;
	}
	
	$qry = "INSERT INTO pesanan (no_pesanan,nama,email,status,total_biaya,tanggal_pesan,jns_pembayaran,jml_cicilan,jml_bulan,metode_bayar,jumlah_dp,created_date) Values ('".$no_pesanan."','".$username."','".$email."','1','".$_POST['jml_pinjaman']."','".$date_now_indo_full."','".$radio."','".str_replace(".","",$_POST['jml_cicilan_dp'])."','".str_replace(".","",$_POST['jml_bln_dp'])."','".$_POST['metode_pembayaran']."','".str_replace(".","",$_POST['jml_cicilan1'])."','".$date_now_indo_full."')";
	$result=$db->execute($qry);
	}
	
	$update_detail = "update pesanan_detail set status = '2' where email='$email' and status='1'";
	$result_update	= $db->Execute($update_detail);
	
	$gen_controller->redirect('member_admin/index');

	
}else {
	//View
	include "view/header.php";
	include "view/pembayaran.php";
	include "view/footer.php";
}
?>