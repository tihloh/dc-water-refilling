<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//post operation here...
	
	$op=$_POST["op"]??"";
	if($op=="save"){
		$userid=$_POST["userid"]??"";
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
		
		$newid=uniqid();
		$ip=$_SERVER['REMOTE_ADDR'];
		
			$aitems=$_POST["items"]??"";
			$items_q="";
			if(isset($_POST["items"])){
				foreach($aitems as $item){
					$fromsched=$sched==""?0:1;
					$items_q .= ($items_q==""?"":", ")."('$newid',$item,$fromsched)";
				}
				$q="INSERT INTO tblorder_items(orderid, itemid, qty,fromsched) VALUES$items_q";
				//echo "$q<br>";
				$mysqli->query($q);
			}
		
		if($sched==""){
			$q="INSERT INTO tblorders(id,userid,time,part,customer,addr,cp,charge, ip) VALUES('$newid','$userid','$time','$part','$cust','$addr','$contact','$charge', '$ip');";
		}else{
			$q="INSERT INTO tblsched(id,userid,sched,part,customer,addr,cp,charge, ip) VALUES('$newid','$userid','$sched','$part','$cust','$addr','$contact','$charge', '$ip');";
		}
		$newid=uniqid(); $time=tosqldate($ftoday);
		$q .= "INSERT INTO tblsms(id,cp,_out,msg,stime) VALUES('$newid','$contact',1,'Order has been created with the total amount of P$charge. -(".SubTITLE.")','$time')";
		$mysqli->multi_query($q);
		$pp=($userlvl>1?"dailyorders":"orders");
		//echo "$sched<br>$q"; exit;
		?><script>window.location = '<?php echo getHome()."?p=$pp";?>';</script><?php
	}
	exit;
}
	$userid=$_GET["user"]??($_SESSION[$sitecode.'id']??"");
	$q="SELECT * FROM tblusers WHERE id='$userid'";

	$result = $mysqli->query($q);
	$row = $result->fetch_assoc();
?>

<h2>Order Summary</h2>

<form method="post">
	<input type="hidden" name="p" value="quickorder"/>
	<input type="hidden" name="userid" value="<?php echo $userid; ?>"/>
<section class="row">
	<div class="col-md-6">
		<div class="well">
			<div class="row">
				<div class="col-md-12">
					<h3>Customer Information</h3>
				</div>
				<div class="col-md-3">
					<h4>Customer:</h4>
				</div>
				<div class="col-md-8">
					<h4><input type="text" name="cust" class="form-control input-md" value="<?php echo @$row['fname']; ?>" required></h4>
				</div>
				<div class="col-md-3">
					<h4>Address:</h4>
				</div>
				<div class="col-md-8">
					<h4><input type="text" name="addr" class="form-control input-md" value="<?php echo @$row['address']; ?>" required></h4>
				</div>
				<div class="col-md-3">
					<h4>Contact:</h4>
				</div>
				<div class="col-md-6">
					<h4><input type="text" name="contact" class="form-control input-md" value="<?php echo @$row['contact']; ?>" required></h4>
				</div>
			</div>
		</div>
		<div class="well">
		<fieldset>
			<div class="form-group row">
			  <label for="inputEmail" class="col-lg-4 control-label input-md">Date of Delivery</label>
			  <div class="col-lg-6">
				<input type="date" style="line-height: 1" class="form-control input-md" name="time" value="<?php echo tosqldate($ftoday); ?>">
			  </div>
			</div>
			<?php if($userid!=""){ ?>
			<div class="form-group row">
			  <label for="inputEmail" class="col-lg-4 control-label input-md">Schedule</label>
			  <div class="col-lg-6" style="font-size:20px">
					<select class="form-control select2 input-md" name="sched[]" multiple="multiple" style="width: 100%;">
						<option value="sun">Sunday</option>
						<option value="mon">Monday</option>
						<option value="tue">Tuesday</option>
						<option value="wed">Wednesday</option>
						<option value="thu">Thursday</option>
						<option value="fri">Friday</option>
						<option value="sat">Saturday</option>
						<option value="sun, mon, tue, wed, thu, fri, sat">- EVERYDAY -</option>
					</select>
			  </div>
			</div>
			<?php } ?>
		</fieldset>
		</div>
	</div>
	<div class="col-md-6">
		<table class="table table-hover">
		  <thead>
			<tr>
			  <th></th>
			  <th>Item</th>
			  <th style="text-align:right">Price</th>
			  <th style="width: 50px" style="text-align:center">Qty</th>
			  <th style="width: 50px" style="text-align:right">Total</th>
			</tr>
		  </thead>
		  <tbody>
	<?php
		$qitems="";
		$arrqty=array();
		if(isset($_GET['id'])){
			$ids = $_GET['id'];
			$qty = $_GET['qty'];
			for ($i = 0; $i < count($ids); $i++){
				$qitems .= ($qitems==""?"":",")."'".$ids[$i]."'";
				$arrqty[$ids[$i]]=$qty[$i];
			}
		}

		$q="SELECT * FROM tblitems WHERE id in ($qitems) ORDER BY item desc";
		$result = $mysqli->query($q);
		$net=0; $isactive=false;
		while ($row = $result->fetch_assoc()){
			$stotal=$row["price"]*$arrqty[$row["id"]];
			$net+=$stotal;
			$pic="images/items/".$row["id"];
			$fpic="images/nopic.jpg";
			if(file_exists("$pic.jpg")){ $fpic="$pic.jpg"; }
			if(file_exists("$pic.png")){ $fpic="$pic.png"; }
		?>
			<input type="hidden" name="items[]" value="<?php echo "'".$row["id"]."','".$arrqty[$row["id"]]."'"; ?>" />
			<tr>
				<td><img class="img-thumbnail" alt="200x200" src="<?php echo $fpic; ?>" style="width: 50px;" /></td>
				<td><h4 class="text-primary"><?php echo $row["item"]; ?></h4></td>
				<td><h4 class="text-muted" style="text-align:right"><?php echo formatnum($row["price"]); ?></h4></td>
				<td><h4 class="text-muted" style="text-align:center"><?php echo $arrqty[$row["id"]]; ?></h4></td>
				<td><h4 style="text-align:right">P<?php echo formatnum($stotal); ?></h4></td>
			</tr>
		<?php
		}
		$result->free();
		?>
			<tr class="warning">
				<td colspan="4"><h3 style="text-align:right">Total Amount to Pay</h3></td>
				<td><h3 class="text-danger" style="text-align:right"><b>P<?php echo formatnum($net); ?></b></h3></td>
			</tr>
		  </tbody>
		</table>
	<div class="col-md-12">
		<div class=" pull-right">
		  <button type="button" class="btn btn-lg btn-default" onclick="window.history.back();"><span class="glyphicon glyphicon-chevron-left"></span> Back</button>
		  <button onclick="return confirm('Confirm Order?')" type="submit" class="btn btn-lg btn-primary" name="op" value="save">Submit Order <span class="glyphicon glyphicon-ok"></span></button>
		</div>
	</div>
	</div>
			<input type="hidden" name="charge" value="<?php echo $net; ?>"/>
	
</section>
</form>

<script src="<?php echo getHome(); ?>/plugins/select2/js/select2.full.min.js"></script>
<script>
	$(function () {
		//Initialize Select2 Elements
		$('.select2').select2({
		  theme: 'bootstrap4'
		})
	});	
</script>