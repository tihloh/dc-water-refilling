<section class="row">
<h2>Messages</h2>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Messages</th>
          <th>Send Time</th>
        </tr>
      </thead>
      <tbody>
<?php
	$q="SELECT * FROM tblsms ORDER BY stime desc";
	//echo $q;
	$result = $mysqli->query($q);
	$no=0; $isactive=false;
	while ($row = $result->fetch_assoc()){
		$no++;
?>
        <tr class="<?php echo ($isactive?"actives":""); $isactive=!$isactive; ?>" onclick="window.location='<?php echo getHome()."/?p=smsinbox";?>'">
          <td><?php echo $row["msg"]; ?></td>
          <td><?php echo toformaldatetime($row["stime"]); ?></td>
        </tr>
 <?php
	}
	$result->free();
  ?>
      </tbody>
    </table>
</section>
