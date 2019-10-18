<?php 
//General Controller
include "../General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "../model/General_Model.php";
$gen_model      = new General_Model();

//Model Galeri
include "model/galeri.php";
$md_sl      = new galeri();

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
  include "view/galeri.php";
  include "view/footer.php";
}
else if($act=="do_add"){
  if(!empty($_SESSION['user_id'])){
    //Foto
      $tmp = $_FILES["myfile"]["tmp_name"];
      $foto_asal = $_FILES['myfile']['name'];
      $foto_name = date("ymdhis")."_galeri_".rand(10000,99999).$foto_asal;
      $path      = "../assets/images/galeri/";

      $allowed =  array('gif','png','jpg','jpeg');
      $ext = pathinfo(strtolower($foto_asal), PATHINFO_EXTENSION);
      if(!in_array($ext,$allowed) ) {
          echo 'error';
      }
      else {
        //Proses
         $insert_data = array();
         $insert_data['gambar']                = $foto_name;
         $insert_data['created_date']          = $date_now_indo_full;
         $insert_data['last_update']           = $date_now_indo_full;
      
         echo $gen_model->Insert('galeri',$insert_data);
         $gen_controller->upload_file($tmp,$path,$foto_name);
      }
  }
  else {
    echo 'NOT_LOGIN';
  }
}

else if($act=="edit" and $id_parameter!=""){
    $edit = $gen_model->GetOneRow('galeri',array('id_galeri'=>$gen_controller->decrypt($id_parameter))); 
    foreach($edit as $key=>$val){
                  $key=strtolower($key);
                  $$key=$val;
    }
    $data = array('id_galeri'=>$gen_controller->encrypt($id_galeri),'gambar'=>$basepath."assets/images/galeri/".$gambar);
    echo json_encode($data); 
}
else if($act=="do_update"){
  if(!empty($_SESSION['user_id'])){ 

         $foto_asal = $_FILES['gambar']['name'];
        
          $tmp       = $_FILES["gambar"]["tmp_name"];
          $foto_name = date("ymdhis")."_slider_".$foto_asal;
          $path      = "../assets/images/galeri/";
       

        //Proses
          $update_data = array();
          $update_data['last_update']    = $date_now_indo_full;
          
             $update_data['gambar']    = $foto_name;
        
       
        //Paramater
          $where_data = array();
          $where_data['id_galeri']             = $gen_controller->decrypt($_POST['id_parameter']);
      
        
               $old_foto = $gen_model->GetOne('gambar','galeri',$where_data);
               $gen_controller->delete_file($path,$old_foto);
               $gen_controller->upload_file($tmp,$path,$foto_name);
       

          echo $gen_model->Update('galeri',$update_data,$where_data);

  }
  else {
    echo 'NOT_LOGIN';
  }
}
else if($act=="do_delete"){
  if(!empty($_SESSION['user_id'])){ 
    //Paramater
    $where_data = array();
    $where_data['id_galeri']  = $gen_controller->decrypt($_POST['id_parameter']);
    
    //Hapus Foto
    $path      = "../assets/images/galeri/";
    $foto_name = $gen_model->GetOne('gambar','galeri',$where_data);
    $gen_controller->delete_file($path,$foto_name);
    echo $gen_model->Delete('galeri',$where_data);
  }
  else {
    echo 'NOT_LOGIN';
  }
}
else if($act=="list_rest"){
  $aColumns = array('gl.gambar','gl.created_date','gl.last_update','gl.id_galeri'); //Kolom Pada Tabel

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

	$rResult 				= $md_sl->getDataGaleri($sWhere,$sOrder,$sLimit);
	$rResultFilterTotal 	= $md_sl->getCountGaleri($sWhere);


	$output = array(
		"sEcho"                => (empty($input['sEcho']) ? '0' : intval($input['sEcho'])),
		"iTotalRecords"        => $rResultFilterTotal,
		"iTotalDisplayRecords" => $rResultFilterTotal,
		"aaData"               => array(),
	);

	while($aRow = $rResult->FetchRow()){

		$param_id = $gen_controller->encrypt($aRow['id_galeri']);
		$edit = '<button data-toggle="modal" data-target="#edit_modal" type="button" onclick=do_edit(\''.$param_id.'\') class="btn btn-gradient-primary btn-rounded btn-icon"><i class="mdi mdi-pencil"></i></button>';
		$delete = '&nbsp; <button  type="button" onclick=do_delete(\''.$param_id.'\') class="btn btn-gradient-danger btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button>';

		$edit_delete = "<center>".$edit.$delete."</center>";
	 	$row = array();
	 	$row = array("<a target='_blank' id='single_image' href='".$basepath."assets/images/galeri/".$aRow['gambar']."'><button  class='btn btn-gradient-primary'><i class='mdi mdi-panorama'></i></button></a>",$gen_controller->get_date_indonesia($aRow['created_date'])." ".substr($aRow['created_date'],10,9),$gen_controller->get_date_indonesia($aRow['last_update'])." ".substr($aRow['last_update'],10,9),"<center>".$edit_delete."</center>");
		$output['aaData'][] = $row;
	}
	echo json_encode($output);
}
else {
	$gen_controller->response_code(http_response_code());
}
?>