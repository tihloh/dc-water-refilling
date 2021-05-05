<?php 
	$tdate=tosqldate($_GET["date"]??$ftoday);
if(isset($_GET["cancel"])){
	$id=$_GET["cancel"]??"";		
	$user=$_GET["user"]??"";		
	$name=$_GET["name"]??"";		
	$q="UPDATE tblorders SET cancelled=1 WHERE id='$id'";
	//echo $q; exit;
	$mysqli->query($q);
		?><script>window.location = '<?php echo getHome()."?p=userorders&user=$user&name=$name";?>';</script><?php
	exit;
}
if(isset($_GET["del"])){
	$id=$_GET["del"]??"";		
	$q="DELETE FROM tblorders WHERE id='$id'";
	//echo $q;
	$mysqli->query($q);
		?><script>window.location = '<?php echo getHome()."?p=userorders&user=$user&name=$name";?>';</script><?php
	exit;
}

$user=$_GET["user"]??"guest";
$name=$_GET["name"]??"Guest";
 ?>
<h1><?php echo $name; ?></h1>
<section class="row">
<div class="col-md-9">
	<h3>Orders</h3>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Customer</th>
          <th>Address</th>
          <th>CP</th>
          <th>Order</th>
          <th>Price</th>
          <th>Status</th>
          <th>Remarks</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php
	$q="SELECT *,o.id oid FROM tblorders o INNER JOIN 
		(SELECT GROUP_CONCAT(' ',oi.qty,' ',item) details, orderid FROM tblorder_items oi INNER JOIN tblitems i ON oi.itemid=i.id WHERE fromsched=0 GROUP BY orderid) oi ON oi.orderid=o.id
		WHERE o.userid='".($user=="guest"?"":$user)."'
		ORDER BY cancelled, time desc";
	//echo $q;
	$result = $mysqli->query($q);
	$no=0; $isactive=false;
	while ($row = $result->fetch_assoc()){
		$cancelled=$row["cancelled"]==1;
?>
        <tr class="<?php if($row["paid"]==1){echo "info";}elseif($row["delivered"]==1){echo "success";}elseif($row["cancelled"]==1){ echo "danger";} ?>">
          <td><i class="fa fa-user "></i> <?php echo $row["customer"]; ?></td>
          <td><?php echo $row["addr"]; ?></td>
          <td><?php echo $row["cp"]; ?></td>
          <td><?php echo $row["details"]; ?></td>
          <td><?php echo formatnum($row["charge"]); ?></td>
          <td><?php 
			if($row["cancelled"]==1){
				echo "Cancelled ";
			}else{
				if($row["paid"]==1){
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
          <td></td>
		  <td>
			<?php if(!$cancelled){ ?>
			<a onclick="return confirm('Confirm cancel?');" href=".?p=userorders&cancel=<?php echo $row["oid"]."&user=$user&name=$name"; ?>" class="btn btn-xs btn-warning">Cancel</a>
			<?php } ?>
			</td>
        </tr>
 <?php
	}
	$result->free();
	/*
	$cday=strtolower(datetoformat($tdate,"D"));
	$q="SELECT *,o.id oid FROM tblsched o INNER JOIN 
		(SELECT GROUP_CONCAT(' ',oi.qty,' ',item) details, orderid FROM tblorder_items oi INNER JOIN tblitems i ON oi.itemid=i.id WHERE fromsched=1 GROUP BY orderid) oi ON oi.orderid=o.id
		WHERE o.userid='$user'";

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
	$result->free();*/
  ?>
      </tbody>
    </table>
</div>	

<div class="col-md-9">
	<form>
	<h2><i class="fa fa-calendar-check-o "></i> Schedules</h2>
	</form>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Customer</th>
          <th>Address</th>
          <th>Order</th>
          <th>Price</th>
          <th>Sched</th>
          <th>Status</th>
          <th>Remarks</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php
	$q="SELECT * FROM tblsched s LEFT JOIN tblusers u ON s.userid=u.id ORDER BY userid desc";
	$q="SELECT * FROM tblsched o INNER JOIN 
		(SELECT GROUP_CONCAT(' ',oi.qty,' ',item) details, orderid FROM tblorder_items oi INNER JOIN tblitems i ON oi.itemid=i.id WHERE fromsched=1 GROUP BY orderid) oi ON oi.orderid=o.id
		LEFT JOIN tblusers u ON o.userid=u.id 
		WHERE o.userid='".($user=="guest"?"":$user)."'
		ORDER BY userid desc";
	//echo $q;
	$result = $mysqli->query($q);
	$no=0; $isactive=false;
	while ($row = $result->fetch_assoc()){
?>
        <tr class="<?php if($row["paid"]==1){echo "info";}elseif($row["delivered"]==1){echo "success";}elseif($row["cancelled"]==1){ echo "danger";} ?>">
          <td><?php echo $row["fname"]; ?></td>
          <td><?php echo $row["addr"]; ?></td>
          <td><?php echo $row["details"]; ?></td>
          <td><?php echo formatnum($row["charge"]); ?></td>
          <td><?php echo $row["sched"]; ?></td>
          <td><?php echo ($row["cancelled"]==1?"Cancelled ":($row["paid"]==1?"Paid ":"Pending").($row["delivered"]==1?"Delivered ":"")); ?></td>
          <td></td>
		  <td><a href=".?p=dailyorders&cancel=<?php echo $row["id"]; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-ban-circle"></span></a></td>
        </tr>
 <?php
	}
	$result->free();
	
	$cday=datetoformat($ftoday,"D");
	$nday=datetoformat($ftoday,"D");
	$q="SELECT * FROM tblsched s LEFT JOIN tblusers u ON s.userid=u.id WHERE sched like '%$cday%' or sched like '%$nday%'";

	//echo $q;
	$result = $mysqli->query($q);
	$no=0; $isactive=false;
	while ($row = $result->fetch_assoc()){
?>
        <tr class="<?php if($row["paid"]==1){echo "info";}elseif($row["delivered"]==1){echo "success";}elseif($row["cancelled"]==1){ echo "danger";} ?>">
          <td><i class="fa fa-calendar-check-o "></i> <?php echo $row["fname"]; ?></td>
          <td><?php echo $row["addr"]; ?></td>
          <td><?php echo $row["part"]; ?></td>
          <td><?php echo formatnum($row["charge"]); ?></td>
          <td><?php echo ($row["paid"]==1?"Paid ":"Pending").($row["delivered"]==1?"Delivered ":"").($row["cancelled"]==1?"Cancelled ":""); ?></td>
          <td>From Sched</td>
        </tr>
 <?php
	}
  ?>
      </tbody>
    </table>
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
