<?php 
class slider { 
	function getDataSlider($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  sl.* FROM slide as sl
					".$where."  ".$order.$limit;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	function getCountSlider($where){
		  global $db;
		  $sql = "SELECT  sl.id_slide FROM slide as sl ".$where;
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