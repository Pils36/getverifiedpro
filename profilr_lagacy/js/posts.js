var post = post || {};


post.ready = function () {
    $("#search_bar").hide();
    $('#posts_tab .item').tab();
    $(".post_link").on("click", function () {
        $("#post_segment").html("<p></p>");
        $(".post_link").removeClass("active");
        $(this).addClass("active");
        post.posts($(this).data("type"));
    });

    $(".msg_link").on("click", function () {
        $("#post_segment").html("<p></p>");
        $(".msg_link").removeClass("active");
        $(this).addClass("active");
        post.messages($(this).data("type"));
    });

    $("#msg_btn").on("click", function () {
        $("#inbox_tab").trigger("click");
    });

    //trigger other postsf
    $("[data-type='others']").trigger("click");
}

post.posts = function (type, pageno=1) {
    data = {
        "function": "fetchPosts",
        "type": type,
        "pageno": pageno
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        if (response.status == "success") {
            if (response.data.length) {
                switch (type) {
                    case "mine":
                        post.mineTemplate(response.data);
                        break;
                    case "others":
                        post.othersTemplate(response.data);
                        break;
                    case "interests":
                        post.interestsTemplate(response.data);
                        break;
                    default:
                        break;
                }

            } else {
                $("#post_segment").html("<p>No record found</p>");
            }

        } else {
            //fetch failed
            $("#post_segment").html("<p>Problem encounter while fetching records. Please refresh page.</p>");
        }
    });
}


post.mineTemplate = function (data) {
    strBuff = "<table class='ui  striped table'> <thead> <tr> <th>Subject</th> <th>Description</th> <th>Location</th> <th>Posted on</th> <th>Deadline</th> <th>Status</th> <th>Interest(s)</th> <th></th><th></th> </tr> </thead> <tbody>";
    var strPub = "";
    $.each(data, function (v, k) {
        if (k.pub_status == "published") {
            strPub = "<td><a href='#' class='mine_pub' data-id='" + k.id + "'>Unpublish</a></td>";
        } else {
            strPub = "<td><a href='#' class='mine_pub' data-id='" + k.id + "'>publish</a></td>";
        }
        strBuff += "<tr><td>" + k.subject + "</td><td>" + k.description + "</td><td>" + k.location + "</td><td>" + k.date_added + "</td><td>" + k.deadline + "</td><td>" + k.status + "</td><td class='center aligned'><a href='#' class='mine_interest' data-id='" + k.id + "'>" + k.interests + "</a></td>" + strPub + "<td><a href='#' class='mine_edit' data-pub='" + k.pub_status + "' data-id='" + k.id + "'>Edit</a></td></tr>";
    });
    strBuff += "</tbody></table>";
    $("#post_segment").html(strBuff);
    $(".mine_interest").on("click", function () {
        post.mineInterest($(this));
    });

    $(".mine_edit").on("click", function () {
        post.mineEdit($(this));
    });

    $(".mine_pub").on("click", function () {
        post.minePub($(this));
    });
}


post.othersTemplate = function (data) {
    strBuff = "<table class='ui  striped table'> <thead> <tr> <th>Subject</th> <th>Description</th> <th>Location</th> <th>Posted on</th> <th>Deadline</th> <th>Status</th><th></th> </tr> </thead> <tbody>";
    $.each(data, function (v, k) {
        strBuff += "<tr><td>" + k.subject + "</td><td>" + k.description + "</td><td>" + k.location + "</td><td>" + k.date_added + "</td><td>" + k.deadline + "</td><td>" + k.status + "</td><td><a href='#' style='text-decoration:underline;' class='others_detail' data-id='" + k.id + "'>Details</a></td></tr>";
    });
    strBuff += "</tbody></table>";
    $("#post_segment").html(strBuff);
    $(".others_detail").on("click", function () {
        post.othersDetail($(this));
    });
}


post.interestsTemplate = function (data) {
    strBuff = "<table class='ui  striped table'> <thead> <tr> <th>Subject</th> <th>Description</th> <th>Location</th> <th>Posted on</th> <th>Deadline</th> <th>Status</th><th></th> </tr> </thead> <tbody>";
    $.each(data, function (v, k) {
        strBuff += "<tr><td>" + k.subject + "</td><td>" + k.description + "</td><td>" + k.location + "</td><td>" + k.date_added + "</td><td>" + k.deadline + "</td><td>" + k.status + "</td><td><a href='#' style='text-decoration:underline;' class='interest_detail' data-id='" + k.id + "'>Details</a></td></tr>";
    });
    strBuff += "</tbody></table>";
    $("#post_segment").html(strBuff);
    //bind links
    $(".interest_detail").on("click", function () {
        post.interestDetail($(this));
    });


}


