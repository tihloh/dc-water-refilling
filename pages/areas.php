<?php
	$tdate=tosqldate($_GET["date"]??$ftoday);
?>
<section class="row">
<div class="col-md-9">
	<form>
	<h2><i class="fa fa-map "></i> Areas
		<div class=" pull-right">
				<input type="hidden" name="p" value="<?php echo $p; ?>" />
				<input type="date" id="dtpicker" name="date" value="<?php echo $tdate; ?>" />
		</div>
	</h2>
	</form>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Areas</th>
          <th width="150px"></th>
        </tr>
      </thead>
      <tbody>
<?php
	$q="SELECT a.addr, COUNT(b.id) orders FROM tblorders a LEFT JOIN tblorders b ON a.id=b.id AND date(b.time)='$tdate' GROUP BY addr";
	//echo $q;
	$result = $mysqli->query($q);
	$no=0; $isactive=false;
	while ($row = $result->fetch_assoc()){
?>
        <tr style="curssor: pointer;" osnclick="window.location='<?php echo getHome()."/?p=areaorders&area=".$row["addr"]."&date=$tdate";?>'">
          <td><?php echo $row["addr"]; ?></td>
          <td>
			  <?php if($row["orders"]>0){ ?> 
				  <button type="button" class="btn btn-xs btn-success" onclick="$.get( 'xrequest.php',{ req:'fordelivery',addr:'<?php echo $row["addr"];?>',tdate:'<?php echo $tdate;?>' });">For Delivery</button>
				  <a href="<?php echo getHome()."/?p=report&r=areaorders&area=".$row["addr"]."&tdate=$tdate";?>" class="btn btn-xs btn-danger" target=_blank>Print</a>
			  <?php }else{ ?>
			  No Orders
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
</section>

<script>
$(function(){
	$("#dtpicker").change(function() {
	  this.form.submit();
	});
});
</script>

