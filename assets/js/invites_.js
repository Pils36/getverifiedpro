var invites = invites || {};

(function () {
    this.onReady = function () {
        $('#connect_tab .item').tab();

        $("#file").change(function () {

            var file = this.files[0];
            var imagefile = file.type;
            var match = ["text/csv"];
            if (!(imagefile === match[0])) {
                //$('#previewing').attr('src','assets/resources/pics/profile-placeholder.png');
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
                url: "controller/app.php", // Url to which the request is send
                type: "POST",             // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request views to be cached
                processData: false,        // To send DOMDocument or non processed data file it is set to false
                success: function (data)   // A function to be called if request succeeds
                {
                    // $('#loading').hide();
                    // $("#message").html(data);
                    alert(data.message);
                    if (data.status.trim() === "success") {
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
            if ($("#manual_emails").val() === "") {
                alert("Email field cannot be black");
                return;
            }
            invites.sendManual();
        });
        if ($("#confirmGmail").text() === "1") {
            if ($("#gmail_modal_description").text().trim() === "No Contacts found") {
                $("#modal_invite_btn").hide();
            }
            $("#gmail_modal").modal({
                closable: false,
                onApprove: function () {
                    return false;
                },
                onHide: function ($element) {
                    $("#confirmGmail").text() === "0";
                    $("[data-type='sent']").trigger("click");
                }
            }).modal("show");

        } else {
            $("[data-type='sent']").trigger("click");
        }

        $(".invite_link").on("click", function () {
            $(".invite_link").removeClass("active");
            $(this).addClass("active");
            $(".invites_segment").hide();
            var type = $(this).data("type");
            $("#" + type + "_invites").show();
            if (type === "sent") {
                invites.sentInvites();
            }
        });

        $(".connect_link").on("click", function () {
            // $("#connect_segment").html("<p></p>");
            $(".connect_link").removeClass("active");
            $(this).addClass("active");
            invites.connections($(this).data("type"));
        });

        $("#connect_btn").on("click", function () {
            $("#connected_tab").trigger("click");
        });


        $("#gmail_btn").on("click", function () {
            invites.getOAuth();
        });

        $("#modal_invite_btn").on("click", function () {
            invites.sendGmail();

        });
    };

    invites.getOAuth = function () {
        // var data = {
        //     "oauth": "",
        //     // "function" : "getGmailConnections"
        // };
        // $.redirect("controller/app.php", data, "get");
        var data = {"oauth": ""};
        sendRequest.postJSON(data, "gmailpeople", function (response) {});
        $.redirect("gmailpeople", data, "get");

    };

    invites.connections = function (type) {

        data = {
            "function": "fetchConnections",
            "type": type
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            if (response.status === "success") {
                if (response.data.length) {
                    switch (type) {
                        case "connected":
                            invites.connectedTemplate(response.data);
                            break;
                        case "suggested":
                            invites.suggestedTemplate(response.data);
                            break;
                        default:
                            break;
                    }

                } else {
                    $("#connect_segment").html("<p>No record found</p>");
                }

            } else {
                //fetch failed
                $("#connect_segment").html("<p>Problem encounter while fetching records. Please refresh page.</p>");
            }
        });
    };
    
    invites.connectedTemplate = function (data) {
        strPos = "";

        strBuff = "<table class='ui  striped table'> <thead> <tr><th></th> <th>Full Name</th> <th>Description</th><th></th></tr> </thead> <tbody>";
        $.each(data, function (v, k) {
            if(!k.position || !k.company){
                strPos = "Not Available";
            }else{
                strPos = k.position+" at "+k.company;
            }
            strBuff += "<tr><td><img class='ui avatar image' src='assets/resources/pics/" + k.photo + "'></td><td>" + k.firstname + " " + k.lastname + "</td><td>"+strPos+"</td><td><a onclick='invites.redirectProfile(this)' style='text-decoration:underline;' class='others_detail' data-account='" + k.id + "'>View</a></td></tr>";
        });
        strBuff += "</tbody></table>";
        $("#connect_segment").html(strBuff);
    };

    invites.suggestedTemplate = function (data) {
        strBuff = "<table class='ui  striped table'> <thead> <tr><th></th> <th>Full Name</th> <th>In Common</th> <th>Description</th><th></th></tr> </thead> <tbody>";
        $.each(data, function (v, k) {
            strBuff += "<tr><td><img class='ui avatar image' src='assets/resources/pics/" + k.photo + "'></td><td>" + k.firstname + " " + k.lastname + "</td><td>" + k.in_common + "</td><td>"+k.position+" at "+k.company+"</td><td><a onclick='invites.redirectProfile(this)' style='text-decoration:underline;' class='others_detail' data-account='" + k.id + "'>View</a></td></tr>";
        });
        strBuff += "</tbody></table>";
        $("#connect_segment").html(strBuff);
    };

    invites.redirectProfile = function (gift) {
        $.redirect("member", {id: $(gift).data("account")}, "post");
    };

    invites.sentInvites = function () {
        var data = {
            "function": "sentInvites"
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            var table = "";
            if (response.status === "success" && response.data) {
                table += "<table class='ui  striped table'> <thead> <tr> <th>#</th><th>SENT TO</th> <th>DATE SENT</th> </tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
                    table += "<tr><td>" + (v + 1) + "</td><td>" + k.sent_to + "</td><td>" + k.date_sent + "</td></tr>";
                });
                table += "</tbody></table>";
            }
            if (table === "") {
                $("#sent_invites").html("<p>No record found</p>");
            } else {
                $("#sent_invites").html(table);
            }
        });

    };

    invites.sendManual = function () {
        var data = {
            "function": "sendManual",
            "emails": $("#manual_emails").val()
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            alert(response.message);
            if (response.status === "success") {
                $("#manual_emails").val("");
            }
        });
    };

    invites.sendCSV = function () {
        $("#upload_csv").trigger("submit");
    };

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
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            alert(response.message);
            if (response.status === "success") {
                $("#gmail_modal").modal("hide");
                $("#confirmGmail").text("0");
            }
        });

    };

    if ($("#confirmGmail").text() === "0") {
        $("[data-type='sent']").trigger("click");
    }
}).apply(invites);

invites.onReady();