post.minePub = function (el) {
    var data = {
        "status": $(el).text().toLowerCase(),
        "function": "pubStatus",
        "id": $(el).data("id")
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        alert(response.message);
        if (response.status == "success") {
            $("[data-type='mine']").trigger("click");
        }
    });
}

post.interestDetail = function (el) {
    //alert($(el).data("id"));
    post.othersDetail(el);
    $("#save_btn_int").hide();
}


post.othersDetail = function (el) {
    //alert($(el).data("id"));
    data = {
        "post_id": $(el).data("id"),
        "function": "othersQualify",
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        if (response.status == "failed") {
            $("#message_content").html("<h5 class='ui red header'>" + response.message + "</h5>");
            $("#message_modal").modal("show");
            return;
        } else {
            var str = "<div class='ui vertical grid segment'> <div class='ui four column row'><div class='ui column'><span class='bold'>Date Posted: </span>" + response.data.date_added + "</div><div class='ui column'><span class='bold'>Posted By: </span>" + response.data.owner + ", " + response.data.owner_country + "</div><div class='ui column'><span class='bold'>Location: </span>" + response.data.location + "</div><div class='ui column'><span class='bold'>Deadline: </span>" + response.data.deadline + "</div></div> </div> <div class='ui vertical grid segment'> <div class='ui two column row'><div class='ui column'><span class='bold'>Industry: </span>" + response.data.industry + "</div><div class='ui column'><span class='bold'>Specialisation: </span>" + response.data.specialisation + "</div></div> </div><div class='ui vertical grid segment'> <div class='ui one column row'><div class='ui column'><span class='bold'>Subject: </span>" + response.data.subject + "</div></div> </div> <div class='ui vertical segment'> <div class='ui horizontal segments'> <div class='ui segment'> <h5 class='ui header bold'>Description</h5><p>" + response.data.description + "</p> </div> <div class='ui segment'> <h5 class='ui header bold'>Requirement(s)</h5><p>" + response.data.requirement + "</p> </div> </div> </div>";

            $("#details_description").html(str);
            $("#save_btn_int").data("post_id", $(el).data("id"));
            $("#content_modal").modal({
                closable: false,
                onApprove: function (el) {
                    //myProfile.delete(btn);
                    post.interested();
                }
            }).modal("show");
        }

    });
}

post.interested = function () {
    var postId = $("#save_btn_int").data("post_id");
    var data = {
        "post_id": $("#save_btn_int").data("post_id"),
        "function": "postInterest"
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        alert(response.message);
        if (response.status == "success") {
            $("#content_modal").modal("hide");
            $("a.others_detail[data-id='" + postId + "']").closest("tr").remove();

        }
    });
}

post.mineEdit = function (el) {
    if ($(el).data("pub") == "published") {
        alert("Published posts cannot be edited");
        return;
    }
    var data = {
        "function": "editRecord",
        "content": "opportunity",
        "ref": $(el).data("id")
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        var response = response;
        var page = "opportunity";
        var header = "Edit Post";
        var buffer = "";
        //show modal
        $("#post_modal_header").html("");
        $("#post_modal_description").html("");
        $("#post_modal_header").html(header);
        data = {
            "function": "fetchIndustries"
        };
        sendRequest.postJSON(data, "../helpers/loader.php", function (response2) {
            var parse = response2;
            $.each(parse.data, function (v, k) {
                buffer += "<option value='" + k.industry + "'>" + k.industry + "</option>";
            });
            var content = "../modals/" + page + ".html";
            $("#post_modal_description").load(content, function () {
                //var buffer=buffer2="<option value=''></option>";
                $("#post_modal").modal({
                    closable: false,
                    onApprove: function (elem) {
                        return false;
                    },
                    onVisible: function (elem) {
                        $("#industry").html(buffer);
                        $.each(response.data.rows, function (v, k) {

                            if (v == "id") {
                                $("form").prepend("<input type='hidden' id = '" + v + "' name='" + v + "' value='" + k + "'>");
                            } else {

                                $("form").find("#" + v).val(k).change();
                            }
                        });
                    }
                }).modal("show");
                $('select').dropdown();
            });
        });


    });
}


