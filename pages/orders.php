	<?php
if(isset($_GET["cancel"])){
	$id=$_GET["cancel"]??"";		
	$q="UPDATE tblorders SET cancelled=1 WHERE id='$id'";
	//echo $q;
	$mysqli->query($q);
	?><script>window.location = '<?php echo getHome();?>?p=orders';</script><?php
	exit;
}
if(isset($_GET["del"])){
	$id=$_GET["del"]??"";		
	$q="DELETE FROM tblsched WHERE id='$id'";
	//echo $q;
	$mysqli->query($q);
	?><script>window.location = '<?php echo getHome();?>?p=orders';</script><?php
	exit;
}

$id=$_SESSION[$sitecode.'id']??"";
?>
<section class="row">
<div class="col-md-6">
	<h2>My Orders</h2>
	<p class="text-danger">*Cancel is not available for orders older than 15mins.</p>
	<?php if($id==""){ ?>
	<p class="text-danger">*You are consider as guest. Orders listed here are based from orders with the same IP address of the device you are using.</p>
	<?php } ?>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Date</th>
          <th>Order</th>
          <th>Price</th>
          <th>Address</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
<?php
	
	$q="SELECT *, TIMESTAMPDIFF(MINUTE,created,NOW()) min FROM tblorders o INNER JOIN 
		(SELECT GROUP_CONCAT(' ',oi.qty,' ',item) details, orderid FROM tblorder_items oi INNER JOIN tblitems i ON oi.itemid=i.id WHERE fromsched=0 GROUP BY orderid) oi ON oi.orderid=o.id
		WHERE userid='$id' ".($id==""?"and ip='$ip'":"")." ORDER BY cancelled, paid,delivered desc,time desc";
	//echo $q;
	$result = $mysqli->query($q);
	$no=0; $isactive=false;
	while ($row = $result->fetch_assoc()){
		$cancelled=$row["cancelled"]==1;
		$paid=$row["paid"];
?>
        <tr class="<?php if($row["paid"]==1){echo "info";}elseif($row["delivered"]==1){echo "success";}elseif($cancelled){ echo "danger";} ?>">
          <td><?php echo toformaldate($row["time"]); ?></td>
          <td><?php echo $row["details"]; ?></td>
          <td><?php echo formatnum($row["charge"]); ?></td>
          <td><?php echo $row["addr"]; ?></td>
          <td><?php echo ($cancelled?"Cancelled ":($row["paid"]==1?"Paid ":"Pending").($row["delivered"]==1?"Delivered ":"")); ?></td>
		  <td>
			<?php if($row["min"]<15 && !$cancelled && $paid==0){ ?>
			<a onclick="return confirm('Confirm cancel?');" href=".?p=orders&cancel=<?php echo $row["id"]; ?>" class="btn btn-xs btn-warning">Cancel</a>
			<a href=".?p=editorder&id=<?php echo $row["id"]; ?>&s=orders" class="btn btn-xs btn-default">Edit</a>
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

<div class="col-md-6">
	<h2>My Scheduled Orders</h2>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Schedule</th>
          <th>Order</th>
          <th>Price</th>
          <th>Address</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
<?php
	$q="SELECT * FROM tblsched WHERE userid='$id' ORDER BY created desc";
	$q="SELECT * FROM tblsched o INNER JOIN 
		(SELECT GROUP_CONCAT(' ',oi.qty,' ',item) details, orderid FROM tblorder_items oi INNER JOIN tblitems i ON oi.itemid=i.id WHERE fromsched=1 GROUP BY orderid) oi ON oi.orderid=o.id
		WHERE userid='$id' ORDER BY created desc";
	//echo $q;
	$result = $mysqli->query($q);
	$no=0; $isactive=false;
	while ($row = $result->fetch_assoc()){
		$sched=$row["sched"];
		$sched=str_ireplace("sun","Sunday",$sched);
		$sched=str_ireplace("mon","Monday",$sched);
		$sched=str_ireplace("tue","Tuesday",$sched);
		$sched=str_ireplace("wed","Wednesday",$sched);
		$sched=str_ireplace("thu","Thursday",$sched);
		$sched=str_ireplace("fri","Friday",$sched);
		$sched=str_ireplace("sat","Saturday",$sched);
?>
        <tr class="<?php if($row["paid"]==1){echo "info";}elseif($row["delivered"]==1){echo "success";}elseif($row["cancelled"]==1){ echo "danger";} ?>">
          <td><?php echo $sched; ?></td>
          <td><?php echo $row["details"]; ?></td>
          <td><?php echo formatnum($row["charge"]); ?></td>
          <td><?php echo $row["addr"]; ?></td>
		  <td>
			<a href=".?p=editorder&id=<?php echo $row["id"]; ?>&s=sched" class="btn btn-xs btn-default">Edit</a>
			<a onclick="return confirm('Confirm delete?');" href=".?p=orders&del=<?php echo $row["id"]; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
			</td>
        </tr>
 <?php
	}
	$result->free();
  ?>
      </tbody>
    </table>
</div>	
</section>
