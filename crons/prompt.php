<?php

error_reporting(1);

$user = 'profilr_user';
$pass = 'portFOLIO_2015';
$hash = 'profilrexecreq2019_rec';
// $hash = 'beto';

try {
    //connect DB
    $dbh = new PDO('mysql:host=localhost;dbname=profilr_beta', $user, $pass);
    
    //Switch Cases
    if(null != $_POST['action'])
    {
        if(md5($hash) === $_POST['hash']){
       switch($_POST['action']){
            case 'Sync':
                //Run Sync Process
                //Check User Email EXIST
                $sql = "SELECT * FROM tbl_account_individual WHERE email = '".$_POST['user']."'";
                    $sth = $dbh->prepare($sql);
                    $r = $sth->execute();
                    $resp = $sth->fetchAll();
                    
                    // Check Validation
                $val = "SELECT * FROM `tbl_validation` JOIN tbl_account_individual ON tbl_validation.member_id = tbl_account_individual.login_id WHERE tbl_account_individual.email = '".$_POST['user']."' ";
                $vth = $dbh->prepare($val);
                $rVal = $vth->execute();
                $respVal = $vth->fetchAll();
                $countVal = count($respVal);
                
                // Check Payment
                    $pay = "SELECT expiry_date >=NOW() FROM `tbl_subscription` JOIN tbl_account_individual ON tbl_subscription.login_id = tbl_account_individual.login_id WHERE tbl_account_individual.email = '".$_POST['user']."'";
                    $pays = $dbh->prepare($pay);
                    $pays->execute();
                    $getPay = $pays->fetchAll();
                    $countPay = count($getPay);
                    
                    
                    if(count($resp) > 0){
                        //Insert Execute USER

                            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "REPLACE INTO exec_user (execute_id, profilr_email, pay)
                            VALUES ('".$_POST['execid']."', '".$_POST['user']."', '".$countPay."')";
                            // use exec() because no results are returned
                            $dbh->exec($sql);
                            
                            
                
                    //  if found either inserted or not into DB
                    //Return result
                    $res = json_encode(array([status => 1, validate => $countVal, experience => $_POST['experience'], pay => 1]));
                    print_r($res);
                    }
                    else{
                        //Failed : User not Found
                        $res = json_encode(array([status => 0, validate => 0, pay => 0]));
                        print_r($res);
                    }
                    
                    break;
                    
            case 'RegisterSync':
                //Run Register Sync Process
                 $sql = "SELECT * FROM exec_user WHERE profilr_email = '".$_POST['user']."'";
                    $sth = $dbh->prepare($sql);
                    $r = $sth->execute();
                    $resp = $sth->fetchAll();
                    
                    // Check Validation
                    $val = "SELECT * FROM `tbl_validation` JOIN tbl_account_individual ON tbl_validation.member_id = tbl_account_individual.login_id WHERE tbl_account_individual.email = '".$_POST['user']."' ";
                    $vth = $dbh->prepare($val);
                    $rVal = $vth->execute();
                    $respVal = $vth->fetchAll();
                    $countVal = count($respVal);
                    
                    
                    // Check Payment
                    $pay = "SELECT expiry_date >=NOW() FROM `tbl_subscription` JOIN tbl_account_individual ON tbl_subscription.login_id = tbl_account_individual.login_id WHERE tbl_account_individual.email = '".$_POST['user']."'";
                    $pays = $dbh->prepare($pay);
                    $pays->execute();
                    $getPay = $pays->fetchAll();
                    $countPay = count($getPay);
                    
                // If already registered
                if(count($resp) > 0){
                    
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sql = "UPDATE exec_user SET profilr_email = '".$_POST['user']."', pay = '".$countPay."'  WHERE profilr_email = '".$_POST['user']."'";
                    
                        // Prepare statement
                        $stmt = $dbh->prepare($sql);
                    
                        // execute the query
                        $stmt->execute();
                    
                    // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    // $sql = "REPLACE INTO exec_user (execute_id, profilr_email, pay) VALUES ('".$_POST['execid']."', '".$_POST['user']."', 0)";
                    // // use exec() because no results are returned
                    // $dbh->exec($sql);
                        
                // Return result
                        $res = json_encode(array([status => 1, validate => $countVal, pay => 1]));
                        print_r($res);
                }
                else{
                    //Failed : User not Found
                    $res = json_encode(array([status => 0, validate => 0, pay => 0]));
                    print_r($res);
                }
                break;
                
                case 'PaySync':
                    // Run Pay Sync Process
                    $sql = "SELECT * FROM exec_user WHERE execute_id = '".$_POST['execid']."'";
                    $sth = $dbh->prepare($sql);
                    $r = $sth->execute();
                    $resp = $sth->fetchAll();
                    
                    // Check Validation
                    $val = "SELECT * FROM `tbl_validation` JOIN tbl_account_individual ON tbl_validation.member_id = tbl_account_individual.login_id WHERE tbl_account_individual.email = '".$_POST['user']."' ";
                    $vth = $dbh->prepare($val);
                    $rVal = $vth->execute();
                    $respVal = $vth->fetchAll();
                    $countVal = count($respVal);
                    
                    // Check Payment
                    $pay = "SELECT expiry_date >=NOW() FROM `tbl_subscription` JOIN tbl_account_individual ON tbl_subscription.login_id = tbl_account_individual.login_id WHERE tbl_account_individual.email = '".$_POST['user']."'";
                    $pays = $dbh->prepare($pay);
                    $pays->execute();
                    $getPay = $pays->fetchAll();
                    $countPay = count($getPay);
                    
                    if(count($resp) > 0){
                        
                        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sql = "UPDATE exec_user SET pay = '".$countPay."' WHERE execute_id = '".$_POST['execid']."'";
                    
                        // Prepare statement
                        $stmt = $dbh->prepare($sql);
                    
                        // execute the query
                        $stmt->execute();
                    
                    // Return result
                    $res = json_encode(array([status => 1, validate => $countVal, pay => 1]));
                    print_r($res);
                    }
                    else{
                        //Failed : User not Found
                        $res = json_encode(array([status => 0, validate => 0, pay => 0]));
                        print_r($res);
                    }
            case 'searchopportunity':
                
                    $search = $_POST['search'];
                    
                    // Search Opportunity Query
                    $sql = "SELECT id AS project_key, subject AS `project_title`, description AS `briefs`, location AS `city`, deadline AS `proposal_submission_deadline` FROM tbl_opportunity WHERE subject LIKE :search";
                    $sth = $dbh->prepare($sql);
                    $sth->bindValue(':search', '%'.$search.'%');
                    $sth->execute();
                    
                    $resp = $sth->fetchAll();
                    
                    // Return result
                    $res = json_encode(array([subject => $resp, item => $_POST['action'], hash =>$_POST['hash']]));
                    print_r($res);
    
            break;
            
            // Services Search
            case 'searchservices':
              
                $search = $_POST['search'];
                $searchcity = $_POST['searchcity'];
                    
                    // Search Opportunity Query
                    $sql = "SELECT name AS companyname, email AS email FROM tbl_company JOIN tbl_account_individual ON tbl_company.login_id = tbl_account_individual.login_id WHERE specialisation LIKE :search AND state LIKE :searchcity";
                    $sth = $dbh->prepare($sql);
                    $sth->bindValue(':search', '%'.$search.'%');
                    $sth->bindValue(':searchcity', '%'.$searchcity.'%');
                    $sth->execute();
                    
                    $resp = $sth->fetchAll();
                    
                    // Return result
                    $res = json_encode(array([subject => $resp, item => $_POST['action'], hash =>$_POST['hash']]));
                    print_r($res);                      
    
            break;
            
            // Search Lead
            case 'searchlead':
                
                    $search = $_POST['search'];
                    
                    // Search Opportunity Query
                    $sql = "SELECT * FROM tbl_opportunity WHERE subject LIKE :search";
                    $sth = $dbh->prepare($sql);
                    $sth->bindValue(':search', '%'.$search.'%');
                    $sth->execute();
                    
                    $resp = $sth->fetchAll();
                    
                    // Return result
                    $res = json_encode(array([subject => $resp, item => $_POST['action']]));
                    print_r($res);
    
            break;
            
            
            // Services Count
            case 'getservices':
                
                $sql = "SELECT * FROM `tbl_company`";
                $sql = $dbh->prepare($sql);
                $sql->execute();
                $res = $sql->fetchAll();
                $rescount = count($res);
                
                // Return result
                    $servcount = json_encode($rescount);
                    print_r($servcount);
                
            break;
            
            // Opportunity count
            case 'getOpportunity':
                
                $opport = "SELECT * FROM `tbl_opportunity`";
                $opport = $dbh->prepare($opport);
                $opport->execute();
                $res = $opport->fetchAll();
                $rescount = count($res);
                
                // Return result
                    $opportcount = json_encode($rescount);
                    print_r($opportcount);
                
            break;
            
            // Opportunity count
            case 'getThisOpportunity':
                
                $opportune = "SELECT * FROM `tbl_opportunity` WHERE industry = '".$_POST['industry']."' OR specialisation = '".$_POST['profession']."'";
                
                $opportune = $dbh->prepare($opportune);
                $opportune->execute();
                $res = $opportune->fetchAll();
                $opportcount = count($res);
                
                // Return result
                    $opportcounter = json_encode($opportcount);
                    print_r($opportcounter);
                
            break;
            
            // Search pushexperience
            case 'pushexperience':
                
                    $sql = "SELECT * FROM tbl_account_individual WHERE email = '".$_POST['user']."'";
                    $sql = $dbh->prepare($sql);
                    $sql->execute();
                    
                    $resp = $sql->fetchAll();
                    
                    if(count($resp)>0)
                    
                    {
                        $experience = json_decode($_POST['experience'],true);
                        print_r($experience['execid']);
                        
                        // print_r($_POST['experience']);
                        
                        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                        foreach($experience as $experiences){
                            $sql = "INSERT INTO tbl_industry_test (login_id,exec_id,position, company, location, from_month, from_year, to_month, to_year, description, award, specialisation)
                            VALUES ('".$experiences['login_id']."', '".$experiences['execid']."','".$experiences['position']."', '".$experiences['company']."','".$experiences['location']."','".$experiences['frommonth']."','".$experiences['fromyear']."','".$experiences['tomonth']."','".$experiences['toyear']."','".$experiences['description']."','".$experiences['award']."','".$experiences['specialisation']."')";
                            
                            // use exec() because no results are returned
                            $dbh->exec($sql);
                        }
                        $res = 1;
                        print_r($res);
                        
                    }
                    
                    // $res = json_encode(array([status => 1, validate => $countVal, experience => $_POST['experience']]));
                    //     print_r($res);
                        
                    //Return result
                    $res = 1;
                    print_r($res);
    
            break;
            
            // Search pushcertification
            case 'pushcertification':
                
                
                    
                    // $res = json_encode(array([status => 1, validate => 1, experience => 1]));
                    //     print_r($res);
                    //Return result
                    $res = 1;
                    print_r($res);
    
            break;
            
            // Search pushqualification
            case 'pushqualification':
                
                
                // $res = json_encode(array([status => 1, validate => 1, experience => 1]));
                //         print_r($res);
                    
                    //Return result
                    $res = 1;
                    print_r($res);
    
            break;
            
            
            
            default:
                
            break;
       }
        }else{
                 $res = json_encode(array([status => 0, validate => md5($hash), reason => $_POST['hash']]));
                 print_r($res);   
        }
    }
    else{
        $res = json_encode(array([status => 0, validate => 0, reason => 'Please provide detail | Invalid source']));
       print_r($res);
    }

        // else{
        //     $item = array(status=>1);
        //     $data = array($item);
        //     $res = json_encode($data);
            
        //     // print_r($res);
        // }
        
    $dbh = null;
} catch (PDOException $e) {
echo 0;
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>