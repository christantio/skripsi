<?php 
include('lib/adodb/adodb.inc.php');
 
// define variabel database
$dbhostname		= "localhost";
$dbusername		= "root";
$dbpassword		= "";
$dbname			= "skripsi_v3";

$db = ADONewConnection('mysql'); // eg. 'mysql' or 'oci8'

// $db->debug = true;
 
// Koneksi Ke Database
//$db->Connect($server, $user, $password, $database);
$status  = $db->Connect($dbhostname,$dbusername,$dbpassword,$dbname);
 $db->SetFetchMode(ADODB_FETCH_ASSOC);

if (!$status ) {
	echo '<h1>Connection Failed</h1>' . $db->ErrorMsg();
}


//Hapus atau Berikan Komentar jika ingin menggunakan jam server
date_default_timezone_set("Asia/Jakarta");
$root_folder   = $_SERVER['DOCUMENT_ROOT']."/skripsi/";
$basepath      = "http://".$_SERVER['HTTP_HOST']."/skripsi/";
$basepath_admin      = "http://".$_SERVER['HTTP_HOST']."/skripsi/login/";
$basepath_member      = "http://".$_SERVER['HTTP_HOST']."/skripsi/member_admin/";
$secret_key    = "skripsi_v3";
$date_now_indo = date("Y-m-d");
$date_now_indo_full = date("Y-m-d H:i:s");

class General_Controller {
	//example : response_code('403')
	function response_code($respon_code){
		global $root_folder;
		  if($respon_code!="200"){
		        $error_pages = $root_folder.'ErrorDocument';
		        $pages_err   = scandir($error_pages, 0);
		        unset($pages_err[0], $pages_err[1]);
		        if(in_array($respon_code.'.php', $pages_err)){
		            include($error_pages.'/'.$respon_code.'.php');
		        }
		        else {
		            include "ErrorDocument/404.php"; 
		        }
		   }
		   else {
		        include "ErrorDocument/404.php"; 
		   }
	}

	//example : redirect_alert('user','kata-kata')
	function redirect_alert($url,$alert){
	   global $basepath;
	   if($url=="window_back"){  //history back
	      echo '<script>history.back(alert("'.$alert.'"))</script>';
	   }
	   else {
	    echo '<script>alert("'.$alert.'");</script>
	         <script>document.location="'.$basepath.$url.'"</script>';
	   }
	}
	
	function redirect($url){
	   global $basepath;
	   if($url=="window_back"){  //history back
	      	echo '<script>history.back</script>';
	   }
	   else {
	    	echo '<script>document.location="'.$basepath.$url.'"</script>';
	   }
	}

	

