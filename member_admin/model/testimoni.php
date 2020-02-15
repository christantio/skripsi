<?php 
class testimoni { 
	function getDataTestimoni($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  pem.* FROM testimoni as pem
					".$where."  ".$order.$limit;		
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	function getCountTestimoni($where){
		  global $db;
		  $sql = "SELECT  pem.id_testi FROM testimoni as pem ".$where;
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