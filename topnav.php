<div class="navbar navbar-default navbar-fixed-top card-shadow">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo getHome(); ?>"><b><?php echo TITLE; ?></b></a>
		</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse">
			<ul class="nav navbar-nav">
			  <li class="<?php echo $p=="homepage"?"active":""; ?>"><a href="<?php echo getHome(); ?>">Home</a></li>
			  <li class="<?php echo $p=="order"?"active":""; ?>"><a href="<?php echo getHome(); ?>?p=order">Order</a></li>
			  
			<?php
			if($issigned){ ?> 
			<?php if($userlvl>=2){ ?>
			  <li class="<?php echo $p=="dailyorders"?"active":""; ?>"><a href="<?php echo getHome(); ?>?p=dailyorders">Daily Orders</a></li>
			  <li class="<?php echo $p=="sched"?"active":""; ?>"><a href="<?php echo getHome(); ?>?p=sched">Schedules</a></li>
			  <li class="<?php echo $p=="areas" || $p=="areaorders"?"active":""; ?>"><a href="<?php echo getHome(); ?>?p=areas">Areas</a></li>
			  <li class="<?php echo $p=="smsinbox"?"active":""; ?>"><a href="<?php echo getHome(); ?>?p=smsinbox">SMS</a></li>
			<?php if($userlvl>=3){ ?>
			  <li class="<?php echo $p=="users" || $p=="userorders"?"active":""; ?>"><a href="<?php echo getHome(); ?>?p=users">Accounts</a></li>
			<?php } ?>
			  <li><a href="#" data-toggle="modal" data-target="#sales-report-modal">Sales Report</a></li>
			<?php }else{ ?>
			  <li class="<?php echo $p=="orders"?"active":""; ?>"><a href="<?php echo getHome(); ?>?p=orders">My Orders</a></li>
			<?php }
			}else{ ?>
			  <li class="<?php echo $p=="orders"?"active":""; ?>"><a href="<?php echo getHome(); ?>?p=orders">My Orders</a></li>
			<?php }?>
			
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if($issigned==true){ ?>
			  <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo @$_SESSION[$sitecode.'fname']; ?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
				  <li><a href="<?php echo getHome(); ?>?p=account">My Account</a></li>
				  <li class="divider"></li>
				  <li><a onclick="return " href="<?php echo getHome(); ?>?logout">Logout</a></li>
				</ul>
			  </li>
				<?php }else{ ?>
			  <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
			  <li><a href="#" data-toggle="modal" data-target="#register-modal">Register</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>

<form target=_blank>
<input type="hidden" name="p" value="report">
<div id="sales-report-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" style="width: 400px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
        <h4 class="modal-title" id="myModalLabel">Sales Report</h4>
      </div>
      <div class="modal-body">
		<div class="form-horizontal">
			<fieldset>
			<div class="form-group">
			  <label class="col-lg-3 control-label">Year</label>
			  <div class="col-lg-8">
				<input class="form-control" name="year" value="<?php echo $current_year; ?>" />
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-lg-3 control-label">Month</label>
			  <div class="col-lg-8">
				<select class="form-control select2" name="month">
					<option selected></option>
					<?php
						for($i=1; $i<=12; $i++){
					?>
						<option value="<?php echo $i;?>"> <?php echo datetoformat("2021-$i-01","F");?></option>
					<?php
						}
					?>						
				</select>
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-lg-3 control-label">Day</label>
			  <div class="col-lg-8">
				<input class="form-control" name="day" />
			  </div>
			</div>
			</fieldset>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="r" value="sales">Generate</button>
      </div>
    </div>
  </div>
</div>
</form>
