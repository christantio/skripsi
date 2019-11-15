<?php 
//General Controller
include "../General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "../model/General_Model.php";
$gen_model      = new General_Model();

//Model Produk
include "model/produk.php";
$md_produk      = new produk();

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
  include "view/produk.php";
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

else if($act=="edit" and $id_parameter!=""){
    $edit = $gen_model->GetOneRow('produk',array('Id_Produk'=>$gen_controller->decrypt($id_parameter))); 
	foreach($edit as $key=>$val){
	  $key=strtolower($key);
	  $$key=$val;
    }
    $data = array('id_parameter'=>$id_parameter,'nama_produk'=>$nama_produk,'stock'=>$stock,'harga'=>$harga,'kategori'=>$kategori,'vendor'=>$vendor,'keterangan'=>$keterangan,'gambar'=>$basepath."assets/img/produk/".$gambar);
    echo json_encode($data); 
}
else if($act=="do_update"){
  if(!empty($_SESSION['user_id'])){ 
        //UPload
		  $tmp = $_FILES["gambar"]["tmp_name"];
		  $foto_asal = $_FILES['gambar']['name'];
		  $foto_name = date("ymdhis")."_produk_".$foto_asal;
		  $path      = "../assets/img/produk/";
	  
		//Proses
        $update_data = array();
		$update_data['nama_produk']           = addslashes($_POST['nama_produk']);
		$update_data['kategori']           	  = addslashes($_POST['kategori']);
		$update_data['stock']           	  = addslashes($_POST['stock']);
		$update_data['harga']           	  = addslashes($_POST['harga']);
		$update_data['keterangan']            = addslashes($_POST['keterangan']);
		$update_data['vendor']	              = addslashes($_POST['vendor']);
		$update_data['gambar']	              = $foto_name;
		$update_data['created_date']          = $date_now_indo_full;
		$update_data['last_update']           = $date_now_indo_full;
       
        //Paramater
          $where_data = array();
          $where_data['Id_Produk']             = $gen_controller->decrypt($_POST['id_parameter']);
        
        if($update_data['nama_produk']!=""){
          echo $gen_model->Update('produk',$update_data,$where_data);
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
    $where_data['Id_Produk']  = $gen_controller->decrypt($_POST['id_parameter']);
    echo $gen_model->Delete('produk',$where_data);
  }
  else {
    echo 'NOT_LOGIN';
  }
}
else if($act=="list_rest"){
  $aColumns = array('pdk.Nama_Produk','pdk.created_date','pdk.last_update','pdk.Id_Produk'); //Kolom Pada Tabel

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

	$rResult 				= $md_produk->getDataProduk($sWhere,$sOrder,$sLimit);
	$rResultFilterTotal 	= $md_produk->getCountProduk($sWhere);


	$output = array(
		"sEcho"                => (empty($input['sEcho']) ? '0' : intval($input['sEcho'])),
		"iTotalRecords"        => $rResultFilterTotal,
		"iTotalDisplayRecords" => $rResultFilterTotal,
		"aaData"               => array(),
	);

	while($aRow = $rResult->FetchRow()){

		$param_id = $gen_controller->encrypt($aRow['Id_Produk']);
		$edit = '<button data-toggle="modal" data-target="#edit_modal" type="button" onclick=do_edit(\''.$param_id.'\') class="btn btn-gradient-primary btn-rounded btn-icon"><i class="mdi mdi-pencil"></i></button>';
		$delete = '&nbsp; <button  type="button" onclick=do_delete(\''.$param_id.'\') class="btn btn-gradient-danger btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button>';

		$edit_delete = "<center>".$edit.$delete."</center>";
	 	$row = array();
	 	$row = array($aRow['Nama_Produk'],$aRow['nm_kategori'],$aRow['Stock'],$aRow['Harga'],$aRow['Keterangan'],"<a target='_blank' id='single_image' href='".$basepath."assets/img/produk/".$aRow['gambar']."'><button  class='btn btn-gradient-primary'><i class='mdi mdi-panorama'></i></button></a>",$gen_controller->get_date_indonesia($aRow['created_date'])." ".substr($aRow['created_date'],10,9),$gen_controller->get_date_indonesia($aRow['last_update'])." ".substr($aRow['last_update'],10,9),"<center>".$edit_delete."</center>");
		$output['aaData'][] = $row;
	}
	echo json_encode($output);
}
else {
	$gen_controller->response_code(http_response_code());
}
?>