post.mineInterest = function (el) {
    // alert($(el).data("id"));
    // alert("laloye");
    if ($(el).text() == "0") {
        alert("No interest has been indicated for this post");
        return;
    }
    var data = {
        "function": "getInterestList",
        "id": $(el).data("id")
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        if (response.status == "success") {

            $("#interest_modal").modal({
                closable: false,
                onApprove: function (elem) {
                    return false;
                },
                onVisible: function (elem) {
                    var str = "<div class='ui large celled list'>";
                    $.each(response.data, function (v, k) {
                        photo = "../resources/pics/" + k.photo;
                        str += "<div class='item'> <img class='ui avatar image' src='" + photo + "'> <div class='content'> <div class='header'><a href='#' style='text-decoration:underline;' class='interest_ref' data-id='" + k.login_id + "'>" + k.firstname.toUpperCase() + " " + k.lastname.toUpperCase() + "</a></div>Country: " + k.country + " | Profession: " + k.profession + "</div> </div>";


                    });
                    str += "</div>";
                    $("#interest_segment").html(str);
                    $(".interest_ref").on("click", function () {
                        post.viewMember($(this));
                    });
                }
            }).modal("show");
        } else {
            alert(response.message);
        }
    });
}


post.viewMember = function (el) {
    // alert($(el).data("id"));
    // redirect to member page
    $.redirect("member.php", {id: $(el).data("id")}, "post", "_blank");
}

post.messages = function (type) {
    var data = {
        "function": "getMessages",
        "type": type
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        if (response.status == "failed") {
            alert(response.message);
            $("#message_segment").html("<p>No message found</p>");
            return;
        }
        //alert("done");
        var str;
        var inbox = sent = "";
        if (!response.data.length) {
            $("#message_segment").html("<p>No message found</p>");
            return;
        }
        if (type == 'sent') {
            strBuff = "<table class='ui  striped table'> <thead> <tr> <th>Subject</th> <th>Sent to</th> <th>Date Sent</th><th></th> </tr> </thead> <tbody>";
            $.each(response.data, function (v, k) {
                strBuff += "<tr><td>" + k.subject.toUpperCase() + "</td><td><a href='#' class='interest_ref' data-id='" + k.sent_to + "'>" + k.member + "</a></td><td>" + k.date_sent + "</td><td><a href='#' class='read_msg' data-id='" + k.id + "'>read</a></td></tr>";
            });
            strBuff += "</tbody></table>";
        } else {
            strBuff = "<table class='ui  striped table'> <thead> <tr> <th>Subject</th> <th>Sent by</th> <th>Date Sent</th> <th></th<</tr> </thead> <tbody>";
            $.each(response.data, function (v, k) {
                strBuff += "<tr><td>" + k.subject.toUpperCase() + "</td><td><a href='#' class='interest_ref' data-id='" + k.sent_by + "'>" + k.member + "</a></td><td>" + k.date_sent + "</td><td><a href='#' class='read_msg' data-id='" + k.id + "'>read</a></td></tr>";
            });
            strBuff += "</tbody></table>";
        }
        $("#message_segment").html(strBuff);
        $(".interest_ref").on("click", function () {
            post.viewMember($(this));
        });
        $(".read_msg").on("click", function () {
            //alert($(this).data("id"));
            var data = {
                "function": "readMessage",
                "id": $(this).data("id")
            };
            sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
                $("#read_message_modal").modal({
                    closable: false,
                    onVisible: function () {
                        $("#msg_date").text(response.data.date_sent);
                        $("#msg_by").text(response.data.sentBy);
                        $("#msg_to").text(response.data.sentTo);
                        $("#msg_subject").text(response.data.subject);
                        $("#msg_content").text(response.data.content);
                    }
                }).modal("show");
            });

        });
    });

}

// post.messageTemplate(data){
// 		strBuff = "<table class='ui  striped table'> <thead> <tr> <th>From</th> <th>Subject</th> <th>Date</th> <th></th> </tr> </thead> <tbody>";
//  $.each(data,function(v,k){
//  	strBuff +="<tr><td>"+k.subject+"</td><td>"+k.description+"</td><td>"+k.location+"</td><td>"+k.date_added+"</td><td>"+k.deadline+"</td><td>"+k.status+"</td><td><a href='#' style='text-decoration:underline;' class='interest_detail' data-id='"+k.id+"'>Details</a></td></tr>";
//  });
//  strBuff +="</tbody></table>";
//  $("#post_segment").html(strBuff);
//  //bind links
//  $(".interest_detail").on("click",function(){
//  	post.interestDetail($(this));
//  });
// }


post.ready();
