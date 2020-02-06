<?php 
//General Controller
include "../General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "../model/General_Model.php";
$gen_model      = new General_Model();

//Model Pemesanan
include "model/konfirmasi.php";
$md_konfirmasi      = new konfirmasi();

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
  include "view/konfirmasi.php";
  include "view/footer.php";
}
else if($act=="edit" and $id_parameter!=""){
	$edit = $gen_model->GetOneRow('pembayaran',array('Id_Pembayaran'=>$gen_controller->decrypt($id_parameter))); 
	foreach($edit as $key=>$val){
	  $key=strtolower($key);
	  $$key=$val;
    }
		
    $data = array('id_pembayaran'=>$gen_controller->encrypt($id_pembayaran),'no_invoice'=>$no_invoice,'no_pesan'=>$no_pesan,'email'=>$email,'jumlah_bayar'=>$jumlah_bayar,'status'=>$status,'gambar'=>$basepath."assets/img/bukti/".$gambar);
    echo json_encode($data); 
}
else if($act=="do_update"){
  if(!empty($_SESSION['user_id'])){ 
        //Proses
          $update_data = array();
          $update_data['status']          = addslashes($_POST['status']);
       
        //Paramater
          $where_data = array();
          $where_data['Id_Pembayaran']             = $gen_controller->decrypt($_POST['id_parameter']);
        
        if($update_data['status']!=""){
          echo $gen_model->Update('pembayaran',$update_data,$where_data);
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
    $where_data['id_kategori']  = $gen_controller->decrypt($_POST['id_parameter']);
    echo $gen_model->Delete('kategori',$where_data);
  }
  else {
    echo 'NOT_LOGIN';
  }
}
else if($act=="list_rest"){
  $aColumns = array('pem.No_Invoice','pem.no_pesan','pem.created_date','pem.last_update','pem.Id_Pembayaran','pem.jumlah_bayar','pem.status'); //Kolom Pada Tabel  
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

	$rResult 				= $md_konfirmasi->getDataKonfirmasi($sWhere,$sOrder,$sLimit);
	$rResultFilterTotal 	= $md_konfirmasi->getCountKonfirmasi($sWhere);

	$output = array(
		"sEcho"                => (empty($input['sEcho']) ? '0' : intval($input['sEcho'])),
		"iTotalRecords"        => $rResultFilterTotal,
		"iTotalDisplayRecords" => $rResultFilterTotal,
		"aaData"               => array(),
	);

	while($aRow = $rResult->FetchRow()){

		$param_id = $gen_controller->encrypt($aRow['Id_Pembayaran']);
		$edit = '<button data-toggle="modal" data-target="#edit_modal" type="button" onclick=do_edit(\''.$param_id.'\') class="btn btn-gradient-primary btn-rounded btn-icon"><i class="mdi mdi-pencil"></i></button>';
		$delete = '&nbsp; <button  type="button" onclick=do_delete(\''.$param_id.'\') class="btn btn-gradient-danger btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button>';

		$edit_delete = "<center>".$edit.$delete."</center>";
	 	$row = array();
	 	$row = array($aRow['No_Invoice'],$aRow['no_pesan'],$aRow['email'],$aRow['jumlah_bayar'],$gen_controller->get_date_indonesia($aRow['created_date'])." ".substr($aRow['created_date'],10,9),"<a target='_blank' id='single_image' href='".$basepath."assets/img/bukti/".$aRow['gambar']."'><button  class='btn btn-gradient-primary'><i class='mdi mdi-panorama'></i></button></a>","<center>".$edit_delete."</center>");
		$output['aaData'][] = $row;
	}
	echo json_encode($output);
}
else {
	$gen_controller->response_code(http_response_code());
}
?>