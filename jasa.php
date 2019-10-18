<?php 
//General Controller
include "General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "model/General_Model.php";
$gen_model      = new General_Model();


$web = $gen_model->GetOneRow('web');



$act="";
if(isset($_GET['do_act'])){
    $act = $_GET['do_act'];
}

$id_parameter="";
if(isset($_GET['id_parameter'])){
        $id_parameter =$_GET['id_parameter'];
}

if($id_parameter!=""){
	if($id_parameter=="perawatan" or $id_parameter=="kerusakan"){
		//View
	    include "view/header.php";
	    include "view/jasa.php";
	    include "view/footer.php";
	}
	else if($id_parameter=="proses_keluhan"){
		//View
	    include "view/header.php";
	    include "view/jasa_keluhan.php";
	    include "view/footer.php";
	}
	else if($id_parameter=="proses_data_diri"){
		//View
	    include "view/header.php";
	    include "view/jasa_data_diri.php";
	    include "view/footer.php";
	}
	else if($id_parameter=="finish"){
		//View
	    include "view/header.php";
	    include "view/jasa_finish.php";
	    include "view/footer.php";
	}
	else if($id_parameter=="get_last_pesanan"){
		//No Order
		$whr = array();
		$whr['tanggal_pesan']   = $date_now_indo;
		$get_max_urut			= $gen_model->GetMaxMin('no_pesanan','pesanan','desc',$whr);
		echo $get_max_urut;
	}
	else if($id_parameter=="do_add"){

		//No Order
		$whr = array();
		$whr['tanggal_pesan']   = $date_now_indo;
		$get_max_urut			= $gen_model->GetMaxMin('no_pesanan','pesanan','desc',$whr);
		$get_no_urut			= substr($get_max_urut,13,5);
		$no_order			 	= "ODR_".date('Ymd')."_".str_pad($get_no_urut + 1, 4, 0, STR_PAD_LEFT);
		$jam = $gen_controller->date_indo_default(addslashes($_POST['jadwal_service']))." ".addslashes($_POST['jam']).":00";
		$insert_data = array();
		$insert_data['status']            	= 'Pending';
		$insert_data['jadwal_service']      = $jam;
		$insert_data['no_pesanan']          = $no_order;
		$insert_data['tipe']            	= addslashes($_POST['tipe']);
		$insert_data['nama']            	= addslashes($_POST['nama']);
		$insert_data['no_tlp']            	= addslashes($_POST['contact']);
		$insert_data['email']            	= addslashes($_POST['email']);
		$insert_data['alamat']            	= addslashes($_POST['alamat']);
		$insert_data['total_biaya']        	= addslashes($_POST['jumlah_harga']);
		$insert_data['created_date']        = $date_now_indo_full;
		$insert_data['last_update']         = $date_now_indo_full;
		$insert_data['tanggal_pesan']       = $date_now_indo;

		if($gen_model->Insert('pesanan',$insert_data)=="OK"){
			$mrk = explode(",",$_POST['merek']);
			$pk  = explode(",",$_POST['pk']);
			$z=0;
			for($i=1;$i<=$_POST['jumlah_order'];$i++){
				$insert_data2 = array();
				$insert_data2['no_pesanan']  			= $no_order;
				$insert_data2['id_merek']  				= $mrk[$z];
				$insert_data2['ukuran_ac ']  			= $pk[$z];
				$insert_data2['id_keluhan']  			= $_POST['klh_'.$i];
				$insert_data2['harga_list_keluhan']  	= $_POST['klh_harga_'.$i];
				$gen_model->Insert('pesanan_detail',$insert_data2);	
				$z++;
			}
			echo "OK";
		}
		else {
			echo 'Terjadi Kesalahan';
		}
	}
	else{
		$gen_controller->redirect('.');
	}
}
else {
    $gen_controller->redirect('.');
}
?>