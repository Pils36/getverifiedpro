<?php

class ProfileView
{
	
	private $dbh;
	
	public function __construct()
	{
		$this->dbh = Database::getInstance();
	}
	
	public function createUserProfileViews($viewed_by, $member_id)
	{
		try {
			$stmt = $this->dbh->prepare("INSERT INTO tbl_profile_views(viewed_by_login_id, member_login_id) VALUES (:viewed_by, :member_by)");
			$stmt->execute(array(
				":viewed_by" => $viewed_by,
				":member_by" => $member_id,
			));
			
// Mailing


$viewer = "SELECT firstname as view_fname, lastname as view_lname FROM tbl_account_individual WHERE login_id = '".$viewed_by."'";
	
        $check = "SELECT tbl_profile_views.member_login_id, tbl_profile_views.viewed_by_login_id,tbl_account_individual.firstname AS firstname, tbl_account_individual.lastname AS lastname, tbl_account_individual.email AS email FROM tbl_profile_views, tbl_account_individual WHERE tbl_profile_views.member_login_id = $member_id AND tbl_profile_views.viewed_by_login_id = $viewed_by AND tbl_account_individual.login_id = $member_id";
        
        $checks = $this->dbh->query($check);
        
        $checks->execute();
        
        $res = $checks->fetchAll();
        
        foreach($res as $key){
            $first = $key['firstname'];
            $last = $key['lastname'];
            $email = $key['email'];
            
$to = $email;
$subject = "$first $last, your profile was viewed on Pro-filr";

$message = '


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Complete Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 20px;background-color: #DEE0E2;">
 <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc;background-color: #F4F4F4; font-family: verdana; font-size: 12px; text-align: justify; line-height: 1.5">
    <tr>
        <td style="padding: 20px 20px 20px 20px;">
            <table width="100%">
                <tr>
                    <td style="font-size: 10px;"><a href="https://pro-filr.com" target="_blank">www.pro-filr.com</a></td>
                    <td style="font-size: 10px;" align="right">Email not displaying correctly?<br/><a href="htttps://www.pro-filr.com/templates/Complete/Complete.html">View in your browser</a></td>
                </tr>
            </table>
        </td>
    </tr>
 <tr>
   <td align="center" style="padding: 10px 10px 10px 10px; font-weight: bold; text-transform: italic">
    Pro-Filr.com, Worlds #1 Platform for Verified Professionals to Collaborate
   </td>
  </tr>
 <tr>
  <td style="padding: 20px 30px 20px 30px;">
 <table border="0" cellpadding="0" cellspacing="0" width="100%">

  <tr>
   <td style="padding: 10px 10px 10px 10px;">
    Hi '.$first.',
   </td>
  </tr>
  <tr>
   <td style="padding: 10px 10px 10px 10px;">
   Your profile was recently viewed on Pro-filr.com
</td>
  </tr>
  <tr>
   <td align="center" style="padding: 10px;">
    <a href="https://www.pro-filr.com/home" style="background-color: #139f5e; color: #fff; padding: 7px; text-decoration: none; font-size: 14px">Check to see who viewed your profile</a>
</td>
  </tr>


 </table>
</td>
 </tr>
 <tr>
    <td style="padding: 20px 30px 20px 30px;">
        <p style="font-style: italic;font-weight: bold; color: #980000;">Upgrade to Classic Membership.</p>
<p>Classic Membership on Pro-filr.com provides you with awesome opportunities. With the upgraded membership, you can engage other professionals, access opportunities, create unlimited professional groups and unlimited projects. Click <a href="https://pro-filr.com/paypal" target="_blank">here</a> to Upgrade. </p>
    </td>
 </tr>
 <tr>
  <td style="padding: 10px 30px 30px 30px;">
    <hr/>
 <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #139f5e; padding: 15px">
 <tr>
<td width="65%" style="color: #fff;font-family: Helvetica;font-size: 10px;line-height: 150%;text-align: left;font-style: italic;">
    
 This email was intended for '.$first.' '.$last.' '.$email.'. Copyright &copy; <script>new Date().getFullYear()>document.write(""+new Date().getFullYear());</script> Professionals File Inc. 10 George St. North. Ontario. L6X 1R2. Canada.
</td>
  <td align="right">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
   <td>
    <a href="https://twitter.com/pro_filr" target="_blank"><img src="https://pro-filr.com/images/twitter.png" width="30" height="30" style="background: #fff; border-radius:100%"></a>
   </td>
   <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
   <td>
    <a href="https://www.facebook.com/profilr2016/" target="_blank"><img src="https://pro-filr.com/images/facebook.png" width="30" height="30" style="background: #fff; border-radius:100%"></a>
   </td>
  </tr>
 </table>
</td>
 </tr>
</table>
</td>
 </tr>
</table>


</body>
</html>


';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <subscription@pro-filr.com>' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);
            
        }
        

// End Mailing
			
			return $insertId = $this->dbh->lastInsertId();
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	
	public function getUserProfileViews($user_id)
	{
		$sql = "SELECT tbl_account_individual.* FROM tbl_profile_views JOIN tbl_account_individual ON tbl_account_individual.login_id = tbl_profile_views.viewed_by_login_id WHERE tbl_profile_views.member_login_id = {$user_id}";
		try {
			$company = $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $company;
		} catch (Exception $ex) {
			return $ex->getMessage();
		}
	}
	
	
	
}