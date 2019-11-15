<?php 
//General Controller
include "General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "model/General_Model.php";
$gen_model      = new General_Model();

//Check Session
session_start();
if(!empty($_SESSION['username'])){
  $gen_controller->redirect('member');
}

$web = $gen_model->GetOneRow('web');

//View
include "view/header.php";
include "view/index.php";
include "view/footer.php";
?>