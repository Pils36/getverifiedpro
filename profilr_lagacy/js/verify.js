$(document).ready(function () {
    myApp.onReady();
    $query = window.location.search;
    $link = $query.split("=")[1];
    //alert($link);
    var data = {
        "function": "verifyEmail",
        "link": $link
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        //parse = JSON.parse(response);
        parse = response;
        $("#verify_response").html(parse.data.response)
    });

    //

    //sendRequest.fetchData()
});