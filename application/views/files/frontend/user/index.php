<div class="omb_login">
    	<h3 class="omb_authTitle">Login</h3>             

		<div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-6">
                <?=form_open('user/login',array('class'=>'omb_loginForm'))?>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="username" placeholder="Username or Email address">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input  type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <label class="checkbox">
                            <input type="checkbox" value="remember-me">Remember Me
                        </label>
                    </div>                    

					<div class="text-center"><button class="btn btn-info btn-login" type="submit">Login</button></div>
                <?=form_close()?>

                <div class="row omb_row-sm-offset-3">
                    <div class="col-xs-12 col-sm-3">
                        <p class="omb_regNow">
                            <a href="<?=$home_url?>register">Register now</a>
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <p class="omb_forgotPwd">
                            <a href="<?=$home_url?>forgot-password">Forgot password?</a>
                        </p>
                    </div>
                </div>
                
                <div id="validation_error" class="alert text-danger" style="padding-left: 0px;"></div>

                <div class="row omb_row-sm-offset-3 omb_loginOr">
                    <div class="col-xs-12 col-sm-6">
                        <hr class="omb_hrOr">
                        <span class="omb_spanOr">or</span>
                    </div>
                </div>

                <div class="text-center">
                    <a href="#" class="btn omb-btn-facebook">
                        <i class="fa fa-facebook visible-xs"></i>
                        <span class="hidden-xs">Facebook</span>
                    </a>
                </div>
			</div>
    	</div>	
	</div>