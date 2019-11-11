<?php 
class vendor { 
	function getDataVendor($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  vdr.* FROM vendor as vdr
					".$where."  ".$order.$limit;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	function getCountVendor($where){
		  global $db;
		  $sql = "SELECT  vdr.id_vendor FROM vendor as vdr  ".$where;
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