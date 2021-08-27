var company = {} || company;
company.ready = function () {
    $("#search_bar").remove();
    $("#company_detail").load("views/modals/company.html", function () {
        //pill company details
        //fetch details and display on form
        var data = {
            "function": "editRecord",
            "content": "company",
            "ref": ""

        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            var response = response;
            var buffer = buffer2 = "<option value=''></option>";
            var data = {
                "function": "fetchIndustries"
            };
            sendRequest.postJSON(data, "controller/app.php", function (response2) {
                var parse = response2;
                $.each(parse.data, function (v, k) {
                    buffer2 += "<option value='" + k.industry + "'>" + k.industry + "</option>";
                });

                $("#industry").html(buffer2);


                $.each(response.data.years, function (v, k) {
                    buffer += "<option value='" + k.year + "'>" + k.year + "</option>"
                });
                $("#year_founded").html(buffer);
                $.each(response.data.rows, function (v, k) {
                    if (v === "id") {
                        $("form").prepend("<input type='hidden' id = '" + v + "' name='" + v + "' value='" + k + "'>");
                    } else {
                        $("form").find("#" + v).val(k).change();
                    }
                });
                $('select').dropdown();
                $(".Site-content").show();
                $("#company_btn").on("click", function () {
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
                        alert(message);
                    });
                });
            });


        });


    });
};
company.ready();