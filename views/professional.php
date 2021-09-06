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

require_once './config/dataconfig.php';

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
                                
                        <h4 style="background-color: #159f5c; color: #fff; text-align: center; padding: auto; width: 100%; border-radius: 10px 10px 0px 0px;"> <img src="https://img.icons8.com/color/48/000000/men-age-group-5.png"> Professional(s) you may know</h4>
                            </div>
                            
                    <div class="divider">
                    <ul class="navi table-responsive">
                        <table id="myTable1" class="table table-hover">
                    <thead>
                    <tr>
                        <th>Profile Pic</th>  
                        <th style="text-align: center">Name</th>
                        <th>Specialization</th>
                        <th>Company</th>
                        <th>Country</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                         $login_id = $_SESSION['login_id'];
    
            $sql0 = "SELECT my_account.*, CONCAT('Friends with ', f_account.firstname,' ', f_account.lastname) AS in_common, COUNT(*) as relevance, GROUP_CONCAT(a.login_id ORDER BY a.login_id) as mutual_friends FROM tbl_connection a JOIN tbl_connection b ON  (b.member_id = a.login_id AND b.login_id = {$login_id}) LEFT JOIN tbl_connection c ON (c.member_id = a.member_id AND c.login_id = {$login_id}) JOIN tbl_account_individual my_account ON my_account.login_id = a.member_id JOIN tbl_account_individual f_account ON f_account.login_id = a.login_id WHERE c.login_id IS NULL AND a.member_id != {$login_id} GROUP BY a.member_id ORDER BY relevance DESC;";
            
            $sql1 = "SELECT tbl_account_individual.*, CONCAT('Worked at ',the_company.name) AS in_common FROM tbl_company AS the_company JOIN tbl_company AS my_company ON my_company.name = the_company.name JOIN tbl_account_individual ON tbl_account_individual.login_id = the_company.login_id WHERE my_company.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
            
            $sql2 = "SELECT tbl_account_individual.*, CONCAT('Worked with ',the_project.project_employer) AS in_common FROM tbl_executed_project AS the_project JOIN tbl_executed_project AS my_project ON my_project.project_employer = the_project.project_employer JOIN tbl_account_individual ON tbl_account_individual.login_id = the_project.login_id WHERE my_project.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
            
            $sql3 = "SELECT tbl_account_individual.*, CONCAT('Worked at ',the_experience.company) AS in_common FROM tbl_industry_experience AS the_experience JOIN tbl_industry_experience AS my_experience ON my_experience.company = the_experience.company JOIN tbl_account_individual ON tbl_account_individual.login_id = the_experience.login_id WHERE my_experience.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
            
            $sql4 = "SELECT tbl_account_individual.*, CONCAT('Member of ',the_affiliation.organisation) AS in_common FROM tbl_affiliation AS the_affiliation JOIN tbl_affiliation AS my_affiliation ON my_affiliation.organisation = the_affiliation.organisation JOIN tbl_account_individual ON tbl_account_individual.login_id = the_affiliation.login_id WHERE my_affiliation.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
            
            $sql5 = "SELECT tbl_account_individual.*, CONCAT('Has ',the_professional_certification.certification) AS in_common FROM tbl_professional_certification AS the_professional_certification JOIN tbl_professional_certification AS my_professional_certification ON my_professional_certification.certification = the_professional_certification.certification JOIN tbl_account_individual ON tbl_account_individual.login_id = the_professional_certification.login_id WHERE my_professional_certification.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id}";
            
            $sql6 = "SELECT tbl_account_individual.*, CONCAT('Schooled at ',the_educational_qualification.school) AS in_common FROM tbl_educational_qualification AS the_educational_qualification JOIN tbl_educational_qualification AS my_educational_qualification ON my_educational_qualification.school = the_educational_qualification.school JOIN tbl_account_individual ON tbl_account_individual.login_id = the_educational_qualification.login_id WHERE my_educational_qualification.login_id = {$login_id} AND tbl_account_individual.login_id != {$login_id} ORDER BY RAND()";

            $sql7 = "select tbl_account_individual.*,concat('Lives in ',country) as in_common from tbl_account_individual where country = (select country from tbl_account_individual where login_id = {$login_id}) and login_id <> {$login_id}";
