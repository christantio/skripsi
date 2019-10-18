<?php 
class merek { 
	function getDataMerek($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  mrk.* FROM merek as mrk
					".$where."  ".$order.$limit;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	function getCountMerek($where){
		  global $db;
		  $sql = "SELECT  mrk.id_merek FROM merek as mrk ".$where;
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