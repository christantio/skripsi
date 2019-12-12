<?php 
class bank { 
	function getDataBank($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  bk.* FROM bank as bk 
				  ".$where."  ".$order.$limit;			
		  $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	
	function getCountBank($where){
		  global $db;
		  $sql = "SELECT  bk.id_bank FROM bank as bk ".$where;
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