  <style>
body {
  padding-top: 30px;

  background: url("images/lowpoly.png") no-repeat center center fixed; 
}
  </style>
<section class="row" style="background-color: #fff;"><br><br>
<div class="container">
	<div class="col-md-4">
		<div class="panel panel-default card-shadow">
		  <div class="panel-body">	
			<center>
				<br>
				<img class="img-thumbnail" alt="200x200" src="images/logo.jpeg" style="width: 200px; height: 200px;">
				<h1 class="text-shadow">
					DC Water Refilling Station
				</h1><br>
				<h4>Zone 3 Fatima, Tabaco City</h4><br>
				<p><a href="<?php echo getHome(); ?>?p=order" class="btn btn-lg btn-primary">Order Now!</a></p>
			</center>
		  </div>
		</div>
	</div>
	
	<div class="col-md-8">
		<?php include "caro.php"; ?>
		<br>
	</div>
</div><br>
</section>
	
<section class="row"><br>
<div class="container">
	<div class="col-md-12">
		<p style="font-size: 30px; color: #fff" class="text-shadow"><br>
			&nbsp; &nbsp; &nbsp; &nbsp; Water is the most unique substance on Earth 
			because it is the only natural substance that is found in all three physical states – liquid, solid and gas – 
			at the temperature normally found on Earth. Water freezes at 32⁰ Fahrenheit (F) and boils at 212⁰ F (at sea level, but 186.4⁰ at 14,000 feet). 
			It dissolves more substances than any other liquid, making it known as “universal solvent”. 
			Aside from that, it’s also a vital substance in the human body; 60% of human body weight is made up of water. 
			It does more than just quench thirst and regulate body temperature, it also keeps the tissues in the body moist. 
			This is the reason why humans must stay hydrated. <br><i>– Laskey, J. (2015)</i>
		</p><br><br>
	</div>
	
</div>
</section>
		
<section class="row card-shadow" style="background-color: #fff;">
	<div class="container">
		<h1>Containers</h1>
	<?php 
		$placesdir="images/containers/";
		foreach(glob($placesdir.'*')as $filename){
			$img=basename($filename);
	?>
			<div class="col-xs-6 col-md-3"><img src="<?php echo $placesdir.$img; ?>" alt="<?php echo $placesdir.$img; ?>" width="100%" /><br><br><br></div>
	<?php
		}
	?>
	</div>
</section>
		
<section class="row">
<div class="container">
	<h1>About Us</h1>
	<div class="col-md-6">
		<p class="lead">
			&nbsp; &nbsp; &nbsp; &nbsp; DC Water Refilling Station is owned and managed by Mr. and Mrs. Cantal, located at Zone 2 Fatima Tabaco City, Albay, operating 8 hours a day from 8:00 am to 5:00 pm from Monday - Saturday. DC Water Refilling Station was established last March 2019 and the reason for establishing a water refilling station is due to its desire to supply safe and clean drinking water to their neighbourhood. Every month, the Tabaco Water District (the main source of water in Tabaco City) conducts a monthly laboratory test of water. After taking sample water, it will then be forwarded to Manila Water Laboratory.
		</p>
	</div>
	<div class="col-md-6">
		<p class="lead">
			&nbsp; &nbsp; &nbsp; &nbsp; DC Water Refilling Station offers discounts and freebies to both new and old clients. For every purchase of 10 containers, there is one (1) free refill; and for every purchase of 15 containers, five (5) extra water containers will be lent to the customer. Customers who own a small business such as canteens, restaurants, offices and even schools, are given free Water Dispenser provided that they will purchase water refills from DC. These promotions are offered in hope to ensure and gain regular customers.
		</p>
	</div>
	
</div>
</section>
		
<section class="row" style="background-color: #fff;">	
<div class="container">
	<h1>We also support ordering via SMS</h1>
	<div class="col-md-6">
		<h2>How to order?</h2>
		SMS Format:
		<div class="well">
		  <span class="text-danger">dc <span class="text-success">Name</span>@<span class="text-success">Address</span>; <span class="text-success">Item</span>,<span class="text-success">Quantity</span>; <span class="text-success">Item</span>,<span class="text-success">Quantity</span>;</span> [...]
		</div>
		send to <p style="font-size:30px"><?php $myfile = fopen("simno.txt", "r") ;echo fgets($myfile); fclose($myfile);?></p>
	</div>
	<div class="col-md-6">
		<h2>Examples</h2>
		example #1
		<div class="well">
		  <span class="text-danger">dc Juan@Bombon, Tabaco City; slim, 1</span>
		</div>
		example #2
		<div class="well">
		  <span class="text-danger">dc Ken@Panal, Tabaco City; round small, 1; slim, 2 </span>
		</div>
	</div>
</div>
</section>
		
<section class="row">
<div class="container">
	<h1>Testimonies</h1>
	<div class="col-md-6">
		<blockquote>
		  <p>Super bilis ng delivery at magalang pa ang nagdedeliver!</p>
		  <small>Ken</small>
		</blockquote>
		
		<blockquote class="pull-right">
		  <p>Masarap ang lasa ng tubig! Hindi lasang chemikal, di katulad ng iba.</p>
		  <small>Super Mom</small>
		</blockquote>
	</div>

	<div class="col-md-6">
		<blockquote>
		  <p>Astig ng bagong systema ng pag order! Nakakasabay sa panahon ngayon! Hi-tech!</p>
		  <small>Cindy</small>
		</blockquote>
		
		<blockquote class="pull-right">
		  <p>Very friendly ang mga crew, nakakatuwa!</p>
		  <small>Elmer</small>
		</blockquote>
	</div>
		
</div>
</section>


<br>
<br>