<?php 
class klaim { 
	function getDataKlaim($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  clm.* FROM claim as clm
				  ".$where."  ".$order.$limit;	
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }		  else {
		  	return $rs;
		  }
	}
	function getCountKlaim($where){
		  global $db;
		  $sql = "SELECT  clm.id_claim FROM claim as clm ".$where;
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