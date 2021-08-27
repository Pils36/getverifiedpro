var myProfile = myProfile || {};
var userProfileData =
    (function () {
        this.onReady = function () {
            NProgress.start();
            //fetch user info
            var profileData = {
                "function": "fetchUserInfo"
            };
            sendRequest.postJSON(profileData, "controller/app.php", function (response) {
                var parse = response;
                myProfile.educationTemplate(parse);
                myProfile.certificationTemplate(parse);
                myProfile.experienceTemplate(parse);
                myProfile.affiliationTemplate(parse);
                myProfile.projectTemplate(parse);
                NProgress.done();
                myProfile.readyList();
            });
            // fetch user info
            //delete button


            $("#save_btn").on("click", function () {
                if ($(this).data("content") === "photo") {
                    myProfile.savePhoto();
                    return;
                }

                var func = $("form").attr("id");
                var formData = $("form").serializeArray();

                var data = {
                    "function": "insertRecord",
                    "model": func,
                    "data": formData
                };
                sendRequest.postJSON(data, "controller/app.php", function (response) {
                    //// console.log(response);
                    status = response.status;
                    message = response.message;
                    if ($.trim(status) === "failed") {

                        alert(message);
                        return;
                    }
                    table = response.data.table;
                    rows = response.data.rows;
                    switch (table) {
                        case "tbl_educational_qualification":
                            myProfile.educationTemplate(rows, "single");
                            break;
                        case "tbl_professional_certification":
                            //code block
                            myProfile.certificationTemplate(rows, "single");
                            break;
                        case "tbl_affiliation":
                            //code block
                            myProfile.affiliationTemplate(rows, "single");
                            break;

                        case "tbl_industry_experience":
                            //code block
                            myProfile.experienceTemplate(rows, "single");
                            break;
                        case "tbl_executed_project":
                            //code block
                            myProfile.projectTemplate(rows, "single");
                            break;
                        case "tbl_account_individual":
                            //code block
                            myProfile.profileTemplate(rows, "single");
                            break;

                        default:
                        //code block
                    }

                    //// console.log(JSON.stringify(response));
                    alert(message);
                    //if($.trim(status) =="success"){
                    //dismiss form
                    $("#profile_modal,#post_modal").modal("hide");
                    //trigger my post click on post page
                    $("*[data-type='mine']").trigger("click");

                    //}
                    myProfile.readyList();
                })
            });
            $(".add_btn").on("click", function () {
                var that = $(this);

                var buffer = buffer2 = buffer3 = "<option value=''></option>";
                var data = {
                    "function": "fetchIndustries"
                };
                sendRequest.postJSON(data, "controller/app.php", function (response) {
                    var parse = response;
                    $.each(parse.data, function (v, k) {
                        
                        
                        
                        buffer += "<option value='" + k.industry + "'>" + k.industry + "</option>";
                    });

                    var data = {
                        "function": "getYears"
                    };
                    sendRequest.postJSON(data, "controller/app.php", function (response) {
                        $.each(response, function (v, k) {
                            
                            // console.log(k);
                            
                            buffer2 += "<option value='" + k.year + "'>" + k.year + "</option>";
                        });
                        var data = {
                            "function": "fetchEmployer"
                        };
                        sendRequest.postJSON(data, "controller/app.php", function (response) {
                            $.each(response.data, function (v, k) {
                                buffer3 += "<option value='" + k.company + "'>" + k.company + "</option>";
                            });

                            myProfile.loadModal($(that), buffer, buffer2, buffer3);
                        });
                    });

                });

            });
            NProgress.done();
        },

            this.educationTemplate = function (parse, dataType="all") {
                //load educational qualifications
                
                strList = "";
                var strItem =strList;
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

                    strItem += "<div class='ui list user-info twelve wide column'><div class='item'><div class='ui horizontal bulleted list'><div class='item' style='font-weight:bold;'>" + k.school + "</div><div class='item'>" + k.from_year + "-" + k.to_year + "</div></div></div><div class='item'><div class='ui horizontal bulleted list'><div class='item'>" + k.degree + "</div><div class='item'>" + k.field_of_study + "</div><div class='item'>" + k.grade + "</div></div></div>" + strDesc + strAward + strAct + "</div><div class='ui two wide column'> <button class='circular ui icon mini right floated basic button edit_btn' data-content='education' data-ref='" + k.id + "'> <i class='icon write'></i> </button> </div><div class='ui two wide column'> <button class='circular ui icon mini left floated basic button delete_btn' data-content='education' data-ref='" + k.id + "'> <i class='icon remove'></i> </button> </div>";
                });
                strList += strItem;
                $("#educational_qualification_row").html(strList);

            },

            this.certificationTemplate = function (parse, dataType="all") {
                if (dataType === "single") {
                    data = parse;
                } else {
                    data = parse.data.certification
                }
                strList = "";
                var strItem = strList; 
                $.each(data, function (v, k) {
                    strAward = strDesc = "";

                    if (k.description) {
                        strDesc = "<div class='item'> <div class='content'> <a class='header'>Description</a> <div class='description'> <p>" + k.description + "</p> </div> </div> </div>";
                    }
                    if (k.award) {
                        strAward = "<div class='item'> <div class='content'> <a class='header'>Awards</a> <div class='description'> <p>" + k.award + "</p> </div> </div> </div>";
                    }

                    strItem += "<div class='ui list user-info twelve wide column'><div class='item'><div class='ui horizontal bulleted list'><div class='item' style='font-weight:bold;'>" + k.institution + "</div><div class='item' style='font-weight:bold;'>" + k.certification + "</div></div></div><div class='item'><div class='ui horizontal bulleted list'><div class='item'>" + k.year_obtained + "</div><div class='item'>" + k.specialization + "</div></div></div>" + strDesc + strAward + "</div><div class='ui two wide column'> <button class='circular ui icon mini right floated basic button edit_btn' data-content='certification' data-ref='" + k.id + "'> <i class='icon write'></i> </button> </div><div class='ui two wide column'> <button class='circular ui icon mini left floated basic button delete_btn' data-content='certification' data-ref='" + k.id + "'> <i class='icon remove'></i> </button> </div>";
                });
                strList += strItem;
                $("#professional_certification_row").html(strList);

            },

            this.experienceTemplate = function (parse, dataType="all") {
                if (dataType === "single") {
                    data = parse;
                } else {
                    data = parse.data.experience;
                }
                var strItem = strList = "";
                $.each(data, function (v, k) {
                    // console.log(k);
                    strAward = strDesc = "";

                    if (k.description) {
                        strDesc = "<div class='item'> <div class='content'> <a class='header'>Description</a> <div class='description'> <p>" + k.description + "</p> </div> </div> </div>";
                    }
                    if (k.award) {
                        strAward = "<div class='item'> <div class='content'> <a class='header'>Award(s)/Commendation(s)</a> <div class='description'> <p>" + k.award + "</p> </div> </div> </div>";
                    }

                    strItem += "<div class='ui list user-info twelve wide column'><div class='item'><div class='ui horizontal bulleted list'><div class='item' style='font-weight:bold;'>" + k.position + "</div></div></div><div class='item'><div class='ui horizontal bulleted list'><div class='item' style='font-weight:bold;'>" + k.company + "</div><div class='item'>" + k.specialisation + "</div><div class='item'>" + k.location + "</div><div class='item'>" + k.from_month + " " + k.from_year + "-" + k.to_month + " " + k.to_year + "</div></div></div>" + strDesc + strAward + "</div><div class='ui two wide column'> <button class='circular ui icon mini right floated basic button edit_btn' data-content='experience' data-ref='" + k.id + "'> <i class='icon write'></i> </button> </div><div class='ui two wide column'> <button class='circular ui icon mini left floated basic button delete_btn' data-content='experience' data-ref='" + k.id + "'>  <i class='icon remove'></i> </button> </div>";
                });
                strList += strItem;
                $("#industry_experience_row").html(strList);

            },

            this.affiliationTemplate = function (parse, dataType="all") {
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


                    strItem += "<div class='ui list user-info twelve wide column'><div class='item'><div class='ui horizontal bulleted list'><div class='item' style='font-weight:bold;'>" + k.organisation + "</div>" + strGroup + "<div class='item'>Member Since: " + k.year_joined + "</div></div></div>" + strDesc + "</div><div class='ui two wide column'> <button class='circular ui icon mini right floated basic button edit_btn' data-content='affiliation' data-ref='" + k.id + "'> <i class='icon write'></i> </button> </div><div class='ui two wide column'> <button class='circular ui icon mini left floated basic button delete_btn' data-content='affiliation' data-ref='" + k.id + "'>  <i class='icon remove'></i> </button> </div>";
                });
                strList += strItem;
                $("#affiliation_row").html(strList);

            },

            this.projectTemplate = function (parse, dataType="all") {
                if (dataType === "single") {
                    data = parse;
                } else {
                    data = parse.data.project;
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

                    strItem += "<div class='ui list user-info twelve wide column'> <div class='item'> <div class='ui horizontal bulleted list'> <div class='item' style='font-weight:bold;'>" + k.project_nature + "@" + k.project_employer + "</div> <div class='item'>" + k.project_from_year + "-" + k.project_to_year + "</div> </div> </div> <div class='item'> <div class='ui horizontal bulleted list'> <div class='item'>Client: " + k.project_client + "</div> <div class='item'>Location: " + k.project_location + "</div> </div> </div>" + strDesc + strComm + "</div> <div class='ui two wide column'> <button class='circular ui icon mini right floated basic button edit_btn' data-content='project' data-ref='" + k.id + "'> <i class='icon write'></i> </button> </div> <div class='ui two wide column'> <button class='circular ui icon mini left floated basic button delete_btn' data-content='project' data-ref='" + k.id + "'> <i class='icon remove'></i> </button> </div>";
                });
                strList += strItem;
                $("#project_row").html(strList);

            },

            this.profileTemplate = function (parse, dataType="all") {
                var data;
                if (dataType === "single") {
                    data = parse;
                } else {
                    data = parse.data.profile;
                }
                $(".profile_picture").attr("src", "assets/resources/pics/" + data[0].photo);
                $("#profile_name").text((data[0].lastname + " " + data[0].firstname).toUpperCase());
                $("#profile_current_position").text((data[0].profession + " at " + data[0].company).toUpperCase());

            },

            this.delete = function (el) {
                //alert($(el).data("content"));
                var data = {
                    "ref": $(el).data("ref"),
                    "content": $(el).data("content"),
                    "function": "deleteRecord"
                };
                sendRequest.postJSON(data, "controller/app.php", function (response) {
                    status = response.status;
                    message = response.message;
                    table = response.data.table;
                    rows = response.data.rows;

                });
                //myProfile.readyList();
                $(el).closest(".column").prev().prev().remove();
                $(el).closest(".column").prev().remove();
                $(el).closest(".column").remove();
                //$(el).closest(".column").prev(".user-info").remove();
            },

            this.readyList = function () {
                $(".delete_btn").on("click", function () {
                    var btn = this;
                    $("#confirm_modal").modal({
                        closable: false,
                        onApprove: function (el) {
                            myProfile.delete(btn);
                        }
                    }).modal("show");
                });
                $(".edit_btn").on("click", function () {
                    //fetch details and display on form
                    var that = $(this);
                    var data = {
                        "function": "editRecord",
                        "content": $(this).data("content"),
                        "ref": $(this).data("ref")
                    };
                    sendRequest.postJSON(data, "controller/app.php", function (response) {
                        //alert(JSON.stringify(response));
                        
                        console.log(data);
                        
                        var response = response;
                        var page = "";
                        var header = "";


                        switch (response.data.table) {
                            case "education":
                                header = "Educational Qualification";
                                page = "education";
                                break;
                            case "affiliation":
                                header = "Religious/Social/Charitable Affiliation";
                                page = "affiliation";
                                break;
                            case "experience":
                                header = "Professional Experience (Previous)";
                                page = "industry";
                                break;
                            case "certification":
                                header = "Professional Certification";
                                page = "professional";
                                break;
                            case "project":
                                header = "Executed Project";
                                page = "project";
                                break;
                            case "profile":
                                header = "Profile Details";
                                page = "profile";
                                break;
                            default:
                                break;
                        }

                        //show modal
                        $("#modal_header").html("");
                        $("#modal_description").html("");

                        $("#modal_header").html(header);
                        //$("#save_btn").data("action",$(this).data("content"));
                        $("#save_btn").data("content", $(that).data("content"));
                        var content = "views/modals/" + page + ".html";
                        $("#modal_description").load(content, function () {
                            var buffer = buffer2 = "<option value=''></option>";
                            $.each(response.data.years, function (v, k) {
                                buffer += "<option value='" + k.year + "'>" + k.year + "</option>"
                            });

                            $.each(response.data.employers, function (v, k) {
                                buffer2 += "<option value='" + k.company + "'>" + k.company + "</option>"
                            });
                            $("#project_employer").html(buffer2);
                            $("#year_founded, #project_from_year,#project_to_year").html(buffer);
                            $("#profile_modal").modal({
                                closable: false,
                                onApprove: function (el) {
                                    return false;
                                },
                                onVisible: function (el) {
                                    $.each(response.data.rows, function (v, k) {
                                        //alert(v);
                                        if (v === "id") {
                                            $("form").prepend("<input type='hidden' id = '" + v + "' name='" + v + "' value='" + k + "'>");
                                        } else {

                                            $("form").find("#" + v).val(k).change();
                                        }
                                    });
                                }
                            }).modal("show");
                            $('select').dropdown();


                        });
                        // populate controls

                    });
                });
            },

            this.industryExperience = function (el) {

                $("#experience_modal > .content").load("views/modals/industry.html", function () {
                    $('.coupled.modal').modal({
                        allowMultiple: true
                    });
                    // open second modal on first modal buttons
                    $('.second.modal').modal({
                        closable: false,
                        onApprove: myProfile.projectSave
                    }).modal('attach events', '.first.modal .project');
                    // show first immediately
                    $('.first.modal').modal({
                        closable: false,
                        onApprove: myProfile.experienceSave
                    }).modal('show');
                });


            },

            this.experienceSave = function () {
                alert("saving");
            };

        this.industryProject = function () {
            var data = {
                "function": "fetchEmployer"
            };
            sendRequest.postJSON(data, "controller/app.php", function (response) {
                //// console.log(response);
                var buffer = "<option value=''></option>";
                var buffer2 = "<option value=''></option>";
                $.each(response.data, function (v, k) {
                    buffer += "<option value='" + k.company + "'>" + k.company + "</option>";
                });

                $.each(response.years, function (v, k) {
                    buffer2 += "<option value='" + k.year + "'>" + k.year + "</option>";
                });
                $("#modal_description").load("views/modals/project.html", function () {
                    $("#modal_header").html("Executed Projects");
                    $("#project_employer").html(buffer);
                    $("#project_from_year").html(buffer2);
                    $("#project_to_year").html(buffer2);
                    $("#profile_modal").modal({
                        closable: false,
                        onApprove: function (el) {
                            //return false;
                        }
                    }).modal("show");
                    $('select').dropdown();
                });
            });
        },

            this.loadModal = function (el, strInd = '', strYr='', strEmployer="") {
                $("#modal_header").html("");
                $("#modal_description").html("");
                var header = $(el).data("header");
                $("#modal_header").html(header);
                $("#save_btn").data("content", $(el).data("content"));

                //var that = $(this);
                var content = "views/modals/" + $(el).data("content") + ".html";
                $("#modal_description").load(content, function () {
                    $("#profile_modal").modal({
                        closable: false,
                        onApprove: function (ele) {
                            return false;
                        }
                    }).modal("show");
                    $('.cookie.nag').nag('show');
                    $("#industry").html(strInd);
                    $("#project_employer").html(strEmployer);
                    $("#year_founded, #project_from_year,#project_to_year").html(strYr);
                    // $("#project_from_year").html(strYr);
                    $('select').dropdown();
                    $('.ui.accordion').accordion();
                });
            },

            this.savePhoto = function () {
                //e.preventDefault();
                $("#message").empty();
                $('#loading').show();
                var form = $('form').get(0);
                $.ajax({
                    url: "controller/app.php", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: new FormData(form), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request views to be cached
                    processData: false,        // To send DOMDocument or non processed data file it is set to false
                    success: function (data)   // A function to be called if request succeeds
                    {
                        //alert("fff");
                        if (data.message.trim() === "Upload Successful") {
                            alert("Your Picture was successfully uploaded");
                            $("#profile_modal").hide();
                            $(".profile_picture").attr("src", data.data.photo);
                        }
                    }
                });
            }


    }).apply(myProfile);

myProfile.onReady();
