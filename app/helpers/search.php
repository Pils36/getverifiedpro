<?php

//require('../sphinxapi.php');

require_once '../../app/sphinxapi.php';



// function search(){



// 	//var_dump($_POST); exit;

// 	$myResponse = new Response();

// 	try{



// 		$stmt = $dbh->prepare("select * from tbl_account_individual where firstname like :query or lastname like :query order by firstname");

// 		$stmt->execute(array(

// 			":query"=>"%{$_POST['query']}%"

// 			));

// 		$rows= $stmt->fetchAll(PDO::FETCH_ASSOC);

// 		$myResponse->status = "success";

//     	$myResponse->message = "Operation Successfull";

//     	$myResponse->data = $rows;

// 		return json_encode($myResponse);

// 	}catch(Exception $ex){

// 		$myResponse->status = "failed";

//     	$myResponse->message = "Operation failed";

// 	}

// }



function makeSearch()

{

	// $query = "*".$_POST['query']."*";

	// foreach ($query as $key => $word) {

	

	// }

	

	$myResponse = new Response();

	try {

		$query = $_POST['query'];

// 		return json_encode($query);

		$cl = new SphinxClient();
		
// 		return json_encode($cl);

		$cl->SetServer('localhost', 9312);
        // $cl->SetServer('localhost', 3312);

		$cl->SetMaxQueryTime(5000);

		$cl->SetMatchMode(SPH_MATCH_EXTENDED);

		$cl->SetSortMode(SPH_SORT_RELEVANCE);

		$cl->SetRankingMode(SPH_RANK_PROXIMITY_BM25);

		$cl->SetIndexWeights(array(

			"opportunities" => 100,

			"members" => 10

		));
		
		

		//$cl->SetFieldWeights(array("subject"=>2));

		// $cl->SetFieldWeights(array(

		// 	"account" => 10,

		// 	"lastname" => 10,

		// 	"firstname" => 10,

		// 	"country" => 20,

		// 	"city" => 10,

		// 	"website" => 10,

		// 	"industry" => 30,

		// 	"company" => 30,

		// 	"position" => 30,

		// 	"profession" => 40,

		// 	"organisation" => 30,

		// 	"group" => 20,

		// 	"school" => 20,

		// 	"degree" => 20,

		// 	"field_of_study" => 20,

		// 	"ind_position" => 20,

		// 	"ind_company" => 20,

		// 	"specialisation" => 30,

		// 	"institution" => 20,

		// 	"certification" => 20,

		// 	"specialization" => 30,

		// ));

		$res = $cl->Query($query, 'members opportunities');
		

// 		return json_encode($res);
		

		$matches = $res['matches'];

// 		return json_encode($matches);

		$total = $res['total_found'];
		
		
		//$matches = array_unique(array_map(function ($i) { return $i['account']; }, $matches));

		//$matches = array_unique($matches);

		// $unique_types = array_unique(array_map(function($elem){return $elem['account'];}, $matches));

		$myResponse->status = "success";

		if ($matches) {

			$myResponse->message = "Results found";

			$myResponse->data = array("matches"=>$matches,"total"=>$total);

		} else {

			$myResponse->message = "No match found";

		}

		return json_encode($myResponse);

	} catch (Exception $ex) {

		$myResponse->status = "failed";

		$myResponse->message = "Search cannot be conducted at this time. Please retry.";

		return json_encode($myResponse);

	}

}



// function makeSearch()

// {

// 	$myResponse = new Response();

// 	$s = new AccountIndividual();

// 	try {

// 		$query = $_POST['query'];

// 		$matches = $s->searchIndividualAccount($query);

// 		$myResponse->status = "success";

// 		if ($matches) {

// 			$myResponse->message = "Results found";

// 			$myResponse->data = $matches;

// 		} else {

// 			$myResponse->message = "No results found";

// 		}

// 		return json_encode($myResponse);

// 	} catch (Exception $ex) {

// 		$myResponse->status = "failed";

// 		$myResponse->message = "Search cannot be conducted at this time. Please retry.";

// 		return json_encode($myResponse);

// 	}

// }

