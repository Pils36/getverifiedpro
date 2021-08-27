<?php
require('sphinxapi.php');
function search($dbh){


	//var_dump($_POST); exit;
	$myResponse = new  response();
	try{
	    
	    // Users search terms is saved in $_POST['q']
        // $q = $_POST['query'];
        // // Prepare statement
        // $search = $db->prepare("SELECT * FROM tbl_account_individual WHERE `firstname` LIKE ?");
        // // Execute with wildcards
        // $search->execute(array("%$q%"));
        // // Echo results
        // foreach($search as $s) {
        //   echo $s['firstname'];
        // }
    
        $query = $_POST['query'];
// 		$stmt = $dbh->prepare("select * from tbl_account_individual where firstname like :query or lastname like :query order by firstname");
        $stmt = $dbh->prepare("SELECT * FROM tbl_account_individual WHERE profession LIKE :query OR country LIKE :query OR industry LIKE :query");
// 		$stmt->execute(array(
// 			":query"=>"%{$_POST['query']}%"
// 			));
        $stmt->execute(array(":query"=>"%$query%"));
		$rows= $stmt->fetchAll(PDO::FETCH_ASSOC);
		$myResponse->status = "success";
    	$myResponse->message = "Operation Successfull";
    	$myResponse->data = $rows;
    	// print_r($myResponse);
		return json_encode($myResponse);
	}catch(Exception $ex){
		$myResponse->status = "failed";
    	$myResponse->message = "Operation failed";
	}
}


// function search($dbh)
// {
// 	// $query = "*".$_POST['query']."*";
// 	// foreach ($query as $key => $word) {
	
// 	// }
// 	$myResponse = new  response();
// 	try {
// 		$query = $_POST['query'];
// 		$cl = new SphinxClient();
// 		$cl->SetServer('localhost', 9312);
// 		$cl->SetMaxQueryTime(5000);
// 		$cl->SetMatchMode(SPH_MATCH_EXTENDED);
// 		$cl->SetSortMode(SPH_SORT_RELEVANCE);
// 		$cl->SetRankingMode(SPH_RANK_PROXIMITY_BM25);
// 		$cl->SetFieldWeights(array(
// 			"account" => 10,
// 			"lastname" => 10,
// 			"firstname" => 10,
// 			"country" => 20,
// 			"city" => 10,
// 			"website" => 10,
// 			"industry" => 30,
// 			"company" => 30,
// 			"position" => 30,
// 			"profession" => 40,
// 			"organisation" => 30,
// 			"group" => 20,
// 			"school" => 20,
// 			"degree" => 20,
// 			"field_of_study" => 20,
// 			"ind_position" => 20,
// 			"ind_company" => 20,
// 			"specialisation" => 30,
// 			"institution" => 20,
// 			"certification" => 20,
// 			"specialization" => 30,
// 		));
// 		$res = $cl->Query($query, 'main_index');
// 		$matches = $res['matches'];
// 		//$matches = array_unique(array_map(function ($i) { return $i['account']; }, $matches));
// 		//$matches = array_unique($matches);
// 		// $unique_types = array_unique(array_map(function($elem){return $elem['account'];}, $matches));
// 		$myResponse->status = "success";
// 		if ($matches) {
// 			$myResponse->message = "Results found";
// 			$myResponse->data = $matches;
// 		} else {
// 			$myResponse->message = "No results";
// 		}
		
		
// 		return json_encode($myResponse);
// 	} catch (Exception $ex) {
// 		$myResponse->status = "failed";
// 		$myResponse->message = "Search cannot be conducted at this time. Please retry.";
// 		return json_encode($myResponse);
// 	}
// }

?>