<?php 
class faq { 
	function getDataFAQ($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  fq.judul_faq,fq.id_faq,fq.created_date,fq.last_update FROM faq as fq
					".$where."  ".$order.$limit;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	function getCountFAQ($where){
		  global $db;
		  $sql = "SELECT  fq.id_faq FROM faq as fq ".$where;
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