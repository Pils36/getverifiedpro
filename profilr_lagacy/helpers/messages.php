<?php
function getMessages($dbh)
{
	// var_dump($_POST);
	$myResponse = new response();
	$query = "";
	try {
		
		switch ($_POST['type']) {
			case 'inbox':
				$query = "select tbl_message.*,upper(concat(firstname,' ',lastname)) as `member` from tbl_message 
							join tbl_account_individual on tbl_message.sent_by = tbl_account_individual.login_id where sent_to = {$_SESSION['login_id']} ORDER BY date_sent desc";
				break;
			case 'sent':
				$query = "select tbl_message.*,upper(concat(firstname,' ',lastname)) as `member` from tbl_message 
							join tbl_account_individual on tbl_message.sent_to = tbl_account_individual.login_id where sent_by = {$_SESSION['login_id']} ORDER BY date_sent desc";
			default:
				# code...
				break;
			
		}
		// echo $query;
		$rows = $dbh->query($query)->fetchAll(PDO::FETCH_ASSOC);
		$myResponse->status = "success";
		$myResponse->message = "Messages retrieved successfully";
		$myResponse->data = $rows;
		return json_encode($myResponse);
	} catch (Exception $e) {
		$myResponse->status = "failed";
		$myResponse->message = "Messages not available this time. Please retry";
		return json_encode($myResponse);
		
	}
	
}

function readMessage($dbh)
{
	$myResponse = new response();
	$query = "";
	try {
		$query = "select *,(select concat(firstname,' ',lastname) from tbl_account_individual where login_id = tbl_message.sent_by) as sentBy,(select concat(firstname,' ',lastname) from tbl_account_individual where login_id = tbl_message.sent_to) as sentTo from tbl_message where id = {$_POST['id']}";
		$rows = $dbh->query($query)->fetch(PDO::FETCH_ASSOC);
		$myResponse->status = "success";
		$myResponse->message = "Messages retrieved successfully";
		$myResponse->data = $rows;
		return json_encode($myResponse);
	} catch (Exception $e) {
		$myResponse->status = "failed";
		$myResponse->message = "Messages not available this time. Please retry";
		return json_encode($myResponse);
		
	}
}

?>