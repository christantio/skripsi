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
include "model/profile.php";
$md_profile      = new profile();

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
	include "view/profile.php";
	include "view/footer.php";
}
else if($act=="do_update"){
	
  if(!empty($_SESSION['user_id'])){ 
	   //UPload
   	   $tmp = $_FILES["gambar"]["tmp_name"];
	   $foto_asal = $_FILES['gambar']['name'];
	   $foto_name = date("ymdhis")."_profile_".$foto_asal;
	   $path      = "../assets/img/man/";
	   
	   $tanggal_array=explode("\/", $_POST['tgl_lahir']);
        
        if($_POST['nama']!=""){
			
			$qry = "UPDATE login SET nama_lengkap='".addslashes($_POST['nama'])."',alamat='".addslashes($_POST['alamat'])."',tgl_lahir='".$tanggal_array[0]."',gambar='".$foto_name."',
			created_date='".$date_now_indo_full."',last_update='".$date_now_indo_full."' where email = '".$_SESSION['email']."' ";
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
else {
	$gen_controller->response_code(http_response_code());
}


?>