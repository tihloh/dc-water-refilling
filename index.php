<?php
	@session_start();
	include "config.php";
	include "conn.php";
	include "tfx.php";
	
	$ip=$_SERVER['REMOTE_ADDR'];
	$sitecode="waterrs";
	if (isset($_POST['login'])){
		$p = $_POST['p']??"";
		$urlvars = $_POST['urlvars']??"";
		$user = $_POST['user']??"";
		$pass = $_POST['pass']??"";
		$q="SELECT * FROM tblusers WHERE md5(username)='".md5($user)."' and password='".md5("$key$pass")."'";
		$e="";
		$result = $mysqli->query($q);
		while ($row = $result->fetch_assoc()){
			if($row["banned"]==1){ $e="e=".base64_encode("Your account has been banned!"); break;}
			$_SESSION[$sitecode.'signed_in']=true;
			$_SESSION[$sitecode.'username']=$row["username"];
			$_SESSION[$sitecode.'password']=$row["password"];
			$_SESSION[$sitecode.'level']=$row["level"]; //1=cust, 2=teller/cashier, 3=manager
			$_SESSION[$sitecode.'fname']=$row["fname"];
			$_SESSION[$sitecode.'address']=$row["address"];
			$_SESSION[$sitecode.'contact']=$row["contact"];
			$_SESSION[$sitecode.'id']=$row["id"];
			$_SESSION[$sitecode.'created']=$row["created"];
		}
		$e=($result->num_rows==0)?"e=".base64_encode("User not found!"):$e;
		
		$result->free();
		
		header("Location: .".($urlvars=="" || $_SESSION[$sitecode.'level']>1?($p==""?"".($e!=""?"?$e":""):"?p=$p&$e"):"?$urlvars&$e"));
		exit();
	}

	if (isset($_POST['register'])){
		$user = $_POST['user']??"";
		$pass=md5($key.$_POST["pass"]??"");
		$pass2=md5($key.$_POST["pass2"]??"");
		$fname = $_POST['fname']??"";
		$addr = $_POST['addr']??"";
		$cp = $_POST['cp']??"";
		$email = $_POST['email']??"";
		
		$q="SELECT * FROM tblusers WHERE username='$user'";
		$result = $mysqli->query($q);
		if($result->num_rows>0){ header("Location: .?e=".base64_encode("Username Already Exist!")); exit(); }

		if($pass==$pass2){
			$newid=uniqid();
			$q="INSERT INTO tblusers(id,username,password,level,fname,address,contact,email) VALUES('$newid','$user','$pass',1,'$fname','$addr','$cp','$email')";
			$mysqli->query($q);
			
			$_SESSION[$sitecode.'signed_in']=true;
			$_SESSION[$sitecode.'username']=$user;
			$_SESSION[$sitecode.'password']=$pass;
			$_SESSION[$sitecode.'level']=1; //1=cust, 2=teller/cashier, 3=manager
			$_SESSION[$sitecode.'fname']=$fname;
			$_SESSION[$sitecode.'address']=$addr;
			$_SESSION[$sitecode.'contact']=$cp;
			$_SESSION[$sitecode.'id']=$newid;
		}else{
			header("Location: .?e=".base64_encode("Password not match!"));exit();
		}
		header("Location: .");
		exit();
	}

	if (isset($_GET['logout'])){
		unset($_SESSION[$sitecode.'signed_in'], $_SESSION[$sitecode.'signed_in'],
			$_SESSION[$sitecode.'username'], $_SESSION[$sitecode.'password'],
			$_SESSION[$sitecode.'level'], $_SESSION[$sitecode.'fname'],
			$_SESSION[$sitecode.'address'], $_SESSION[$sitecode.'contact'],
			$_SESSION[$sitecode.'pic'], $_SESSION[$sitecode.'id'],
			$_SESSION[$sitecode.'created']);
		header("Location: .");
		exit;
	}

	$issigned = $_SESSION[$sitecode.'signed_in']??false;
	$userlvl = $_SESSION[$sitecode.'level']??0;
	$userid = $_SESSION[$sitecode.'id']??"";
	
	$p=$_GET['p']??"homepage";
	$e_msg=$_GET["e"]??"";
	$msg=$_GET["msg"]??"";
	if($p=="report"){ include "report.php"; exit;}
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo TITLE; ?> | <?php echo $p; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="<?php echo getHome(); ?>/css/bootstrap.min.css" rel="stylesheet">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo getHome(); ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo getHome(); ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
  <link href="<?php echo getHome(); ?>/js/themes/base/jquery-ui.css" rel="stylesheet">
  <script src="<?php echo getHome(); ?>/js/jquery.min.js"></script>
  <script src="tfx.js"></script>

  <link rel="stylesheet" href="<?php echo getHome(); ?>/plugins/font-awesome/css/font-awesome.min.css">

  <!-- Custom Styles -->	
  <style>
  
.navbar-default {
	background-image: url("images/lowpoly2.png");
    border-color: #e7e7e7;
}
.navbar-default .navbar-nav > li > a {
    color: #fee;
}
.navbar-default .navbar-brand {
    color: #fee;
}

body {
  padding-top: 60px;
}
.card-shadow{
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.text-shadow{
	color: #448bdd;
	text-shadow: 2px 2px 4px #000000;
}
  </style>
</head>
<body>
	<?php include "topnav.php"; ?>
  <div class="<?php echo $p!="homepage"?"container":""?>">
    <!-- contents starts here -->
	<br>
	<?php 
	if (file_exists("pages/$p.php")) {
		include "pages/$p.php"; 
	} else {
		include "pages/404.php"; 
	}
	?>
    <!-- contents end here -->	
  </div>
  
	<?php include "loginreg.php"; ?>
	<?php include "footer.php"; ?>
	
<div id="e_msg-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" style="width: 400px">
    <div class="modal-content" style="border-color: #ff6c6c;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
        <h4 class="modal-title" id="myModalLabel" style="color: #ff6c6c">Error</h4>
      </div>
		<div class="modal-body" style="color: #ff6c6c">
			<?php echo ($e_msg!=""?base64_decode($e_msg):""); ?>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</div>
    </div>
  </div>
</div>
	
<div id="msg-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" style="width: 400px">
    <div class="modal-content" style="border-color: green;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
        <h4 class="modal-title" id="myModalLabel" style="color: green">Success</h4>
      </div>
		<div class="modal-body" style="color: green">
			<?php echo ($msg!=""?base64_decode($msg):""); ?>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
		</div>
    </div>
  </div>
</div>

  <!-- JavaScript Includes -->
  <script src="<?php echo getHome(); ?>/js/jquery-ui.min.js"></script>
  <script src="<?php echo getHome(); ?>/js/bootstrap.min.js"></script>
  
  <!-- JavaScript Scripts -->
  <script>
	$(function () {
		<?php if($e_msg!=""){ ?>
		$('#e_msg-modal').modal('show');
		<?php } ?>
		<?php if($msg!=""){ ?>
		$('#msg-modal').modal('show');
		<?php } ?>
	});
  </script>

</body>
</html>