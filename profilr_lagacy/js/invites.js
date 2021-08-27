var invites = invites || {};

invites.ready = function () {
    $("#file").change(function () {

        var file = this.files[0];
        var imagefile = file.type;
        var match = ["text/csv"];
        if (!(imagefile == match[0])) {
            //$('#previewing').attr('src','../resources/pics/profile-placeholder.png');
            alert("Only csv file type allowed");
            $("#file").val("");
            return false;
        }
    });

    $("#upload_csv").on('submit', (function (e) {
        e.preventDefault();
        if ($('#file').get(0).files.length === 0) {
            alert("Please select a file to proceed");
            return false;
        }

        // $("#message").empty();
        // $('#loading').show();
        $.ajax({
            url: "../helpers/loader.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,        // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                // $('#loading').hide();
                // $("#message").html(data);
                alert(data.message);
                if (data.status.trim() == "success") {
                    $("#file").val("");
                    $("#csv_modal").modal("hide");
                }
            }
        });
    }));


    $("#csv_btn").on("click", function () {
        $("#csv_modal").modal({
            closable: false,
            onApprove: function ($element) {
                invites.sendCSV();
                return false;
            }
        }).modal("show");

    });
    $("#manual_btn").on("click", function (e) {
        e.preventDefault();
        if ($("#manual_emails").val() == "") {
            alert("Email field cannot be black");
            return;
        }
        invites.sendManual();
    });
    if ($("#confirmGmail").text() == "1") {
        if ($("#gmail_modal_description").text().trim() == "No Contacts found") {
            $("#modal_invite_btn").hide();
        }
        $("#gmail_modal").modal({
            closable: false,
            onApprove: function () {
                return false;
            },
            onHide: function ($element) {
                $("#confirmGmail").text() == "0";
                $("[data-type='sent']").trigger("click");
            }
        }).modal("show");

    } else {
        $("[data-type='sent']").trigger("click");
    }

    $(".invites_link").on("click", function () {
        $(".invites_link").removeClass("active");
        $(this).addClass("active");
        $(".invites_segment").hide();
        var type = $(this).data("type");
        $("#" + type + "_invites").show();
        if (type == "sent") {
            invites.sentInvites();
        }

    });
    $("#gmail_btn").on("click", function () {
        invites.getOAuth();
    });

    $("#modal_invite_btn").on("click", function () {
        invites.sendGmail();

    });
}

invites.getOAuth = function () {
    var data = {"oauth": ""};
    sendRequest.postJSON(data, "../helpers/gmailpeople.php", function (response) {
    });
    $.redirect("../helpers/gmailpeople.php", data, "get");

}


invites.sentInvites = function () {
    var data = {
        "function": "sentInvites"
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        var table = "";
        if (response.status == "success" && response.data) {
            table += "<table class='ui  striped table'> <thead> <tr> <th>#</th><th>SENT TO</th> <th>DATE SENT</th> </tr> </thead> <tbody>";
            $.each(response.data, function (v, k) {
                table += "<tr><td>" + (v + 1) + "</td><td>" + k.sent_to + "</td><td>" + k.date_sent + "</td></tr>";
            });
            table += "</tbody></table>";
        }
        if (table == "") {
            $("#sent_invites").html("<p>No record found</p>");
        } else {
            $("#sent_invites").html(table);
        }
    });

}


invites.sendManual = function () {
    var data = {
        "function": "sendManual",
        "emails": $("#manual_emails").val()
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        alert(response.message);
        if (response.status == "success") {
            $("#manual_emails").val("");
        }
    });
}

invites.sendCSV = function () {
    $("#upload_csv").trigger("submit");
}


invites.sendGmail = function () {
    var emails = "";
    $("#contacts_tbody").find("input:checked").each(function () {
        emails += $(this).parent().next().text() + ",";
    });
    //alert(emails);
    var data = {
        "function": "sendManual",
        "emails": emails
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        alert(response.message);
        if (response.status == "success") {
            $("#gmail_modal").modal("hide");
            $("#confirmGmail").text("0");
        }
    });

}
invites.ready();

if ($("#confirmGmail").text() == "0") {
    $("[data-type='sent']").trigger("click");
}