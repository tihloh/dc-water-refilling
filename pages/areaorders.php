<?php 
	$tdate=tosqldate($_GET["date"]??$ftoday);
if(isset($_GET["cancel"])){
	$id=$_GET["cancel"]??"";		
	$q="UPDATE tblorders SET cancelled=1 WHERE id='$id'";
	echo $q; exit;
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

$area=$_GET["area"]??"";
$q="SELECT *,o.id oid FROM tblorders o INNER JOIN 
	(SELECT GROUP_CONCAT(' ',oi.qty,' ',item) details, orderid FROM tblorder_items oi INNER JOIN tblitems i ON oi.itemid=i.id WHERE fromsched=0 GROUP BY orderid) oi ON oi.orderid=o.id
	WHERE o.addr='$area' and time='$tdate' ORDER BY cancelled, time desc";
?>
		<form>
<h1>
	<a type="button" class="btn btn-md btn-default" onclick="window.history.back();"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
	Area: <?php echo $area; ?>
	<div class=" pull-right">
				<input type="hidden" name="p" value="<?php echo $p; ?>" />
				<input type="hidden" name="area" value="<?php echo $area; ?>" />
				<input type="date" id="dtpicker" name="date" value="<?php echo $tdate; ?>" />
		<a class="btn btn-lg btn-danger" href="<?php echo "?p=report&r=areaorders&area=$area&tdate=$tdate"; ?>" target=_blank>Print</a>
	</div>
</h1>
		</form>
<section class="row">
<div class="col-md-12">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Customer</th>
          <th>Address</th>
          <th>Order</th>
          <th>Price</th>
          <th>Status</th>
          <th>Remarks</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php
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
		WHERE o.addr='$area'";

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

</section>

<script>
$(function(){
	$("#dtpicker").change(function() {
	  this.form.submit();
	});
});
</script>
