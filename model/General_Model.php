<?php 
class General_Model { 
	function Insert($table='',$data=array()){ 
		  global $db;
		  $qry = "INSERT INTO ".$table."(";
			foreach ($data as $key => $value) {
				$kez[]=$key;
				$val[]="'".$value."'";
			}
		$qry =$qry.implode(' , ', $kez).") VALUES( ".implode(' , ',$val).")";
		$result=$db->execute($qry);
		if (!$result){
			return $db->ErrorMsg();
		}
		else{
			return "OK";
		}
	}
	function Update($table='',$data=array(),$whr=array()){
		global $db;

		$qry = "UPDATE ".$table." SET ";
		foreach ($data as $key => $value) {
			$qrr[]= $key." = '".$value."'";
		}
		if(!empty($whr)){
			foreach ($whr as $key => $value) {
				$whrr[]= $key." = '".$value."'";
			}
			$data =$qry.implode(' , ', $qrr)." WHERE ".implode(' and ',$whrr);
		}		
		else {
			$data =$qry.implode(' , ', $qrr);
		}
		$result=$db->execute($data);
		if (!$result){
			return $db->ErrorMsg();
		}
		else{
			return "OK";
		}
	}
	function Delete($table="",$whr=array()){
		global $db;
		
		if(!empty($whr)){
			$qry="DELETE FROM ".$table." WHERE ";
			foreach ($whr as $key => $value) {
				$arr[]=$key." = '".$value."'";
			}
			$data=$qry.implode(' and ', $arr);
		}
		else {
			$qry="DELETE FROM ".$table;
		}
		
		
		$result=$db->execute($data);
		if (!$result){
			return $db->ErrorMsg();
		}
		else{
			return "OK";
		}
	}
	function GetOne($coloumn="",$table="",$whr=array()){
		global $db;
		if(!empty($whr)){
			$qry="Select ".$coloumn." FROM ".$table." WHERE ";
			foreach ($whr as $key => $value) {
				$arr[]=$key." = '".$value."'";
			}
			$data=$qry.implode(' and ', $arr);	
		}
		else {
			$data="Select ".$coloumn." FROM ".$table;		
		}
		$result=$db->getOne($data);
		if (!$result){
			return $db->ErrorMsg();
		}
		else{
			return $result;
		}
	}
	function GetOneRow($table='',$arr=array()){
		global $db;

		if(!empty($arr)){
			$qry = "SELECT * FROM ".$table." WHERE ";
			foreach ($arr as $key => $value) {
				$qrr[]= $key." = '".$value."'";
			}
			$data =$qry.implode(' and ', $qrr);
		}
		else {
			$data = "SELECT * FROM ".$table;
		}
		//var_dump($data);
		$result=$db->getRow($data);
		if (!$result){
			return $db->ErrorMsg();
		}
		else {
			return $result;
		}
	}
	function GetWhere($table='',$arr=array()){
		global $db;

		if(!empty($arr)){
			$qry = "SELECT * FROM ".$table." WHERE ";
			foreach ($arr as $key => $value) {
				$qrr[]= $key." = '".$value."'";
			}
			$data =$qry.implode(' and ', $qrr);
		}
		else {
			$data = "SELECT * FROM ".$table;
		}

		$result=$db->execute($data);
		if (!$result){
			return $db->ErrorMsg();
		}
		else {
			return $result;
		}
		
	}
	function GetMaxMin($col,$table,$tipe,$whr=array()){
		global $db;
		if(!empty($whr)){
			$qry="Select ".$col." FROM ".$table." WHERE ";
			foreach ($whr as $key => $value) {
				$arr[]=$key." = '".$value."'";
			}
			$data=$qry.implode(' and ', $arr);
			$data.= " order by ".$col." ".$tipe; 	
		}
		else {
			$data="Select ".$col." FROM ".$table;
			$data.= " order by ".$col." ".$tipe; 			
		}
		$result=$db->getOne($data);
		if (!$result){
			return $db->ErrorMsg();
		}
		else{
			return $result;
		}
	}
}

?>