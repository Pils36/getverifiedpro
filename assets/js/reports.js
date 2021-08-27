var reports = reports || {};

reports.ready = function () {
    $(".upgrade").hide();
    $("select").dropdown();

    reports.fetchUsersReports();


    $(".admin_link").on("click", function () {
        $(".admin_link").removeClass('active');
        $(this).addClass("active");
        var type = $(this).data("type");
        $(".admin_segment").hide();
        $("#" + type + "_segment").show();
        // // // console.log(type);
        switch (type) {
            case "users":
                reports.fetchUsersReports();
                break;
            case "profiles":
                reports.fetchProfilesReports();
                break;
            case "growth":
                reports.fetchGrowthReports();
                break;
            case "validation":
                reports.fetchValidationReports();
                break;
            case "utilisation":
                reports.fetchUtilisationReports();
                break;
            default:
                break;
        }
    });
};


$('#validation_date_range_form')
    .form({
        onSuccess: function (event, fields) {
            event.preventDefault();
            reports.filterValidations();
        }
    });


reports.filterValidations = function () {
    var v_start_date = $("#v_start_date").val();
    var v_end_date = $("#v_end_date").val();

    reports.fetchValidationReports(v_start_date, v_end_date);
};

$('#utilisation_date_range_form')
    .form({
        onSuccess: function (event, fields) {
            event.preventDefault();
            reports.filterUtilisation();
        }
    });


reports.filterUtilisation = function () {
    var u_start_date = $("#u_start_date").val();
    var u_end_date = $("#u_end_date").val();

    reports.fetchUtilisationReports(u_start_date, u_end_date);
};

reports.fetchUsersReports = function () {
    // // // // console.log('got here');
    var data = {
        "function": "fetchUsersReports"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response){
        var strMsg = '';
        if (response.status === "success") {

            var otherTables = [];
            if (response.data.length) {

                // // // console.log(response.data);
                strMsg += "<table class='ui striped table report_data_table'> <thead> <tr> <th>#</th><th>METRIC NAME</th> <th>VALUE</th></tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
                    // // console.log(typeof k);
                    if(typeof k.value === 'object'){
                        // // // console.log(k);
                        if(k.value){
                            otherTables.push({name: k.name, value: k.value});
                        }
                    }else{
                        strMsg += "<tr><td>" + (v + 1) + "</td><td>" + k.name + "</td><td>" + k.value + "</td></tr>";
                    }

                });
                strMsg += "</tbody></table>";

                if(otherTables.length){
                    // // // console.log(otherTables);
                    $.each(otherTables, function (k1, v1) {
                        // console.log(v1);
                        strMsg += '<h3>'+v1.name+'</h3>';
                        strMsg += "<table class='ui striped table report_data_table'> <thead> <tr> ";

                        var keys = [];
                        if(v1.value.length){
                            keys = Object.keys(v1.value[0]);
                        }
                        // // console.log(keys);

                        $.each(keys, function (k2, v2) {
                            strMsg += '<th>'+v2.toUpperCase()+'</th>';
                        });

                        strMsg += "</tr> </thead> <tbody>";
                        $.each(v1.value, function (k3, v3) {
                            strMsg += '<tr>';
                            $.each(keys, function (k2, v2) {
                                strMsg += '<td>'+v3[v2]+'</td>';
                            });
                            strMsg += '</tr>';
                        });
                        strMsg += "</tbody></table>";
                    });
                }
            } else {
                strMsg = "<p>No Report</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }

        // // // console.log(strMsg);
        $("#users_content").html(strMsg);
    });
};

