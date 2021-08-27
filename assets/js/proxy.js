var myProfileData;
var sendRequest = sendRequest || {};
(function () {

    this.onReady = function () {
        this.checkLogin();
        $('#search-form')
            .form({
                onSuccess: function (event, fields) {
                    event.preventDefault();
                    var query = $("#search_input").val();
                    if (query.length) {
                        $.redirect('search', {'query': query});
                    }
                }
            });
        NProgress.start();
        this.navDataLoad();
        NProgress.done();
    };



    this.postJSON = function (dataObject, targeturl, callback) {
        //$.blockUI({ message: '<h4><img src="assets/images/ajax-loader.gif" /></h4>' });
        NProgress.start();
        $.ajax({
            type: "POST",
            url: targeturl,
            // beforeSend: function(request){
            //    request.setRequestHeader('Authorization', 'Bearer ' + myApp.JWT);
            // },
            data: {"json": JSON.stringify(dataObject)},
            dataType: 'json',
            success: function (data) {
                //// console.log(data);
                // $.unblockUI();
                NProgress.done();
                callback(data);
                return true;

            },
            complete: function () {
            },
            error: function (xhr, textStatus, errorThrown) {
                //// console.log('ajax loading error...');
                //$.unblockUI();
                NProgress.done();
                return false;

            }
        });
    };

    this.navDataLoad = function () {

        //fetch user info
        var profileData = {
            "function": "fetchUserInfo"
        };

        sendRequest.postJSON(profileData, "controller/app.php", function (response) {

            if (response.status === 'success') {
                var parse = response;
                var photo = "assets/resources/pics/" + parse.data.profile[0].photo;
                var name = (parse.data.profile[0].lastname + " " + parse.data.profile[0].firstname).toUpperCase();
                $(".profile_picture").attr("src", photo);
                var profession = "";
                if (parse.data.profile[0].profession) {
                    profession = parse.data.profile[0].profession + " at " + parse.data.profile[0].company;
                }
                $("#profile_current_position").text(profession.toUpperCase());
                $("#profile_name").text(name);

                $("#profile_validations").text(parse.data.stats.vals);
                $("#profile_views").text(parse.data.stats.views);
                $("#profile_messages").text(parse.data.stats.msgs);
                $("#profile_groups").text(parse.data.stats.groups);
                $("#profile_connections").text(parse.data.stats.cons);
        

                if (parse.data.subscription.active === "0") {
                    // $(".profile_menu").prepend(' <li class="btn btn-success item"><a href="upgrade" class="ui positive button">Upgrade</a></li>');
                }

                window.myProfileData = parse.data.profile[0];
            }
        });

        $(".Site-content").show();
        // fetch user info

        $('.ui.dropdown').dropdown();


        $(".profile_link").on("click", function () {
            view = $(this).data("view");
            // check for active subscription before redirect
            var data = {
                "function":"getActiveSubscription",
                "view":view
            };
            sendRequest.postJSON(data, "controller/app.php", function (response) {
                if ((response.message).trim() === "inactive") {
                    alert("This feature is available to paid subscription only. Please upgrade your subscription")
                    return;
                }else{
                    $.redirect(view, {"fromNav": "1"});
                }
            });

        });


        $("[data-view='logout']").on("click", function () {
            var data = {
                "function": "logout"
            };
            sendRequest.postJSON(data, "controller/app.php", function (response) {
                if ((response.message).trim() === "successful") {
                    $.redirect('home');
                }
            });
        });

    };

}).apply(sendRequest);


sendRequest.checkActiveSub = function(view){
    alert(view);
};


sendRequest.checkLogin = function () {
    //confirm login
    var data = {
        "function": "isLoggedIn"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        if (response.message != 1) {
            // window.location.href = 'account';
        } else if (response.data && response.data.subscription === "inactive") {
            // console.log(response.data.subscription);
            $('#upgrade_btn').removeClass('hidden');
        }
    });

};

sendRequest.onReady();
