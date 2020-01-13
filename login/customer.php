<?php 
//General Controller
include "../General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "../model/General_Model.php";
$gen_model      = new General_Model();

//Model customer
include "model/customer.php";
$md_customer      = new customer();

//Model User
include "model/user.php";
$md_user      = new user();

//Check Session
session_start();
if(empty($_SESSION['username'])){
  $gen_controller->redirect('');
}

$act="";
if(isset($_GET['do_act'])){
    $act = $_GET['do_act'];
}

$id_parameter="";
if(isset($_GET['id_parameter'])){
        $id_parameter =$_GET['id_parameter'];
}

if($act=="" or $act==null) {
  //View
  include "view/header.php";
  include "view/customer.php";
  include "view/footer.php";
}
else if($act=="edit" and $id_parameter!=""){
	$edit = $gen_model->GetOneRow('login',array('id_user'=>$gen_controller->decrypt($id_parameter))); 
	foreach($edit as $key=>$val){
		  $key=strtolower($key);
		  $$key=$val;
    }
    $data = array('id_user'=>$gen_controller->encrypt($id_user),'username'=>$username,'email'=>$email,'nama_lengkap'=>$nama_lengkap,'alamat'=>$alamat,'gambar'=>$basepath."assets/img/man/".$gambar,"tgl_lahir"=>$tgl_lahir);
    echo json_encode($data); 
}
else if($act=="do_update"){
  if(!empty($_SESSION['user_id'])){ 
		//UPload
		  $tmp = $_FILES["gambar"]["tmp_name"];
		  $foto_asal = $_FILES['gambar']['name'];
		  $foto_name = date("ymdhis")."_profile_".$foto_asal;
		  $path      = "../assets/img/man/";

		  $tanggal_array=explode("\/", $_POST['tgl_lahir']);
	   
        //Proses
          $update_data = array();
          $update_data['username']       = addslashes($_POST['username']);
          $update_data['email']          = addslashes($_POST['email']);
          $update_data['nama_lengkap']   = addslashes($_POST['nama_lengkap']);
          $update_data['alamat']         = addslashes($_POST['alamat']);
          $update_data['last_update']    = $date_now_indo_full;
		  $update_data['gambar']	     = $foto_name; 	
		  $update_data['tgl_lahir']	     = $tanggal_array; 	
	   
        //Paramater
          $where_data = array();
          $where_data['id_user']             = $gen_controller->decrypt($_POST['id_parameter']);
        
        if($update_data['username']!=""){
          echo $gen_model->Update('login',$update_data,$where_data);
        }
        else {
          echo 'Terjadi kesalahan';
        }
  }
  else {
    echo 'NOT_LOGIN';
  }
}
else if($act=="do_delete"){
  if(!empty($_SESSION['user_id'])){ 
    //Paramater
    $where_data = array();
    $where_data['id_user']  = $gen_controller->decrypt($_POST['id_parameter']);
    echo $gen_model->Delete('login',$where_data);
  }
  else {
    echo 'NOT_LOGIN';
  }
}
else if($act=="list_rest"){
  $aColumns = array('cs.username','cs.created_date','cs.id_user','cs.nama_lengkap','cs.email','cs.tgl_lahir','cs.alamat','cs.gambar'); //Kolom Pada Tabel  
  	// Input method (use $_GET, $_POST or $_REQUEST)
	$input =& $_POST;
	$iColumnCount = count($aColumns);
	
	$sLimit = $gen_controller->Paging($input);
	
	$sOrder = $gen_controller->Ordering($input, $aColumns );
	$sWhere = $gen_controller->Filtering($aColumns, $iColumnCount, $input);
	$aQueryColumns = array();
	foreach ($aColumns as $col) {
		if ($col != ' ') {
			$aQueryColumns[] = $col;
		}
	}

	$rResult 				= $md_customer->getDataCustomer($sWhere,$sOrder,$sLimit);
	$rResultFilterTotal 	= $md_customer->getCountCustomer($sWhere);


	$output = array(
		"sEcho"                => (empty($input['sEcho']) ? '0' : intval($input['sEcho'])),
		"iTotalRecords"        => $rResultFilterTotal,
		"iTotalDisplayRecords" => $rResultFilterTotal,
		"aaData"               => array(),
	);

	while($aRow = $rResult->FetchRow()){

		$param_id = $gen_controller->encrypt($aRow['id_user']);
		$edit = '<button data-toggle="modal" data-target="#edit_modal" type="button" onclick=do_edit(\''.$param_id.'\') class="btn btn-gradient-primary btn-rounded btn-icon"><i class="mdi mdi-pencil"></i></button>';
		$delete = '&nbsp; <button  type="button" onclick=do_delete(\''.$param_id.'\') class="btn btn-gradient-danger btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button>';

		$edit_delete = "<center>".$edit.$delete."</center>";
	 	$row = array();
	 	$row = array($aRow['username'],$aRow['email'],$aRow['nama_lengkap'],$gen_controller->get_date_indonesia($aRow['tgl_lahir'])." ".substr($aRow['tgl_lahir'],10,9),$aRow['alamat'],$gen_controller->get_date_indonesia($aRow['created_date'])." ".substr($aRow['created_date'],10,9),"<a target='_blank' id='single_image' href='".$basepath."assets/img/man/".$aRow['gambar']."'><button  class='btn btn-gradient-primary'><i class='mdi mdi-panorama'></i></button></a>","<center>".$edit_delete."</center>");
		$output['aaData'][] = $row;
	}
	echo json_encode($output);
}
else {
	$gen_controller->response_code(http_response_code());
}
?>