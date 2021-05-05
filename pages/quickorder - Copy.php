<?php
	if(!$_SESSION["water_signed_in"]??false){header("Location: ./signin.php?p=quickorder");}
?>
<style>
.alert-selected {
    color: #ffffff;
    background-color: #008929;
    border-color: #faebcc;
}
</style>

<form>
	<input type="hidden" name="p" value="quickorder"/>
<?php 
$step=$_GET["step"]??0;

if($step==0){

?>
	<h2>
		Please select the item(s) you want to order...
<?php
	if(($_SESSION["level"]??0)>2){
?>
		<button type="button" class="btn btn-default pull-right"><span class="glyphicon glyphicon-plus"></span> Add Item</button>
<?php
	}
?>
	</h2>
	<br>
	
	<input type="hidden" name="step" value="1"/>
<?php
	$q="SELECT * FROM tblitems ORDER BY item desc";
	//echo $q;
	$result = $mysqli->query($q);
	$no=0; $isactive=false;
	while ($row = $result->fetch_assoc()){
?>
    <span class="button-checkbox">
        <button type="button" class="panel panel-default">
			  <div class="panel-heading">
				<h3 class="panel-title"><?php echo $row["item"]; ?></h3>
			  </div>
			  <div class="panel-body" style="padding: 0;">
				<center><img class="check" src="images/check.png" style="width: 100px; position: absolute;"></img></center>
				<img alt="200x200" src="images/items/<?php echo $row["id"]; ?>.jpg" style="width: 200px; height: 200px;"></img>
			  </div>
			  <h3 class="panel-title">P<?php echo formatnum($row["price"]); ?></h3>
		</button>
        <input type="checkbox" class="hidden" name="item[]" value="<?php echo $row["id"]; ?>" />
    </span>
 <?php
	}
	$result->free();
}
	if($step==1){
  ?>
	<h2>
		Please adjust the quantity...
<?php
	if(($_SESSION["level"]??0)>2){
?>
		<button type="button" class="btn btn-default pull-right"><span class="glyphicon glyphicon-plus"></span> Add Item</button>
<?php
	}
?>
	</h2>
	<br>
	
	<input type="hidden" name="step" value="2"/>

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
			$qitems .= ($qitems==""?"":",").$item;
		}
	}

	$q="SELECT * FROM tblitems WHERE id in ($qitems) ORDER BY item desc";
	//echo $q;
	$result = $mysqli->query($q);
	$no=0; $isactive=false;
	while ($row = $result->fetch_assoc()){
?>
        <tr class="<?php echo ($isactive?"active":""); $isactive=!$isactive; ?>">
          <td><img class="img-thumbnail" alt="200x200" src="images/items/<?php echo $row["id"]; ?>.jpg" style="width: 100%;" /></td>
          <td><h3 class="text-muted"><?php echo $row["code"]; ?></h3></td>
          <td><h3 class="text-primary"><?php echo $row["item"]; ?></h3></td>
          <td><h3 class="text-success"><?php echo formatnum($row["price"]); ?></h3></td>
          <td><h3><input type="hidden" name="item[][id]" value="<?php echo $row["id"]; ?>" /><input type="number" name="item[][qty]" value="1" /></h3></td>
        </tr>
 <?php
	}
	$result->free();
  ?>
      </tbody>
    </table>
  
  <?php } ?>
  <br>
  <br>
  <button class="btn btn-lg btn-primary pull-right">Next</button>
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