var signup = signup || {};
(function () {
    this.onReady = function () {
        // $("#signup_businessname").val("-");
        // $("#signup_firstname").val("-");
        // $("#signup_lastname").val("-");
        $('.ui.dropdown').dropdown({
            onChange: function (value, text, $choice) {
                //alert(value);
                if (value == 1) {
                    $("#business_name").css("display", "none");
                    // $("#signup_form").form('set value', 'business-name', '-');
                    // $("#signup_businessname").val("-");
                    $("#signup_firstname").val("");
                    $("#signup_lastname").val("");

                    $("#individual_name").css("display", "block");
                } else if (value == 2) {
                    $("#business_name").css("display", "block");
                    // $("#signup_form").form('set value', 'first-name', '-');
                    // $("#signup_form").form('set value', 'last-name', '-');
                    $("#signup_businessname").val("");
                    // $("#signup_firstname").val("-");
                    // $("#signup_lastname").val("-");
                    $("#individual_name").css("display", "none");
                }
            }
        });
        $('#signup_form')
            .form({
                fields: {
                    accountType: {
                        identifier: 'select_type',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please select type of account'
                            }
                        ]
                    },
                    businessName: {
                        identifier: 'business-name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter your Business Name'
                            }
                        ]
                    },
                    firstName: {
                        identifier: 'first-name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter your first name'
                            }
                        ]
                    },
                    lastName: {
                        identifier: 'last-name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter your last name'
                            }
                        ]
                    },
                    profession: {
                        identifier: 'signup_profession',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter your profession'
                            }
                        ]
                    },
                    industry: {
                        identifier: 'industry',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please select your industry'
                            }
                        ]
                    },
                    city: {
                        identifier: 'signup_city',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter your city'
                            }
                        ]
                    },
                    country: {
                        identifier: 'country',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please select your country'
                            }
                        ]
                    },
                    email: {
                        identifier: "email",
                        rules: [
                            {
                                type: 'email',
                                promt: 'Please enter a valid email address'
                            }
                        ]
                    },
                    password: {
                        identifier: "create-password",
                        rules: [
                            {
                                type: 'minLength[8]',
                                prompt: 'Your password must be at least {ruleValue} characters'
                            }
                        ]
                    },

                    confirm_password: {
                        identifier: "confirm-password",
                        rules: [
                            {
                                type: "match[create-password]",
                                prompt: "Passwords do not match"
                            }
                        ]
                    },
                    terms: {
                        identifier: 'terms',
                        rules: [
                            {
                                type: 'checked',
                                prompt: 'You must agree to the terms and conditions'
                            }
                        ]
                    }
                },
                onSuccess: function (event, fields) {
                    event.preventDefault();
                    signup.signUp();
                }
            });
    },
        this.signUp = function () {
            var data = {
                "function": "signUp",
                // "type":$("#select_type").val(),
                // "business":$("#signup_businessname").val(),
                "firstname": $("#signup_firstname").val(),
                "lastname": $("#signup_lastname").val(),
                "email": $("#signup_email").val(),
                "password": $("#signup_password").val(),
                "profession": $("#signup_profession").val(),
                "industry": $("#industry").val(),
                "city": $("#signup_city").val(),
                "country": $("#country").val()
            }
            sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
                //var parse = JSON.parse(response);
                //alert(JSON.parse(response));
                $("#signup_response").html("<p style='text-align:center; color:red;'>" + response.data.response + "</p>");
                if (response.data.response == $.trim("A verification email has been sent to you")) {
                    $('#signup_form')[0].reset();
                }


            });
        }
}).apply(signup);


signup.onReady();