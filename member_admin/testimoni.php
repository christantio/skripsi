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

//Model User
include "model/testimoni.php";
$md_testimoni      = new testimoni();

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
	include "view/testimoni.php";
	include "view/footer.php";
}
else if($act=="export"){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Pembayaran.xls");
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
			<th>Nama</th>
			<th>Isi</th>
			<th>Email</th>
			<th>Produk</th>
	     </tr>";
	   $sql = "SELECT * FROM testimoni where email = '".$_SESSION['email']."'";			   
	   $rs  = $db->Execute($sql);
	   $no=0;
	   while($aRow = $rs->FetchRow()){
		   foreach ($aRow as $key=>$val) {
				$key = strtolower($key);
				$$key = $val;
			}
		echo "<tr>
			<td>".++$no."</td>
			<td>$nama</td>
			<td>$isi</td>
			<td>$email</td>
			<td>$produk</td>
		   </tr>";
	   }
}	
else if($act=="do_add"){
  if(!empty($_SESSION['user_id'])){

	//UPload
      $tmp = $_FILES["gambar"]["tmp_name"];
      $foto_asal = $_FILES['gambar']['name'];
      $foto_name = date("ymdhis")."_produk_".$foto_asal;
      $path      = "../assets/img/produk/";
	  
	//Proses
    $insert_data = array();
    $insert_data['nama_produk']           = addslashes($_POST['nama_produk']);
    $insert_data['Kategori']           	  = addslashes($_POST['Kategori']);
    $insert_data['stock']           	  = addslashes($_POST['stock']);
    $insert_data['harga']           	  = str_replace(".","",addslashes($_POST['harga']));
    $insert_data['keterangan']            = addslashes($_POST['keterangan']);
    $insert_data['vendor']	              = addslashes($_POST['vendor']);
	if ($_POST['Kategori']=="1"){
		$insert_data['tahun']          		  = addslashes($_POST['tahun']);
		$insert_data['bulan']	              = addslashes($_POST['bulan']);
    }
	$insert_data['gambar']	              = $foto_name;
    $insert_data['created_date']          = $date_now_indo_full;
    $insert_data['last_update']           = $date_now_indo_full;
			
    if($insert_data['nama_produk']!=""){
        echo $gen_model->Insert('produk',$insert_data);
		$gen_controller->upload_file($tmp,$path,$foto_name);
		
    }
    else {
        echo 'Terjadi kesalahan';
    }
  }
  else {
    echo 'NOT_LOGIN';
  }
}
else if($act=="do_claim"){
	if(!empty($_SESSION['user_id'])){ 
	   
		$strSQL	= "select cast(substr(no_invoice,5,4) as int)+1 as nomerurut from claim where id_claim is not null and year(created_date)=year(CURRENT_DATE()) order by cast(substr(no_invoice,5,4) as int) desc ";
		$result	= $db->SelectLimit($strSQL,1,0);
		if (!$result) echo $db->ErrorMsg();
		$row = $result->FetchRow();
		$nomor = $row["nomerurut"];
		if(empty($nomor)) $nomor="1";
		//26 aug 2010. kalau primary key-nya lebih dari 999 ganti prefix incremental 1 letter
		$nomor=sprintf("%04d",$nomor);
		$no_invoice = "CLM-".$nomor."";
		$jumlah_bayar = str_replace(".","",$_POST['jml_bayar']);  
        
        if($_POST['no_pesan']!=""){			
			$qry = "INSERT INTO CLAIM (no_invoice,jumlah_claim,status,email,no_pesan,created_date,keterangan) VALUES ('$no_invoice','$jumlah_bayar','1','".$_SESSION['email']."','".$_POST['no_pesan']."','$date_now_indo_full','".$_POST['keterangan']."')";
			$result=$db->execute($qry);						
			if (!$result){
				return $db->ErrorMsg();
			}
			else{
				echo "
						<link href=\"".$basepath."assets/css/bootstrap.css\" rel=\"stylesheet\" />
						<link href=\"".$basepath."assets/css/font-awesome.css\" rel=\"stylesheet\" />
						<link href=\"".$basepath."assets/css/style.css\" rel=\"stylesheet\" />
				";
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
										<p>Data Berhasil Disimpan</p>
										<p><button class=\"btn btn-inverse\" onClick=location.href='pembatalan'>&laquo; Kembali</button></p>
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
		}
        else {
          echo 'Terjadi kesalahan';
        }
		
		
  }
  else {
    echo 'NOT_LOGIN';
  }
}
else if($act=="edit" and $id_parameter!=""){
    $edit = $gen_model->GetOneRow('testimoni',array('id_testi'=>$gen_controller->decrypt($id_parameter))); 
	foreach($edit as $key=>$val){
	  $key=strtolower($key);
	  $$key=$val;
    }
    $data = array('id_parameter'=>$id_parameter,'nama'=>$nama,'isi'=>$isi,'email'=>$email,'produk'=>$produk);
    echo json_encode($data); 
}
else if($act=="bayar"){
	 //View
	include "view/header.php";
	include "view/pembayaran_bayar.php";
	include "view/footer.php";
}
else if($act=="claim"){
	 //View
	include "view/header.php";
	include "view/pembatalan_bayar.php";
	include "view/footer.php";
}
else {
	$gen_controller->response_code(http_response_code());
}


?>