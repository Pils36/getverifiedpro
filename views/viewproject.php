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

<!--Goto Member Page-->

<?php

if(isset($_GET['submit'])){
    echo $id;
}

?>

<!DOCTYPE html>
<html>
<?php include("partials/b_head.html"); ?>
<?php //echo "token:".$_SESSION['token']; ?>
<body>
<?php include("partials/b_profile_nav.html"); ?>

<style>
    .m-div > p{
        font-size: 13px;
    }
    .professional-box ul{
        list-style: none;
    }
    
    .professional-box{
        border: 1px solid #159f5c;
        background-color: #fff;
        border-radius: 5px;
        padding: 15px;
    }
    .img-prof img{
        width: 70px; height: 70px;
        padding: 10px;
        border-radius: 100%;
        position: relative;
    }
    .btn-check{
        padding: 5px;
        border: 1px solid #159f5c;
        background-color: #fff;
        color: #159f5c;
        text-align: center;
    }
    .btn-check:hover{
        background-color: #159f5c;
        color: #fff;
    
    }



    .navi-list{
        text-align: justify;
        font-size: 13px;
        padding: 15px;
    }

    
</style>
<div class="container sections-wrapper">
    <div class="row">

        <div class="secondary col-md-3 col-sm-12 col-xs-12">
            <aside class="info aside section">
                <div class="section-inner">
                    <img class="profile_picture img-thumbnail" style="width: 100%" src="assets/images/man.png"/>
                </div>
                <div class="section-inner">
                    <!--          Button trigger modal -->
                    <?php 
        $sth = $dbh->prepare("SELECT * FROM `tbl_validation` WHERE member_id ='".$_SESSION['login_id']."'");
        $sth->execute();
        
        $res = $sth->fetchAll();
        $count = count($res);
        
        if($count > 0)?>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg" style="color:#fff; width: 100%; font-size: 13px;">
     
        VERIFIED
</button>
 
        else
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg" style="color:#fff; width: 100%; font-size: 13px;">
             NOT YET VERIFIED
</button>
        <?
     ?>            
 
                    <h4 class="header" id="profile_name"></h4>
                    <div class="description" id="profile_current_position"></div>
                    <br>
                    <div class="clearfix"></div>
                    <!--                    <hr>-->
                     <div class="content quote">


                        <ul class="list-unstyled">
                            <?php 
                                $sth = $dbh->prepare("SELECT * FROM `tbl_subscription` WHERE expiry_date >= NOW() AND login_id = '".$_SESSION['login_id']."'");
                                $sth->execute();
                                $result = $sth->fetchAll();
                                
                                $count = count($result);
                                // print_r($count);
                                if($count > 0)?>
                                    <li><a href="validation">Validations</a><span class="label label-success pull-right"
                                                 id="profile_validations">0</span></li>
                            <li><a href="profile_view">Profile Views</a><span class="label label-danger pull-right"
                                                   id="profile_views">0</span></li>
                               
                               else ?>
                                   <li><a id="validations" style="cursor: pointer">Validations</a><span class="label label-success pull-right"
                                                 id="profile_validations">0</span></li>
                            <li><a id="views" style="cursor: pointer">Profile Views</a><span class="label label-danger pull-right"
                                                   id="profile_views">0</span></li>
                               <?
                            ?>
                            
                            <li><a href="posts"> Messages</a><span class="label label-warning pull-right" id="profile_messages">0</span>
                            </li>
                            <li><a href="invites"> Connections</a><span class="label label-primary pull-right" id="profile_connections">0</span>
                            </li>
                            <li><a href="groups"> Groups</a><span class="label label-default pull-right" id="profile_groups">0</span>
                            </li>
                        </ul>
                    </div><!--//content-->
                    </div><!--//section-inner-->
            </aside><!--//aside-->

        </div><!--//secondary-->
        <div class="primary col-md-9 col-sm-12 col-xs-12">
            <div class="professional-box">
                
                <div class="row">
                    
                    <div class="col-md-12">
                        <div>
                            
                    <h4 style="background-color: #159f5c; color: #fff; text-align: center; padding: auto; width: 100%; border-radius: 10px 10px 0px 0px;"> <img src="https://img.icons8.com/color/48/000000/training.png"> Current project(s) on Pro-filr</h4>
                        </div>
                        
                <div class="divider">
                <ul class="navi table-responsive">
                    <table id="myTable1" class="table table-hover">
                <thead>
                  <tr>
                    <th>Owners Image</th>
                    <th>Company</th>
                    <th>Profession</th>  
                    <th>Project name</th>
                    <th>Date created</th>
                    <th>View profile</th>
                  </tr>
                </thead>
                <tbody>

                 <?php
 $login_id = $_SESSION['login_id'];
 
    $project = $dbh->query("SELECT tbl_projects.title as title, tbl_projects.date_created AS date_created,tbl_account_individual.login_id AS login_id, tbl_account_individual.firstname AS firstname, tbl_account_individual.lastname as lastname,
    tbl_account_individual.company as company,
    tbl_account_individual.profession as profession,tbl_account_individual.photo, tbl_account_individual.online_status AS active, tbl_account_individual.last_seen AS inactive FROM `tbl_projects`, tbl_account_individual WHERE tbl_projects.owner_login_id = tbl_account_individual.login_id")->fetchAll(PDO::FETCH_ASSOC);

    foreach($project as $key)
			    $login_id = $key['login_id'];
			    $title = $key['title'];
			    $date_created = $key['date_created'];
			    $lastname = $key['lastname'];
			    $firstname = $key['firstname'];
			    $company = $key['company'];
			    $profession = $key['profession'];
			    $photo = $key['photo'];
			    $online = $key['active'];
			    $offline = $key['inactive'];
			?>
            
			 
                  <tr>
                    <td>
                        <img src=https://www.pro-filr.com/assets/resources/pics/<?php echo $photo ?> align="left" style="width:50px; height: 50px; border-radius: 100%">
                    </td>
                    
                    <td style="text-transform: capitalize ;text-align: justify">
                        <?php echo $company ?>
                    </td>
                    
                    <td style="text-transform: capitalize ;text-align: justify">
                        <?php echo $profession ?>
                    </td>
                    <td style="font-size: 12px; text-align: justify">
                        
                        <?php echo substr($title, 0, 20); ?>
                        
                    </td>

                    
                    <td>
                        <?php echo date('d-m-Y', strtotime($date_created)) ?>
                    </td>
                    <td>
                        <form action="member" method="POST" target="_blank">
                            <input type="text" value="<?php echo $login_id?>" name="id" readonly style="display:none">
                            <button name="submit" class="text-center" style="text-decoration: underline; color: #007acc; border: none; outline: none" data-account="<?php echo $login_id ?>">view profile</button>
                        </form>
                    </td>
                  </tr>
                 
                    
			<?

			
?>
                     <!--<hr>-->
                </tbody>
             </table>                 
                
                </ul>
                </div>
                </div>
          
                
            </div>
        </div><!--//primary-->

    </div><!--//row-->
</div><!--//masonry-->




<?php include("partials/scripts.html"); ?>


<!--<script type="text/javascript" src="assets/js/landing.js"></script>-->

</body>
</html>
     