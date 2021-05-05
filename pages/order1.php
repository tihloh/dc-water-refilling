<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {	
	$op=$_POST["op"]??"";
	if($op=="save"){
		$id=$_POST["id"]??uniqid();
		$code=$_POST["code"]??"";
		$details=$_POST["details"]??"";
		$price=$_POST["price"]??"";
					
		if(is_uploaded_file($_FILES['image']['tmp_name'])) {
			$fname = $_FILES["image"]["name"];
			$ext = pathinfo($fname, PATHINFO_EXTENSION);
			move_uploaded_file($_FILES["image"]["tmp_name"], "images/items/$id.$ext");
		}
		
		if(!isset($_POST["id"])){
			$q="INSERT INTO tblitems(id,code,item,price) VALUES('$id','$code','$details','$price')";
		}else{
			$q="UPDATE tblitems SET code='$code',item='$details',price='$price' WHERE id='$id'";
		}
		$mysqli->query($q);
		?><script>window.location = '<?php echo getHome();?>?p=order';</script><?php
	}
	exit;
}

if(isset($_GET["del"])){
	$id=$_GET["del"]??"";		
	$q="DELETE FROM tblitems WHERE id='$id'";
	$mysqli->query($q);
	$matches = glob('images/items/'.$id.'.*');
	foreach($matches as $filename){
		unlink($filename);
	}
		?><script>window.location = '<?php echo getHome();?>?p=order';</script><?php
	exit;
}
?>
<form>
		<h2>
			Please select the item(s) you want to order...
	<div class=" pull-right">
	<?php if(($userlvl??0)>2){ ?>
			<button type="button" class="btn btn-lg btn-success" href="#" data-toggle="modal" data-target="#item-modal"><span class="glyphicon glyphicon-plus"></span> Add Item</button>
	<?php } ?>
		<button type="button" class="btn btn-lg btn-default" onclick="window.history.back();"><span class="glyphicon glyphicon-chevron-left"></span> Back</button>
		<button class="btn btn-lg btn-primary" name="step" value="2">Next <span class="glyphicon glyphicon-chevron-right"></span></button>
	</div>
		</h2>

<section class="row">
	<div class="col-md-12">
		<input type="hidden" name="p" value="order"/>
		<br>
		<?php
		$q="SELECT * FROM tblitems ORDER BY item desc";
		//echo $q;
		$result = $mysqli->query($q);
		$no=0; $isactive=false;
		while ($row = $result->fetch_assoc()){
			$pic="images/items/".$row["id"];
			$fpic="images/nopic.jpg";
			if(file_exists("$pic.jpg")){ $fpic="$pic.jpg"; }
			if(file_exists("$pic.png")){ $fpic="$pic.png"; }
	?>
		<span class="button-checkbox">
			<button type="button" class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title">
						<b><?php echo $row["item"]; ?></b><br>
						<i><?php echo $row["code"]; ?></i>
						<br>
						P<?php echo formatnum($row["price"]); ?>
					</h3>
				  </div>
				  <div class="panel-body" style="padding: 0;">
					<center><img class="check" src="images/check.png" style="width: 100px; position: absolute;"></img></center>
					<img alt="200x200" src="<?php echo $fpic;?>" style="width: 200px; height: 200px;"></img>
					<?php if(($userlvl??0)>2){ ?>
						<br><a onclick="return confirm('Confirm Delete?');" href=".?p=order&del=<?php echo $row["id"]; ?>" class="btn btn-sm btn-default" style="color: red;"><span class="glyphicon glyphicon-trash"></span> Delete</a>
					<?php } ?>
				  </div>
			</button>
			<input type="checkbox" class="hidden" name="item[]" value="<?php echo $row["id"]; ?>" />
		</span>
	 <?php
		}
		$result->free();
	?>
	
	</div>	
</section>

<section class="row">
	<div class=" pull-right">
	<?php if(($userlvl??0)>2){ ?>
			<button type="button" class="btn btn-lg btn-success" href="#" data-toggle="modal" data-target="#item-modal"><span class="glyphicon glyphicon-plus"></span> Add Item</button>
	<?php } ?>
		<button type="button" class="btn btn-lg btn-default" onclick="window.history.back();"><span class="glyphicon glyphicon-chevron-left"></span> Back</button>
		<button class="btn btn-lg btn-primary" name="step" value="2">Next <span class="glyphicon glyphicon-chevron-right"></span></button>
	</div>
</section>
</form>


<form method="post" enctype="multipart/form-data">
<div id="item-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" style="width: 400px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Item</h4>
      </div>
      <div class="modal-body">
		<div class="form-horizontal">
			<fieldset>
			<div class="form-group">
			  <label class="col-lg-3 control-label">Details</label>
			  <div class="col-lg-8">
				<input type="text" name="details" class="form-control" placeholder="Details">
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-lg-3 control-label">Code</label>
			  <div class="col-lg-8">
				<input type="text" name="code" class="form-control" placeholder="Code for the item">
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-lg-3 control-label">Price</label>
			  <div class="col-lg-8">
				<input type="number" name="price" class="form-control" placeholder="Price">
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-lg-3 control-label">Picture</label>
			  <div class="col-lg-8">
				<input type="file" name="image" class="form-control" accept="image/*" onchange="previewImgFile(this);"> 
				<img id="previewImg" src="<?php echo $pic; ?>" alt="Placeholder" width="150px" class="img-thumbnail" />
			  </div>
			</div>
			</fieldset>
		   </div>
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="op" value="save">Save</button>
      </div>
    </div>
  </div>
</div>
</form>


  <script>
  $(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            $check = $widget.find('.check'),
            color = $button.data('color'),
            settings = {
                on: {
                    //icon: 'glyphicon glyphicon-check'
                },
                off: {
                    //icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');
            $button.data('state', (isChecked) ? "on" : "off");

            if (isChecked) {
                $check.attr("src","images/check.png");
            }
            else {
                $check.attr("src","");
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            //if ($button.find('.state-icon').length == 0) {
                //$button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            //}
        }
        init();
    });
});
</script>