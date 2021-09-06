var invites = invites || {};

var group = group || {};

var project = project || {};

var landing = landing || {};


(function () {

    this.ready = function () {
        //fetch page contents
        NProgress.start();
        var data = {
            "function": "fetchLanding"
        };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
            
            // console.log(response.data.suggestions);

            
            if (response.status === "success") {
                landing.blogTemplate(response.data.blogposts);
                landing.opportunityTemplate(response.data.opportunities);
                landing.suggestionTemplate(response.data.suggestions);
                landing.onlineConnection(response.data.onlineConnection);
                landing.profileview(response.data.profileview);
                landing.profileviewnow(response.data.profileviewnow);
                landing.subscriber(response.data.subscriber);
                landing.group(response.data.group);
                landing.project(response.data.project);
            }


        });
        NProgress.done();

    },
    
    invites.redirectProfile = function (gift) {
        // console.log(gift);
        $.redirect("member", {id: $(gift).data("account")}, "post");
    },
    
    // Subscribed users
    this.subscriber = function(data){
        // console.log(data);
    },
    
    // Show who viewed my profile
    this.profileviewnow = function(data){
        // console.log(1);
        
        // if(this.subscriber == "success"){
        //     console.log(2);
        // }
        // else{
        //     console.log(3);
        // }
    },
    
    // Show view status
    this.profileview = function(data){

        console.log(data);
        
        // if(!data.length){
        //     iziToast.show("No connection online!");
        // }
        // if(data.length){
        //         iziToast.warning({
        //             title: 'Profile view',
        //             iconUrl: 'https://img.icons8.com/cotton/64/000000/view-file.png',

        //             message: ' You have '+data.length+' profile views',
        //             timeout: 25000,
        //             transitionIn: 'fadeInDown',
        //             transitionOut: 'fadeOutRight',
                    
        //             // buttons: [
        //             //     ['<button style="background-color: #fff; color: green">View</button>', function (instance, toast) {
        //             //         window.location.replace("https://www.pro-filr.com/profile_view");
        //             //     }, true],
        //             // ],
        //         });
        //     }
        
        
    },
    

    
    // Professional Group
    this.group = function (data) {
            if (!data.length) {
                $("#group_list").html(landing.emptyResponse);
                return;
            }
            var strPosts = "<div class='ui comments'>";
            $.each(data, function (v, k) {
                // console.log(k);
                // strPosts += "<div class='comment'> <div class='content'> <a class='subject'>" + k.title + "</a> <div class='metadata'> <div class='date'>" + k.date_posted + "</div> <span class='reply green text'>" + k.comments + " Comments</span> </div> <div class='text'>" + k.summary + "</div> <div class='actions'> <a class='read'>Read</a> </div> </div> </div> <div class='ui divider'></div>";

                strPosts += "<div class='section-inner'>" +
                    "<h2 class='heading'> Group name: " + k.title + "</h2>" +
                    "<p>by: "+k.firstname+ ' ' +k.lastname+"<br/><br/><a style='cursor: pointer' class='more-link' onclick='invites.redirectProfile(this)' data-account='"+k.login_id+"'><img src='https://img.icons8.com/color/48/000000/add-user-group-man-man.png' style='width: 15px; height: 15px;'> Message Group Admin to Join</a></p></div>";
                    
                    
                            
            });
                    
                    
            strPosts += "</div>";
            $("#group_list").html(strPosts);


        },
        
        
        // Ongoing Projects
    this.project = function (data) {
            if (!data.length) {
                $("#project_list").html(landing.emptyResponse);
                return;
            }
            var strPosts = "<div class='ui comments'>";
            $.each(data, function (v, k) {
                // console.log(k);
                // strPosts += "<div class='comment'> <div class='content'> <a class='subject'>" + k.title + "</a> <div class='metadata'> <div class='date'>" + k.date_posted + "</div> <span class='reply green text'>" + k.comments + " Comments</span> </div> <div class='text'>" + k.summary + "</div> <div class='actions'> <a class='read'>Read</a> </div> </div> </div> <div class='ui divider'></div>";

                strPosts += "<div class='section-inner'>" +
                    " <h2 class='heading'> <img src='https://img.icons8.com/color/48/000000/ms-project.png' style='width: 20px; height: 20px'> " + k.title + "</h2>" +
                    "<p><a class='more-link' href='viewproject'><i class='fa fa-external-link'></i> View More</a></p></div>"
            });
            strPosts += "</div>";
            $("#project_list").html(strPosts);


        },
        
    
    
    
    
    // Show online connections
    this.onlineConnection = function (data){
        
        if(!data.length){
            // iziToast.show("No connection online!");
        }
        
        $.each(data, function(v,k){
            // console.log(data);
            // console.log(k);
            // if Online
            if(k.online_status == 1){
                iziToast.success({
                    title: 'Connection',
                    icon: '',

                    message: ' '+k.firstname+' '+k.lastname+' is online',
                    timeout: 25000,
                    transitionIn: 'fadeInDown',
                    transitionOut: 'fadeOutRight',
                    image: 'assets/resources/pics/' + k.photo + ' ',
                    buttons: [
                        ['<button data-account="' + k.login_id + '" style="background-color: #fff; color: green" onclick="invites.redirectProfile(this)">Connect</button>', function (instance, toast) {}, true],
                    ],
                });
            }
        });
    },
    

        this.suggestionTemplate = function (data) {
            // console.log(data);
            if (!data.length) {
                $("#suggestion_list").html(landing.emptyResponse);
                return;
            }
            var strPosts = "";
            $.each(data, function (v, k) {
                // console.log(k.length);
                
                // console.log(k.online_status == 1);
                var dateString = k.last_seen;
dateString = new Date(dateString).toUTCString();
dateString = dateString.split(' ').slice(0, 4).join(' ');
// console.log(dateString);
                
                
                if(k.online_status == 1){
                    strPosts += '<li><a onclick="landing.redirectProfile(this)"  data-account="' + k.login_id + '"><span><img alt ="" src="assets/resources/pics/' + k.photo + '"><img src="https://img.icons8.com/color/48/000000/id-verified.png" style="width: 16px; height:16px; position: relative; top: 15px;left:-10px; right:0px;bottom:0px;"></span>' + k.firstname + ' ' + k.lastname + '<span><br> -' + k.profession +'</span><span><br>' + k.in_common + '</span></a></li>';
                    
                    iziToast.success({
                        title: 'Professional you may know,',
                        icon: '',
    
                        message: ' '+k.firstname+' '+k.lastname+' is online',
                        timeout: 25000,
                        transitionIn: 'fadeInDown',
                        transitionOut: 'fadeOutRight',
                        image: 'assets/resources/pics/' + k.photo + ' ',
                        buttons: [
                            ['<button data-account="' + k.login_id + '" style="background-color: #fff; color: green" onclick="invites.redirectProfile(this)">Connect</button>', function (instance, toast) {}, true],
                        ],
                    });
                }
                else{
                    strPosts += '<li><a onclick="landing.redirectProfile(this)"  data-account="' + k.login_id + '"><span><img alt ="" src="assets/resources/pics/' + k.photo + '"><img src="https://img.icons8.com/color/48/000000/id-not-verified.png" style="width: 16px; height:16px; position: relative; top: 15px;left:-10px; right:0px;bottom:0px;"></span>' + k.firstname + ' ' + k.lastname + '<span><br>' + k.in_common + '</span><br><span style="font-size: 11px; color: #9d9d9d">Last seen: '+dateString+'</span></a></li>';
                }
                
                
                
                
                
            });
            strPosts += "";
            $("#suggestion_list").html(strPosts);

        },

        this.redirectProfile = function (gift) {
            $.redirect("member", {id: $(gift).data("account")}, "post");
        };

    this.opportunityTemplate = function (data) {
        if (!data.length) {
            $("#opportunity_list").html("<section class='projects section'><div class='section-inner'>" +
                "<h2 class='heading sr-only'></h2>" +
                "<div class='content'><div class='item'>" +
                "<h3 class='title'><span class='date'>No posted opportunity can be found at the moment</span></h3>" +
                "</div></div></div></section>");
            return;
        }
        var strPosts = "";
        $.each(data, function (v, k) {

            strPosts += "<section class='projects section'><div class='section-inner'>" +
                "<h2 class='heading sr-only'>" + k.subject + "</h2>" +
                "<div class='content'><div class='item'>" +
                "<h3 class='title'><a href='#'>" + k.subject + "</a><br><span class='date'>Deadline: " + k.deadline + ", Location: " + k.location + "</span></h3>" +
                "<div class='clearfix'></div> <p class='summary'>" + k.description + "</p>" +
                "<p><a class='more-link' href='posts'><i class='fa fa-external-link'></i> View</a></p>" +
                "</div></div></div></section><!--//section-->";
        });
        strPosts += "";
        $("#opportunity_list").html(strPosts);

    },

        this.blogTemplate = function (data) {
            if (!data.length) {
                $("#blog_list").html(landing.emptyResponse);
                return;
            }
            var strPosts = "<div class='ui comments'>";
            $.each(data, function (v, k) {
                // strPosts += "<div class='comment'> <div class='content'> <a class='subject'>" + k.title + "</a> <div class='metadata'> <div class='date'>" + k.date_posted + "</div> <span class='reply green text'>" + k.comments + " Comments</span> </div> <div class='text'>" + k.summary + "</div> <div class='actions'> <a class='read'>Read</a> </div> </div> </div> <div class='ui divider'></div>";

                strPosts += "<div class='section-inner'>" +
                    "<h2 class='heading'>" + k.title + "</h2>" +
                    "<p><a class='more-link' href='blog'><i class='fa fa-external-link'></i> Read More</a></p></div>"
            });
            strPosts += "</div>";
            $("#blog_list").html(strPosts);


        },

        this.emptyResponse = "<div class='ui comments'><div class='comment'><div class='text'>No record found</div> </div></div>";


}).apply(landing);

landing.ready();