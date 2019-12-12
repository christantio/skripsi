<?php 
class user { 
	function login($email,$pwd){
		  global $db;
		  $sql = "SELECT * FROM login WHERE
						(
							email = '".$email."'
							OR username = '".$email."'
						)
					AND password = '".$pwd."'";		
	      $result=$db->getRow($sql);
			if (!$result){
				return "NOK : ".$db->ErrorMsg();
			}
			else {
				return $result;
			}
	}
	function getDetailDataUser($col_param='',$id=''){
		  global $db;

		  $where ="";
		  if(!empty($id)){
		  	 $where =" where us.".$col_param."='".$id."' ";
		  }

		  $sql = "SELECT us.* FROM login as us  ".$where;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	function fetch($start,$limit,$nama,$position,$gender){

		$where ="";

		if(!empty($nama)){
			$where .=" and us.nama_lengkap like '%".$nama."%' ";
		} 
		if(!empty($position)){
			$where .=" and jbt.jabatan like '%".$position."%' ";
		} 
		if(!empty($gender)){
			$where .=" and us.jenis_kelamin='".$gender."' ";
		} 

		global $db;
		  $sql = "select DISTINCT(jbt.jabatan),us.user_id,us.nip,us.nama_lengkap,us.foto 
					from user as us 
						inner join jabatan as jbt 
							on us.level=jbt.id_jabatan
					where 1=1 ".$where." order by us.created_date asc limit ".$start.",".$limit;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
}
?>