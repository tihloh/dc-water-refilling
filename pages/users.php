<?php

if(isset($_GET["ban"])){
	$id=$_GET["ban"]??"";		
	$q="UPDATE tblusers SET banned=1 WHERE id='$id'";
	$mysqli->query($q);
		?><script>window.location = '<?php echo getHome();?>?p=users';</script><?php
	exit;
}
if(isset($_GET["unban"])){
	$id=$_GET["unban"]??"";		
	$q="UPDATE tblusers SET banned=0 WHERE id='$id'";
	$mysqli->query($q);
		?><script>window.location = '<?php echo getHome();?>?p=users';</script><?php
	exit;
}
$search=$_GET["search"]??"";
$search=str_replace(" ","% %",$search);
?>
<section class="row">
<div class="col-md-9">
	<form>
	<h2><i class="fa fa-calendar-check-o "></i> Accounts
		<div class=" pull-right">
				<input type="hidden" name="p" value="<?php echo $p; ?>" />
				<input type="input" name="search" value="<?php echo $search; ?>" placeholder=" search" />
		</div>
	</h2>
	</form>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Username</th>
          <th>Level</th>
          <th>Name</th>
          <th>Address</th>
          <th>Contact</th>
          <th>Email</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php
	$q="SELECT * FROM tblusers WHERE level<3".($search!=""?" and concat(fname,' ',address,' ',fname,' ',address) like '%$search%'":"");
	//echo $q;
	$result = $mysqli->query($q);
	$no=0; $isactive=false;
	while ($row = $result->fetch_assoc()){
?>
        <tr class="<?php echo $row["banned"]==1?"danger":""; ?>" style="cursor: pointer;" onclick="window.location='<?php echo getHome()."/?p=userorders&user=".$row["id"]."&name=".$row["fname"];?>'">
          <td><?php echo $row["username"]; ?></td>
          <td><?php echo $row["level"]; ?></td>
          <td><?php echo $row["fname"]; ?></td>
          <td><?php echo $row["address"]; ?></td>
          <td><a href="?p=smsinbox&cp=<?php echo $row["contact"]; ?>&user=<?php echo $row["fname"]; ?>"><?php echo $row["contact"]; ?></a></td>
          <td><?php echo $row["email"]; ?></td>
          <td><?php echo $row["banned"]==1?"Banned":"Active"; ?></td>
		  <td><?php if($row["banned"]==1){ ?>
			<a onclick="return confirm('Confirm remove ban status?');" href=".?p=users&unban=<?php echo $row["id"]; ?>" class="btn btn-xs btn-default">Unban</a>
		  <?php }else{ ?>
			<a onclick="return confirm('Confirm Banning?');" href=".?p=users&ban=<?php echo $row["id"]; ?>" class="btn btn-xs btn-warning">Ban</a>
		  <?php } ?>
		  </td>
        </tr>
 <?php
	}
	$result->free();
	
  ?>
        <tr class="warning" style="cursor: pointer;" onclick="window.location='<?php echo getHome()."/?p=userorders";?>'">
          <td colspan=7><b>Guest</b></td>
        </tr>
      </tbody>
    </table>
</div>	
</section>