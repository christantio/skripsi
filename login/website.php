<?php 
//General Controller
include "../General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "../model/General_Model.php";
$gen_model      = new General_Model();


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
  include "view/website.php";
  include "view/footer.php";
}
else if($act=="edit"){
    $edit = $gen_model->GetOneRow('web'); 
    foreach($edit as $key=>$val){
                  $key=strtolower($key);
                  $$key=$val;
    }
    $data = array('judul_web'=>$judul_web,'logo'=>$basepath."assets/images/".$logo,'favicon'=>$basepath."assets/images/".$favicon,'email'=>$email,'no_tlp'=>$no_tlp,'no_hp'=>$no_hp,'tentang'=>$tentang,'cara_pesan'=>$cara_pemesanan,'alamat'=>$alamat);
    echo json_encode($data); 
}
else if($act=="do_update"){
  if(!empty($_SESSION['user_id'])){ 

         $logo_asal = $_FILES['logo']['name'];
         $favicon_asal = $_FILES['favicon']['name'];
         if($logo_asal!=""){
          $tmp_logo  = $_FILES["logo"]["tmp_name"];
          $logo_name = date("ymdhis")."_logo_".$logo_asal;
          $path      = "../assets/images/";
        } 

        if($favicon_asal!=""){
          $tmp_fav   = $_FILES["favicon"]["tmp_name"];
          $fav_name  = date("ymdhis")."_favicon_".$favicon_asal;
          $path      = "../assets/images/";
        }

        //Proses
          $update_data = array();
          $update_data['judul_web']           = addslashes($_POST['judul_web']);
          $update_data['email']               = addslashes($_POST['email']);
          $update_data['no_tlp']              = addslashes($_POST['no_tlp']);
          $update_data['no_hp']               = addslashes($_POST['no_hp']);
          $update_data['alamat']              = addslashes($_POST['alamat']);
          $update_data['tentang']             = addslashes($_POST['tentang_kami']);
          $update_data['cara_pemesanan']      = addslashes($_POST['cara_pesan']);
          $update_data['last_update']         = $date_now_indo_full;
          if($logo_asal!=""){
             $update_data['logo']    = $logo_name;
          }
          if($favicon_asal!=""){
             $update_data['favicon']    = $fav_name;
          }
       
       
        if($update_data['judul_web']!=""){
          
          //Hapus Logo
            if($logo_asal!=""){
               $old_foto = $gen_model->GetOne('logo','web','');
               $gen_controller->delete_file($path,$old_foto);
               $gen_controller->upload_file($tmp_logo,$path,$logo_name);
            }

          //Hapus Favicon
            if($favicon_asal!=""){
               $old_foto = $gen_model->GetOne('favicon','web');
               $gen_controller->delete_file($path,$old_foto);
               $gen_controller->upload_file($tmp_fav,$path,$fav_name);
            }
             echo $gen_model->Update('web',$update_data);
         

        }
        else {
          echo 'Terjadi kesalahan';
        }
  }
  else {
    echo 'NOT_LOGIN';
  }
}
else {
	$gen_controller->response_code(http_response_code());
}
?>