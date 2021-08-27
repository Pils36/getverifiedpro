var myApp = myApp || {};
(function () {
    var self = this;
    var environment = "development";
    this.origin = function () {
        appRoot = location.origin;
        if (environment === "production") {
            return appRoot.toString() + "/?";
        } else {
            return appRoot.toString() + "/profilr/?";
        }
    },
        //var environment = "production";
        this.setJWT = function (data) {
            this.JWT = data;
        },
        this.onReady = function () {
            //alert("welcome");

            $(".nav_link").on("click", function () {
                // if($(this).data("view")=="profile" && (store.getJWT()===null)){
                //     $("[data-view='login']").trigger("click");
                //     return;
                // }
                if ($(this).data("view") === "profile") {
                    $.redirect('profile');
                    return;
                }
                page = $(this).data("page");
                view = $(this).data("view");
                $(".Site-content").load("templates/" + page + "_shell.html", function () {

                    if (page === "profile") {
                        view = view + ".php"
                    } else {
                        view = view + ".html"
                    }
                    $("spcontent").load("templates/" + view, function () {
                        $("footer").load("templates/footer.html");
                    });
                });


            });

            $(".signup").on("click", function () {
                self.loadSignup();
                //$("#signup_modal").modal("show");
            });

            $('.ui.modal').modal('setting', 'closable', false);

        },

        this.loadSignup = function () {
            $("#signup_content").load("templates/signup.html", function () {
                $("#signup_modal").modal("show");
            });
        },

        this.signUp = function () {
            var data = {
                "function": "signUp",
                "type": $("#select_type").val(),
                "business": $("#signup_businessname").val(),
                "firstname": $("#signup_firstname").val(),
                "lastname": $("#signup_lastname").val(),
                "email": $("#signup_email").val(),
                "password": $("#signup_password").val()
            };
            sendRequest.postJSON(data, "controller/app.php", function (response) {
                //var parse = JSON.parse(response);
                //alert(JSON.parse(response));
                $("#signup_response").html("<p style='text-align:center; color:red;'>" + response.message + "</p>");


            });


            //

        },

        this.onLogin = function () {
            var data = {
                "function": "getToken",
                "email": $("#login_email").val(),
                "password": $("#login_password").val()
            };
            sendRequest.postJSON(data, "controller/app.php", function (response) {
                $(".ui.error.message").text();
                $(".ui.error.message").css("display", "none");
                if (response.data != null) {
                    //valid login
                    //alert(response.message);
                    //$.redirect('profile.html', {'stages': menu});
                    //store.setJWT(response.data.jwt);
                    //trigger profile page
                    //$("[data-view='profile']").trigger("click");
                    //redirect to profile page
                    $.redirect('profile', {'token': response.data.jwt});

                } else {
                    //invalid login
                    $(".ui.error.message").text(response.message);
                    $(".ui.error.message").css("display", "block");

                }

            });

        }
}).apply(myApp);