<?php 
class kritik_saran { 
	function getDataKritik($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  kr.* FROM kritik_saran as kr
					".$where."  ".$order.$limit;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	function getCountKritik($where){
		  global $db;
		  $sql = "SELECT  kr.id_saran FROM kritik_saran as kr ".$where;
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