// First fetch
        $sth = $dbh->prepare($sql0);
        $sth->execute();
        $result0 = $sth->fetchAll();
        
        
        
    // Second Fetch
        $sth = $dbh->prepare($sql1);
        $sth->execute();
        $result1 = $sth->fetchAll();
        
        
        // Third Fetch
        $sth = $dbh->prepare($sql2);
        $sth->execute();
        $result2 = $sth->fetchAll();
        
        // Forth Fetch
        $sth = $dbh->prepare($sql3);
        $sth->execute();
        $result3 = $sth->fetchAll();
        
        
        // Five Fetch
        $sth = $dbh->prepare($sql4);
        $sth->execute();
        $result4 = $sth->fetchAll();
        
        
        // Sixth Fetch
        $sth = $dbh->prepare($sql5);
        $sth->execute();
        $result5 = $sth->fetchAll();
        
        // Seventh Fetch
        $sth = $dbh->prepare($sql6);
        $sth->execute();
        $result6 = $sth->fetchAll();
        
        // Eight Fetch
        $sth = $dbh->prepare($sql7);
        $sth->execute();
        $result7 = $sth->fetchAll();
        

                $results = array_merge($result0, $result1, $result2, $result3, $result4, $result5, $result6, $result7);

        
                foreach($results as $key)
                    $id = $key['login_id'];
                    $lastname = $key['lastname'];
                    $firstname = $key['firstname'];
                    $country = $key['country'];
                    $industry = $key['industry'];
                    $photo = $key['photo'];
                    $company = $key['company'];
                    $online = $key['online_status'];
                    $offline = $key['last_seen'];
                    
                    
                ?>

                 <tr>
                        
                        <td>
                            <img src=https://getverifiedpro.com/resources/pics/<?php echo $photo ?> align="left" style="width:100px; height: 100px">
                        </td>
                        
                        <td style="text-transform: uppercase; text-align: center">
                            <?php echo $firstname .' '.$lastname?>
                        </td>
                        <td>
                            <?php echo $industry?>
                        </td>
                        <td>
                            <?php echo $company?>
                        </td>
                        <td>
                            <?php echo $country;?>
                        </td>
                        <td>
                            <form action="member" method="POST" target="_blank">
                                <input type="text" value="<?php echo $id?>" name="id" readonly style="display:none">
                                <button name="submit" class="btn btn-success" data-account="<?php echo $id?>">View</button>
                            </form>
                        </td>
                    </tr>

                         
                    <!--<li class="navi-list">-->
        <!--                     <div class="img-prof">-->
        <!--                         <img src=https://getverifiedpro.com/resources/pics/<?php echo $photo ?> align="left">-->
        <!--                         </div>-->
        <!--                     <div class="info">-->
        <!--                         <p>Name:<?php echo $firstname .' '.$lastname?> </p>-->
        <!--                         <p>Specialization: <?php echo $industry?></p>-->
        <!--                         <p>Company: <?php echo $company?> | <?php echo$country;?></p>-->
                                    
        <!--                         <a href="https://www.pro-filr.com/member?id=<?php echo $id?>" data-account="<?php echo $id?>" type="button" class="btn btn-check">View</a>-->
        <!--                     </div>-->
        <!--         </li>-->
                        
                <?

                
    ?>
                        
        <!--<hr>-->
                    </tbody>
                </table>                 
                    
                    </ul>
                    </div>
                    </div>
                    
                    <!--<img src="https://www.pro-filr.com/assets/images/imgSpace.png" style="width: 100%; position: relative;">-->
                    
                </div>
            </div><!--//primary-->

        </div><!--//row-->
    </div><!--//masonry-->



    <?php include("partials/scripts.html"); ?>


    <!--<script type="text/javascript" src="assets/js/landing.js"></script>--> ]

    </body>
    </html>