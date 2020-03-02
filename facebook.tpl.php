<?php

	class facebookTemplate extends template {

		public $facebookLogin = '
			<a href="{loginUrl}">Log in with Facebook!</a>
		';


		public $facebookSignup = '
			<form method="POST" action="#">

				<p>
					To finish off your registration please enter a username and a new password!
				</p>           

                <label>Username</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="newUsername" value="" autocomplete="new-password" />
                </div>              

                <label>Password</label>
                <div class="form-group">
                    <input type="password" class="form-control" name="newPassword" value="" autocomplete="new-password" />
                </div>

                <label>Confirm Password</label>
                <div class="form-group">
                    <input type="password" class="form-control" name="confirmPassword" value="" autocomplete="new-password" />
                </div>

                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Save</button>
                </div>
			</form> 
		';

        public $options = '

            <h4> Step 1 - Facebook App details</h4>
            <form method="post" action="?page=admin&module=facebook&action=options">


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="pull-left">Facebook APP ID</label>
                            <input type="number" class="form-control" name="facebookAppID" value="{facebookAppID}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="pull-left">Facebook App Secret</label>
                            <input type="text" class="form-control" name="facebookSecret" value="{facebookSecret}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="pull-left">Facebook Login Redirect URL</label>
                            <input type="text" class="form-control" name="facebookLoginURL" value="{facebookLoginURL}" />
                            <small>Usualy https://yourgame.com/?page=facebook</small>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Save</button>
                </div>

            </form>
            
            <h4> Step 2 - Make Sure Facebook App is setup correctly</h4>
             - <a target="_blank" href="https://developers.facebook.com/apps/{facebookAppID}/settings/basic/">Setup Basics</a> <br />
             - <a target="_blank" href="https://developers.facebook.com/apps/{facebookAppID}/fb-login/settings/">Setup Login</a> <br />
             <small>Valid OAuth Redirect URIs should be https://yourgame.com/?page=facebook</small>

             <h4>Support</h4>
             <p>
             	This is a free module so support is limited! For support please visit <a target="_blank" href="https://makewebgames.io/topic/27511-glv2modfree-facebook-login/">Make Web games</a>!
             </p>

             <hr />

             <p>
             	If you like this module consider donating to the author!
             </p>

             <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="cmd" value="_s-xclick" />
				<input type="hidden" name="hosted_button_id" value="EBN4L2V2YA86S" />
				<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
				<img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1" />
			</form>

        ';

	}