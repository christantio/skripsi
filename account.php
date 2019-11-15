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

if($act=="" or $act==null) {
  //View
	include "view/header.php";
	include "view/account.php";
	include "view/footer.php";
}
else if($act=="do_add"){
 	 
	//Proses
  /*   $insert_data = array();
    $insert_data['nama_lengkap']          = 
    $insert_data['username']           	  = addslashes($_POST['email']);
    $insert_data['created_date']          = 
    $insert_data['last_update']           = $date_now_indo_full; */
			
    if($_POST['nama']!=""){
        $qry = "INSERT INTO login (username,password,nama_lengkap,email,created_date,last_update) VALUES ('".addslashes($_POST['email'])."','".hash('crc32b',$_POST['password'])."','".addslashes($_POST['nama'])."','".addslashes($_POST['email'])."','".$date_now_indo_full."','".$date_now_indo_full."')";
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
										<p>Akun anda sudah berhasil dibuat. Silahkan klik login untuk masuk ke halaman beranda anda</p>
										<p><button class=\"btn btn-inverse\" onClick=history.back(-1);>&laquo; Kembali</button></p>
									</div>
								</div>
							</div>
						</div>
						<!-- end panel -->
					</div>
				</div>
				</p>
				";	
		} 
    }
    else {
        echo 'Terjadi kesalahan';
    }
}

?>