var emails = emails || {};

emails.ready = function () {
    $(".upgrade").hide();
    $("select").dropdown();
    $(".admin_segment").show();

    emails.fetchEmailTemplate();

    $(".admin_link").on("click", function () {
        $(".admin_link").removeClass('active');
        $(this).addClass("active");
        var type = $(this).data("type");
        $(".admin_segment").hide();
        $("#" + type + "_segment").show();
        // console.log(type);
        switch (type) {
            case "created":
                emails.fetchEmailTemplate();
                break;

            case "saved":
                emails.fetchSavedEmailTemplates();
                break;
            default:
                break;
        }
    });


    $("#email_form").submit(function (event) {
        emails.sendEmails();
        event.preventDefault();
    });

    $('#save_email').on('click', function () {
        emails.saveEmails();

    });

    $("#template_content").change(function () {
        // // console.log('template_content');
        if($("#template_content").val() != 0){
            var data = {
                "function": "fetchEmailTemplate",
                "template_id": $("#template_content").val()
            };
            sendRequest.postJSON(data, "controller/app.php", function (response) {
                if (response.status === "failed") {
                    alert(response.message);
                } else {
                    // // console.log(response);
                    // $.redirect("emails");
                    $("#subject").val(response.data[0].subject);
                    // $("#message").val(response.data[0].body_text);
                    $('#message').trumbowyg('html', response.data[0].body_text);
                    // $.get(response.data[0].body_text);
                    // var html = response.data[0].body_text;
                }
            });
        }else{
            $("#subject").val('');
            $('#message').trumbowyg('html', '');
        }
    });
};

emails.saveEmails = function () {
    // alert("login");
    // return;
    var data = {
        "function": "saveAdminEmails",
        "subject": $("#subject").val(),
        "test_email": $("#test_email").val(),
        "message": $("#message").val(),
        "template_content": $("#template_content").val(),
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        alert(response.message);
        //
        // if (response.status === "failed") {
        //     alert(response.message);
        // } else {
        //     // console.log(response);
            $.redirect("emails");
        // }
    });
};

emails.sendEmails = function () {
    // alert("login");
    // return;
    var data = {
        "function": "sendAdminEmails",
        "subject": $("#subject").val(),
        "message": $("#message").val(),
        "template_content": $("#template_content").val(),
        "test_email": $("#test_email").val(),

        "user_group": $("#user_group").val(),
        "email_verify": $("#email_verify").val(),
        "country": $("#country").val(),
        "min_profile_views": $("#min_profile_views").val(),
        "max_profile_views": $("#max_profile_views").val()
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        if (response.status === "failed") {
            alert(response.message);
        } else {
            // console.log(response);
            $.redirect("emails");
        }
    });
};

emails.fetchSavedEmailTemplates = function() {
    var data = {
        "function": "getEmailTemplates"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        var strMsg = '';

        if (response.status === "success") {
            if (response.data.length) {

                strMsg += "<table class='ui striped table report_data_table'> <thead> <tr> <th>#</th><th>SUBJECT</th> <th>ACTION</th></tr> </thead> <tbody>";

                $.each(response.data, function (v, k) {

                    var del= '<a href="#" class="pull-right" email_id="' + k.id + '" title="remove"  onclick="return confirm(\'Are you sure, you want to remove ' + k.subject + '\') ? emails.removeEmail(this): \'\' "><i class="fa fa-trash"></i></a>';

                    console.log(del);
                    strMsg += '<tr><td>' + (v + 1) + '</td><td>' + k.subject + '</td>' +
                        '<td>' +
                        '<a href="#" class="pull-right" email_id="' + k.id + '" title="remove"  onclick="return confirm(\'Are you sure, you want to remove ' + k.subject + '\') ? emails.removeEmail(this): \'\' "><button class="ui button negative">delete</button></a>' +
                        '</td>' +
                        '</tr>';
                });

                strMsg += "</tbody></table>";

            } else {
                strMsg = "<p>" + response.message + "</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }
        $("#saved_content").html(strMsg);
        // bind view
        $(".blog_link").on("click", function () {
            emails.viewBlog(this);
        });

    });
}

emails.removeEmail = function (gift) {
    var email_id = $(gift).attr('email_id');

    var data = {
        "function": "removeEmail",
        "email_id": email_id
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        emails.fetchSavedEmailTemplates();
    });
};

emails.fetchEmailTemplate = function () {
    var data = {
        "function": "getEmailTemplates"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        var strMsg = "<option value='0'>No Template</option>";
        if (response.status === "success") {
            if (response.data.length) {
                $.each(response.data, function (v, k) {
                    strMsg += "<option value='"+k.id+"'>"+k.subject+"</option>";
                });
            } else {
                strMsg = "<option></option>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }
        $("#template_content").html(strMsg);
        // bind view
        $(".blog_link").on("click", function () {
            emails.viewBlog(this);
        });

    });
};

emails.ready();