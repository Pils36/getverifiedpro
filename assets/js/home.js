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
				var industry;
				var nature_of_business;
				var description;
				var business_name;
				var country;
				var email;
				var telephone;
				var website;
            	if(response.status =="success"){
            		if(response.data.cbd.status != 400){

						if(response.data.cbd.message == "No record"){
							$("#pro_list").html("<table><thead><tr><th>S/N</th><th>Industry</th><th>Nature of Business</th><th>Description of Business</th><th>Name of Firm</th><th>Contact Us</th><th>Location</th><th>Website</th></tr></thead><tbody><td colspan='8' style='text-align: center; color: red;'>"+response.data.cbd.message+"</td></tbody></table>");

							$("#pro_segment").removeClass("loading");
						}
						else{
							//populate Classified Business Directory
            			$.each(response.data.cbd.data, function (v, k) {

							if(k.industry != null){
								industry = k.industry;
							}
							else{
								industry = "-";
							}
							if(k.nature_of_business != null){
								nature_of_business = k.nature_of_business;
							}
							else{
								nature_of_business = "-";
							}
							if(k.description != null){
								description = k.description;
							}
							else{
								description = "-";
							}
							if(k.business_name != null){
								business_name = k.business_name;
							}
							else{
								business_name = "-";
							}
							if(k.country != null){
								country = k.country;
							}
							else{
								country = "-";
							}
							if(k.email != null){
								email = k.email;
							}
							else{
								email = "-";
							}
							if(k.telephone != null){
								telephone = k.telephone;
							}
							else{
								telephone = "-";
							}
							if(k.website != null){
								website = "<a href='http://"+k.website+"' target='_blank'>Visit</a>";
							}
							else{
								website = "-";
							}
							

            				strPro += "<tr><td>"+(v+1)+"</td><td>"+industry+"</td><td>"+nature_of_business+"</td><td>"+description.substring(0, 200)+"</td><td>"+business_name.substring(0, 40)+"</td><td><b>Email:</b> <a href='mailto:"+email+"'>"+email+"</a> <br> <b>Telephone:</b> <a href='tel:"+telephone+"'>"+telephone+"</a></td><td>"+country+"</td><td>"+website+"</td></tr>";
							
            				// strPro += "<div class='item'><img class='ui avatar image' alt='' src='assets/resources/pics/"+k.photo+"'><div class='content'><div class='header'><a class='ui blue small member_link' data-id='" + k.login_id + "' data-source='search'>"+k.firstname.toProperCase()+" "+k.lastname.toProperCase()+"</a></div><span style='color:#072902'>"+k.profession+" | "+k.country+"</span></div></div>";
            			});
            			$("#pro_list").html("<table><thead><tr><th>S/N</th><th>Industry</th><th>Nature of Business</th><th>Description of Business</th><th>Name of Firm</th><th>Contact Us</th><th>Location</th><th>Website</th></tr></thead><tbody>"+strPro+"</tbody></table>");
            			$("#pro_segment").removeClass("loading");
            			$(".member_link").on("click", function () {
				            //search.member(this);
				            $.redirect("member", {id: $(this).data("id"),source:$(this).data("source")}, "post");
				        });
						}

            			
            		}else{
            			//no Classified Business Directory
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