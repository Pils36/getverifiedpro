var blog = blog || {};

blog.ready = function () {
    $(document).ready(function () {
        var data = {
            "function": "getBlog"
        };
        sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
            //console.log(response.data);
            var strBlog = strAside = "";
            $.each(response.data, function (v, k) {
                strBlog += "<div class='ui vertical segment'> <h2 class='ui header'> <a name='" + k.id + "'>" + k.title + "</a> <div class='sub header'>" + k.date_posted + "</div> </h2>" + k.content + "</p> </div>";
                strAside += "<a class='item' href='#" + k.id + "'>" + k.title + "</a>";
            });
            $("article").html(strBlog);
            $("#blog_titles").html(strAside);


        });
    });

}


blog.ready();