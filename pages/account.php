<?php

	if (isset($_POST["op"])){
		$op=$_POST["op"];
		
		if (isset($_POST["urlvars"])){$urlvars=$_POST["urlvars"];}else{$urlvars="";}
	
		$id=@$_POST["id"];
		$msg="";
		if ($op=="save"){
			$user=$_POST["user"];
			$pass=$_POST["pass"];
			$pass2=$_POST["pass2"];
			$hashedpass=md5($key.$_POST["pass"]);
			$hashedpass2=md5($key.$_POST["pass2"]);
			$fname=@$_POST["fname"];
			$addr=@$_POST["addr"];
			$gender=@$_POST["gender"];
			$cp=@$_POST["cp"];
			$email=@$_POST["email"];
			
			if(is_uploaded_file($_FILES['photo']['tmp_name'])) {
				delpic("images/profiles/$userid");
				$fn = $_FILES["photo"]["name"];
				$ext = pathinfo($fn, PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["photo"]["tmp_name"], "images/profiles/$userid.$ext");
			}
			
			if ($hashedpass==$hashedpass2){
				$qpass=""; 
				if($pass!=$_SESSION[$sitecode.'password']){
					$qpass=", password='$hashedpass'";
					$_SESSION[$sitecode.'password']=$hashedpass;
				}
				$q="UPDATE tblusers SET username='$user', fname='$fname', address='$addr', contact='$cp', email='$email' $qpass WHERE id='$userid'";
				$_SESSION[$sitecode.'username']=$user;
				$_SESSION[$sitecode.'fname']=$fname;
				$_SESSION[$sitecode.'gender']=$gender;
				$_SESSION[$sitecode.'address']=$addr;
				$_SESSION[$sitecode.'contact']=$cp;
			}
			if (!$mysqli->query($q)) {
				$_SESSION['emsg'] =$mysqli->error;
				$_SESSION['emsg'] .= "<br>$q";
			}else{
				$msg="Success!";
			}
		}else{
			$_SESSION['emsg']="Password not matched!";		
		}
			?>
			<script>window.location = '<?php echo getHome();?>?p=account<?php echo $msg!=""?"&msg=".base64_encode($msg):""; ?>';</script>
			<?php
		exit;
	}
		
?>
<section class="row"><br>
	<div class="form-horizontal">
	<form method="post" enctype="multipart/form-data">
<div class="col-md-5">
		<fieldset>
		<div class="form-group">
		  <label class="col-lg-3 control-label">Username</label>
		  <div class="col-lg-6">
			<input type="text" name="user" class="form-control" placeholder="Type your username" value="<?php echo $_SESSION[$sitecode.'username']; ?>" readonly>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-lg-3 control-label">Password</label>
		  <div class="col-lg-9">
			<input type="password" name="pass"class="form-control" placeholder="Type your password" value="<?php echo $_SESSION[$sitecode.'password']; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-lg-3 control-label"></label>
		  <div class="col-lg-9">
			<input type="password" name="pass2" class="form-control" placeholder="Re-Enter Password" value="<?php echo $_SESSION[$sitecode.'password']; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-lg-3 control-label">Fullname</label>
		  <div class="col-lg-9">
			<input type="text" name="fname" class="form-control" placeholder="Type your fullname" value="<?php echo $_SESSION[$sitecode.'fname']; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-lg-3 control-label">Address</label>
		  <div class="col-lg-9">
			<input type="text" name="addr" class="form-control" placeholder="Type your address" value="<?php echo $_SESSION[$sitecode.'address']; ?>">
		  </div>
		  </div>
		<div class="form-group">
			<label class="col-lg-3 control-label">Gender</label> 
			<div class="col-lg-5">
				<select class="form-control" name="gender">
				  <option></option>
				  <option <?php echo ($_SESSION[$sitecode.'gender']=="Male"?"selected":""); ?>>Male</option>
				  <option <?php echo ($_SESSION[$sitecode.'gender']=="Female"?"selected":""); ?>>Female</option>
				  <option <?php echo ($_SESSION[$sitecode.'gender']=="Rather not say"?"selected":""); ?>>Rather not say</option>
				</select>
			</div>
		</div>
		<div class="form-group">
		  <label class="col-lg-3 control-label">Contact No.</label>
		  <div class="col-lg-9">
			<input type="text" name="cp" class="form-control" placeholder="Type your contact no." value="<?php echo $_SESSION[$sitecode.'contact']; ?>">
		  </div>
		</div>
</div>
<div class="col-md-4">
		<?php  $pic=loadpic("images/profiles/".$_SESSION[$sitecode."id"],"images/nopic.jpg"); ?>
		<div class="form-group row">
			<label class="col-sm-3 control-label">Photo</label>
			<div class="col-sm-8">
				<input type="file" class="form-contrsol" id="photo" name="photo" onchange="previewImgFile(this);">
				<img id="previewImg" src="<?php echo $pic; ?>" alt="Placeholder" width="80%" class="img-thumbnail" />
			</div>
		</div>
		</fieldset>
</div>
<div class="col-md-9">
			<div class="pull-right">
				<button onclick="return confirm('Confirm save?');" id="btn3" type="submit" name="op" value="save" class="btn btn-lg btn-primary">Save</button>
			</div>
</div>
	</form>
</div>
</div>	
</section>
