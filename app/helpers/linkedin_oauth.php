<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 15/03/2018
 * Time: 05:12 PM
 */


// require_once '../app/Models/Database.php';
require_once '../app/Core/Database.php';

require_once '../app/Models/AccountIndividual.php';


require_once '../app/Core/Response.php';





// import client class
use LinkedIn\Client;

function linkedinAuth()
{
	
	$client = new Client(LINKEDIN_CLIENT_ID, LINKEDIN_CLIENT_SECRET);
	$dbh = Database::getInstance();
	$myResponse = new Response();
	$ie = new IndustryExperience();
	$account = new AccountIndividual();
	
	
	if (isset($_GET['code'])) { // we are returning back from LinkedIn with the code
		if (isset($_GET['state']) &&  // and state parameter in place
			isset($_SESSION['state']) && // and we have have stored state
			$_GET['state'] === $_SESSION['state'] // and it is our request
		) {
			try {
				$client->setRedirectUrl(LINKEDIN_REDIRECT_URL);
				// retrieve access token using code provided by LinkedIn
				$accessToken = $client->getAccessToken($_GET['code']);
				// perform api call to get profile information
				$email = $client->get(
					'people/~:(email-address)'
				);
				
				// Now that we have the profile, we check if user existed or not
				$stmt = $dbh->prepare("SELECT * FROM tbl_login WHERE email=:email");
				$stmt->execute(array(
					":email" => $email['emailAddress'],
				));
				$rows = $stmt->fetch(PDO::FETCH_ASSOC);
				
				
				if (empty($rows) && empty($_SESSION['import_mode'])) {
					$profile = $client->get(
						'people/~:(email-address,first-name,last-name,location,headline,industry)'
					);
					
					$url = APP_DOMAIN . 'controller/app.php';
					$data = [
						"function" => "signUp",
						"firstname" => $profile['firstName'],
						"lastname" => $profile['lastName'],
						"email" => $profile['emailAddress'],
						"password" => 'linkedin',
						"profession" => $profile['headline'],
						"industry" => $profile['industry'],
						"city" => 'City',
						"country" => $profile['location']['name']
					];
					
					$response = callAPI('POST', $url, $data);
					
					if ($response->status === 'success') {
						$data = $response->data;
						$login_id = $data['login_id'];
					} else {
						$myResponse->status = "failed";
						$myResponse->message = $response->message;
						return json_encode($myResponse);
					}
				} else {
					$login_id = $rows['login_id'];
				}
				
				$profile = $client->get(
					'people/~:(positions,picture-url)'
				);
				$current_company = '';
				// create experience
				if (!empty($profile['positions']['_total'])) {
					foreach ($profile['positions']['values'] as $position) {
						$company_name = $position['company']['name'];
						$from_year = $position['startDate']['year'];
						$from_month = $position['startDate']['month'];
						$location = $position['location']['name'];
						$description = $position['title'];
						
						if ($ie->ifUserExistInCompany($login_id, $company_name) !== true) {
							$ie->create($login_id, $description, $company_name, $location, $from_month, $from_year, '', '', '', '', '');
						}
						if ($position['isCurrent']) $current_company = $company_name;
					}
				}
				
				// update profile picture
				
				if (!empty($profile['pictureUrl'])) {
					$picture_url = $profile['pictureUrl'];
					$pic_name = generate_string(10) . '.jpg';
					if (save_online_picture($picture_url, $pic_name)) {
						$account->updatePictureAndCompany($login_id, $pic_name, $current_company);
					}
				}
				
				// ready to be logged in
				$token = getToken($login_id);
				//populate SESSION
				$_SESSION['token'] = $token;
				
				$myResponse->status = "success";
				$myResponse->message = "LinkedIn Profile Import Successful";
				$data = array(
					"token" => $token,
				);
				$myResponse->data = $data;
				(new AccountIndividual())->updateOnlineStatus($rows["login_id"], 1);
				
				return json_encode($myResponse);

//			var_dump($rows);
				
			} catch (\LinkedIn\Exception $exception) {
				$myResponse->status = "failed";
				$myResponse->message = "An Error Occurred";
				return json_encode($myResponse);
			}
		} else {
			$myResponse->status = "failed";
			$myResponse->message = "Expired Request, Please try again";
			return json_encode($myResponse);
		}
	} elseif (isset($_GET['error'])) {
		$myResponse->status = "failed";
		$myResponse->message = $_GET['error'];
		return json_encode($myResponse);
	}
}

