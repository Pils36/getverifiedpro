var project = project || {};

(function () {

    this.onReady = function () {

        project.getAllMyGroupMembers();

        project.loadProjects();

        $("#createProject").on("show.bs.modal",function(){

            

            //return false;

        });

    };





    this.loadProjects = function () {



        project.getProjectList();

    };



    this.getProjectList = function () {

        NProgress.start();

        var data = {

            "function": "fetchProjects"

        };

        sendRequest.postJSON(data, "controller/app.php", function (response) {

            if (response.status === "success") {

                project.projectListTemplate(response.data);

            }





        });

        NProgress.done();

    };





    this.projectListTemplate = function (data) {

        // console.log(data);

        if (!data.length) {

            $("#project_table_list").html(project.emptyResponse);

            return;

        }
        var strPosts = '';

        $.each(data, function (k, v) {
            // console.log(data);
            strPosts += "<li class='contact project-item rw' onclick='project.getProjectData(this)' id='" + v.id + "'><div class='wrap'><div class='meta'>" +

                "<p class='name'>" + v.title + "</p>" +

                "</div></div></li>";

        });

        strPosts += '';

        $("#project_table_list").html(strPosts);



    };





    this.emptyResponse = "<div class='ui comments'><div class='comment'><div class='text'>No record found</div> </div></div>";





    $('#create_task_form')

        .form({

            onSuccess: function (event, fields) {

                event.preventDefault();

                project.createTask();

            }

        });



    $('#create_project_form')

        .form({

            onSuccess: function (event, fields) {

                event.preventDefault();

                project.createProject();

            }

        });





    this.createTask = function () {

        var project_id = $("#project_id").val();

        //loop based on php max limit
        var n = $("#max").val();
        
        for(i=1; i<=n; i++){
            //To get var res
            if($(".selected > a > span").html() == $(".selectpicker > option:nth-Child("+i+")").html()){
                var res = $(".selectpicker > option:nth-Child("+i+")").val();
            }
        }
            
        
        
        var data = {

            "function": "createProjectTask",

            "title": $("#task_title").val(),

            "owner_login_id": res,

            "project_id": project_id,

        };
        // console.log(data);
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            

            $("#task_response").html("<p style='text-align:center; color:red;'>" + response.message + "</p>");

            if (response.message === $.trim("Project Task Created Successfully")) {
                
                $("#task_response").html("<p style='text-align:center; color:green;'>" + response.message + "</p>");

                $('#create_task_form')[0].reset();
                
                

                project.fetchProjectTasks(project_id);

                project.fetchProjectMembers(project_id);
                // project.fetchProjectMembers(member_login_id);
                
                // $(".modal").modal('hide');
                $("#create_task_form > div > button").click();



            }

        });



    };

    
    this.createProject = function () {

        var data = {

            "function": "createProject",

            "title": $("#project_title").val()

        };

        sendRequest.postJSON(data, "controller/app.php", function (response) {

            $("#project_response").html("<p style='text-align:center; color:red;'>" + response.message + "</p>");

            if (response.message === $.trim("Project Created Successfully")) {

                // window.location.reload(true);

                project.getProjectList();

                $("#createProject").modal("hide");

            }

        });



    };



    this.getProjectData = function (gift) {

        $('#task_body').removeClass('hidden');

        $("#message_project_form").removeClass('hidden');



        $('.project-item').removeClass('active');

        $(gift).addClass("active");

        var project_id = gift.id;

        project.fetchProjectTasks(project_id);

        project.fetchProjectMessages(project_id);

        project.fetchProjectMembers(project_id);

        project.fetchProjectFiles(project_id);

    };



    this.fetchProjectMessages = function (project_id) {

        NProgress.start();

        var data = {

            "function": "getProjectMessages",

            "project_id": project_id

        };

        sendRequest.postJSON(data, "controller/app.php", function (response) {

            if (response.status === "success") {

                project.projectMessagesTemplate(project_id, response.data);

            }





        });

        NProgress.done();

    };





    this.fetchProjectTasks = function (project_id) {

        NProgress.start();

        var data = {

            "function": "getProjectTasks",

            "project_id": project_id

        };

        sendRequest.postJSON(data, "controller/app.php", function (response) {

            if (response.status === "success") {

                project.projectTasksTemplate(project_id, response.data);

            }

        });

        $("#project_id").val(project_id);

        NProgress.done();

    };



    this.projectTasksTemplate = function (project_id, data) {



        if (!data.length) {

            $("#task_table_list").html(project.emptyResponse);

            return;

        }



        // console.log(myProfileData);

        var strPosts = '';

        $.each(data, function (k, v) {

            if(myProfileData.login_id !== v.owner_login_id){

                $("#create_task").addClass('hidden');

            }



            var deleteB = (myProfileData.login_id === v.member_login_id || myProfileData.login_id === v.owner_login_id) ? '<a href="#" task_id="' + v.id + '" project_id="' + v.project_id + '" title="remove"  onclick="return confirm(\'Are you sure, you want to remove ' + v.title + '\') ? project.removeProjectTask(this): \'\' "><i class="fa fa-trash"></i></a>' : '';



            strPosts += "<li class='contact group-item rw' id='" + v.id + "'><div class='wrap'><div class='meta'>" +

                "<p class='name'>" + v.title + "</p>" +

                deleteB + "<small class='list-group-item-text pull-right small' ><i class='fa fa-briefcase'></i> " + v.firstname + " " + v.lastname + "</small>" +

                "<div class='clearfix'></div></div></div></li>";

        });

        strPosts += ' ';

        $("#task_table_list").html(strPosts);

    };



    this.removeProjectTask = function (gift) {



        var project_id = $(gift).attr('project_id');

        var task_id = $(gift).attr('task_id');



        var data = {

            "function": "removeProjectTask",

            "project_id": project_id,

            'task_id': task_id

        };

        sendRequest.postJSON(data, "controller/app.php", function (response) {

            project.fetchProjectTasks(project_id);

            project.fetchProjectMembers(project_id);

        });

    };





    this.removeProject = function (gift) {

        var project_id = $(gift).attr('project_id');



        var data = {

            "function": "removeProject",

            "project_id": project_id,

        };

        sendRequest.postJSON(data, "controller/app.php", function (response) {

            document.location.reload(true);

        });

    };



    this.projectMessagesTemplate = function (project_id, data) {

        // // console.log(data);



        var strMessages = '';



        $.each(data, function (k, v) {

            var className = myProfileData.login_id === v.sent_by ? 'sent' : 'replies';



            strMessages += '<li class="' + className + '"><img src="assets/resources/pics/' + v.photo + '">' +

                '<p><small style="font-size: 10px;">' + v.firstname + ' ' + v.lastname + '</small><br>' +

                '' + v.content + '</p></li><div class="clearfix"></div> '

        });

        strMessages += '';



        $('#message-outlet').html(strMessages);

        $(".message-input").removeClass('hidden');

        $("#project_id").val(project_id);

    };





    this.fetchProjectMembers = function (project_id) {



        var data = {

            "function": "getProjectMembers",

            "project_id": project_id

        };

        sendRequest.postJSON(data, "controller/app.php", function (response) {

            if (response.status === "success") {

                project.projectMembersTemplate(project_id, response.data);

            }





        });

    };





    this.projectMembersTemplate = function (project_id, data_obj) {



        var data = Object.keys(data_obj).map(function(key) {

            return data_obj[key];

        });



        // console.log(data);





        var deleteB = (myProfileData.login_id === data[0].owner_login_id) ? '<a href="#" class="pull-right" project_id="' + data[0].project_id + '" title="remove"  onclick="return confirm(\'Are you sure, you want to remove ' + data[0].title + '\') ? project.removeProject(this): \'\' "><i class="fa fa-trash"></i></a>' : '';





        var strMembers = '<h1 class="heading">Project ' + data[0].title + ' Members' + deleteB + '</h1><br>';

        strMembers += '<div class="content quote"></div><ul class="list-unstyled">';



        $.each(data, function (k, v) {
        

            var type = v.login_id === v.owner_login_id ? 'Admin' : 'Member';

            var onlineStatus = v.online_status ? "<img src='https://img.icons8.com/color/48/000000/id-verified.png' style='width: 16px; height:16px; position: relative; top: 10px;left:-5px; right:0px;bottom:0px;'>" : "<img src='https://img.icons8.com/color/48/000000/id-verified.png' style='width: 16px; height:16px; position: relative; top: 10px;left:-5px; right:0px;bottom:0px;'>";

            var lastSeen = !v.online_status ? 'Last Seen: '+ v.last_seen : '';



            strMembers += '<li><a onclick="project.redirectProfile(this)"  data-account="' + v.login_id + '"><span><img src="assets/resources/pics/' + v.photo + '"></span>' +

                '<span>'+ onlineStatus +' ' + v.firstname + ' ' + v.lastname + '</span></a>' +

                '<a  onclick="project.prepareDM(this)" style="padding: 0 10px;" data-toggle="modal" class="pull-right" data-id="'+v.login_id+'"' +

                'data-target="#sendMessage">Message <i class="fa fa-envelope-o" style="color: green;"></i></a>' +

                '<br>' +

                '<br>' +

                '<small class="pull-left">' + lastSeen + '</small>' +

                '<small class="pull-right">' + type + '</small>' +

                '<div class="clearfix"></div> </li>'

        });

        strMembers += ' </ul>';

        $('#third-row-data-outlet').html(strMembers);





        var strProjectInfo = '<div class="contact-profile">' +

            '<p style="margin-left: 10px">' + data[0].title + ' Room</p>' +

            '<span style="font-size: 11px; margin-right: 7px;" class="pull-right">' + data.length + ' members&nbsp;&nbsp;&nbsp;<a href="controller/app.php?data_id=' + project_id + '&type=project" title="Download Messages"><i class="fa fa-download"></i></a></span>' +

            '</div>';



        $('#project-info').html(strProjectInfo);



    };



    this.fetchProjectFiles = function (project_id) {



        var data = {

            "function": "getProjectFiles",

            "project_id": project_id

        };

        sendRequest.postJSON(data, "controller/app.php", function (response) {

            if (response.status === "success") {

                project.projectFilesTemplate(project_id, response.data);

            }





        });

    };





    this.projectFilesTemplate = function (project_id, data) {

        $('#files-row-data-outlet').html('');

        if(!data[0]) return;





        var strMembers = '<h1 class="heading">Project ' + data[0].title + ' Files</h1><br>';

        strMembers += '<div class="content quote"></div><ul class="list-unstyled">';



        $.each(data, function (k, v) {



            strMembers += '<li><a href="assets/resources/msg_attachments/'+v.filename+'">' +

                '<span>' + v.filename + '</span></a><br>' +

                '<div class="clearfix"></div> </li>'

        });

        strMembers += ' </ul>';

        $('#files-row-data-outlet').html(strMembers);

    };





    this.redirectProfile = function (gift) {

        $.redirect("member", {id: $(gift).data("account")}, "post");

    };



    this.prepareDM = function (gift) {

        // $.redirect("member", {id: $(gift).data("account")}, "post");

        var member_id =  $(gift).data("id");

        $('#member_id').val(member_id);

    };





    $('#message_project_form')

        .form({

            onSuccess: function (event, fields) {

                event.preventDefault();

                project.messageProject();

                $('#message_project_form')[0].reset();

            }

        });



    $('#message_member_form')

        .form({

            onSuccess: function (event, fields) {

                event.preventDefault();

                project.messageMember();

                $('#message_member_form')[0].reset();

            }

        });





    this.messageProject = function () {

        var project_id = $("#project_id").val();

        var files = $("#attachedFiles").val();

        files = files ? JSON.parse(files) : '';

        var message = $("#project_message_text").val();

        var data = {

            "function": "sendMessageRevised",

            "message": message,

            "sent_to": project_id,

            "attached_files": files,

            "message_type": "project"

        };

        sendRequest.postJSON(data, "controller/app.php", function (response) {

            $('#project_message_text').removeClass('hidden');

            $("#attachedFiles").val('');

            $("#file_upload_list").html('');

            $('#message_project_form')[0].reset();

            project.fetchProjectMessages(project_id);

            project.fetchProjectFiles(project_id);

        });

    };



    this.messageMember = function () {

        var member_id = $("#member_id").val();

        var message = $("#message_text").val();

        var subject = $("#subject").val();

        var data = {

            "function": "sendMessageRevised",

            "message": message,

            "subject": subject,

            "sent_to": member_id,

            "message_type": "private"

        };

        sendRequest.postJSON(data, "controller/app.php", function (response) {

            $("#message_response").html("<p style='text-align:center; color:red;'>" + response.message + "</p>");

            if (response.message === $.trim("Message Sent Successfully")) {

                $('#message_member_form')[0].reset();

                $("#sendMessage").modal("hide");



            }

        });

    };





    this.getAllMyGroupMembers = function () {



        var data = {

            "function": "getAllMyGroupMembers"

        };

        sendRequest.postJSON(data, "controller/app.php", function (response) {

            if (response.status === 'success') {

                var data = response.data;

                var strAllMembers = '';

                // // console.log(myProfileData);

                $.each(data, function (k, v) {

                    strAllMembers += '<option value="' + v.login_id + '">' + v.firstname + ' ' + v.lastname + ' (' + v.title + ')</option>'

                });

                $('#task_owners').html(strAllMembers);

            }

        });



    };

}).apply(project);



project.onReady();



project.sendMessage = function ($el) {

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





project.doSend = function ($el) {

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



// Table search

$(function () {



    $.extend($.expr[':'], {

        'containsi': function (elem, i, match, array) {

            return (elem.textContent || elem.innerText || '').toLowerCase()

                .indexOf((match[3] || "").toLowerCase()) >= 0;

        }

    });



    $("#projectTableSearch").keyup(function () {

        var query = $(this).val();

        $('#project_table_list .rw:not(:containsi(' + query + '))').hide();

        $('#project_table_list .rw:containsi(' + query + ')').show();

    });



});

