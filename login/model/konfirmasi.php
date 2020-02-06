<?php 
class konfirmasi { 
	function getDataKonfirmasi($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  pem.* FROM pembayaran as pem 
				  ".$where."  ".$order.$limit;	
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }		  else {
		  	return $rs;
		  }
	}
	function getCountKonfirmasi($where){
		  global $db;
		  $sql = "SELECT  pem.Id_Pembayaran FROM pembayaran as pem ".$where;
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