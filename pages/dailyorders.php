<?php 
	$tdate=tosqldate($_GET["date"]??$ftoday);
if(isset($_GET["cancel"])){
	$id=$_GET["cancel"]??"";		
	$q="UPDATE tblorders SET cancelled=1 WHERE id='$id'";
	//echo $q; exit;
	$mysqli->query($q);
		?><script>window.location = '<?php echo getHome();?>?p=dailyorders';</script><?php
	exit;
}
if(isset($_GET["paid"])){
	$id=$_GET["paid"]??"";		
	$q="UPDATE tblorders SET paid=1 WHERE id='$id'";
	//echo $q; exit;
	$mysqli->query($q);
		?><script>window.location = '<?php echo getHome();?>?p=dailyorders';</script><?php
	exit;
}
if(isset($_GET["del"])){
	$id=$_GET["del"]??"";		
	$q="DELETE FROM tblorders WHERE id='$id'";
	//echo $q;
	$mysqli->query($q);
		?><script>window.location = '<?php echo getHome();?>?p=dailyorders';</script><?php
	exit;
}

 ?>
<section class="row">
<div class="col-md-9">
<ul class="nav nav-tabs">
	<li class="active">
		<a href="#orders" data-toggle="tab"><h2>Orders</h2></a>
	</li>
	<li>
		<a href="#booking" data-toggle="tab"><h2>Bookings</h2></a>
	</li>
	<li class="pull-right">
		<form>
			<h2>
				<input type="hidden" name="p" value="<?php echo $p; ?>" />
				<input type="date" id="dtpicker" name="date" value="<?php echo $tdate; ?>" />
			</h2>
		</form>
	</li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="orders">
	<h3>Orders to be delivered today.</h3>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Customer</th>
          <th>Address</th>
          <th>Order</th>
          <th>Price</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php
	$q="SELECT *,o.id oid, (delivered=0 && date(time)<date(CURRENT_TIMESTAMP)) past FROM tblorders o INNER JOIN 
		(SELECT GROUP_CONCAT(' ',oi.qty,' ',item) details, orderid FROM tblorder_items oi INNER JOIN tblitems i ON oi.itemid=i.id WHERE fromsched=0 GROUP BY orderid) oi ON oi.orderid=o.id
		LEFT JOIN tblusers u ON o.userid=u.id 
		WHERE date(time)='$tdate' ORDER BY cancelled, time desc";

	$result = $mysqli->query($q);
	$no=0; $isactive=false;
	while ($row = $result->fetch_assoc()){
		$cancelled=$row["cancelled"]==1;
		$paid=$row["paid"];
?>
        <tr class="<?php if($paid==1){echo "info";}elseif($row["delivered"]==1){echo "success";}elseif($row["cancelled"]==1){ echo "danger";} ?>">
          <td><i class="fa fa-user "></i> <?php echo $row["customer"]; ?></td>
          <td><?php echo $row["addr"]; ?></td>
          <td><?php echo $row["details"]; ?></td>
          <td><?php echo formatnum($row["charge"]); ?></td>
          <td><?php 
			if($row["cancelled"]==1){
				echo "Cancelled ";
			}elseif($row['past']==1){
				echo "Undelivered";
			}else{
				if($paid==1){
					echo "Paid ";
				}
				if($row["delivered"]==1){
					echo "Delivered ";
				}else{
					if($row["otw"]==1){
						echo "On the Way ";
					}
				}
			}
			?></td>
		  <td>
			<?php if(!$paid && !$cancelled){ ?>
			<a onclick="return confirm('Confirm payment?');" href=".?p=dailyorders&paid=<?php echo $row["oid"]; ?>" class="btn btn-xs btn-warning">Confirm Paid</a>
			<a onclick="return confirm('Confirm cancel?');" href=".?p=dailyorders&cancel=<?php echo $row["oid"]; ?>" class="btn btn-xs btn-warning">Cancel</a>
			<?php } ?>
			</td>
        </tr>
 <?php
	}
	$result->free();
	
	$cday=strtolower(datetoformat($tdate,"D"));
	$q="SELECT *,o.id oid FROM tblsched o INNER JOIN 
		(SELECT GROUP_CONCAT(' ',oi.qty,' ',item) details, orderid FROM tblorder_items oi INNER JOIN tblitems i ON oi.itemid=i.id WHERE fromsched=1 GROUP BY orderid) oi ON oi.orderid=o.id
		LEFT JOIN tblusers u ON o.userid=u.id 
		WHERE sched like '%$cday%'";

	//echo $q;
	$result = $mysqli->query($q);
	$no=0; $isactive=false;
	while ($row = $result->fetch_assoc()){
?>
        <tr class="<?php if($row["paid"]==1){echo "info";}elseif($row["delivered"]==1){echo "success";}elseif($row["cancelled"]==1){ echo "danger";} ?>">
          <td><i class="fa fa-user "></i> <i class="fa fa-calendar-check-o "></i> <?php echo $row["fname"]; ?></td>
          <td><?php echo $row["addr"]; ?></td>
          <td><?php echo $row["details"]; ?></td>
          <td><?php echo formatnum($row["charge"]); ?></td>
          <td><?php echo ($row["paid"]==1?"Paid ":"Pending").($row["delivered"]==1?"Delivered ":"").($row["cancelled"]==1?"Cancelled ":""); ?></td>
          <td>From Sched</td>
          <td></td>
        </tr>
 <?php
	}
	$result->free();
  ?>
      </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="booking">
	<h3>Received orders.</h3>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Customer</th>
          <th>Address</th>
          <th>Order</th>
          <th>Price</th>
          <th>Delivery Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php
	$q="SELECT *,o.id oid, (delivered=0 && date(time)<date(CURRENT_TIMESTAMP)) past FROM tblorders o INNER JOIN 
		(SELECT GROUP_CONCAT(' ',oi.qty,' ',item) details, orderid FROM tblorder_items oi INNER JOIN tblitems i ON oi.itemid=i.id WHERE fromsched=0 GROUP BY orderid) oi ON oi.orderid=o.id
		LEFT JOIN tblusers u ON o.userid=u.id 
		WHERE date(o.created)='$tdate' ORDER BY cancelled, time desc";
	//echo $q;
	$result = $mysqli->query($q);
	$no=0; $isactive=false;
	while ($row = $result->fetch_assoc()){
		$cancelled=$row["cancelled"]==1;
?>
        <tr class="<?php if($row["paid"]==1){echo "info";}elseif($row["delivered"]==1){echo "success";}elseif($row["cancelled"]==1){ echo "danger";} ?>">
          <td><i class="fa fa-user "></i> <?php echo $row["customer"]; ?></td>
          <td><?php echo $row["addr"]; ?></td>
          <td><?php echo $row["details"]; ?></td>
          <td><?php echo formatnum($row["charge"]); ?></td>
          <td><?php echo toformaldate($row["time"]); ?></td>
          <td><?php echo ($row["cancelled"]==1?"Cancelled ":($row["past"]==1?"Undelivered":($row["paid"]==1?"Paid ":"Pending").($row["delivered"]==1?"Delivered ":""))); ?></td>
		  <td>
			<?php if(!$cancelled){ ?>
			<a onclick="return confirm('Confirm cancel?');" href=".?p=dailyorders&cancel=<?php echo $row["oid"]; ?>" class="btn btn-xs btn-warning">Cancel</a>
			<?php } ?>
			</td>
        </tr>
 <?php
	}
	$result->free();
  ?>
      </tbody>
    </table>
  </div>
</div>
</div>	
</section>

<script>
$(function(){
	$("#dtpicker").change(function() {
	  this.form.submit();
	});
});
</script>
