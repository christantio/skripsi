<?php 
class produk { 
	function getDataProduk($where,$order,$limit){
		  global $db;
		  $sql = "SELECT  pdk.*,b.kategori as nm_kategori FROM produk as pdk 
				  left join kategori as b on pdk.kategori = b.id_kategori 
					".$where."  ".$order.$limit;
		  $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	
	function getCountProduk($where){
		  global $db;
		  $sql = "SELECT  pdk.id_produk FROM produk as pdk ".$where;
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