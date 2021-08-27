var sendRequest = sendRequest || {};
(function () {

    this.postJSON = function (dataObject, targeturl, callback) {
        //$.blockUI({ message: '<h4><img src="../images/ajax-loader.gif" /></h4>' });
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
                //console.log(data);
                // $.unblockUI();
                NProgress.done();
                callback(data);
                return true;

            },
            complete: function () {
            },
            error: function (xhr, textStatus, errorThrown) {
                //console.log('ajax loading error...');
                //$.unblockUI();
                NProgress.done();
                return false;

            }
        });
    }
}).apply(sendRequest);


$(document).ready(function () {
    $(".search_link").on("click", function () {
        var query = $("#search_input").val();
        if (query.length) {
            $.redirect('search.php', {'query': query});
        }
    });
});

