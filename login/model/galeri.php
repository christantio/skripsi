<?php 
class galeri { 
	function getDataGaleri($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  gl.* FROM galeri as gl
					".$where."  ".$order.$limit;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	function getCountGaleri($where){
		  global $db;
		  $sql = "SELECT  gl.id_galeri FROM galeri as gl  ".$where;
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