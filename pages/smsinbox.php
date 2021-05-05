<?php
	if(!($_SESSION[$sitecode.'signed_in']??false) || ($_SESSION[$sitecode.'level']??0)<2){header("Location: .");}
	$cp=$_GET["cp"]??"";
	$user=$_GET["user"]??"";
	$tdate=tosqldate($_GET["date"]??$ftoday);
?>
<section class="row">
<div class="col-md-8">
	<h2><?php echo $cp==""?"Messages":$user; ?> 
		<form class="pull-right">
			<input type="hidden" name="p" value="<?php echo $p; ?>" />
			<input type="date" class="submitonchange" name="date" value="<?php echo $tdate; ?>" />
		</form>
	</h2>
<?php if($cp!=""){ ?>
	<h3><?php echo $cp; ?></h3>
	<a href="#" onclick="window.history.back();" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
<?php } ?>
    <table class="table table-hover">
      <thead>
        <tr>
          <?php if($cp==""){ ?><th width="200px">Sender</th><?php } ?>
          <th>Messages</th>
          <th width="180px">Send Time</th>
        </tr>
      </thead>
      <tbody>
<?php
	if($cp!=""){
		$q="SELECT *, stime time FROM tblsms WHERE cp like '%$cp' and _out=0 ORDER BY stime desc";
	}else{
		$q="SELECT s.cp, ifnull(u.fname,s.cp) sender2, s.msg, s.stime
		FROM tblsms s LEFT JOIN tblusers u ON s.cp like concat('%',u.contact,'%') and u.contact!='' 
		WHERE _out=0 and date(stime)='$tdate' ORDER BY stime desc";
	}
	$result = $mysqli->query($q);
	$no=0;
	while ($row = $result->fetch_assoc()){
		$no++;
?>
        <tr class="warning" style="cursor: pointer;" onclick="window.location='<?php echo getHome()."/?p=smsinbox&cp=".$row["cp"]."&user=".trim($row["sender2"]);?>'">
          <?php if($cp==""){ ?><td><?php echo $row["sender2"]; ?></td><?php } ?>
          <td><?php echo $row["msg"]; ?></td>
          <td><?php echo toformaldatetime($row["stime"]); ?></td>
        </tr>
 <?php
	}
	$result->free();
  ?>
      </tbody>
    </table><p style="font-size: 20px"><span class="label label-success">Powered by <b>Bits SMS</b></span></p>
</div>	
</section>
  
  