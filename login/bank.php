<?php 
//General Controller
include "../General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "../model/General_Model.php";
$gen_model      = new General_Model();

//Model Produk
include "model/bank.php";
$md_bank      = new bank();

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
  include "view/bank.php";
  include "view/footer.php";
}
else if($act=="do_add"){
  if(!empty($_SESSION['user_id'])){

	//UPload
      $tmp = $_FILES["gambar"]["tmp_name"];
      $foto_asal = $_FILES['gambar']['name'];
      $foto_name = date("ymdhis")."_bank_".$foto_asal;
      $path      = "../assets/img/bank/";
	  
	//Proses
    $insert_data = array();
    $insert_data['nama']           = addslashes($_POST['nama']);
    $insert_data['no_rek']           	  = addslashes($_POST['no_rek']);
    $insert_data['keterangan']           	  = addslashes($_POST['keterangan']);
    $insert_data['gambar']	              = $foto_name;
    $insert_data['created_date']          = $date_now_indo_full;
			
    if($insert_data['nama']!=""){
        echo $gen_model->Insert('bank',$insert_data);
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

else if($act=="edit" and $id_parameter!=""){
    $edit = $gen_model->GetOneRow('bank',array('ID_Bank'=>$gen_controller->decrypt($id_parameter))); 
	foreach($edit as $key=>$val){
	  $key=strtolower($key);
	  $$key=$val;
    }
    $data = array('ID_Bank'=>$id_parameter,'Nama'=>$nama,'No_Rek'=>$no_rek,'keterangan'=>$keterangan,'gambar'=>$basepath."assets/img/bank/".$gambar);
    echo json_encode($data); 
}
else if($act=="do_update"){
  if(!empty($_SESSION['user_id'])){ 
        //UPload
		  $tmp = $_FILES["gambar"]["tmp_name"];
		  $foto_asal = $_FILES['gambar']['name'];
		  $foto_name = date("ymdhis")."_produk_".$foto_asal;
		  $path      = "../assets/img/bank/";
	  
		//Proses
        $update_data = array();
		$update_data['nama']           = addslashes($_POST['nama']);
		$update_data['no_rek']         = addslashes($_POST['no_rek']);
		$update_data['keterangan']     = addslashes($_POST['keterangan']);
		$update_data['gambar']	       = $foto_name;
       
        //Paramater
          $where_data = array();
          $where_data['id_bank']             = $gen_controller->decrypt($_POST['id_parameter']);
        
        if($update_data['nama']!=""){
          echo $gen_model->Update('bank',$update_data,$where_data);
		  if ($update_data['gambar']!=""){
			$gen_controller->upload_file($tmp,$path,$foto_name);
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
else if($act=="do_delete"){
  if(!empty($_SESSION['user_id'])){ 
    //Paramater
    $where_data = array();
    $where_data['ID_Bank']  = $gen_controller->decrypt($_POST['id_parameter']);
    echo $gen_model->Delete('bank',$where_data);
  }
  else {
    echo 'NOT_LOGIN';
  }
}
else if($act=="list_rest"){
  $aColumns = array('bk.Nama','bk.created_date','bk.ID_Bank','bk.No_Rek','bk.Keterangan'); //Kolom Pada Tabel

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

	$rResult 				= $md_bank->getDataBank($sWhere,$sOrder,$sLimit);
	$rResultFilterTotal 	= $md_bank->getCountBank($sWhere);


	$output = array(
		"sEcho"                => (empty($input['sEcho']) ? '0' : intval($input['sEcho'])),
		"iTotalRecords"        => $rResultFilterTotal,
		"iTotalDisplayRecords" => $rResultFilterTotal,
		"aaData"               => array(),
	);

	while($aRow = $rResult->FetchRow()){

		$param_id = $gen_controller->encrypt($aRow['ID_Bank']);
		$edit = '<button data-toggle="modal" data-target="#edit_modal" type="button" onclick=do_edit(\''.$param_id.'\') class="btn btn-gradient-primary btn-rounded btn-icon"><i class="mdi mdi-pencil"></i></button>';
		$delete = '&nbsp; <button  type="button" onclick=do_delete(\''.$param_id.'\') class="btn btn-gradient-danger btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button>';

		$edit_delete = "<center>".$edit.$delete."</center>";
	 	$row = array();
		$row = array($aRow['Nama'],$aRow['No_Rek'],$aRow['Keterangan'],"<a target='_blank' id='single_image' href='".$basepath."assets/img/bank/".$aRow['gambar']."'>","<center>".$edit_delete."</center>");
	 	//$row = array($aRow['nama'],$aRow['No_Rek'],$aRow['Keterangan'],"<a target='_blank' id='single_image' href='".$basepath."assets/img/produk/".$aRow['gambar']."'>","<center>".$edit_delete."</center>");
		$output['aaData'][] = $row;
	}
	echo json_encode($output);
}
else {
	$gen_controller->response_code(http_response_code());
}
?>