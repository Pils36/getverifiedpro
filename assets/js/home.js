var home = {} || home;

home.ready = function(){
	// fetch recent posts
	var data = {
                "function": "recentPosts",
            };
            sendRequest.postJSON(data, "controller/app.php", function (response) {
            	var strPro = "";
            	var  strPosts = "";
            	var strInf = "";
            	if(response.status =="success"){
            		if(response.data.profiles){
            			//populate recently viewed profiles
            			$.each(response.data.profiles, function (v, k) {
            				strPro += "<div class='item'><img class='ui avatar image' alt='' src='assets/resources/pics/"+k.photo+"'><div class='content'><div class='header'><a class='ui blue small member_link' data-id='" + k.login_id + "' data-source='search'>"+k.firstname.toProperCase()+" "+k.lastname.toProperCase()+"</a></div><span style='color:#072902'>"+k.profession+" | "+k.country+"</span></div></div>";
            			});
            			$("#pro_list").html(strPro);
            			$("#pro_segment").removeClass("loading");
            			$(".member_link").on("click", function () {
				            //search.member(this);
				            $.redirect("member", {id: $(this).data("id"),source:$(this).data("source")}, "post");
				        });
            		}else{
            			//no recently viewed profile
            			$("#pro_list").html("<p></p>");
            		}
            		if(response.data.posts){
            			//recent opportunities
            			$.each(response.data.posts, function (v, k) {
            				strPosts += "<div class='item'><div class='content'><div class='header'><a class='ui blue small opportunity_link' data-id='" + k.id + "' data-source='search'>"+k.subject.toProperCase()+"</a></div><span style='color:red'>Location:</span> "+k.location.toProperCase()+" | <span style='color:red'>Closes:</span> "+k.deadline+"</div></div>";
            			});
            			$("#post_list").html(strPosts);
            			$("#post_segment").removeClass("loading");
            			$(".opportunity_link").on("click", function () {
				            //search.member(this);
				            $.redirect("posts", {id: $(this).data("id"),source:$(this).data("source")}, "post");
				        });
            		}else{
            			//no recent opportunity
            		}
            		
            // 		Influence
            
            if(response.data.influencers){
            			//populate recently viewed profiles
            			$.each(response.data.influencers, function (v, k) {
            			    console.log(k);
            				strInf += "<div class='item'><img class='ui avatar image' alt='' src='assets/resources/pics/"+k.photo+"'><div class='content'><div class='header'><a class='ui blue small member_link' data-id='" + k.id + "' data-source='search'>"+k.firstname.toProperCase()+" "+k.lastname.toProperCase()+"</a></div><div style='width: 200px;'><span style='color:#139f5e !important; font-size: 12px'>"+k.company+"</span></div><div ><span style='font-size: 12px; color: #98273d !important'># of imported contacts: "+k.NO+"</span></div></div></div>";
            			});
            			$("#influencer_list").html(strInf);
            			$("#influencer_segment").removeClass("loading");
            			$(".member_link").on("click", function () {
				            //search.member(this);
				            $.redirect("member", {id: $(this).data("id"),source:$(this).data("source")}, "post");
				        });
            		}else{
            			//no recently viewed profile
            			$("#influencer_list").html("<p></p>");
            		}
            		
            	}else{
            		//response.status == failed
            	}
            });
}



home.ready();

String.prototype.toProperCase = function () {
    return this.replace(/\w\S*/g, function (txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
};