reports.fetchProfilesReports = function () {
    // // // // console.log('got here');
    var data = {
        "function": "fetchProfilesReports"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response){
        var strMsg = '';
        if (response.status === "success") {

            var otherTables = [];
            if (response.data.length) {

                // // // console.log(response.data);
                strMsg += "<table class='ui striped table report_data_table'> <thead> <tr> <th>#</th><th>METRIC NAME</th> <th>VALUE</th></tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
                    // // console.log(typeof k);
                    if(typeof k.value === 'object'){
                        // // // console.log(k);
                        if(k.value){
                            otherTables.push({name: k.name, value: k.value});
                        }
                    }else{
                        strMsg += "<tr><td>" + (v + 1) + "</td><td>" + k.name + "</td><td>" + k.value + "</td></tr>";
                    }

                });
                strMsg += "</tbody></table>";

                if(otherTables.length){
                    // // // console.log(otherTables);
                    $.each(otherTables, function (k1, v1) {
                        // console.log(v1);
                        strMsg += '<h3>'+v1.name+'</h3>';
                        strMsg += "<table class='ui striped table report_data_table'> <thead> <tr> ";

                        var keys = [];
                        if(v1.value.length){
                            keys = Object.keys(v1.value[0]);
                        }
                        // // console.log(keys);

                        $.each(keys, function (k2, v2) {
                            strMsg += '<th>'+v2.toUpperCase()+'</th>';
                        });

                        strMsg += "</tr> </thead> <tbody>";
                        $.each(v1.value, function (k3, v3) {
                            strMsg += '<tr>';
                            $.each(keys, function (k2, v2) {
                                strMsg += '<td>'+v3[v2]+'</td>';
                            });
                            strMsg += '</tr>';
                        });
                        strMsg += "</tbody></table>";
                    });
                }
            } else {
                strMsg = "<p>No Report</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }

        // // // console.log(strMsg);
        $("#profiles_content").html(strMsg);
    });

};

reports.fetchGrowthReports = function () {
    // // // // console.log('got here');
    var data = {
        "function": "fetchGrowthReports"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response){
        var strMsg = '';
        if (response.status === "success") {

            var otherTables = [];
            if (response.data.length) {

                // // // console.log(response.data);
                strMsg += "<table class='ui striped table report_data_table'> <thead> <tr> <th>#</th><th>METRIC NAME</th> <th>VALUE</th></tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
                    // // console.log(typeof k);
                    if(typeof k.value === 'object'){
                        // // // console.log(k);
                        if(k.value){
                            otherTables.push({name: k.name, value: k.value});
                        }
                    }else{
                        strMsg += "<tr><td>" + (v + 1) + "</td><td>" + k.name + "</td><td>" + k.value + "</td></tr>";
                    }

                });
                strMsg += "</tbody></table>";

                if(otherTables.length){
                    // // // console.log(otherTables);
                    $.each(otherTables, function (k1, v1) {
                        // console.log(v1);
                        strMsg += '<h3>'+v1.name+'</h3>';
                        strMsg += "<table class='ui striped table report_data_table'> <thead> <tr> ";

                        var keys = [];
                        if(v1.value.length){
                            keys = Object.keys(v1.value[0]);
                        }
                        // // console.log(keys);

                        $.each(keys, function (k2, v2) {
                            strMsg += '<th>'+v2.toUpperCase()+'</th>';
                        });

                        strMsg += "</tr> </thead> <tbody>";
                        $.each(v1.value, function (k3, v3) {
                            strMsg += '<tr>';
                            $.each(keys, function (k2, v2) {
                                strMsg += '<td>'+v3[v2]+'</td>';
                            });
                            strMsg += '</tr>';
                        });
                        strMsg += "</tbody></table>";
                    });
                }
            } else {
                strMsg = "<p>No Report</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }

        // // // console.log(strMsg);
        $("#growth_content").html(strMsg);
    });

};

