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

	}