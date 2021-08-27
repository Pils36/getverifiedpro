$(document).ready(function () {
    //$("spcontent").load("views/home.html");
    //myRouter.onLoad();
    myApp.onReady();

    $(".Site-content").load("views/index_shell.html", function () {
        var page = getUrlParameter("page");
        if (page == "login") {
            $("spcontent").load("views/login.html", function () {
                $("footer").load("views/footer.html");
            });
            return;
        }
        $("spcontent").load("views/home.html", function () {
            $("footer").load("views/footer.html");
        });
        //$("[data-view='home']")[0].click();
    });


    //myRouter.navigate();
});

function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};