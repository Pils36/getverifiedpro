<?php

// error_reporting(1);

$user = 'profilr_user';
$pass = 'portFOLIO_2015';

try {
    //connect DB
    $dbh = new PDO('mysql:host=localhost;dbname=profilr_beta', $user, $pass);
    
    if(isset($_POST['login_id'])){
        $login_id = $_POST['login_id'];
        
        $expiry = date('Y-m-d', mktime(0, 0, 0, date("m") + 1, date("d") - 1, date("Y")));
        
        foreach($login_id as $key){
            
          $sql = "INSERT INTO `tbl_subscribe`(`login_id`, `plan`, `expiry_date`, `subscription_date`, `state`) VALUES ('".$key."','Monthly Plan','".$expiry."',NOW(),0)";
          $sqls = $dbh->prepare($sql);
          $res = $sqls->execute();
        
        $stmt = "SELECT firstname AS first, lastname as last, email as emai from tbl_account_individual WHERE login_id = '".$key."' LIMIT 2";
            
            $stmts = $dbh->query($stmt);
            $stmts->execute();
            
            $resStm = $stmts->fetchAll();
            
            foreach($resStm as $key){
                $first = $key['first'];
                $last = $key['last'];
                $email = $key['email'];
                
            // $to = $email;
            $to = "duntanadebiyi@yahoo.com";
            $subject = "$first $last, you now have access to classic plan on Pro-filr";
            
            $message = '
            
            
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
             <head>
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
              <title>Promo Profilr</title>
              <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            </head>
            <body style="margin: 0; padding: 20px;background-color: #DEE0E2;">
             <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc;background-color: #F4F4F4; font-family: verdana; font-size: 12px; text-align: justify; line-height: 1.5">
                <tr>
                    <td style="padding: 20px 20px 20px 20px;">
                        <table width="100%">
                            <tr>
                                <td style="font-size: 10px;"><a href="https://pro-filr.com" target="_blank">www.pro-filr.com</a></td>
                                <td style="font-size: 10px;" align="right">Email not displaying correctly?<br/><a href="https://www.pro-filr.com/templates/Complete/Complete.html">View in your browser</a></td>
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
                <td align="center">
                    
                    <div style="background-color: #fff; max-width: 320px; text-align: justify !important; padding: 30px;"><img src="https://thumbs.gfycat.com/LikableWeeCoyote-max-1mb.gif" style="width:60px; height: 60px; position: relative; top: 50px">
                        <h1 align="center">HURRAY!!!</h1><hr>
                        <p style="text-align: center">You now have access to classic plan on Pro-filr for</p> <p style="text-align: center"><span style="color: #3e9a47; font-weight: bold; font-size: 30px;">30 days</span></p>
                        <hr style="color:#f2f2f2">
             
                    </div>
                    
                <p> <a href="https://www.pro-filr.com/account" style="color: #fff; background-color: #139f5e; padding: 7px; text-decoration: none">Visit today to Get Started</a> </p>
                </td>
            </tr>
             </table>
            </td>
             </tr>
             <tr>
                 
                <td style="padding: 20px 30px 20px 30px;">
                    <p style="font-style: italic;font-weight: bold; color: #980000;">Upgrade to Classic Membership.</p>
            <p>Classic Membership on Pro-filr.com provides you with awesome opportunities. With the upgraded membership, you can engage other professionals, access opportunities, create unlimited professional groups and unlimited projects. <a href="https://pro-filr.com/paypal" target="_blank">Visit today to Upgrade. </a></p>
                </td>
             </tr>
             <tr>
              <td style="padding: 10px 30px 30px 30px;">
                <hr/>
             <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #139f5e; padding: 15px">
             <tr>
              <td width="65%" style="color: #fff;font-family: Helvetica;font-size: 10px;line-height: 150%;text-align: left;font-style: italic;"> This email was intended for '.$first.' '.$last.' '.$email.' Copyright &copy; 2016 - 2019 <script>new Date().getFullYear()>&&document.write(""+new Date().getFullYear());</script> Professionals File Inc. 10 George St. North. Ontario. L6X 1R2. Canada.
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
            
            // print_r($message);
            
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers .= 'From: <subscription@pro-filr.com>' . "\r\n";
            // $headers .= 'Cc: myboss@example.com' . "\r\n";
            
            mail($to,$subject,$message,$headers);    
}
           

           
           
            
        }
        
        print_r("Done");
        echo "<a href='https://www.pro-filr.com/dashboard'>Go back</a>";
        
        header( "Location:https://www.pro-filr.com/dashboard" );
    }
 
    
    
    

} catch (PDOException $e) {
echo 0;
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>