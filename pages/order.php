
<?php
	$step=$_GET["step"]??1;
?>

<link rel="stylesheet" href="<?php echo getHome(); ?>/plugins/arrowprogress/arrowprogress.css">
<div class="container">
  <div class="arrow-steps clearfix">
    <div class="step <?php echo $step>=1?"current":""?>"> <span> <a href="#" ><b>Step 1:</b> Select Item</a></span> </div>
    <div class="step <?php echo $step>=2?"current":""?>"> <span><a href="#" ><b>Step 2:</b> Adjust Quantity</a></span> </div>
    <div class="step <?php echo $step>=3?"current":""?>"> <span><a href="#" ><b>Step 3:</b> Account</a></span> </div>
    <div class="step <?php echo $step>=4?"current":""?>"> <span><a href="#" ><b>Step 4:</b> Order Summary</a><span> </div>
  </div>
</div>

<?php
include "order$step.php";
?>
