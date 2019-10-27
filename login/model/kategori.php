<?php 
class kategori { 
	function getDataKategori($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  ktg.* FROM kategori as ktg
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
		  $sql = "SELECT  ktg.id_kategori FROM kategori as ktg ".$where;
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