<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

if (!validateLogin()) {
	$_SESSION['oauth_error'] = 'Please Login';
	header('Location: account');
	exit;
}

if (empty($_SESSION['state'])) {
	$_SESSION['state'] = generate_string(15);
}

if (empty($_SESSION['import_mode'])) {
	$_SESSION['import_mode'] = TRUE;
}
?>

<?php

// error_reporting(1);

$user = 'profilr_user';
$pass = 'portFOLIO_2015';

try {
    //connect DB
    $dbh = new PDO('mysql:host=localhost;dbname=profilr_beta', $user, $pass);

} catch (PDOException $e) {
echo 0;
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>
<!DOCTYPE html>
<html>
<?php include("partials/s_head.html"); ?>
<?php //echo "token:".$_SESSION['token']; ?>
<body class="Site">

<?php include("partials/s_profile_nav.html"); ?>

<style>
    .segment-count{
        border: 1px solid #f1f1f1;
        width: 100%;
        height: auto;
        padding: 15px;
    }
    .segment-count h5{
        background-color: #129d59;
        color: #fff;
        width: 100%;
        padding: 10px;
        margin: 10px auto;
        position: relative;
    }
</style>
<div class="ui grid container Site-content" style="padding-top: 50px;width: 90% !important; display: none;">
    <div class="row" style="margin-top: 30px;"></div>

    <!-- content row -->
    <div class="row">

        <div class="ui four wide column" id="left-column">
            <div class="ui card section">
                <div class="image">
                    <img class="profile_picture" src="assets/images/man.png">
                </div>
                <div class="content">
                    <a class="header" id="profile_name"></a>
                    <!-- <div class="meta"><span class="date">Joined in 2013</span></div> -->
                    <div class="description" id="profile_current_position"></div>
                    <!-- <div class="ui divider"></div> -->
                    <!-- <div class="description">Systems Engineer at Grace InfoTech Limited</div> -->
                </div>

            </div>
        </div>
        

        <div class="ui eight wide column" id="middle-column">
	
	        <?php
	        if (!empty($_SESSION['oauth_error'])) {
		        ?>
                <div class="ui error message">
			        <?= $_SESSION['oauth_error'] ?>
                </div>
		        <?php
		        unset($_SESSION['oauth_error']);
	        }
	        ?>
            
            <div class="ui">
                
                <div class="row">
                    <div class="col-md-12">
                        <table id="myTable1" class="table table-striped table-hover" width="100%">
                            <thead>
                                <tr style="text-align: justify; color: #fff; background-color: #129d59">
                                    <th>S/N</th>
                                    <th>Viewed by</th>
                                    <th>Company</th>
                                    <th>Industry</th>
                                    <th>Profession</th>
                                    <!--<th>Verification status</th>-->
                                    <th>Date viewed</th>
                                    
                                </tr>
                            </thead>
                                
                            <tbody>
                                <?php
                                
                                    $sth = $dbh->query("SELECT * FROM `tbl_profile_views` JOIN tbl_account_individual WHERE tbl_profile_views.viewed_by_login_id = tbl_account_individual.login_id AND tbl_profile_views.member_login_id = '".$_SESSION['login_id']."'");
                                    
                                    $sth->execute();
                                    $result = $sth->fetchAll();

                                     $i = 1;
                                    foreach($result as $key => $member)?>
                                        <tr style="text-align: justify">
                                        <td><?php echo $i++;?></td>
                                    <td><?php echo $member['lastname'].' '.$member['firstname']; ?></td>
                                    <td><?php echo $member['company']; ?></td>
                                    <td><?php echo $member['industry']; ?></td>
                                    <td><?php echo $member['profession']; ?></td>
                                    <td><?php echo $member['date_viewed']; ?></td>
                                    </tr>
                                    <?
                                
                                ?>

                            </tbody>
                            
                        </table>
                    </div>
                    
                </div>
            </div>
