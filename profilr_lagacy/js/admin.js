var admin = admin || {};

admin.ready = function () {
    $(".upgrade").hide();
    $("select").dropdown();

    $("#blog_update_btn").on("click", function () {
        admin.updateBlog(this);
    });
    $("#blog_status").dropdown();
    $("#blog_form_content").html('');
    $("#new_blog_btn").on("click", function () {
        $("#blog_update_btn").hide();
        $("#blog_add_btn").show();
        $("#blog_modal").modal({
            closable: false,
            onHidden: function () {
                $("#blog_status").val('');
                $("#blog_subject").val('');
                $("#blog_form_content").html('');
                $("*[data-type='blogs']").trigger("click");
            },
            onApprove: function () {
                admin.newBlog();
                return false;
            }
        }).modal("show");
    });
    $("#login_form").submit(function (event) {
        admin.login();
        event.preventDefault();
    });

    $(".admin_link").on("click", function () {
        $(".admin_link").removeClass('active');
        $(this).addClass("active");
        var type = $(this).data("type");
        $(".admin_segment").hide();
        $("#" + type + "_segment").show();
        switch (type) {
            case "blogs":
                admin.fetchBlogs();
                break;
            case "members":
                admin.fetchMembers();
                break;
            case "subscriptions":
                admin.fetchSubcriptions();
                break;
            default:
                break;
        }

    });

    admin.fetchBlogs();
}


admin.login = function () {
    // alert("login");
    // return;
    var data = {
        "function": "adminLogin",
        "username": $("#login_email").val(),
        "password": $("#login_password").val()
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        if (response.status == "failed") {
            alert(response.message);

        } else {
            $.redirect("admin.php");
        }
    });
}


admin.fetchBlogs = function () {
    var data = {
        "function": "getBlogs"
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        var strMsg = ""
        if (response.status == "success") {
            if (response.data.length) {
                strMsg += "<table class='ui  striped table'> <thead> <tr> <th>#</th><th>DATE POSTED</th> <th>TITLE</th> <th>STATUS</th><th></th></tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
                    strMsg += "<tr><td>" + (v + 1) + "</td><td>" + k.date_posted + "</td><td>" + k.title + "</td><td>" + k.status + "</td><td><a href='#' class='blog_link' data-id='" + k.id + "'>view</a></td></tr>";
                });
                strMsg += "</tbody></table>";
            } else {
                strMsg = "<p>No blog post found</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }
        $("#blog_content").html(strMsg);
        // bind view
        $(".blog_link").on("click", function () {
            admin.viewBlog(this);
            ;
        });

    });
}


admin.fetchMembers = function () {
    var data = {
        "function": "getMembers"
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        var strMsg = ""
        if (response.status == "success") {
            if (response.data.length) {
                strMsg += "<table class='ui  striped table'> <thead> <tr> <th>#</th><th>FIRST NAME</th> <th>LAST NAME</th> <th>COUNTRY</th><th>EMAIL</th><th>SIGNUP DATE</th><th></th><th></th></tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
                    strMsg += "<tr><td>" + (v + 1) + "</td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.country + "</td><td>" + k.email + "</td><td>" + k.date_created + "</td><td><a href='#' class='member_link  interest_ref' data-id='" + k.no + "'>View Profile</a></td><td><a href='#' data-id='" + k.no + "' class='subscription_link'>Add Subscription</a></td></tr>";
                });
                strMsg += "</tbody></table>";
            } else {
                strMsg = "<p>No blog post found</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }
        $("#members_content").html(strMsg);
        $(".interest_ref").on("click", function () {
            admin.viewMember($(this));
        });
        $(".subscription_link").on("click", function () {
            var firstname = $(this).parent().prev().prev().prev().prev().prev().prev().text();
            var lastname = $(this).parent().prev().prev().prev().prev().prev().text();
            var email = $(this).parent().prev().prev().prev().text();
            $("#subscription_modal_header").text("New Subscription for " + firstname + " " + lastname);
            $("#email_addy").val(email);
            $("#member").val($(this).data("id"));
            admin.addSubscription();
        });
    });
}

admin.viewMember = function (el) {
    // alert($(el).data("id"));
    // redirect to member page
    $.redirect("../pages/member.php", {id: $(el).data("id")}, "post", "_blank");
}

admin.addSubscription = function () {
    $("#subscription_modal").modal({
        closable: false,
        onApprove: function () {
            admin.proccessSub();
            return false;
        }
    }).modal("show");
}

admin.fetchSubcriptions = function () {
    var data = {
        "function": "getSubscriptions"
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        var strMsg = ""
        if (response.status == "success") {
            if (response.data.length) {
                strMsg += "<table class='ui  striped table'> <thead> <tr> <th>#</th><th>FIRST NAME</th> <th>LAST NAME</th> <th>EMAIL</th><th>SUBSCRIPTION DATE</th><th>STATUS</th></tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
                    strMsg += "<tr><td>" + (v + 1) + "</td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.email + "</td><td>" + k.subscription_date + "</td><td>" + k.status + "</td></tr>";
                });
                strMsg += "</tbody></table>";
            } else {
                strMsg = "<p>No blog post found</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }
        $("#subscriptions_content").html(strMsg);
    });

}

admin.newBlog = function () {
    var data = {
        "function": "newBlog",
        "status": $("#blog_status").val(),
        "title": $("#blog_subject").val(),
        "content": $("#blog_form_content").html()
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        alert(response.message);
        if (response.status == "success") {
            $("#blog_modal").modal("hide");

        }
    });
}

admin.viewBlog = function (el) {
    //alert($(el).data("id"));
    var data = {
        "function": "viewBlog",
        "id": $(el).data("id")
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        if (response.status == "success") {
            $("#blog_form").find("#blog_status").val(response.data.status).change();
            $("#blog_form").find("#blog_subject").val(response.data.title).change();
            $("#blog_form_content").html(response.data.content);
            $("#blog_update_btn").data("id", response.data.id);
            $("#blog_add_btn").hide();
            $("#blog_update_btn").show();
            $("#blog_modal").modal({
                closable: false
            }).modal("show");
        }

    });
}

admin.updateBlog = function ($el) {
    var data = {
        "function": "updateBlog",
        "status": $("#blog_status").val(),
        "title": $("#blog_subject").val(),
        "content": $("#blog_form_content").html(),
        "id": $($el).data("id")
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        alert(response.message);
    });
}


admin.proccessSub = function () {
    var data = {
        "function": "newSubscription",
        "plan": $("#subscription_plan").val(),
        "member": $("#member").val()
    }

    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        alert(response.message);
    });
}

admin.ready();