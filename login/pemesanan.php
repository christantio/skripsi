<?php 
//General Controller
include "../General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "../model/General_Model.php";
$gen_model      = new General_Model();

//Model Kritik Saran
include "model/pemesanan.php";
$md_psn      = new pemesanan();

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
else if($act=="detail" and $id_parameter!=""){
    $detail = $gen_model->GetWhere('pesanan',array('no_pesanan'=>$id_parameter));
	$i=1;
}
else if($act=="update_status"){
  if(!empty($_SESSION['user_id'])){ 
        //Proses
          $update_data = array();
          $update_data['status']          = addslashes($_POST['status']);
          $update_data['last_update']     = $date_now_indo_full;
       
        //Paramater
          $where_data = array();
          $where_data['id_pesanan']             = $gen_controller->decrypt($_POST['id_parameter']);
        
        if($update_data['status']!=""){
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
else if($act=="edit" and $id_parameter!=""){
    $edit = $gen_model->GetOneRow('pesanan',array('id_pesanan'=>$gen_controller->decrypt($id_parameter))); 
    foreach($edit as $key=>$val){
                  $key=strtolower($key);
                  $$key=$val;
    }
    $count = $gen_model->GetOne('count(*)','pesanan_detail',array('no_pesanan'=>$no_pesanan)); 

	$color ="";
	if($status=="1"){
		$color = "orange";	
	}
	else if($status=="3"){
		$color = "red";
	}
	else{
		$color = "green";
	}
	$mystatus = "<span style='color:".$color."'>".$status."</span>";


    $data = array('id_pesanan'=>$gen_controller->encrypt($id_pesanan),'tipe'=>$tipe,'status'=>$mystatus,'no_order'=>$no_pesanan,'nama'=>ucwords(strtolower($nama)),'email'=>ucwords(strtolower($email)),'tlp'=>$no_tlp,'alamat'=>ucwords(strtolower($alamat)),'jadwal'=>$gen_controller->get_date_indonesia($jadwal_service)." ".substr($jadwal_service,10,6),'biaya'=>"Rp. ".$gen_controller->to_rupiah($total_biaya),'tgl_pesan'=>$gen_controller->get_date_indonesia($created_date)." ".substr($created_date,10,9),'unit'=>$count,'status2'=>$status);
    echo json_encode($data); 
}
else if($act=="do_delete"){
  if(!empty($_SESSION['user_id'])){ 
    //Paramater
    $where_data = array();
    $where_data['id_pesanan']  = $gen_controller->decrypt($_POST['id_pesanan']);
    echo $gen_model->Delete('pesanan',$where_data);
  }
  else {
    echo 'NOT_LOGIN';
  }
}
else if($act=="list_rest"){
  $aColumns = array('ps.no_pesanan','ps.status','ps.nama','ps.email'); //Kolom Pada Tabel

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

  $rResult        = $md_psn->getDataPemesanan($sWhere,$sOrder,$sLimit);
  $rResultFilterTotal   = $md_psn->getCountPemesanan($sWhere);


  $output = array(
    "sEcho"                => (empty($input['sEcho']) ? '0' : intval($input['sEcho'])),
    "iTotalRecords"        => $rResultFilterTotal,
    "iTotalDisplayRecords" => $rResultFilterTotal,
    "aaData"               => array(),
  );

  while($aRow = $rResult->FetchRow()){

    $param_id = $gen_controller->encrypt($aRow['id_pesanan']);
    $edit = '<button data-toggle="modal"  type="button" onclick=report(\''.$aRow['no_pesanan'].'\') class="btn btn-gradient-success btn-rounded btn-icon"><i class="mdi mdi-printer"></i></button> &nbsp; <button data-toggle="modal" data-target="#edit_modal" type="button" onclick=do_edit(\''.$param_id.'\') class="btn btn-gradient-primary btn-rounded btn-icon"><i class="mdi mdi-file"></i></button> &nbsp;
      <button data-toggle="modal" data-target="#status_modal" type="button" onclick=do_status(\''.$param_id.'\') class="btn btn-gradient-warning btn-rounded btn-icon"><i class="mdi mdi-check"></i></button>';
    $delete = '&nbsp; <button  type="button" onclick=do_delete(\''.$param_id.'\') class="btn btn-gradient-danger btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button>';

    $edit_delete = "<center>".$edit."</center>";
    $row = array();

      $count = $gen_model->GetOne('count(*)','pesanan_detail',array('no_pesanan'=>$aRow['no_pesanan'])); 

      $color ="";
      if($aRow['status']=="1"){
        $color = "orange";  
      }
      else if($aRow['status']=="3"){
        $color = "red";
      }
      else{
        $color = "green";
      }
      $status = "<span style='color:".$color."'>".$aRow['status']."</span>";

    $row = array($aRow['no_pesanan'],$status,ucwords(strtolower($aRow['nama'])),$aRow['no_tlp'],ucwords(strtolower($aRow['email'])),"<center>".$count."</center>","Rp. ".$gen_controller->to_rupiah($aRow['total_biaya']),$gen_controller->get_date_indonesia($aRow['created_date'])." ".substr($aRow['created_date'],10,9),"<center>".$edit_delete."</center>");
    $output['aaData'][] = $row;
  }
  echo json_encode($output);
}

else if($act=="list_rest_today"){
  $aColumns = array('ps.no_pesanan','ps.tipe','ps.status','ps.nama','ps.no_tlp','ps.email','ps.id_pesanan as unit','ps.total_biaya','ps.jadwal_service','ps.created_date','ps.id_pesanan'); //Kolom Pada Tabel

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

	$rResult 				= $md_psn->getDataPemesananToday($sWhere,$sOrder,$sLimit);
	$rResultFilterTotal 	= $md_psn->getCountPemesananToday($sWhere);


	$output = array(
		"sEcho"                => (empty($input['sEcho']) ? '0' : intval($input['sEcho'])),
		"iTotalRecords"        => $rResultFilterTotal,
		"iTotalDisplayRecords" => $rResultFilterTotal,
		"aaData"               => array(),
	);

	while($aRow = $rResult->FetchRow()){

		$param_id = $gen_controller->encrypt($aRow['id_pesanan']);
		$edit = '<button data-toggle="modal"  type="button" onclick=report(\''.$aRow['no_pesanan'].'\') class="btn btn-gradient-success btn-rounded btn-icon"><i class="mdi mdi-printer"></i></button> &nbsp; <button data-toggle="modal" data-target="#edit_modal" type="button" onclick=do_edit(\''.$param_id.'\') class="btn btn-gradient-primary btn-rounded btn-icon"><i class="mdi mdi-file"></i></button> &nbsp;
			<button data-toggle="modal" data-target="#status_modal" type="button" onclick=do_status(\''.$param_id.'\') class="btn btn-gradient-warning btn-rounded btn-icon"><i class="mdi mdi-check"></i></button>';
		$delete = '&nbsp; <button  type="button" onclick=do_delete(\''.$param_id.'\') class="btn btn-gradient-danger btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button>';

		$edit_delete = "<center>".$edit."</center>";
	 	$row = array();

    	$count = $gen_model->GetOne('count(*)','pesanan_detail',array('no_pesanan'=>$aRow['no_pesanan'])); 

    	$color ="";
    	if($aRow['status']=="Pending"){
    		$color = "orange";	
    	}
    	else if($aRow['status']=="Cancel"){
    		$color = "red";
    	}
    	else{
    		$color = "green";
    	}
    	$status = "<span style='color:".$color."'>".$aRow['status']."</span>";

	 	$row = array($aRow['no_pesanan'],$aRow['tipe'],$status,ucwords(strtolower($aRow['nama'])),$aRow['no_tlp'],ucwords(strtolower($aRow['email'])),"<center>".$count."</center>","Rp. ".$gen_controller->to_rupiah($aRow['total_biaya']),$gen_controller->get_date_indonesia($aRow['jadwal_service'])." ".substr($aRow['jadwal_service'],10,6),$gen_controller->get_date_indonesia($aRow['created_date'])." ".substr($aRow['created_date'],10,9),"<center>".$edit_delete."</center>");
		$output['aaData'][] = $row;
	}
	echo json_encode($output);
}
else {
	$gen_controller->response_code(http_response_code());
}
?>