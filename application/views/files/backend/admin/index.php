
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title text-center">Admin sign in</h3>
			 	</div>
			  	<div class="panel-body">
                  <?=form_open('admin/login',array('class'=>''))?>
                    <fieldset>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user" style="padding: 0px 2px"></i></span>
                                <input type="text" class="form-control" name="username" placeholder="Username or Email address">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                        </div>
			    		
                        <input class="btn btn-success btn-block" type="submit" value="Login">
                            <p class="text-right" style="margin-top: 10px;">                            
                                <a href="<?=$home_url?>forgot-password">Forgot password?</a>                           
                            </p>
                        
                        <div id="validation_error" class="alert text-danger" style="padding-left: 0px;"></div>
			    	</fieldset>
			      	<?=form_close()?>
			    </div>
			</div>
		</div>
	