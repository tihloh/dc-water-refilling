<?php
@session_start();
include "config.php";
include "tfx.php";
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	$req=$_GET['req']??"";
	if($req=="fordelivery"){
		$addr=$_GET['addr']??"";
		$tdate=$_GET['tdate']??"";
			
		$q="SELECT cp,customer,charge FROM tblorders WHERE date(time)='$tdate' and addr='$addr'";

		$result = $mysqli->query($q);
		$values="";
		while ($row = $result->fetch_assoc()){
			$newid=uniqid();
			$cp=$row["cp"];
			$charge=formatnum($row["charge"]);
			$customer=$row["customer"];
			$cp=str_replace("+","",$cp);
			$cp=str_replace(" ","",$cp);
			$cplen=strlen($cp);
			if($cplen>=11 && $cplen<=12 && is_numeric($cp)){
				$values .=($values!=""?",":"")."('$newid','".$row["cp"]."','1','Good day $customer, Your order(s) are on its way. Please prepare a total amount of P$charge. Thank you. -(".SubTITLE.")','$tdate')";
			}
		}$result->free();
		
		if($values!=""){
			$q="INSERT INTO tblsms(id,cp,_out,msg,stime) VALUES$values";
			//echo $q;
			$mysqli->query($q);
		}
	}
}

?>