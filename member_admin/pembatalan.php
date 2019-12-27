<?php 
//General Controller
include "../General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "../model/General_Model.php";
$gen_model      = new General_Model();

//Model User
include "../model/user.php";
$md_user      = new user();

//Model User
include "model/pembatalan.php";
$md_pembatalan      = new pembatalan();

//Check Session
session_start();

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
	include "view/pembatalan.php";
	include "view/footer.php";
}
else if($act=="export"){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Pembatalan.xls");
	echo "<style>
		table.report {
		border-width: 1px;
		border-spacing: ;
		border-style: solid;
		border-color: 000000;
		border-collapse: collapse;
		background-color: white;
		width:95%;
		}
		
		table.report tr {
		
		background-color:#FFFFFF;
		
		}
		table.report th {
		background-color:#FFFFFF;
		color:#000000;
		border-width: 1px;
		padding: 5px;
		border-style: solid;
		border-color: #000000;
		}
		table.report td {
		border-width: 1px;
		padding: 3px;
		border-style: SOLID;
		border-color: #000000;
		background-color: #FFFFFF;
		-moz-border-radius: ;
		}
	</style>";
	echo "<table width=150% cellpadding=0 cellspacing=0 border=0 class=report>
		<tr>
		<th>No</th>
		<th>No Invoice</th>
		<th>No Pesanan</th>
		<th>Produk</th>
		<th>Jumlah</th>
		<th>Tanggal Claim</th>
		<th>Status</th>
		<th>Keterangan</th>
	  </tr>";
	   $sql = "SELECT * FROM claim where email = '".$_SESSION['email']."'";		
	   $rs  = $db->Execute($sql);
	   $no = 0;
	   while($aRow = $rs->FetchRow()){
		   foreach ($aRow as $key=>$val) {
				$key = strtolower($key);
				$$key = $val;
			}
			
			$nama_produk=$db->getOne("SELECT c.nama_produk FROM `pesanan` as a left join pesanan_detail b on a.no_pesanan = b.no_pesanan left join produk c on b.id_produk = c.id_produk where a.no_pesanan = '$no_pesan'");
			
			if ($status == "1"){
				$nm_status = "Pending";
			}else if ($status == "2"){
				$nm_status = "Sukses";
			}else if ($status == "3"){
				$nm_status = "Ditolak";
			}else {
				$nm_status = "";
			}	
			
		 echo "<tr>
			<td>".++$no."</td>
			<td>".$no_invoice."</td>
			<td>".$no_pesan."</td>
			<td>".$nama_produk."</td>
			<td>".$gen_controller->ribuan($jumlah_claim)."</td>
			<td>".$created_date."</td>
			<td>".$nm_status."</td>
			<td>".$keterangan."</td>
		   </tr>";
		   
	   }
}
?>