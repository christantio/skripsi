<?php 
//General Controller
include "General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "model/General_Model.php";
$gen_model      = new General_Model();

echo "
		<link href=\"".$basepath."assets/css/bootstrap.css\" rel=\"stylesheet\" />
		<link href=\"".$basepath."assets/css/font-awesome.css\" rel=\"stylesheet\" />
		<link href=\"".$basepath."assets/css/style.css\" rel=\"stylesheet\" />
";

//Model User
include "model/user.php";
$md_user      = new user();

//Check Session
session_start();

if(!empty($_SESSION['email'])){
	$email = $_SESSION['email'];
}else{
	$email = "";
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

if($act=="" or $act==null) {
  //View
	include "view/header.php";
	include "view/checkout.php";
	include "view/footer.php";
}else if($act=="lanjut"){
	foreach ($_POST as $key=>$val) {
		$key=strtolower($key);
		$$key=htmlspecialchars($val,ENT_QUOTES);
		$HTTP_POST_VARS[$key]=htmlspecialchars($val,ENT_QUOTES);
		$_POST[$key]=htmlspecialchars($val,ENT_QUOTES);
	}
	
	$sql_delete="delete from pesanan_detail where email='$email' and status ='1'";
	$delete_berkas=$db->Execute($sql_delete);
	for ($a=1; $a <= $jumlah_pesanan; $a++) {
		$no_pesanan="no_pesanan_".$a;
		$id_produk="id_produk_".$a;
		$hitung="hitung_".$a;
		$total="total_".$a;
		
		$no_pesanan = $$no_pesanan;
		$id_produk = $$id_produk;
		$hitung = $$hitung;
		$total = $$total;
		
		$qry = "INSERT INTO pesanan_detail (no_pesanan,id_produk,email,kuantitas,harga_list,status,created_date) Values ('".$no_pesanan."','".$id_produk."','$email','$hitung','$total','1','".$date_now_indo_full."')";
		$result=$db->execute($qry);
		
	}
	
	$gen_controller->redirect('pembayaran');
	
}else if($act=="delete"){
	$id_parameter= $_GET['id_parameter']; 
	$sql_delete="delete from pesanan_detail where id_pesanan_detail ='".$id_parameter."'";
	$delete_berkas=$db->Execute($sql_delete);
	
	echo "
				<p align=center>
				<div class=\"row\">
					<div class=\"col-md-6 col-md-offset-3\">
						<!-- begin panel -->
						<div class=\"panel panel-info\" data-sortable-id=\"ui-widget-12\">
							<div class=\"panel-heading\">
								<h4 class=\"panel-title\">Info</h4>
							</div>
							<div class=\"panel-body bg-aqua text-white\">
								<div class=\"row\">
									<div class=\"col-md-2\">
										<i class=\"fa fa-info-circle fa-3x\" aria-hidden=\"true\"></i>
									</div>
									<div class=\"col-md-10\">
										<p>Pesanan Telah berhasil dihapus</p>
										<p><button class=\"btn btn-inverse\" onClick=location.href='checkout'>&laquo; Kembali</button></p>
									</div>
								</div>
							</div>
						</div>
						<!-- end panel -->
					</div>
				</div>
				</p>
				";
				die();
}
?>