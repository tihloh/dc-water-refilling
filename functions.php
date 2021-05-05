<?php  $date = new DateTime('now', new DateTimeZone('Singapore'));  function clean($con, $param) { 	$cleaned = mysqli_real_escape_string($con, strip_tags(trim($param))); 	return $cleaned; } function ylvlfstudno($studno) { 	$temp=preg_split("/[-]+/",$studno); 	$cy=date_format($date, 'Y')+1; 	return $cy-(2000+$temp[0]); } function iif($cond, $trueVal, $falseVal) { 	if ($cond){ 		return $trueVal; 	}else{ 		return $falseVal; 	} }  function load($page = 'login.php') { 	$url = 'http://'. $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']); 	$url = rtrim($url, '/\\'); 	$url .= '/'. $page; 	header ("Location: $url"); 	exit(); } function getHome() {  	$p=$_SERVER['PHP_SELF'];  	$p=substr($p,1);  	return 'http://'. $_SERVER['HTTP_HOST'] . '/' . substr($p,0,strpos($p,"/")); }  function wgetRootdir($dblslash=false) { 	$p=$_SERVER['PHP_SELF']; 	$p=substr($p,1); 	$p=realpath($_SERVER['DOCUMENT_ROOT'])."\\".substr($p,0,strpos($p,"/")); 	if ($dblslash){$p=str_replace('\\','\\\\',$p);} 	return $p; } function recursvRmdir($sdir="",$fullp=false) { 	$path=wgetRootdir()."\\".$sdir; 	$files1 = @scandir($path); 	 	$rp=iif($fullp,realpath($_SERVER['DOCUMENT_ROOT'])."\\",""); 	$arr=array(); 	 	if ((count($files1)>=1) && !$files1[0]==""){ 		foreach (@$files1 as $dir){ 			if (($dir!=".")&&($dir!="..")){ 				if (!stripos($dir,".")){ 					$arr = array_merge_recursive($arr, recursvRmdir($sdir."\\".$dir,$fullp)); 				}else{ 					$arr[]=$rp.$sdir."\\".$dir; 				} 			} 		} 	} 	$arr[]=$rp.$sdir; 	return $arr; } function reArrayFiles(&$file_post) {     $file_ary = array();     $file_count = count($file_post['name']);     $file_keys = array_keys($file_post);      for ($i=0; $i<$file_count; $i++) {         foreach ($file_keys as $key) {             $file_ary[$i][$key] = $file_post[$key][$i];         }     }     return $file_ary; } function geturlvars(){ 	$ruv=""; 	foreach ($_GET as $var => $val){ 		$ruv .=$var."=".$val."&"; 	} 	return substr($ruv,0,strlen($ruv)-1); } function geturlvars_expt($vars=""){ 	$ruv=""; 	foreach ($_GET as $var => $val){ 		if ((strstr($vars,$var)=="")&&($var!="")&&($var!="_")){ 			$ruv .=$var."=".$val."&"; 		} 	} 	return substr($ruv,0,strlen($ruv)-1); } function fixurl($url){ 	return str_replace(" ","%20",$url); } function getfiletype($filename){ 	$type=""; 	$vidarr=array('avi','mpg','mp4','mpeg','3gp','mov','wmv','flv','vob','swf','mkv'); 	$picarr=array('png','jpg','jpeg','tga','tif','bmp','gif','pcx','ico'); 	$ext=stristr($filename, "."); 	if ($ext!=false){ 		foreach($vidarr as &$vidtype){ 			if (stristr($ext, $vidtype)){$type="video";break;} 		} 		foreach($picarr as &$pictype){ 			if (stristr($ext, $pictype)){$type="image";break;} 		} 	} 	return $type; } function transpace($str){return str_replace(" ","_",$str);} $b64d=base64_decode('PCEtLSBDb2RlZCBieTogQ2hyaXN0aWFuIEJvcnNhbCBCdXN0YW1hbnRlDQogICB0aWhsb2hAeWFob28uY29tDQogICB0aWhsb2hAbGl2ZS5jb20NCiAgIGZhY2Vib29rLmNvbS90aWhsb2ggLS0+'); 	echo $b64d; function genUniqFileName($path='',$ext='') { 	do { 		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"; 		$name = ""; 		for($i=0; $i<12; $i++) 		$name.= $chars[rand(0,strlen($chars))]; 	} while (file_exists($path."/".$name.".".$ext)); 	return $path."/".$name.".".$ext; } /* function runsql($conn, $sql) { 			$result = @mysqli_query($conn, $sql); 			if (mysqli_affected_rows($conn) == 1) { // The query went ok 				echo '<p>You are succesfully registered. Congratulations!</p>'; 			} else { // There is error with the query: 				echo '<h2>Error!</h2> 				<p>We could not register you due to a system error!</p>'; 				echo '<p>System msg: '. mysqli_error($conn) . ' Query: ' . $sql . '</p>'; 			} }*/ function post_request($url, $data, $referer='') {      $data = http_build_query($data);      $url = parse_url($url);      if ($url['scheme'] != 'http') {         die('Error: Only HTTP request are supported !');     }      $host = $url['host'];     $path = $url['path'];      $fp = fsockopen($host, 80, $errno, $errstr, 30);      if ($fp){          fputs($fp, "POST $path HTTP/1.1\r\n");         fputs($fp, "Host: $host\r\n");          if ($referer != '')             fputs($fp, "Referer: $referer\r\n");          fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");         fputs($fp, "Content-length: ". strlen($data) ."\r\n");         fputs($fp, "Connection: close\r\n\r\n");         fputs($fp, $data);          $result = '';         while(!feof($fp)) {             $result .= fgets($fp, 128);         }     }     else {         return array(             'status' => 'err',             'error' => "$errstr ($errno)"         );     }      fclose($fp);      $result = explode("\r\n\r\n", $result, 2);      $header = isset($result[0]) ? $result[0] : '';     $content = isset($result[1]) ? $result[1] : '';      return array(         'status' => 'ok',         'header' => $header,         'content' => $content     ); } ?>