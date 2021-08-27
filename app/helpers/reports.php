<?php

function fetchUsersReports()
{
	$myResponse = new Response();
	$region = !empty($_POST['region']) ? $_POST['region'] : '';
	$specialisation = !empty($_POST['specialisation']) ? $_POST['specialisation'] : '';
	
	$r = new Reports();
	try {
		$total_users = $r->getTotalUsers();
		$basic_users = $r->getBasicUsers();
		$classic_users = $r->getClassicUsers();
		$weekly_classic_users = $r->getWeeklyClassicUsers();
		
		$data = [
			['name' => 'Total Number of Users', 'value' => count($total_users)],
			['name' => 'Total Number of Users List', 'value' => ($total_users)],
			['name' => 'Number of Basic Users', 'value' => count($basic_users)],
			['name' => 'Number of Basic Users List', 'value' => ($basic_users)],
			['name' => 'Number of Classic Users', 'value' => count($classic_users)],
			['name' => 'Number of Classic Users List', 'value' => ($classic_users)],
			['name' => 'Number of Classic Users this Week', 'value' => count($weekly_classic_users)],
			['name' => 'Number of Classic Users this Week List', 'value' => ($weekly_classic_users)],
		];
		
		$myResponse->status = "success";
		$myResponse->message = "Records fetched successfully";
		$myResponse->data = $data;
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Cannot get Users Reports";
	}
	return json_encode($myResponse);
}


// Fetch Imported Contacts Reports
// function fetchImportedContactsReports(){
    
//     $myResponse = new Response();
// 	$region = !empty($_POST['region']) ? $_POST['region'] : '';
// 	$specialisation = !empty($_POST['specialisation']) ? $_POST['specialisation'] : '';
	
// 	$r = new Reports();
// 	try {
// 		$total_users = $r->getTotalUsers();
// 		$basic_users = $r->getBasicUsers();
// 		$classic_users = $r->getClassicUsers();
// 		$weekly_classic_users = $r->getWeeklyClassicUsers();
		
// 		$data = [
// 			['name' => 'Total Number of Users', 'value' => count($total_users)],
// 			['name' => 'Total Number of Users List', 'value' => ($total_users)],
// 			['name' => 'Number of Basic Users', 'value' => count($basic_users)],
// 			['name' => 'Number of Basic Users List', 'value' => ($basic_users)],
// 			['name' => 'Number of Classic Users', 'value' => count($classic_users)],
// 			['name' => 'Number of Classic Users List', 'value' => ($classic_users)],
// 			['name' => 'Number of Classic Users this Week', 'value' => count($weekly_classic_users)],
// 			['name' => 'Number of Classic Users this Week List', 'value' => ($weekly_classic_users)],
// 		];
		
// 		$myResponse->status = "success";
// 		$myResponse->message = "Records fetched successfully";
// 		$myResponse->data = $data;
// 	} catch (Exception $ex) {
// 		$myResponse->status = "failed";
// 		$myResponse->message = "Cannot get Users Reports";
// 	}
// 	return json_encode($myResponse);
// }


function fetchProfilesReports()
{
	$myResponse = new Response();
	$region = !empty($_POST['region']) ? $_POST['region'] : '';
	
	$r = new Reports();
	try {
		$complete_users = $r->getCompletedProfiles($region);
		$incomplete_users = $r->getUncompletedProfiles($region);
		
		
		$data = [
			['name' => 'Number of Completed Profiles', 'value' => count($complete_users)],
			['name' => 'List of Completed Profiles', 'value' => $complete_users],
			['name' => 'Number of Uncompleted Profiles', 'value' => count($incomplete_users)],
			['name' => 'List of Uncompleted Profiles', 'value' => $incomplete_users],
		];
		
		$myResponse->status = "success";
		$myResponse->message = "Records fetched successfully";
		$myResponse->data = $data;
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Cannot get Users Reports";
	}
	return json_encode($myResponse);
}



function fetchGrowthReports()
{
	$myResponse = new Response();
	$r = new Reports();
	try {
		$total_imported = $r->getTotalImportedContacts();
		$weekly_imported = $r->getWeeklyImportedContacts();
		$weekly_users = $r->getWeeklyNewSignUps();
		$weekly_completed = $r->getWeeklyCompletedProfiles();
		
		$num_weekly_imported = $weekly_imported ? count($weekly_imported) : 1;
		$num_weekly_completed = $weekly_completed ? count($weekly_completed) : 1;
		
		$data = [
			['name' => 'Total Number of imported contacts', 'value' => count($total_imported)],
			['name' => 'Total Number of imported contacts List', 'value' => ($total_imported)],
			['name' => 'Weekly % of users against imported contact', 'value' => (count($weekly_users) * 100 / $num_weekly_imported).' %'],
			['name' => 'Weekly % of users against completed contact', 'value' => (count($weekly_users) * 100 / $num_weekly_completed).' %'],
		];
		
		$myResponse->status = "success";
		$myResponse->message = "Records fetched successfully";
		$myResponse->data = $data;
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Cannot get Users Reports";
	}
	return json_encode($myResponse);
}

function fetchValidationReports()
{
	$myResponse = new Response();
	
	$start_date = !empty($_POST['start_date']) ? $_POST['start_date'] : '';
	$end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : '';
	
	$r = new Reports();
	try {
		$total_validations = $r->getValidationsOverDateRange($start_date, $end_date);
		$total_users = $r->getUsersOverDateRange($start_date, $end_date);
		$imported_contacts = $r->getImportedContactsOverDateRange($start_date, $end_date);
		
		$num_imported_contacts = $imported_contacts ? count($imported_contacts) : 1;
		$num_total_users = $total_users ? count($total_users) : 1;


//		var_dump($total_users);
		
		$data = [
			['name' => 'No. of validations within Range', 'value' => ($total_validations)],
			['name' => '% of validations over total users within Range', 'value' => (count($total_validations) * 100 / $num_total_users).' %'],
			['name' => '% of validations over imported contacts within Range', 'value' => (count($total_validations) * 100 / $num_imported_contacts).' %'],
		];
		
		$myResponse->status = "success";
		$myResponse->message = "Records fetched successfully";
		$myResponse->data = $data;
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Cannot get Users Reports";
	}
	return json_encode($myResponse);
}


function fetchUtilisationReports()
{
	$myResponse = new Response();
	
	$start_date = !empty($_POST['start_date']) ? $_POST['start_date'] : '';
	$end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : '';
	
	$r = new Reports();
	try {
		$profile_views = $r->getProfileViewed($start_date, $end_date);
		$active_opp = $r->getActiveOpportunities($start_date, $end_date);
		$expired_opp = $r->getExpiredOpportunities($start_date, $end_date);
		
		$data = [
			['name' => 'Unique Visit within Range', 'value' => 'Please refer to Google Analytics Data'],
			['name' => 'Profile Views Within Range', 'value' => ($profile_views)],
			['name' => 'Search Type Within Range', 'value' => 'Data not currently being captured'],
			['name' => 'Total Number of Active Opportunities within Range', 'value' => ($active_opp)],
			['name' => 'Total Number of Expired Opportunities within Range', 'value' => ($expired_opp)],
		];
		
		$myResponse->status = "success";
		$myResponse->message = "Records fetched successfully";
		$myResponse->data = $data;
	} catch (Exception $ex) {
		$myResponse->status = "failed";
		$myResponse->message = "Cannot get Users Reports";
	}
	return json_encode($myResponse);
}
