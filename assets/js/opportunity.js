var member = {} || member;
member.ready = function () {

    $("#search_bar").hide();
    $("#msg_btn").on("click", function () {
        member.sendMessage($(this));
    });

    $("#validate_type").on("change", function () {
        // member.validateUser($(this));
        var validate_type = $("#validate_type").val();
        // console.log(validate_type);

        var data = {
            "function": "getValidationItems",
            'table': validate_type,
            "member_id": $("#mem").text()
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            var strItem = "";
            $.each(response.data, function (k, v) {

                strItem += "<option>" + v.item_title + "</option>";
            });
            $("#validate_select").html(strItem);

        });
    });

    $("#validate_btn").on("click", function () {
        member.validateUser($(this));
    });
    $("#group_btn").on("click", function () {
        member.groupUser($(this));
    });


    $("#connect_btn").on("click", function () {
        member.connectUser($(this));
    });

    var data = {
        "member": $("#mem").text(),
        "function": "fetchUserInfo"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        var parse = response;
        var profession = "";
        photo = "assets/resources/pics/" + parse.data.profile[0].photo;
        name = (parse.data.profile[0].lastname + " " + parse.data.profile[0].firstname).toUpperCase();
        if (!parse.data.profile[0].profession || parse.data.profile[0].company) {
            profession = ""
        } else {
            profession = parse.data.profile[0].profession + " at " + parse.data.profile[0].company;
        }
        $("#profile_picture").attr("src", photo);
        $("#profile_name").text(name);

        $("#profile_current_position").text(profession.toUpperCase());
        member.educationTemplate(parse);
        member.certificationTemplate(parse);
        member.experienceTemplate(parse);
        member.affiliationTemplate(parse);
        member.projectTemplate(parse);
        member.companyTemplate(parse);

    });

    var data = {
        "function": "fetchGroups"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        if (response.status === "success") {
            var strPosts = '';
            $.each(response.data, function (k, v) {
                strPosts += "<option value='" + v.id + "'>" + v.title + "</option>";
            });
            strPosts += ' ';
            $("#group_select").html(strPosts);
        }
    });

};

member.educationTemplate = function (parse, dataType="all") {
    //load educational qualifications
    var strItem = strList = "";
    var data;
    if (dataType === "single") {
        data = parse;
    } else {
        data = parse.data.education
    }
    $.each(data, function (v, k) {
        strAward = strDesc = strAct = "";
        if (k.activities) {
            strAct = "<div class='item'> <div class='content'> <a class='header'>Activities and Societies</a> <div class='description'> <p>" + k.activities + "</p> </div> </div> </div>";
        }
        if (k.description) {
            strDesc = "<div class='item'> <div class='content'> <a class='header'>Description</a> <div class='description'> <p>" + k.description + "</p> </div> </div> </div>";
        }
        if (k.award) {
            strAward = "<div class='item'> <div class='content'> <a class='header'>Awards</a> <div class='description'> <p>" + k.award + "</p> </div> </div> </div>";
        }

        strItem += "<div class='ui list user-info column'><div class='item'><div class='ui horizontal bulleted list'><div class='item' style='font-weight:bold;'>" + k.school + "</div><div class='item'>" + k.from_year + "-" + k.to_year + "</div><div class='item'>" + k.degree + "</div><div class='item'>" + k.field_of_study + "</div><div class='item'>" + k.grade + "</div></div></div>" + strDesc + strAward + strAct + "</div>";
    });
    strList += strItem;
    if (strList.length) {
        $("#educational_qualifications").append(strList);
    } else {
        $("#educational_qualifications").append("<div class='ui list user-info column'><div class='item'>Record not found</div>");
    }

};

member.certificationTemplate = function (parse, dataType="all") {
        if (dataType === "single") {
            data = parse;
        } else {
            data = parse.data.certification
        }
        var strItem = strList = "";
        $.each(data, function (v, k) {
            strAward = strDesc = "";

            if (k.description) {
                strDesc = "<div class='item'> <div class='content'> <a class='header'>Description</a> <div class='description'> <p>" + k.description + "</p> </div> </div> </div>";
            }
            if (k.award) {
                strAward = "<div class='item'> <div class='content'> <a class='header'>Awards</a> <div class='description'> <p>" + k.award + "</p> </div> </div> </div>";
            }

            strItem += "<div class='ui list user-info column'><div class='item'><div class='ui horizontal bulleted list'><div class='item' style='font-weight:bold;'>" + k.institution + "</div><div class='item' style='font-weight:bold;'>" + k.certification + "</div><div class='item'>" + k.year_obtained + "</div><div class='item'>" + k.specialization + "</div></div></div>" + strDesc + strAward + "</div>";
        });
        strList += strItem;
        // $("#professional_certifications").append(strList);
        if (strList.length) {
            $("#professional_certifications").append(strList);
        } else {
            $("#professional_certifications").append("<div class='ui list user-info column'><div class='item'>Record not found</div>");
        }

    };

member.experienceTemplate = function (parse, dataType="all") {
    if (dataType === "single") {
        data = parse;
    } else {
        data = parse.data.experience
    }
    var strItem = strList = "";
    $.each(data, function (v, k) {
        strAward = strDesc = "";

        if (k.description) {
            strDesc = "<div class='item'> <div class='content'> <a class='header'>Description</a> <div class='description'> <p>" + k.description + "</p> </div> </div> </div>";
        }
        if (k.award) {
            strAward = "<div class='item'> <div class='content'> <a class='header'>Award(s)/Commendation(s)</a> <div class='description'> <p>" + k.award + "</p> </div> </div> </div>";
        }

        strItem += "<div class='ui list user-info twelve wide column'><div class='item'><div class='ui horizontal bulleted list'><div class='item' style='font-weight:bold;'>" + k.position + "</div><div class='item' style='font-weight:bold;'>" + k.company + "</div><div class='item'>" + k.specialisation + "</div><div class='item'>" + k.location + "</div><div class='item'>" + k.from_month + " " + k.from_year + "-" + k.to_month + " " + k.to_year + "</div></div></div>" + strDesc + strAward + "</div>";
    });
    strList += strItem;
    // $("#industry_experience").append(strList);
    if (strList.length) {
        $("#industry_experience").append(strList);
    } else {
        $("#industry_experience").append("<div class='ui list user-info column'><div class='item'>Record not found</div>");
    }

};

