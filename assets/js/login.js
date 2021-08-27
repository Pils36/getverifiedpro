var login = login || {};
(function () {
    this.onReady = function () {

        $('#login_form').form({
            fields: {

                email: {
                    identifier: "login_email",
                    rules: [
                        {
                            type: 'email',
                            promt: 'Please enter a valid email address'
                        }
                    ]
                },
                password: {
                    identifier: "login_password",
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter you password'
                        }
                    ]
                }
            },
            onSuccess: function (event, fields) {
                event.preventDefault();
                login.onLogin();
            }
        });
    };
    this.onLogin = function () {
        var data = {
            "function": "getLogin",
            "email": $("#login_email").val(),
            "password": $("#login_password").val()
        };
        // // console.log(data);

        $(".ui.error.message").text();
        $(".ui.error.message").css("display", "none");
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            $(".ui.error.message").text();
            $(".ui.error.message").css("display", "none");
            if (response.data !== null) {
                //valid login
                //alert(response.message);
                //$.redirect('profile.html', {'stages': menu});
                //store.setJWT(response.data.jwt);
                //trigger profile page
                //$("[data-view='profile']").trigger("click");
                //redirect to profile page
                $.redirect('home', {'response': JSON.stringify(response)});

            } else {
                //invalid login
                $(".ui.error.message").text(response.message);
                $(".ui.error.message").css("display", "block");

            }

        });

    }

}).apply(login);
login.onReady();