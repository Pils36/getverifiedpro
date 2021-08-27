<?php

$curl = curl_init();
// Set some options - we are passing in a useragent too here
// $dataArray->execid = 'PRO_COLAB15461551430871';
// $dataArray->position = 'null'; 
// $dataArray->location = 'null';
// $dataArray->company = 'Professional\'s File Inc'; 
// $dataArray->award = 'null';
// $dataArray->frommonth = 'January';
// $dataArray->fromyear = '2019';
// $dataArray->tomonth = 'January'; 
// $dataArray->toyear = '2019';
// $dataArray->description = 'null'; 
// $dataArray->specialisation = 'null';

// $myRes = json_encode($dataArray);

// $dataArray = json_decode(["id":2,"execid":"PRO_COLAB15461551430871","position":null,"location":null,"company":"Professional's File Inc","award":null,"frommonth":"January","tomonth":"January","fromyear":2019,"toyear":2019,"description":null,"specialisation":null,"publish":0,"created_at":"2019-03-01 11:28:50","updated_at":"2019-03-01 11:28:50"]);
// $dataArray['frommonth'] = 1;
    
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://www.pro-filr.com/crons/prompt.php?a=1&b=2',
    CURLOPT_USERAGENT => 'Profilr cURL Request',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => array(
        execid => 'PRO_COLAB15461551430871',
        // experience => $myRes,
        action => 'getThisOpportunity',
        user => 'adenugaadebambo41@gmail.com',
        industry => 'Information Technology and Services',
        desc => 'Sync user from pro-exec',
        hash => 'profilrexecreq2019_rec',
        // hash => 'aab722da21be7ad07a3b72eede4a9e9a',
        search => '',
        searchcity => '',
        profession => 'Technology, IT',
    )
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);


print_r($resp);

// $curl = curl_init();

// curl_setopt_array($curl, array(
// CURLOPT_URL => "https://www.pro-filr.com/crons/prompt.php?a=1&b=yuyyy",
// CURLOPT_RETURNTRANSFER => true,
// CURLOPT_ENCODING => "",
// CURLOPT_TIMEOUT => 30000,
// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// CURLOPT_CUSTOMREQUEST => "POST",
//     CURLOPT_POST => 1,
//     CURLOPT_POSTFIELDS => array(
//         item1 => 'value',
//         item2 => 'value2'
//     ),
// CURLOPT_HTTPHEADER => array(
// // Set Here Your Requesred Headers
// 'Content-Type: application/json',
// ),
// ));
// $response = curl_exec($curl);
// $err = curl_error($curl);
// curl_close($curl);

// if ($err) {
// echo "cURL Error #:" . $err;
// } else {
// print_r($response);
// }



?>