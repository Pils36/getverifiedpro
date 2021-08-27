var group = group || {};
(function () {
    this.onReady = function () {
        group.getUserAccounts();
        group.loadGroups();
        $('#groups').on('click', function () {
            $("#group_body").removeClass('hidden');


            $(".message-input").addClass('hidden');
            $("#group-info").html('');
            $("#message-outlet").html('');
            $("#third-row-data-outlet").html('');

            group.loadGroups();

        });
    };

    this.loadGroups = function () {

        $("#groups").addClass('active');
        group.getGroupList();
    };

    this.getGroupList = function () {
        NProgress.start();
        var data = {
            "function": "fetchGroups"
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            if (response.status === "success") {
                group.groupListTemplate(response.data);
            }


        });
        NProgress.done();
    };

    this.groupListTemplate = function (data) {
        if (!data.length) {
            $("#group_table_list").html(group.emptyResponse);
            return;
        }
        var strPosts = '';
        $.each(data, function (k, v) {
            strPosts += "<li class='contact group-item rw' onclick='group.getGroupData(this)' id='" + v.id + "'><div class='wrap'><div class='meta'>" +
                "<p class='name'>" + v.title + "</p>" +
                "</div></div></li>";
        });
        strPosts += ' ';
        $("#group_table_list").html(strPosts);

    };


    this.emptyResponse = "<div class='ui comments'><div class='comment'><div class='text'>No record found</div> </div></div>";


    $('#add_member_form')
        .form({
            onSuccess: function (event, fields) {
                event.preventDefault();
                group.addMember();
            }
        });
    $('#create_group_form')
        .form({
            onSuccess: function (event, fields) {
                event.preventDefault();
                group.createGroup();
            }
        });


    this.createGroup = function () {
        var data = {
            "function": "createGroup",
            "title": $("#group_title").val()
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            $("#group_response").html("<p style='text-align:center; color:red;'>" + response.message + "</p>");
            if (response.message === $.trim("Group Created Successfully")) {
                window.location.reload(true);
                group.getGroupList();
                $("#createGroup").modal("hide");
            }
        });

    };

    this.addMember = function () {
        var group_id = $("#group_id").val();
         
         //loop based on php max limit
        var n = $("#max").val();
        
        // Get HTML of input
        var input = $(".show-tick button > span").html();
        
        // Split into object
        var spl = input.split(",");
        
        // Loop through each and compare
        
        
        var ress = [];
        $.each(spl, function(renId, renStr){
            
            // console.log(renStr.trim());
            
            // Loop through child element
            
            for(i=1; i<=n; i++){
 
                //To get var res
                if(renStr.trim() == $("#search_member > option:nth-Child("+i+")").html()){
                    //value
                    var res = $("#search_member > option:nth-Child("+i+")").val();
                    
                    //push
                    ress.push(res);
                    // console.log(true)
                    
                }
                
                else{
                    
                    // console.log(false);
                }
                
            }

        });
            
            
        
        
        
        var data = {
            "function": "addMembers",
            // "members_login_id": $("#search_member").val(),
            "members_login_id": ress,
            "group_id": group_id
        };
        // console.log(data);
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            $("#member_response").html("<p style='text-align:center; color:red;'>" + response.message + "</p>");
            if (response.message === $.trim("Members Added")) {
                $("#member_response").html("<p style='text-align:center; color:green;'>" + response.message + "</p>");
                // window.location.reload(true);
                group.fetchGroupMembers(group_id);
                
                // $("#add_member_form > div > button").click();
            }
        });

    };

    this.getGroupData = function (gift) {

        $("#message_group_form").removeClass('hidden');

        $('.group-item').removeClass('active');
        $(gift).addClass("active");
        var group_id = gift.id;

        $("#group_id").val(group_id);

        group.fetchGroupMembers(group_id);
        group.fetchGroupMessages(group_id);
        group.fetchGroupFiles(group_id);
    };


    this.fetchGroupMessages = function (group_id) {
        NProgress.start();
        var data = {
            "function": "getGroupMessages",
            "group_id": group_id
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            if (response.status === "success") {
                group.groupMessagesTemplate(group_id, response.data);
            }


        });
        NProgress.done();
    };

    this.fetchGroupMembers = function (group_id) {

        var data = {
            "function": "getGroupMembers",
            "group_id": group_id
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            
            
            
            if (response.status === "success") {
                group.groupMembersTemplate(group_id, response.data);
            }


        });
    };


    this.groupMembersTemplate = function (group_id, data) {

        // console.log(data);

        var deleteB = (myProfileData.login_id === data[0].owner_login_id) ? '<a href="#" class="pull-right" group_id="' + data[0].group_id + '" title="remove"  onclick="return confirm(\'Are you sure, you want to remove ' + data[0].title + '\') ? group.removeGroup(this): \'\' "><i class="fa fa-trash"></i></a>' : '';


        var strMembers = '<h1 class="heading">' + data[0].title + ' Members' + deleteB + '</h1><br>';
        strMembers += '<div class="content quote"></div><ul class="list-unstyled">';

        $.each(data, function (k, v) {
            // console.log(v);
            var type = v.login_id === v.owner_login_id ? 'Admin' : 'Member';
            var deleteB = (myProfileData.login_id === v.owner_login_id || myProfileData.login_id === v.login_id) ? '<a href="#" group_id="' + v.group_id + '" login_id="' + v.login_id + '" title="remove"  onclick="return confirm(\'Are you sure, you want to remove ' + v.firstname + ' ' + v.lastname + '\') ? group.removeGroupMember(this): \'\' "><i class="fa fa-trash"></i></a>' : '';
            
            var dateString = v.last_seen;
dateString = new Date(dateString).toUTCString();
dateString = dateString.split(' ').slice(0, 4).join(' ');
// console.log(dateString);

            var onlineStatus = v.online_status ? '<img src="https://img.icons8.com/color/48/000000/id-verified.png" style="width: 16px; height:16px; position: relative; top: 15px;left:-10px; right:0px;bottom:0px;"></span>' : '<img src="https://img.icons8.com/color/48/000000/id-verified.png" style="width: 16px; height:16px; position: relative; top: 15px;left:-10px; right:0px;bottom:0px;"></span>';
            var lastSeen = !v.online_status ? 'Last Seen: '+dateString : '<img src="https://img.icons8.com/color/48/000000/id-not-verified.png" style="width: 16px; height:16px; position: relative; top: 15px;left:-10px; right:0px;bottom:0px;"></span>';
            
            if(v.online_status == 1){
                strMembers += '<li><a onclick="group.redirectProfile(this)"  data-account="' + v.login_id + '"><span><img src="assets/resources/pics/' + v.photo + '"></span>' +
                '<span>'+ onlineStatus +' ' + v.firstname + ' ' + v.lastname + '</span></a>' +
                '<a  onclick="group.prepareDM(this)" style="padding: 0 10px;" data-toggle="modal" class="pull-right" data-id="'+v.login_id+'"' +
                'data-target="#sendMessage">Message <i class="fa fa-envelope-o" style="color: green;"></i></a>' +
                '<br>' +
                '<br>' +
                
                '<small class="pull-right">' + type + ' ' + deleteB + '</small>' +
                '<div class="clearfix"></div> </li>'
            }
            else{
                strMembers += '<li><a onclick="group.redirectProfile(this)"  data-account="' + v.login_id + '"><span><img src="assets/resources/pics/' + v.photo + '"></span>' +
                '<span>'+ lastSeen +' ' + v.firstname + ' ' + v.lastname + '</span><br><span style="font-size:10px">Last seen: <br>'+dateString+'</span></a>' +
                '<a  onclick="group.prepareDM(this)" style="padding: 0 10px;" data-toggle="modal" class="pull-right" data-id="'+v.login_id+'"' +
                'data-target="#sendMessage">Message <i class="fa fa-envelope-o" style="color: green;"></i></a>' +
                '<br>' +
                '<br>' +
                
                '<small class="pull-right">' + type + ' ' + deleteB + '</small>' +
                '<div class="clearfix"></div> </li>'
            }

            
        });
        strMembers += ' </ul>';

        if(myProfileData.login_id === data[0].owner_login_id){
            strMembers += '<a href="#" style="padding: 0 10px;" data-toggle="modal" class="pull-right"' +
                '                                   data-target="#addMember" title="Add Member"><i class="fa fa-plus"></i> Add Member</a>';
        }

        $('#third-row-data-outlet').html(strMembers);

        // console.log(data);

        var strGroupInfo = '<div class="contact-profile">' +
            '<p style="margin-left: 10px">' + data[0].title + '</p>' +
            '<span style="font-size: 11px; margin-right: 7px;" class="pull-right">' + data.length + ' members&nbsp;&nbsp;&nbsp;<a href="controller/app.php?data_id=' + group_id + '&type=group" title="Download Messages"><i class="fa fa-download"></i></a></span>' +
            '</div>';



        $('#group-info').html(strGroupInfo);

    };

    this.redirectProfile = function (gift) {
        $.redirect("member", {id: $(gift).data("account")}, "post");
    };


    this.prepareDM = function (gift) {
        // $.redirect("member", {id: $(gift).data("account")}, "post");
        var member_id =  $(gift).data("id");
        $('#member_id').val(member_id);
    };

    $('#message_member_form')
        .form({
            onSuccess: function (event, fields) {
                event.preventDefault();
                group.messageMember();
                $('#message_member_form')[0].reset();
            }
        });

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


    this.removeGroupMember = function (gift) {

        var group_id = $(gift).attr('group_id');
        var login_id = $(gift).attr('login_id');

        var data = {
            "function": "removeGroupMember",
            "group_id": group_id,
            'login_id': login_id
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            group.fetchGroupMembers(group_id);
        });
    };

    this.removeGroup = function (gift) {
        var group_id = $(gift).attr('group_id');

        var data = {
            "function": "removeGroup",
            "group_id": group_id,
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            document.location.reload(true);
        });
    };

    this.groupMessagesTemplate = function (group_id, data) {
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
        $("#group_id").val(group_id);
    };

    this.fetchGroupFiles = function (group_id) {

        var data = {
            "function": "getGroupFiles",
            "group_id": group_id
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            if (response.status === "success") {
                group.groupFilesTemplate(group_id, response.data);
            }


        });
    };


    this.groupFilesTemplate = function (group_id, data) {
        $('#files-row-data-outlet').html('');
        if(!data[0]) return;

        var strMembers = '<h1 class="heading">Group ' + data[0].title + ' Files</h1><br>';
        strMembers += '<div class="content quote"></div><ul class="list-unstyled">';

        $.each(data, function (k, v) {

            strMembers += '<li><a href="assets/resources/msg_attachments/'+v.filename+'">' +
                '<span>' + v.filename + '</span></a><br>' +
                '<div class="clearfix"></div> </li>'
        });
        strMembers += ' </ul>';
        $('#files-row-data-outlet').html(strMembers);
    };


    $('#message_group_form')
        .form({
            onSuccess: function (event, fields) {
                event.preventDefault();
                group.messageGroup();
                $('#message_group_form')[0].reset();
            }
        });


    this.messageGroup = function () {
        var group_id = $("#group_id").val();
        var files = $("#attachedFiles").val();
        files = files ? JSON.parse(files) : '';
        var message = $("#group_message_text").val();
        var data = {
            "function": "sendMessageRevised",
            "message": message,
            "sent_to": group_id,
            "attached_files": files,
            "message_type": "group"
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            $('#group_message_text').removeClass('hidden');
            $("#attachedFiles").val('');
            $("#file_upload_list").html('');
            $('#message_group_form')[0].reset();
            window.fileNamesArray = [];
            group.fetchGroupMessages(group_id);
            group.fetchGroupFiles(group_id);
        });
    };


    this.getUserAccounts = function () {

        var data = {
            "function": "fetchAllAccountsConnected"
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            if (response.status === 'success') {
                var data = response.data;
                var strAllMembers = '';
                // // console.log(myProfileData);
                $.each(data, function (k, v) {
                    strAllMembers += '<option value="' + v.login_id + '">' + v.firstname + ' ' + v.lastname + ' (' + v.position + ' at ' + v.company + ')</option>'
                });
                $('#search_member').html(strAllMembers);
            }
        });

    };
}).apply(group);

group.onReady();

// Table search
$(function () {

    $.extend($.expr[':'], {
        'containsi': function (elem, i, match, array) {
            return (elem.textContent || elem.innerText || '').toLowerCase()
                .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
    });

    $("#groupTableSearch").keyup(function () {
        var query = $(this).val();
        $('#group_table_list .rw:not(:containsi(' + query + '))').hide();
        $('#group_table_list .rw:containsi(' + query + ')').show();
    });
});
