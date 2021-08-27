var login = login || {};
(function () {
    this.ready = function () {

    }
    this.onLogin = function () {
        var data = {
            "function": "getLogin",
            "email": $("#login_email").val(),
            "password": $("#login_password").val()
        };
        // console.log(data);
        sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
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
                $.redirect('landing.php', {'response': JSON.stringify(response)});

            } else {
                //invalid login
                $(".ui.error.message").text(response.message);
                $(".ui.error.message").css("display", "block");

            }

        });

    }

}).apply(login);