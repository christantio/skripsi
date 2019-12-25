<?php 
class profile { 
	function getDataProfile($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  pem.* FROM login as pem
					".$where."  ".$order.$limit;		
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	function getCountProfile($where){
		  global $db;
		  $sql = "SELECT  pem.id_pesanan FROM login as pem ".$where;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs->recordCount();
		  }
	}
	
	
	
}
?>