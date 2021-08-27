

var invites = invites || {};

(function () {
    this.onReady = function () {
        $("#resend_btn").on("click",function(){
            var data = {"function":"resendInvites"};
            sendRequest.postJSON(data,"controller/app.php",function(response){
                // alert(response.message);
                console.log(response);
                swal("Good job!",response.message, "success");
            });
        });
        $('#connect_tab .item').tab();
        $('select').dropdown();
        $("#file").change(function () {

            var file = this.files[0];
            var imagefile = file.type;
            //alert(imagefile);return;
            var match = ["application/vnd.ms-excel","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];
            if (!(imagefile === match[0]) && !(imagefile === match[1])) {
                //$('#previewing').attr('src','assets/resources/pics/profile-placeholder.png');
                // alert("Only excel files allowed");
                swal("Oops!","Only excel files allowed", "error");
                $("#file").val("");
                return false;
            }
        });

        $("#upload_csv").on('submit', (function (e) {
            e.preventDefault();
            if ($('#file').get(0).files.length === 0) {
                // alert("Please select a file to proceed");
                swal("Alert!","Please select a file to proceed","warning")
                return false;
            }

            // $("#message").empty();
            // $('#loading').show();
                NProgress.start();
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
                    NProgress.done();
                }
                
            });
            NProgress.done();
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
                // alert("Email field cannot be black");
                swal("Alert!","Email field cannot be black", "warning");
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
                invites.fetchresendInvites();
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
            // invites.getOAuth();
            $("#gmail_modal").modal({
                closable: false,
                onApprove: function () {
                    return false;
                },
                onHide: function ($element) {
                    $("#confirmGmail").text() === "0";
                    $("[data-type='sent']").trigger("click");
                },
                onShow: invites.gmailAuth(),
            }).modal("show");
            
        });

        $("#modal_invite_btn").on("click", function () {
            invites.sendGmail();

        });
    };
    
    invites.gmailAuth = function(){
        var config = {
	      'client_id': '515443319156-n5t3rrjpktvq7nrb8laihml0griel2p6.apps.googleusercontent.com',
	      'scope': 'https://www.google.com/m8/feeds'
	    };
	    gapi.auth.authorize(config, function() {
	      invites.gmailFetch(gapi.auth.getToken());  
	     
	    });
    };
    
    invites.gmailFetch = function(token){
        $.ajax({
		    url: "https://www.google.com/m8/feeds/contacts/default/full?access_token=" + token.access_token + "&alt=json",
		    dataType: "json",
		    success:function(data) {
		        //alert(JSON.stringify(data));
                // display all your data in console
		      //console.log(JSON.stringify(data));
		      //console.log(JSON.stringify(data.feed.entry));
		      if(!data.feed.entry){
		          $("#gmail_modal_description").html("No Gmail Contact found in your address book");
		      }else{
		          str = "";
		          $.each(data.feed.entry, function (v, k) {
		              //if(typeof k['gd$email'][0]['address'] !== "undefined" && k['gd$email'][0]['address'] !== null){
		              try{
		                str += "<tr><td><input type='checkbox' value=''></td><td>" + k['gd$email'][0]['address'] + "</td><td>" + k.title.$t + "</td></tr>";
		              }catch(err){}
		              //}
		          });
		          str = "<table class='ui celled striped table'><thead><tr><th></th><th>Email Address</th><th>Name</th></tr></thead><tbody id='contacts_tbody'>"+str+"</tbody></table>";
		          $("#gmail_modal_description").html(str);
		          //console.log(str);
		      }
		    }
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
            // console.log(k.online_status);
            if(!k.position || !k.company){
                strPos = "Not Available";
            }else{
                strPos = k.position+" at "+k.company;
            }
            
            var dateString = k.last_seen;
dateString = new Date(dateString).toUTCString();
dateString = dateString.split(' ').slice(0, 4).join(' ');
// console.log(dateString);
            
            if(k.online_status == 1){
                strBuff += "<tr><td><img class='ui avatar image' src='assets/resources/pics/" + k.photo + "'><img src='https://img.icons8.com/color/48/000000/id-verified.png' style='width: 16px; height:16px; position: relative; top: -15px;left:10px; right:0px;bottom:0px;'></td><td>" + k.firstname + " " + k.lastname + "</td><td>"+strPos+"</td><td><a onclick='invites.redirectProfile(this)' style='text-decoration:underline;' class='others_detail' data-account='" + k.id + "'>View</a></td></tr>";
            }
            else{
                strBuff += "<tr><td><img class='ui avatar image' src='assets/resources/pics/" + k.photo + "'><img src='https://img.icons8.com/color/48/000000/id-not-verified.png' style='width: 16px; height:16px; position: relative; top: -15px;left:10px; right:0px;bottom:0px;'><br><span style='color: #9d9d9d'>Last seen: <br>"+dateString+"</span></td><td>" + k.firstname + " " + k.lastname + "</td><td>"+strPos+"</td><td><a onclick='invites.redirectProfile(this)' style='text-decoration:underline;' class='others_detail' data-account='" + k.id + "'>View</a></td></tr>";
            }
            
        });
        strBuff += "</tbody></table>";
        $("#connect_segment").html(strBuff);
    };

    invites.suggestedTemplate = function (data) {
        strBuff = "<table class='ui  striped table'> <thead> <tr><th></th> <th>Full Name</th> <th>In Common</th> <th>Description</th><th></th></tr> </thead> <tbody>";
        $.each(data, function (v, k) {
            
            console.log(data.length);
            
            var dateString = k.last_seen;
dateString = new Date(dateString).toUTCString();
dateString = dateString.split(' ').slice(0, 4).join(' ');
// console.log(dateString);
            // console.log(k.online_status);
            if(k.online_status == 1){
                strBuff += "<tr><td><img class='ui avatar image' src='assets/resources/pics/" + k.photo + "'><img src='https://img.icons8.com/color/48/000000/id-verified.png' style='width: 16px; height:16px; position: relative; top: 0px;left:-10px; right:0px;bottom:0px;'></td><td>" + k.firstname + " " + k.lastname + "</td><td>" + k.in_common + "</td><td>"+k.position+" at "+k.company+"</td><td><a onclick='invites.redirectProfile(this)' style='text-decoration:underline;' class='others_detail' data-account='" + k.id + "'>View</a></td></tr>";
            }
            else{
                strBuff += "<tr><td><img class='ui avatar image' src='assets/resources/pics/" + k.photo + "'><img src='https://img.icons8.com/color/48/000000/id-not-verified.png' style='width: 16px; height:16px; position: relative; top: 0px;left:-10px; right:0px;bottom:0px;'><br><span style='color: #9d9d9d'>Last seen: <br>"+dateString+"</span></td><td>" + k.firstname + " " + k.lastname + "</td><td>" + k.in_common + "</td><td>"+k.position+" at "+k.company+"</td><td><a onclick='invites.redirectProfile(this)' style='text-decoration:underline;' class='others_detail' data-account='" + k.id + "'>View</a></td></tr>";
            }
            
        });
        strBuff += "</tbody></table>";
        $("#connect_segment").html(strBuff);
    };

    invites.redirectProfile = function (gift) {
        $.redirect("member", {id: $(gift).data("account")}, "post");
    };


// Sent Invites
    invites.sentInvites = function () {
        var data = {
            "function": "sentInvites",
            
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            
            // console.log(data);
            
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
    

    
// Pending Invites
    invites.fetchresendInvites = function () {
        var data = {
            "function": "fetchresendInvites"
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            // console.log(data);
            var table = "";
            if (response.status === "success" && response.data) {
                
                table += "<table class='ui  striped table'> <thead> <tr> <th>#</th><th>SENT TO</th> <th>STATUS</th> </tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
                    // console.log(k);
                    table += "<tr><td>" + (v + 1) + "</td><td>" + k.sent_to + "</td><td style='color: red'>Awaiting Registration</td></tr>";
                });
                table += "</tbody></table>";
            }
            
            
            
            if (table === "") {
                $("#pend_invites").html("<p>No record found</p>");
            } else {
                $("#pend_invites").html(table);
            }
        });

    };    
    
    
    

    invites.sendManual = function () {
        var data = {
            "function": "sendManual",
            "emails": $("#manual_emails").val()
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            // alert(response.message);
            
            if (response.status === "success") {
                swal("Good job!",response.message, "success");
                
                $("#manual_emails").val("");
                
            }
            else{
                swal("Oops!",response.message, "warning");
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
        if(emails == ""){
            // alert("Please select contacts to proceed");
            swal("Alert!","Please select contacts to proceed","warning");
            return;
        }
        //alert(emails);
        var data = {
            "function": "sendManual",
            "emails": emails
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            alert(response.message);
            swal("",response.message,"info");
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
$("*[data-type='sent']").trigger("click");
