<?php 
class testimoni { 
	function getDataTesti($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  ts.nama,ts.id_testi,ts.created_date,ts.last_update FROM testimoni as ts
					".$where."  ".$order.$limit;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	function getCountTesti($where){
		  global $db;
		  $sql = "SELECT  ts.id_testi FROM testimoni as ts ".$where;
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