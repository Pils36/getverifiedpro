var landing = landing || {};
(function () {
    this.ready = function () {
        //fetch page contents
        NProgress.start();
        var data = {
            "function": "fetchLanding"
        };
        sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
            if (response.status == "success") {
                landing.blogTemplate(response.data.blogposts);
                landing.opportunityTemplate(response.data.opportunities);
            }


        });
        NProgress.done();

    },

        this.opportunityTemplate = function (data) {
            if (!data.length) {
                $("#opportunity_list").html(landing.emptyResponse);
                return;
            }
            var strPosts = "<div class='ui comments'>";
            $.each(data, function (v, k) {
                strPosts += "<div class='comment'> <div class='content'> <a class='subject'>" + k.subject + "</a> <div class='metadata'> <div class='date'>Deadline: " + k.deadline + "</div> <div class='reply'> Location: " + k.location + "</div> </div> <div class='text'>" + k.description + "</div> <div class='actions'> <a class='read'>View</a> </div> </div> </div> <div class='ui divider'></div>";
            });
            strPosts += "</div>";
            $("#opportunity_list").html(strPosts);

        },

        this.blogTemplate = function (data) {
            if (!data.length) {
                $("#blog_list").html(landing.emptyResponse);
                return;
            }
            var strPosts = "<div class='ui comments'>";
            $.each(data, function (v, k) {
                strPosts += "<div class='comment'> <div class='content'> <a class='subject'>" + k.title + "</a> <div class='metadata'> <div class='date'>" + k.date_posted + "</div> <span class='reply green text'>" + k.comments + " Comments</span> </div> <div class='text'>" + k.summary + "</div> <div class='actions'> <a class='read'>Read</a> </div> </div> </div> <div class='ui divider'></div>";
            });
            strPosts += "</div>";
            $("#blog_list").html(strPosts);


        },

        this.emptyResponse = "<div class='ui comments'><div class='comment'><div class='text'>No record found</div> </div></div>";


}).apply(landing);

landing.ready();