reports.fetchValidationReports = function (start_date = '', end_date = '') {
    // // // // console.log('got here');
    var data = {
        "function": "fetchValidationReports",
        'start_date': start_date,
        'end_date': end_date
    };
    sendRequest.postJSON(data, "controller/app.php", function (response){
        var strMsg = '';
        if (response.status === "success") {

            var otherTables = [];
            if (response.data.length) {

                // // // console.log(response.data);
                strMsg += "<table class='ui striped table report_data_table'> <thead> <tr> <th>#</th><th>METRIC NAME</th> <th>VALUE</th></tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
                    // // console.log(typeof k);
                    if(typeof k.value === 'object'){
                        // // // console.log(k);
                        if(k.value){
                            otherTables.push({name: k.name, value: k.value});
                        }
                    }else{
                        strMsg += "<tr><td>" + (v + 1) + "</td><td>" + k.name + "</td><td>" + k.value + "</td></tr>";
                    }

                });
                strMsg += "</tbody></table>";

                if(otherTables.length){
                    // // // console.log(otherTables);
                    $.each(otherTables, function (k1, v1) {
                        // console.log(v1);
                        strMsg += '<h3>'+v1.name+'</h3>';
                        strMsg += "<table class='ui striped table report_data_table'> <thead> <tr> ";

                        var keys = [];
                        if(v1.value.length){
                            keys = Object.keys(v1.value[0]);
                        }
                        // // console.log(keys);

                        $.each(keys, function (k2, v2) {
                            strMsg += '<th>'+v2.toUpperCase()+'</th>';
                        });

                        strMsg += "</tr> </thead> <tbody>";
                        $.each(v1.value, function (k3, v3) {
                            strMsg += '<tr>';
                            $.each(keys, function (k2, v2) {
                                strMsg += '<td>'+v3[v2]+'</td>';
                            });
                            strMsg += '</tr>';
                        });
                        strMsg += "</tbody></table>";
                    });
                }
            } else {
                strMsg = "<p>No Report</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }

        // // // console.log(strMsg);
        $("#validation_content").html(strMsg);
    });

};

reports.fetchUtilisationReports = function (start_date = '', end_date = '') {
    // // // // console.log('got here');
    var data = {
        "function": "fetchUtilisationReports",
        'start_date': start_date,
        'end_date': end_date
    };
    sendRequest.postJSON(data, "controller/app.php", function (response){
        var strMsg = '';
        if (response.status === "success") {

            var otherTables = [];
            if (response.data.length) {

                // // // console.log(response.data);
                strMsg += "<table class='ui striped table report_data_table'> <thead> <tr> <th>#</th><th>METRIC NAME</th> <th>VALUE</th></tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
                    // // console.log(typeof k);
                    if(typeof k.value === 'object'){
                        // // // console.log(k);
                        if(k.value){
                            otherTables.push({name: k.name, value: k.value});
                        }
                    }else{
                        strMsg += "<tr><td>" + (v + 1) + "</td><td>" + k.name + "</td><td>" + k.value + "</td></tr>";
                    }

                });
                strMsg += "</tbody></table>";

                if(otherTables.length){
                    // // // console.log(otherTables);
                    $.each(otherTables, function (k1, v1) {
                        // console.log(v1);
                        strMsg += '<h3>'+v1.name+'</h3>';
                        strMsg += "<table class='ui striped table report_data_table'> <thead> <tr> ";

                        var keys = [];
                        if(v1.value.length){
                            keys = Object.keys(v1.value[0]);
                        }
                        // // console.log(keys);

                        $.each(keys, function (k2, v2) {
                            strMsg += '<th>'+v2.toUpperCase()+'</th>';
                        });

                        strMsg += "</tr> </thead> <tbody>";
                        $.each(v1.value, function (k3, v3) {
                            strMsg += '<tr>';
                            $.each(keys, function (k2, v2) {
                                strMsg += '<td>'+v3[v2]+'</td>';
                            });
                            strMsg += '</tr>';
                        });
                        strMsg += "</tbody></table>";
                    });
                }
            } else {
                strMsg = "<p>No Report</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }

        // // // console.log(strMsg);
        $("#utilisation_content").html(strMsg);
    });

};

reports.ready();