member.affiliationTemplate = function (parse, dataType="all") {
    if (dataType === "single") {
        data = parse;
    } else {
        data = parse.data.affiliation
    }
    var strItem = strList = "";
    $.each(data, function (v, k) {
        strDesc = strGroup = "";


        if (k.group) {
            strGroup = "<div class='item'> Group: " + k.group + "</div>";
        }
        if (k.remark) {
            strDesc = "<div class='item'> <div class='content'> <a class='header'>Description</a> <div class='description'> <p>" + k.remark + "</p> </div> </div> </div>";
        }


        strItem += "<div class='ui list user-info column'><div class='item'><div class='ui horizontal bulleted list'><div class='item' style='font-weight:bold;'>" + k.organisation + "</div>" + strGroup + "<div class='item'>Member Since: " + k.year_joined + "</div></div></div>" + strDesc + "</div>";
    });
    strList += strItem;
    // $("#affiliations").append(strList);
    if (strList.length) {
        $("#affiliations").append(strList);
    } else {
        $("#affiliations").append("<div class='ui list user-info column'><div class='item'>Record not found</div>");
    }


};

member.companyTemplate = function (parse, dataType="all") {
    if (dataType === "single") {
        data = parse;
    } else {
        data = parse.data.company
    }
    // console.log(data);
    var strItem = strList = "";
    $.each(data, function (v, k) {
        strItem += "<div class='ui list user-info column'><div class='item'><div class='ui horizontal bulleted list'><div class='item' style='font-weight:bold;'>" + k.name + "</div><div class='item'>" + k.address1 + "</div><div class='item'>" + k.address2 + "</div><div class='item'>" + k.country + "</div><div class='item'>" + k.state + "</div><div class='item'>" + k.city + "</div><div class='item'>" + k.website + "</div><div class='item'>" + k.year_founded + "</div><div class='item'>" + k.specialisation + "</div></div></div>" + k.description + "</div>";
    });
    strList += strItem;
    // $("#affiliations").append(strList);
    if (strList.length) {
        $("#company").append(strList);
    } else {
        $("#company").append("<div class='ui list user-info column'><div class='item'>Record not found</div>");
    }


};

member.projectTemplate = function (parse, dataType="all") {
    if (dataType === "single") {
        data = parse;
    } else {
        data = parse.data.project
    }
    var strItem = strList = "";
    $.each(data, function (v, k) {
        strDesc = strComm = "";


        if (k.project_description) {
            strDesc = "<div class='item'> <div class='content'> <a class='header'>Description</a> <div class='description'> <p>" + k.project_description + "</p> </div> </div> </div>";
        }

        if (k.project_commendation) {
            strComm = "<div class='item'> <div class='content'> <a class='header'>Commendation</a> <div class='commendation'> <p>" + k.project_commendation + "</p> </div> </div> </div>";
        }

        strItem += "<div class='ui list user-info column'> <div class='item'> <div class='ui horizontal bulleted list'> <div class='item' style='font-weight:bold;'>" + k.project_nature + "@" + k.project_employer + "</div> <div class='item'>" + k.project_from_year + "-" + k.project_to_year + "</div> <div class='item'>Client: " + k.project_client + "</div> <div class='item'>Location: " + k.project_location + "</div> </div> </div> <div class='item'> <div class='ui horizontal bulleted list'> </div> </div>" + strDesc + strComm + "</div>";
    });
    strList += strItem;
    // $("#executed_projects").append(strList);
    if (strList.length) {
        $("#executed_projects").append(strList);
    } else {
        $("#executed_projects").append("<div class='ui list user-info column'><div class='item'>Record not found</div>");
    }

};

member.sendMessage = function ($el) {
    //confirm login
    var data = {
        "function": "isLoggedIn"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        if (response.message != 1) {
            alert("Please Sign in to send a message to this user");

        } else if (response.data && response.data.subscription === "inactive") {
            alert("Please upgrade your account to send a message to this user");

        } else {
            $("#message_modal").modal({
                closable: false,
                onApprove: function ($elem) {
                    //send message and email to user
                    member.doSend($elem);
                    return false;
                }
            }).modal("show");
        }
    });

};


member.doSend = function ($el) {
    var data = {
        "function": "sendMessage",
        "subject": $("#msg_subject").val(),
        "message": $("#msg_body").val(),
        "member_id": $("#mem").text()
    };
    //return false;
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        window.alert(response.message);
        if (response.status === "success") {
            $("#msg_form")[0].reset();
            $("#message_modal").modal("hide");

        }
    });
};

member.validateUser = function ($el) {
    var data = {
        "function": "isLoggedIn"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        if (response.message != 1) {
            alert("Please Sign in to send a message to this user");

        } else {
            $("#validation_modal").modal({
                closable: false,
                onShow: function () {
                    $("#validate_type").dropdown();
                },
                onApprove: function ($elem) {
                    //send message and email to user
                    member.doValidate($elem);
                    return false;
                }
            }).modal("show");
        }
    });
};










member.ready();