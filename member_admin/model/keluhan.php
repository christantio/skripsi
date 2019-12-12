<?php 
class keluhan { 
	function getDataKeluhan($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  klh.* FROM keluhan as klh
					".$where."  ".$order.$limit;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	function getCountKeluhan($where){
		  global $db;
		  $sql = "SELECT  klh.id_keluhan FROM keluhan as klh ".$where;
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