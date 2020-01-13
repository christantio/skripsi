<?php 
//General Controller
include "../General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "../model/General_Model.php";
$gen_model      = new General_Model();

//Model kategori
include "model/kategori.php";
$md_kategori      = new kategori();

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
  include "view/kategori.php";
  include "view/footer.php";
}
else if($act=="do_add"){
  if(!empty($_SESSION['user_id'])){
	//Proses
    $insert_data = array();
    $insert_data['kategori']              = addslashes($_POST['kategori']);
    $insert_data['link']              = addslashes($_POST['link']);
    $insert_data['created_date']          = $date_now_indo_full;
    $insert_data['last_update']           = $date_now_indo_full;
    
    if($insert_data['kategori']!=""){
        echo $gen_model->Insert('kategori',$insert_data);
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
	$edit = $gen_model->GetOneRow('kategori',array('id_kategori'=>$gen_controller->decrypt($id_parameter))); 
	foreach($edit as $key=>$val){
	  $key=strtolower($key);
	  $$key=$val;
    }
    $data = array('id_kategori'=>$gen_controller->encrypt($id_kategori),'kategori'=>$kategori,'link'=>$link);
    echo json_encode($data); 
}
else if($act=="do_update"){
  if(!empty($_SESSION['user_id'])){ 
        //Proses
          $update_data = array();
          $update_data['kategori']          = addslashes($_POST['kategori']);
          $update_data['link']          = addslashes($_POST['link']);
          $update_data['last_update']    = $date_now_indo_full;
       
        //Paramater
          $where_data = array();
          $where_data['id_kategori']             = $gen_controller->decrypt($_POST['id_parameter']);
        
        if($update_data['kategori']!=""){
          echo $gen_model->Update('kategori',$update_data,$where_data);
        }
        else {
          echo 'Terjadi kesalahan';
        }
  }
  else {
    echo 'NOT_LOGIN';
  }
}
else if($act=="cetak"){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Kategori.xls");
	echo "<style>
		table.report {
		border-width: 1px;
		border-spacing: ;
		border-style: solid;
		border-color: 000000;
		border-collapse: collapse;
		background-color: white;
		width:95%;
		}
		
		table.report tr {
		
		background-color:#FFFFFF;
		
		}
		table.report th {
		background-color:#FFFFFF;
		color:#000000;
		border-width: 1px;
		padding: 5px;
		border-style: solid;
		border-color: #000000;
		}
		table.report td {
		border-width: 1px;
		padding: 3px;
		border-style: SOLID;
		border-color: #000000;
		background-color: #FFFFFF;
		-moz-border-radius: ;
		}
	</style>";
	
	echo "
		<table class='report' border=1>
		  <thead>
			<tr>
				<th><b>No</b></th>
				<th><b>Kategori</b></th>
				<th><b>Tanggal dibuat</b></th>
				<th><b>Tanggal diubah</b></th>
			</tr>
		  </thead>
		  <tbody>
	";
	
	$sql = "SELECT * FROM kategori order by id_kategori asc";
	$rs  = $db->Execute($sql);
	$no=1;
	while($aRow =$rs->FetchRow()){
		foreach($aRow as $key=>$val){
		  $key=strtolower($key);
		  $$key=$val;
		}
		
		echo "
		 
			<tr>
			<td>".$no."</td>
			<td>".$kategori."</td>
			<td>".$gen_controller->get_date_indonesia($created_date)."</td>
			<td>".$gen_controller->get_date_indonesia($last_update)."</td>
			</tr>
			
		";
		$no++;
	}
	
	echo "</tbody></table>";
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
  $aColumns = array('ktg.kategori','ktg.created_date','ktg.last_update','ktg.id_kategori'); //Kolom Pada Tabel  
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

	$rResult 				= $md_kategori->getDataKategori($sWhere,$sOrder,$sLimit);
	$rResultFilterTotal 	= $md_kategori->getCountKategori($sWhere);


	$output = array(
		"sEcho"                => (empty($input['sEcho']) ? '0' : intval($input['sEcho'])),
		"iTotalRecords"        => $rResultFilterTotal,
		"iTotalDisplayRecords" => $rResultFilterTotal,
		"aaData"               => array(),
	);

	while($aRow = $rResult->FetchRow()){

		$param_id = $gen_controller->encrypt($aRow['id_kategori']);
		$edit = '<button data-toggle="modal" data-target="#edit_modal" type="button" onclick=do_edit(\''.$param_id.'\') class="btn btn-gradient-primary btn-rounded btn-icon"><i class="mdi mdi-pencil"></i></button>';
		$delete = '&nbsp; <button  type="button" onclick=do_delete(\''.$param_id.'\') class="btn btn-gradient-danger btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button>';

		$edit_delete = "<center>".$edit.$delete."</center>";
	 	$row = array();
	 	$row = array($aRow['kategori'],$gen_controller->get_date_indonesia($aRow['created_date'])." ".substr($aRow['created_date'],10,9),$gen_controller->get_date_indonesia($aRow['last_update'])." ".substr($aRow['last_update'],10,9),"<center>".$edit_delete."</center>");
		$output['aaData'][] = $row;
	}
	echo json_encode($output);
}
else {
	$gen_controller->response_code(http_response_code());
}
?>