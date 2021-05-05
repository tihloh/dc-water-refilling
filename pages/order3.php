<?php
$actual_link = $_SERVER["REQUEST_URI"];

		$urlparams= $_SERVER['QUERY_STRING'];
		parse_str($urlparams, $params); 
		$urlvars=str_ireplace("&step=".$params['step'],"&step=4",$urlparams);
$search=$_GET["search"]??"";
$search=str_replace(" ","% %",$search);

if($issigned && $userlvl>1){
?>
<div class="col-md-9">
	<form action="<?php echo getHome()."?$urlparams"; ?>">
	<h2><i class="fa fa-check "></i> Select a Customer
			<div class=" pull-right">
				<input type="hidden" name="p" value="<?php echo $p; ?>" />
				<input type="hidden" name="step" value="3" />
				<?php foreach($_GET['id'] as $key => $val){
						echo '<input type="hidden" name="id[]" value="'.htmlspecialchars($val).'" />';
					}
				?>
				<?php foreach($_GET['qty'] as $key => $val){
						echo '<input type="hidden" name="qty[]" value="'.htmlspecialchars($val).'" />';
					}
				?>
				<input type="input" name="search" value="<?php echo $search; ?>" placeholder=" search" />
		</div>
	</h2>
	</form>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Customer</th>
          <th>Address</th>
          <th>Contact</th>
        </tr>
      </thead>
      <tbody>
<?php
	$q="SELECT * FROM tblusers WHERE level<2 and fname like '%$search%'";
	//echo $q;
	$result = $mysqli->query($q);
	while ($row = $result->fetch_assoc()){
?>
        <tr class="warning" style="cursor: pointer;" onclick="window.location = '<?php echo getHome()."?$urlvars&user=".$row["id"]; ?>';">
          <td><i class="fa fa-user "></i> <?php echo $row["fname"]; ?></td>
          <td><?php echo $row["address"]; ?></td>
          <td><?php echo $row["contact"]; ?></td>
        </tr>
 <?php
	}
  ?>
        <tr class="info" onclick="window.location = '<?php echo getHome()."?$urlvars&user="; ?>';" style="cursor: pointer;">
          <td colspan=3><i class="fa fa-user "></i> <b>Click here for Unregistered User / Person with No Account</b></td>
        </tr>
      </tbody>
    </table>
	<div class="col-md-12">
		  <button type="button" class="btn btn-lg btn-default" onclick="window.history.back();"><span class="glyphicon glyphicon-chevron-left"></span> Back</button>
	</div>
</div>	
<?php 
}else{ 
?>
<div class="col-md-4">
</div>
<div class="col-md-4">
	<h2>Please login to continue</h2>
	<br><br><br>
	<center>
		<a href="#" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#login-modal"><span class="glyphicon glyphicon-log-in"></span> Login</a>
		<br>
		<br>
		<a href="<?php echo getHome()."?$urlvars"; ?>" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-log-in"></span> Login as Guest</a>
		<br>
		<br>
		<button type="button" class="btn btn-lg btn-default" onclick="window.history.back();"><span class="glyphicon glyphicon-chevron-left"></span> Back</button>
	<center>
</div>
<div class="col-md-4">
</div>
<?php
}
?>

<script>
$(function(){
	$("#loginurlvars").val("<?php echo $urlvars;?>");
});
</script>