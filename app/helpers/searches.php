<?php




function makeSearches()

{

	

	$myResponse = new Response();

	try {

		$query = $_POST['query'];


		$matches = $res['matches'];


		$total = $res['total_found'];
		
	

		$myResponse->status = "success";

		if ($matches) {

			$myResponse->message = "Results found";

			$myResponse->data = $query;

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




