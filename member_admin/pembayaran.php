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
include "model/pembayaran.php";
$md_pembayaran      = new pembayaran();

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
	include "view/pembayaran.php";
	include "view/footer.php";
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
else if($act=="do_bayar"){
	if(!empty($_SESSION['user_id'])){ 
	   //UPload
   	   $tmp = $_FILES["gambar"]["tmp_name"];
	   $foto_asal = $_FILES['gambar']['name'];
	   $foto_name = date("ymdhis")."_profile_".$foto_asal;
	   $path      = "../assets/img/man/";
	   
	   $tanggal_array=explode("\/", $_POST['tgl_lahir']);
        
        if($_POST['nama']!=""){
			
			$qry = "INSERT INTO PEMBAYARAN () VALUES ()";
			$result=$db->execute($qry);
			
			if ($foto_name!=""){
				$gen_controller->upload_file($tmp,$path,$foto_name);
			}
			
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
										<p><button class=\"btn btn-inverse\" onClick=location.href='profile'>&laquo; Kembali</button></p>
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
    $edit = $gen_model->GetOneRow('produk',array('Id_Produk'=>$gen_controller->decrypt($id_parameter))); 
	foreach($edit as $key=>$val){
	  $key=strtolower($key);
	  $$key=$val;
    }
    $data = array('id_parameter'=>$id_parameter,'nama_produk'=>$nama_produk,'stock'=>$stock,'harga'=>$harga,'kategori'=>$kategori,'vendor'=>$vendor,'keterangan'=>$keterangan,'gambar'=>$basepath."assets/img/produk/".$gambar);
    echo json_encode($data); 
}
else if($act=="bayar"){
	 //View
	include "view/header.php";
	include "view/pembayaran_bayar.php";
	include "view/footer.php";
}
else {
	$gen_controller->response_code(http_response_code());
}


?>