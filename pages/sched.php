<?php 
if(isset($_GET["del"])){
	$id=$_GET["del"]??"";		
	$q="DELETE FROM tblsched WHERE id='$id'";
	$mysqli->query($q);
	?><script>window.location = '<?php echo getHome();?>?p=sched';</script><?php
	exit;
}

	$tdate=tosqldate($_GET["date"]??$ftoday);
 ?>
<section class="row">
<div class="col-md-12">
	<form>
	<h2><i class="fa fa-calendar-check-o "></i> Schedules</h2>
	</form>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Customer</th>
          <th>Address</th>
          <th>CP</th>
          <th>Order</th>
          <th>Price</th>
          <th>Schedules</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php
	$q="SELECT * FROM tblsched s LEFT JOIN tblusers u ON s.userid=u.id ORDER BY userid desc";
	$q="SELECT *, s.id sid FROM tblsched s INNER JOIN 
		(SELECT GROUP_CONCAT(' ',oi.qty,' ',item) details, orderid FROM tblorder_items oi INNER JOIN tblitems i ON oi.itemid=i.id WHERE fromsched=1 GROUP BY orderid) oi ON oi.orderid=s.id
		LEFT JOIN tblusers u ON s.userid=u.id 
		ORDER BY userid desc";
	//echo $q;
	$result = $mysqli->query($q);
	$no=0; $isactive=false;
	while ($row = $result->fetch_assoc()){
?>
        <tr class="<?php if($row["paid"]==1){echo "info";}elseif($row["delivered"]==1){echo "success";}elseif($row["cancelled"]==1){ echo "danger";} ?>">
          <td><?php echo $row["fname"]; ?></td>
          <td><?php echo $row["addr"]; ?></td>
          <td><?php echo $row["cp"]; ?></td>
          <td><?php echo $row["details"]; ?></td>
          <td><?php echo formatnum($row["charge"]); ?></td>
          <td><?php echo $row["sched"]; ?></td>
		  <td>
			<a onclick="return confirm('Confirm delete?');" href=".?p=sched&del=<?php echo $row["sid"]; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
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

<script>
$(function(){
	$("#dtpicker").change(function() {
	  this.form.submit();
	});
});
</script>
