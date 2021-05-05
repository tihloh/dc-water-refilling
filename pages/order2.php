
<?php
	if(!isset($_GET["item"])){		
		?><script>window.history.back();</script><?php
	}
?>
<h2>Please adjust the quantity...</h2>
<form>
	<input type="hidden" name="p" value="order"/>
<section class="row">
	<div class="col-md-12">
		<br>

		<table class="table table-hover">
		  <thead>
			<tr>
			  <th style="width: 130px"></th>
			  <th style="width: 100px">Code</th>
			  <th>Item</th>
			  <th>Price</th>
			  <th style="width: 50px">Qty</th>
			</tr>
		  </thead>
		  <tbody>
		<?php
			$qitems="";
			if(isset($_GET['item'])){
				$items = $_GET['item'];
				foreach($items as $item) {
					$qitems .= ($qitems==""?"":",")."'$item'";
				}
			}

			$q="SELECT * FROM tblitems WHERE id in ($qitems) ORDER BY item desc";
			//echo $q;
			$result = $mysqli->query($q);
			$no=0; $isactive=false;
			while ($row = $result->fetch_assoc()){
			$pic="images/items/".$row["id"];
			$fpic="images/nopic.jpg";
			if(file_exists("$pic.jpg")){ $fpic="$pic.jpg"; }
			if(file_exists("$pic.png")){ $fpic="$pic.png"; }
		?>
				<tr class="<?php echo ($isactive?"active":""); $isactive=!$isactive; ?>">
				  <td>
					<input type="hidden" name="id[]" value="<?php echo $row["id"]; ?>" />
					<img class="img-thumbnail" alt="200x200" src="<?php echo $fpic; ?>" style="width: 100%;" />
				  </td>
				  <td><h3 class="text-muted"><?php echo $row["code"]; ?></h3></td>
				  <td><h3 class="text-primary"><?php echo $row["item"]; ?></h3></td>
				  <td><h3 class="text-success"><?php echo formatnum($row["price"]); ?></h3></td>
				  <td><h3><input type="number" name="qty[]" value="1" min=1 /></h3></td>
				</tr>
		 <?php
			}
			$result->free();
		  ?>
		  </tbody>
		</table>
	</div>
</section>

<section class="row">
	<div class="col-md-12">
		<div class=" pull-right">
		  <button type="button" class="btn btn-lg btn-default" onclick="window.history.back();"><span class="glyphicon glyphicon-chevron-left"></span> Back</button>
			<button class="btn btn-lg btn-primary" type="submit" name="step" value="<?php echo !$issigned || ($issigned && $userlvl>1)?"3":"4"; ?>" >Next<span class="glyphicon glyphicon-chevron-right"></span></button>
		</div>
	</div>
</section>
 </form>
 