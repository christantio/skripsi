<?php 
class pembayaran { 
	function getDataPembayaran($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  pem.* FROM pembayaran as pem
					".$where."  ".$order.$limit;		
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	function getCountPembayaran($where){
		  global $db;
		  $sql = "SELECT  pem.id_pesanan FROM pembayaran as pem ".$where;
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