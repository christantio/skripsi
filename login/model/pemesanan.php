<?php 
class pemesanan { 
	function getDataPemesanan($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  ps.* FROM pesanan as ps
					".$where."  ".$order.$limit;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }		  else {
		  	return $rs;
		  }
	}
	function getCountPemesanan($where){
		  global $db;
		  $sql = "SELECT  ps.id_pesanan FROM pesanan as ps ".$where;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs->recordCount();
		  }
	}-
}
?>