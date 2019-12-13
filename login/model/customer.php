<?php 
class customer { 
	function getDataCustomer($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  cs.* FROM login as cs
					".$where."  ".$order.$limit;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	function getCountKategori($where){
		  global $db;
		  $sql = "SELECT  cs.id_user FROM login as cs ".$where;
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