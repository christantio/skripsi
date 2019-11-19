<?php 
//General Controller
include "../General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "../model/General_Model.php";
$gen_model      = new General_Model();

//Model vendor
include "model/vendor.php";
$md_sl      = new vendor();

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
  include "view/vendor.php";
  include "view/footer.php";
}
else if($act=="do_add"){
  if(!empty($_SESSION['user_id'])){
	//Proses
	 $insert_data = array();
	 $insert_data['Nama_vendor']           = addslashes($_POST['Nama_vendor']);
	 $insert_data['created_date']          = $date_now_indo_full;
	 $insert_data['last_update']           = $date_now_indo_full;
  
	 echo $gen_model->Insert('vendor',$insert_data);
  }
  else {
    echo 'NOT_LOGIN';
  }
}

else if($act=="edit" and $id_parameter!=""){
    $edit = $gen_model->GetOneRow('vendor',array('id_vendor'=>$gen_controller->decrypt($id_parameter))); 
    foreach($edit as $key=>$val){
                  $key=strtolower($key);
                  $$key=$val;
    }
    $data = array('id_vendor'=>$gen_controller->encrypt($id_vendor),'gambar'=>$basepath."assets/images/vendor/".$gambar);
    echo json_encode($data); 
}
else if($act=="do_update"){
  if(!empty($_SESSION['user_id'])){ 
       
        //Proses
         $update_data = array();
         $update_data['last_update']    = $date_now_indo_full;
          
         $update_data['gambar']    = $foto_name;
        
       
        //Paramater
          $where_data = array();
          $where_data['id_vendor']             = $gen_controller->decrypt($_POST['id_parameter']);
       

          echo $gen_model->Update('vendor',$update_data,$where_data);

  }
  else {
    echo 'NOT_LOGIN';
  }
}
else if($act=="do_delete"){
  if(!empty($_SESSION['user_id'])){ 
    //Paramater
    $where_data = array();
    $where_data['id_vendor']  = $gen_controller->decrypt($_POST['id_parameter']);
    
    //Hapus Foto
    $path      = "../assets/images/vendor/";
    $foto_name = $gen_model->GetOne('gambar','vendor',$where_data);
    $gen_controller->delete_file($path,$foto_name);
    echo $gen_model->Delete('vendor',$where_data);
  }
  else {
    echo 'NOT_LOGIN';
  }
}
else if($act=="list_rest"){
  $aColumns = array('vdr.Nama_vendor','vdr.created_date','vdr.last_update','vdr.id_vendor'); //Kolom Pada Tabel

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

	$rResult 				= $md_sl->getDatavendor($sWhere,$sOrder,$sLimit);
	$rResultFilterTotal 	= $md_sl->getCountvendor($sWhere);


	$output = array(
		"sEcho"                => (empty($input['sEcho']) ? '0' : intval($input['sEcho'])),
		"iTotalRecords"        => $rResultFilterTotal,
		"iTotalDisplayRecords" => $rResultFilterTotal,
		"aaData"               => array(),
	);

	while($aRow = $rResult->FetchRow()){

		$param_id = $gen_controller->encrypt($aRow['id_vendor']);
		$edit = '<button data-toggle="modal" data-target="#edit_modal" type="button" onclick=do_edit(\''.$param_id.'\') class="btn btn-gradient-primary btn-rounded btn-icon"><i class="mdi mdi-pencil"></i></button>';
		$delete = '&nbsp; <button  type="button" onclick=do_delete(\''.$param_id.'\') class="btn btn-gradient-danger btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button>';

		$edit_delete = "<center>".$edit.$delete."</center>";
	 	$row = array();
	 	$row = array($aRow['Nama_vendor'],$gen_controller->get_date_indonesia($aRow['created_date'])." ".substr($aRow['created_date'],10,9),$gen_controller->get_date_indonesia($aRow['last_update'])." ".substr($aRow['last_update'],10,9),"<center>".$edit_delete."</center>");
		$output['aaData'][] = $row;
	}
	echo json_encode($output);
}
else {
	$gen_controller->response_code(http_response_code());
}
?>