<nav class="navbar navbar-inverse">
    <div class="navbar-header">
    	<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?=$home_url?>">Sverre Admin</a>
	</div>
	
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="nav navbar-nav">
			<?php if($this->session->has_userdata('admin_logged_in')) { ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Center Sales <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="<?=$home_url?>dashboard/retail-data">Retail Data</a></li>
					<li class="divider"></li>
					<li><a href="#">Center Data</a></li>
					<li class="divider"></li>
					<li><a href="#">Settings - Sales Portal</a></li>
				</ul>
			</li>
			<?php } ?>
		</ul>
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <?php if($this->session->has_userdata('admin_logged_in')) { ?>
                    <?=$this->session->userdata('admin_username')?>
                <?php } else { ?>
                    My account
                <?php } ?>
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <?php if($this->session->has_userdata('admin_logged_in')) { ?>
                    <li><a href="<?=$home_url?>dashboard/create-new-user">Create new user</a></li>                    
                    <!-- <li class="divider"></li> -->
                <?php } else { ?>                    
                    <li><a href="<?=$home_url?>forgot-password">Forgot Password</a></li>
                <?php } ?>
          </ul>
        </li>
			<?php if($this->session->has_userdata('admin_logged_in')) { ?>
				<li><a href="<?=$home_url?>logout">logout</a></li>
			<?php } ?>
      </ul>
	</div><!-- /.nav-collapse -->
  </nav>