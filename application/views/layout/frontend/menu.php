<nav class="navbar navbar-inverse">
    <div class="navbar-header">
    	<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?=$home_url?>">Sverre</a>
	</div>
	
	<div class="collapse navbar-collapse js-navbar-collapse">		
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <?php if($this->session->has_userdata('logged_in')) { ?>
                    <?=$this->session->userdata('username')?>
                <?php } else { ?>
                    My account
                <?php } ?>
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <?php if($this->session->has_userdata('logged_in')) { ?>
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                <?php } else { ?>
                    <li><a href="<?=$home_url?>">Login</a></li>
                    <li class="divider"></li>
                    <li><a href="<?=$home_url?>register">Register</a></li>
                    <li class="divider"></li>
                    <li><a href="<?=$home_url?>forgot-password">Forgot Password</a></li>
                <?php } ?>
          </ul>
        </li>
			<?php if($this->session->has_userdata('logged_in')) { ?>
				<li><a href="<?=$home_url?>user/logout">logout</a></li>
			<?php } ?>
      </ul>
	</div><!-- /.nav-collapse -->
  </nav>