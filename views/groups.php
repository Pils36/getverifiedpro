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

$hostname='localhost';
$username='profilr_user';
$password='portFOLIO_2015';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=profilr_beta",$username,$password);

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
    // echo 'Connected to Database<br/>';
    
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }




?>
<!DOCTYPE html>
<html>
<?php include("partials/b_head.html"); ?>
<link rel="stylesheet" href="assets/lib/bootstrap-select/css/bootstrap-select.min.css">

<?php //echo "token:".$_SESSION['token']; ?>
<body>
<?php include("partials/b_profile_nav.html"); ?>

<div class="container sections-wrapper">
    <div class="row">
        <div class="secondary col-md-3 col-sm-12 col-xs-12">
            <aside class="info aside section">
                <div class="section-inner">
                    <div class="content quote">
                        <ul class="list-unstyled">
                            <li><a href="posts">Opportunities</a></li>
                            <li><a href="posts">Messages</a></li>
                            <li class="active">Professional Groups</li>
                        </ul>
                    </div><!--//content-->
                </div><!--//section-inner-->
            </aside><!--//aside-->

        </div><!--//secondary-->

        <div class="primary col-md-6 col-sm-12 col-xs-12">
            <div id="frame">
                <div id="sidepanel">

                    <div id="group_body">
                        <div id='profile'>
                            <div class='wrap'><p>Groups</p>
                                <a href="#" style="padding: 0 10px;" data-toggle="modal" class="pull-right"
                                   data-target="#createGroup" onclick="groupd();"><i class="fa fa-plus"></i> Create Group</a>

                            </div>
                        </div>
                        <div id='search'><label for=''><i class='fa fa-search' aria-hidden='true'></i></label><input
                                    type='text' id='groupTableSearch' placeholder='Search Groups...'/></div>
                        <div id="contacts">
                            <ul id="group_table_list">

                            </ul>
                        </div>
                    </div>

                </div>

                <div class="content">
                    <div id="group-info">

                    </div>
                    <div class="messages">
                        <ul id="message-outlet">

                        </ul>
                    </div>

                    <div class="message-input">
                        <form class="wrap hidden" id="message_group_form" method="post" action="controller/app.php">
                            <div class="upload">
                                <div class="drop">
                                    <ul id="file_upload_list">

                                    </ul>
                                </div>
                            </div>
                            <input type="text" id="group_message_text" class="form-control"
                                   placeholder="Write your message..."/>
                            <input type="hidden" id="group_id">
                            <input type="hidden" id="attachedFiles">
                            <button class="submit" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                            </button>
                            <div class="clearfix"></div>
                            <div id="upload" class="upload">
                                <div id="drop" class="drop">
                                    <a><span>Attach File <i class="fa fa-paperclip attachment"
                                                            aria-hidden="true"></i></span></a>
                                    <input type="file" name="attachment" multiple/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!--//masonry-->
        </div><!--//primary-->
        <div class="secondary col-md-3 col-sm-12 col-xs-12">
            <aside class="info aside section">
                <div class="section-inner" id="third-row-data-outlet">

                </div>
            </aside>

            <aside class="info aside section">
                <div class="section-inner" id="files-row-data-outlet">

                </div>
            </aside>
        </div>
    </div>

    <!-- Create Group Modal -->
    <div class="modal fade" id="createGroup" tabindex="-1" role="dialog" aria-labelledby="createGroupLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="createGroupLabel">Create Group</h4>
                </div>
                <div class="modal-body">
                    <div id="group_response"></div>
                    <form id="create_group_form" autocomplete="off">
                        <div class="form-group">
                            <label for="title">Group Name</label>
                            <input type="text" class="form-control" id="group_title" placeholder="Group Name">
                        </div>

                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default" style="padding: 10px 15px; width: 20%">Submit</button>
                    <!--                    <button type="submit" class="btn btn-primary">Submit</button>-->
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    
    <!--Add member to group-->
    
    <div class="modal fade" id="addMember" tabindex="-1" role="dialog" aria-labelledby="addMemberLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addMemberLabel">Add Member</h4>
                </div>
                <div class="modal-body">
                    <div id="member_response"></div>
                    <form id="add_member_form" autocomplete="off">
                        <div class="form-group">
                            <label for="members">My Connections</label>
                            <select id="search_members" class="form-control" style="display:none;">
                                
                            </select>
                            <select id="search_member" class="form-control selectpicker" multiple data-live-search="true">
                                
<?php 
 
    // Fetch Members in connection to add to group
    $login_id = $_SESSION['login_id'];
    $sth = $dbh->prepare("SELECT tbl_connection.login_id, tbl_connection.member_id, firstname, lastname FROM tbl_connection JOIN tbl_account_individual WHERE tbl_connection.member_id = tbl_account_individual.login_id AND tbl_connection.login_id = $login_id");
    $sth->execute();
    
    /* Fetch all of the remaining rows in the result set */
    $result = $sth->fetchAll();
    $i = 0;
    foreach($result as $key){  $i=$i+1; ?>
        <option value="<?php echo $key['member_id'] ?>"><?php echo $key['firstname']." ".$key['lastname']?></option>
    <?php }?>                                
                                
                                
                            </select>
                            <input type="number" id="max" value="<?php echo count($result); ?>" style="display:none;" />
                        </div>
                        <input type="hidden" id="group_id">

                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default" style="padding: 10px 15px; width: 20%">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>


    <!-- Send Private Message -->
    <div class="modal fade" id="sendMessage" tabindex="-1" role="dialog" aria-labelledby="sendMessageLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="createTaskLabel">Compose A Message</h4>
                </div>
                <div class="modal-body">
                    <div id="message_response"></div>
                    <form id="message_member_form" autocomplete="off">
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" placeholder="Subject">
                        </div>
                        <input type="hidden" name="member_id" id="member_id">
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message_text" class="form-control" placeholder="Write Message">

                            </textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	<?php include("partials/scripts.html"); ?>
    <script type="text/javascript" src="assets/lib/bootstrap-select/js/bootstrap-select.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.selectpicker').selectpicker();
        });
    </script>
    
    <script type="text/javascript" src="assets/js/groups.js"></script>

    <script src="assets/upload/js/jquery.knob.js"></script>
    <script src="assets/upload/js/jquery.ui.widget.js"></script>
    <script src="assets/upload/js/jquery.iframe-transport.js"></script>
    <script src="assets/upload/js/jquery.fileupload.js"></script>
    <script src="assets/upload/js/script.js"></script>
</body>
</html>