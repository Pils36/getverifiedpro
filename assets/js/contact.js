var contact = contact || {};
(function () {
    this.onReady = function () {
        $("#contact_type").dropdown();
        $('#contact_form')
            .form({
                fields: {
                    contactType: {
                        identifier: 'contact_type',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please select an option'
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
                    subject: {
                        identifier: 'subject',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter a subject'
                            }
                        ]
                    },
                    message: {
                        identifier: 'message',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please type a message'
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
                    }
                },
                onSuccess: function (event, fields) {
                    event.preventDefault();
                    contact.sendMessage();
                }
            });
    },
        this.sendMessage = function () {

            var data = {
                "function": "contactUs",
                "type": $("#contact_type").val(),
                "firstname": $("#contact_firstname").val(),
                "lastname": $("#contact_lastname").val(),
                "email": $("#contact_email").val(),
                "message": $("#contact_message").val(),
                "subject": $("#contact_subject").val(),
            };
            $.blockUI();
            sendRequest.postJSON(data, "controller/app.php", function (response) {

                //var parse = JSON.parse(response);
                //alert(JSON.parse(response));
                $("#contact_response").html("<p style='text-align:center; color:red;'>" + response.message + "</p>");
                $.unblockUI();
                if (response.message === $.trim("Thank you for contacting us. You message will be treated appropriately")) {
                    $('#contact_form')[0].reset();
                }


            });

        }
}).apply(contact);


contact.onReady();