	//example : get_client_ip()
	function get_client_ip() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}

	//example : date_indo_default('30/03/2018')
	function date_indo_default($date){  
		if($date==null or $date==""){
			return "null";
		}
		else {
			$tgl = explode("/",$date);
			return $tgl[2]."-".$tgl[1]."-".$tgl[0];  // yyyy-mm-dd
		}
	}

	//example : get_hari('2018-03-30')
	function get_hari($tanggal){  //Only format yyyy-mm-dd
		$day = date('D', strtotime($tanggal));
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu'
		);
		return $dayList[$day]; //output data => Day Name
	}


	//example : get_date_indonesia('2018-03-30','all')
	function get_date_indonesia($date,$jns=''){   //Only format yyyy-mm-dd  
	    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 
	    $tahun = substr($date, 0, 4);
	    $bulan = substr($date, 5, 2);
	    $tgl   = substr($date, 8, 2);
		
		if($jns=="all"){
			$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;  
			// output data =>  dd, month name yyyy
		}
		else if($jns=="month"){
			$result = $BulanIndo[(int)$bulan-1];   // output data => month name
		}
		else if($jns=="month_year"){
			$result = $BulanIndo[(int)$bulan-1] . " ". $tahun; // output data=> month name  yyyy
		}
		else {
			$newDate = date("d/m/Y", strtotime($date));
			if($date==null or $date==""){
				return "";
			}
			else {
				return $newDate;  // output data =>  dd/mm/yyyy
			}
		}
	    return($result);
	}

	//example : upload_file('temporary_file','path_file','file_name')
	function upload_file($tmp,$path,$file_name) {
	   @copy($tmp,$path.$file_name);
	}

	//example : delete_file('path_file','file_name')
	function delete_file($path,$file_name) {
	   unlink($path.$file_name);   
	}

	//example : array_to_string('$data',',')
	function array_to_string($data,$simbol) {
	       $all_data="";
		    foreach ($data as $dt){ 
		        $all_data .= $dt.$simbol; 
		    }
		   $all_data = rtrim($all_data,$simbol);
		   return $all_data;
	}

	//example : array_to_string('3,2,4','3',',')
	function array_to_string_checked($from,$to,$simbol) {
		$array_of_data = explode($simbol, $from); 
		if(in_array($to,$array_of_data)) return "checked";
	}

	//example : if_select('3','3')
	function if_select($from,$to,$output) {
		if($from==$to) {
			return $output;
		}
		else {
			return "";
		}
	}

	function to_rupiah($var,$decimal=''){
			$data ="";
			if(empty($decimal)){
				$data = number_format($var,0,',','.');
			}
			else {
				$data =  number_format($var,$decimal,',','.');
			}
			return $data;
	}

	function to_int($var){
		return preg_replace('/[^0-9]/', '', $var);
	}

	//example : encrypt('hello_world')
	function encrypt($string) {
	  global $secret_key;
	  $result = '';
	  for($i=0; $i<strlen($string); $i++) {
	    $char = substr($string, $i, 1);
	    $keychar = substr($secret_key, ($i % strlen($secret_key))-1, 1);
	    $char = chr(ord($char)+ord($keychar));
	    $result.=$char;
	  }
	  return base64_encode($result);
	}

	//example : decrypt('enkripsi_data')
	function decrypt($string) {
	  global $secret_key;	
	  $result = '';
	  $string = base64_decode($string);
	  for($i=0; $i<strlen($string); $i++) {
	    $char = substr($string, $i, 1);
	    $keychar = substr($secret_key, ($i % strlen($secret_key))-1, 1);
	    $char = chr(ord($char)-ord($keychar));
	    $result.=$char;
	  }
	  return $result;
	}


	//Start Property DataTables ServerSide
	function Paging( $input ){
	$sLimit = "";
	if ( isset( $input['iDisplayStart'] ) && $input['iDisplayLength'] != '-1' ) {
		$sLimit = " LIMIT ".intval( $input['iDisplayStart'] ).", ".intval( $input['iDisplayLength'] );
	}
	return $sLimit;
	}


	function Ordering( $input, $aColumns ){
			$aOrderingRules = array();
			if ( isset( $input['iSortCol_0'] ) ) {
				$iSortingCols = intval( $input['iSortingCols'] );
				for ( $i=0 ; $i<$iSortingCols ; $i++ ) {
					if ( $input[ 'bSortable_'.intval($input['iSortCol_'.$i]) ] == 'true' ) {
						$aOrderingRules[] =
						$aColumns[ intval( $input['iSortCol_'.$i] ) ]." "
						.($input['sSortDir_'.$i]==='asc' ? 'asc' : 'desc');
					}
				}
			}

			if (!empty($aOrderingRules)) {
				$sOrder = " ORDER BY ".implode(", ", $aOrderingRules);
				} else {
				$sOrder = "";
			}
			return $sOrder;
	}

	function Filtering( $aColumns, $iColumnCount, $input){
			if ( isset($input['sSearch']) && $input['sSearch'] != "" ) {
				$aFilteringRules = array();
				for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
					if ( isset($input['bSearchable_'.$i]) && $input['bSearchable_'.$i] == 'true' ) {
						$aFilteringRules[] = $aColumns[$i]." LIKE '%".addslashes( $input['sSearch'] )."%'";
					}
				}
				if (!empty($aFilteringRules)) {
					$aFilteringRules = array('('.implode(" OR ", $aFilteringRules).')');
				}
			}

			// Individual column filtering
			for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
				if ( isset($input['bSearchable_'.$i]) && $input['bSearchable_'.$i] == 'true' && $input['sSearch_'.$i] != '' ) {
					$aFilteringRules[] = $aColumns[$i]."  LIKE '%".addslashes($input['sSearch_'.$i])."%'";
				}
			}

			if (!empty($aFilteringRules)) {
				$sWhere = " WHERE ".implode(" OR ", $aFilteringRules);
				} else {
				$sWhere = " WHERE 1=1 ";
			}
			return $sWhere;
	}
	
	function ribuan($angka){
		if(empty($angka)) $angka=0;
		$angka = number_format($angka,"0",",",".");
		return $angka;
	}
	//End Property DataTables ServerSide

}
?>