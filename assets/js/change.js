var change = {} || change;
change.ready = function () {
    $("#search_bar").hide();
};

$("#change_btn").on("click", function () {
    var data = {
        "function": "changePassword",
        "current": $("#current").val(),
        "new": $("#new").val(),
        "confirm": $("#confirm").val()
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        alert(response.message);
        if (response.status === "success") {
            $("#current").val("");
            $("#new").val("");
            $("#confirm").val("");
        }
    });
});

change.ready();