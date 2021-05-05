<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {	
	$op=$_POST["op"]??"";
	if($op=="save"){
		$id=$_POST["id"]??"";
		$time=$_POST["time"]??"";
		$cust=$_POST["cust"]??"";
		$addr=$_POST["addr"]??"";
		$contact=$_POST["contact"]??"";
		$charge=$_POST["charge"]??"";
		$part="";
		
			$asched=$_POST["sched"]??"";
			$sched="";
			if(isset($_POST["sched"])){
				for($i=0; $i < count($asched); $i++){
					$sched .= iif($sched=="","",", ");
					$sched .= $asched[$i];
				}
			}
				
		if($sched==""){
			$q="UPDATE tblorders SET time='$time',customer='$cust',addr='$addr',cp='$contact' WHERE id='$id'";
		}else{
			$q="UPDATE tblsched SET sched='$sched',customer='$cust',addr='$addr',cp='$contact' WHERE id='$id'";
		}
		$newid=uniqid(); $time=tosqldate($ftoday);
		$mysqli->multi_query($q);
		$pp=($userlvl>1?"dailyorders":"orders");
		?><script>window.history.go(-2);</script><?php
	}
	exit;
}
	$id=$_GET["id"]??"";
	$s=$_GET["s"]??"";
	if($s=="orders"){
		$q="SELECT *,date(time) dtime FROM tbl$s WHERE id='$id'";
	}else{
		$q="SELECT * FROM tbl$s WHERE id='$id'";
	}
	$result = $mysqli->query($q);
	$row = $result->fetch_assoc();
?>

<h2>Edit Info</h2>

<form method="post">
	<input type="hidden" name="p" value="quickorder"/>
	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
	<input type="hidden" name="tbl" value="<?php echo $s; ?>"/>
<section class="row">
	<div class="col-md-2"></div>
	<div class="col-md-6">
		<div class="well">
			<div class="row">
				<div class="col-md-3">
					<h4>Customer:</h4>
				</div>
				<div class="col-md-8">
					<h4><input type="text" name="cust" class="form-control input-md" value="<?php echo $row['customer']; ?>" required></h4>
				</div>
				<div class="col-md-3">
					<h4>Address:</h4>
				</div>
				<div class="col-md-8">
					<h4><input type="text" name="addr" class="form-control input-md" value="<?php echo $row['addr']; ?>" required></h4>
				</div>
				<div class="col-md-3">
					<h4>Contact:</h4>
				</div>
				<div class="col-md-6">
					<h4><input type="text" name="contact" class="form-control input-md" value="<?php echo $row['cp']; ?>" required></h4>
				</div>
			</div>
		</div>
		<div class="well">
		<fieldset>
			<?php if($s=="orders"){ ?>
			<div class="form-group row">
			  <label for="inputEmail" class="col-lg-4 control-label input-md">Date of Delivery</label>
			  <div class="col-lg-6">
				<input type="date" style="line-height: 1" class="form-control input-md" name="time" value="<?php echo $row['dtime']; ?>" min="<?php echo tosqldate($ftoday);?>">
			  </div>
			</div>
			<?php }else{ ?>
			<div class="form-group row">
			  <label for="inputEmail" class="col-lg-4 control-label input-md">Schedule</label>
			  <div class="col-lg-6" style="font-size:20px">
					<select class="form-control select2 input-md" name="sched[]" multiple="multiple" style="width: 100%;">
						<option value="sun" <?php echo (strpos($row['sched'],"sun") !== false?"selected":"");?>>Sunday</option>
						<option value="mon" <?php echo (strpos($row['sched'],"mon") !== false?"selected":"");?>>Monday</option>
						<option value="tue" <?php echo (strpos($row['sched'],"tue") !== false?"selected":"");?>>Tuesday</option>
						<option value="wed" <?php echo (strpos($row['sched'],"wed") !== false?"selected":"");?>>Wednesday</option>
						<option value="thu" <?php echo (strpos($row['sched'],"thu") !== false?"selected":"");?>>Thursday</option>
						<option value="fri" <?php echo (strpos($row['sched'],"fri") !== false?"selected":"");?>>Friday</option>
						<option value="sat" <?php echo (strpos($row['sched'],"sat") !== false?"selected":"");?>>Saturday</option>
					</select>
			  </div>
			</div>
			<?php } ?>
		</fieldset>
		</div>
		<div class=" pull-right">
		  <button type="button" class="btn btn-lg btn-default" onclick="window.history.back();">Cancel</button>
		  <button onclick="return confirm('Confirm Order?')" type="submit" class="btn btn-lg btn-primary" name="op" value="save">Save</button>
		</div>
	</div>
	
</section>
</form>

<script src="<?php echo getHome(); ?>/plugins/select2/js/select2.full.min.js"></script>
<script>
	$(function () {
		$('.select2').select2({
		  theme: 'bootstrap4'
		})
	});	
</script>