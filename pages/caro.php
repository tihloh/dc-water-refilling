<div id="carousel-example-generic" class="carousel slide card-shadow" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
	<?php 
	$imgpath="images/gallery/";
	$active=false;
	foreach(glob($imgpath.'*') as $filename){
		$img=basename($filename);
	?>
		<div class="item <?php if(!$active){ echo "active"; $active=true; } ?>">
		  <img style="width:100%" data-src="holder.js/1140x500/auto/#555:#333/text:Forth slide" alt="Forth slide [1140x500]" src="<?php echo $imgpath.$img; ?>" data-holder-rendered="true">
		</div>
	<?php
	}
	?>
  </div>
  <a class="left carousel-control" href="http://getbootstrap.com/examples/theme/#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="http://getbootstrap.com/examples/theme/#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>