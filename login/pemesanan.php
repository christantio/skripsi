<?php 
//General Controller
include "../General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "../model/General_Model.php";
$gen_model      = new General_Model();

//Model Pemesanan
include "model/pemesanan.php";
$md_pemesanan      = new pemesanan();

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
  include "view/pemesanan.php";
  include "view/footer.php";
}
else if($act=="edit" and $id_parameter!=""){
	$edit = $gen_model->GetOneRow('pesanan',array('id_pesanan'=>$gen_controller->decrypt($id_parameter))); 
	foreach($edit as $key=>$val){
	  $key=strtolower($key);
	  $$key=$val;
    }
	$kuantitas = $gen_model->GetOne('kuantitas','pesanan_detail',array('no_pesanan'=>$no_pesanan));
		
    $data = array('id_pesanan'=>$gen_controller->encrypt($id_pesanan),'no_pesanan'=>$no_pesanan,'nama'=>$nama,'email'=>$email,'kuantitas'=>$kuantitas,'total_biaya'=>$total_biaya,'status'=>$status);
    echo json_encode($data); 
}
else if($act=="do_update"){
	if(!empty($_SESSION['user_id'])){ 
        //Proses
          $update_data = array();
          $update_data['status']          = addslashes($_POST['status1']);
          $update_data['last_update']    = $date_now_indo_full;
       
        //Paramater
          $where_data = array();
          $where_data['id_pesanan']             = $gen_controller->decrypt($_POST['id_parameter']);
        
        if($_POST['no_pesanan']!=""){
          echo $gen_model->Update('pesanan',$update_data,$where_data);
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
  $aColumns = array('ps.no_pesanan','ps.created_date','ps.last_update','ps.id_pesanan','ps.status','ps.nama','ps.email','ps.total_biaya','ps.tanggal_pesan','ps.jns_pembayaran'); //Kolom Pada Tabel  
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

	$rResult 				= $md_pemesanan->getDataPemesanan($sWhere,$sOrder,$sLimit);
	$rResultFilterTotal 	= $md_pemesanan->getCountPemesanan($sWhere);

	$output = array(
		"sEcho"                => (empty($input['sEcho']) ? '0' : intval($input['sEcho'])),
		"iTotalRecords"        => $rResultFilterTotal,
		"iTotalDisplayRecords" => $rResultFilterTotal,
		"aaData"               => array(),
	);

	while($aRow = $rResult->FetchRow()){

	$param_id = $gen_controller->encrypt($aRow['id_pesanan']);
		$edit = '<button data-toggle="modal" data-target="#edit_modal" type="button" onclick=do_edit(\''.$param_id.'\') class="btn btn-gradient-primary btn-rounded btn-icon"><i class="mdi mdi-pencil"></i></button>';
		$delete = '&nbsp; <button  type="button" onclick=do_delete(\''.$param_id.'\') class="btn btn-gradient-danger btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button>';

		$edit_delete = "<center>".$edit.$delete."</center>";
	 	if ($aRow['status'] == "1"){
			$nm_sts = "Pending";		
		}else if ($aRow['status'] == "2"){
			$nm_sts = "Sukses";
		}else if ($aRow['status'] == "3"){
			$nm_sts = "Batal";
		}
		$row = array();
		$row = array($aRow['no_pesanan'],$aRow['nama'],$aRow['email'],$aRow['kuantitas'],$aRow['total_biaya'],$gen_controller->get_date_indonesia($aRow['created_date'])." ".substr($aRow['created_date'],10,9),$nm_sts,"<center>".$edit_delete."</center>");
		$output['aaData'][] = $row;
	}
	echo json_encode($output);
}
else if($act=="list_rest_today"){
  $aColumns = array('ps.no_pesanan','ps.created_date','ps.last_update','ps.id_pesanan','ps.status','ps.nama','ps.email','ps.total_biaya','ps.tanggal_pesan','ps.jns_pembayaran'); //Kolom Pada Tabel    
  // Input method (use $_GET, $_POST or $_REQUEST)
	$input =& $_POST;
	$iColumnCount = count($aColumns);
	
	$sLimit = $gen_controller->Paging($input);	
	$sOrder = $gen_controller->Ordering($input, $aColumns);
	$sWhere = $gen_controller->Filtering($aColumns, $iColumnCount, $input);
	$aQueryColumns = array();
	foreach ($aColumns as $col) {
		if ($col != ' ') {
			$aQueryColumns[] = $col;
		}
	}

	$rResult 				= $md_pemesanan->getDataPemesanan($sWhere,$sOrder,$sLimit);
	$rResultFilterTotal 	= $md_pemesanan->getCountPemesanan($sWhere);

	$output = array(
		"sEcho"                => (empty($input['sEcho']) ? '0' : intval($input['sEcho'])),
		"iTotalRecords"        => $rResultFilterTotal,
		"iTotalDisplayRecords" => $rResultFilterTotal,
		"aaData"               => array(),
	);

	while($aRow = $rResult->FetchRow()){

		$param_id = $gen_controller->encrypt($aRow['id_pesanan']);
		$edit = '<button data-toggle="modal" data-target="#edit_modal" type="button" onclick=do_edit(\''.$param_id.'\') class="btn btn-gradient-primary btn-rounded btn-icon"><i class="mdi mdi-pencil"></i></button>';
		$delete = '&nbsp; <button  type="button" onclick=do_delete(\''.$param_id.'\') class="btn btn-gradient-danger btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button>';

		$edit_delete = "<center>".$edit.$delete."</center>";
		if ($aRow['status'] == "1"){
			$nm_sts = "Pending";		
		}else if ($aRow['status'] == "2"){
			$nm_sts = "Sukses";
		}else if ($aRow['status'] == "3"){
			$nm_sts = "Batal";
		}
		
	 	$row = array();
	 	$row = array($aRow['no_pesanan'],$aRow['nama'],$aRow['email'],$aRow['kuantitas'],$aRow['total_biaya'],$gen_controller->get_date_indonesia($aRow['created_date'])." ".substr($aRow['created_date'],10,9),$nm_sts,"<center>".$edit_delete."</center>");
		$output['aaData'][] = $row;
	}
	echo json_encode($output);
}
else {
	$gen_controller->response_code(http_response_code());
}
?>