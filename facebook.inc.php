<?php

	require_once __DIR__ . '/sdk/autoload.php'; 

    class facebook extends module {
        
        public $allowedMethods = array();
        
        public $fb = null;

        public function constructModule() {
        	$fb = new \Facebook\Facebook([
				'app_id' => $this->_settings->loadSetting("facebookAppID"),
				'app_secret' => $this->_settings->loadSetting("facebookSecret"),
				'default_graph_version' => 'v2.10',
				//'default_access_token' => '{access-token}', // optional
			]);

        	$helper = $fb->getRedirectLoginHelper();

			$permissions = ['email']; // optional
				
			try {
				if (isset($_SESSION['fbToken'])) {
					$accessToken = $_SESSION['fbToken'];
				} else {
			  		$accessToken = $helper->getAccessToken();
				}
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			 	// When Graph returns an error
			 	return $this->error('Graph returned an error: ' . $e->getMessage());

			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			 	// When validation fails or other local issues
				return $this->error('Facebook SDK returned an error: ' . $e->getMessage());
			}

			if (isset($accessToken)) {
			
				if (isset($_SESSION['fbToken'])) {
					$fb->setDefaultAccessToken($_SESSION['fbToken']);
				} else {
					// getting short-lived access token
					$_SESSION['fbToken'] = (string) $accessToken;

				  	// OAuth 2.0 client handler
					$oAuth2Client = $fb->getOAuth2Client();

					// Exchanges a short-lived access token for a long-lived one
					$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['fbToken']);

					$_SESSION['fbToken'] = (string) $longLivedAccessToken;

					// setting default access token to be used in script
					$fb->setDefaultAccessToken($_SESSION['fbToken']);
				}

				// redirect the user back to the same page if it has "code" GET variable
				if (isset($_GET['code'])) {
					header('Location: ?page=facebook');
				}

				// getting basic info about user
				try {
					$profile_request = $fb->get('/me?fields=name,email');
					$profile = $profile_request->getGraphNode()->asArray();
				} catch(Facebook\Exceptions\FacebookResponseException $e) {
					// When Graph returns an error
					session_destroy();
					header('Location: ?page=facebook');
					//return $this->error('Graph returned an error: ' . $e->getMessage());
				} catch(Facebook\Exceptions\FacebookSDKException $e) {
					// When validation fails or other local issues
					return $this->error('Facebook SDK returned an error: ' . $e->getMessage());
					exit;
				}
				
				print_r($profile);

				$user = $this->db->select("
					SELECT * 
					FROM facebookLogins 
					LEFT OUTER JOIN users ON (FB_email = U_email)
					WHERE FB_id = :id
					ORDER BY U_id DESC
					LIMIT 0, 1	
				", array(
					":id" => $profile["id"]
				));
		
				if (isset($user["FB_id"]) && $user["U_id"]) {
					$_SESSION["userID"] = $user["U_id"];
					header("Location: ?");
					exit;
				} else {
					return $this->html .= $this->page->buildElement("facebookSignup");
				}

			} else {
				// replace your website URL same as added in the developers.facebook.com/apps e.g. if you used http instead of https and you used non-www version or www version of your website then you must add the same here
				$loginUrl = $helper->getLoginUrl('https://glscript.net/demo/?page=facebook', $permissions);
				$this->html .= $this->page->buildElement("facebookLogin", array(
					"loginUrl" => $loginUrl
				));
			}


        }

    }
