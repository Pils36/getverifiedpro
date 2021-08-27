var search = search || {};

search.load = function () {
    if ($("#query").text()) {
        $("#search_input").val($("#query").text());
        //$(".search_main").trigger("click");
        search.search();
    }
};

search.search = function () {
    var data = {
        "function": "makeSearches",
        "query": $("#search_input").val(),
    };
    // alert(data['query']);
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        
        // console.log(data);
        console.log(response);
        
        $("#search_results").addClass("loading");

        if (response.data) {
            
            $("#search_header").text("Search Result (Total Found: "+response.data.total+")")
            buffer = "<div class='ui divided items'>";
            // sort array based on weight
            //search.propSort(response.data.matches,"weight",true);

            $.each(response.data.matches, function (v, k) {
                var prof, coun, ind;

                if (k.attrs.profession) {
                    prof = k.attrs.profession;
                } else {
                    prof = "Not available";
                }

                if (k.attrs.country) {
                    coun = k.attrs.country;
                } else {
                    coun = "Not available";
                }

                if (k.attrs.industry) {
                    ind = k.attrs.industry;
                } else {
                    ind = "Not available";
                }

                if(k.attrs.source == "member"){
                buffer += "<div class='item'> <div class='content'> <a class='ui blue small member_link' style='color: blue !important; font-size: 13px !important' data-id='" + k.attrs.login_id + "' data-source='search' data-type='"+k.attrs.source+"'><i class='chevron right icon'></i>" + k.attrs.firstname.toProperCase() + " " + k.attrs.lastname.toProperCase() + "</a> <div class='description'> <p><span style='color:brown;'>Profession:</span> " + prof.toProperCase() + " | <span style='color:brown;'>Country:</span> " + coun.toProperCase() + " | <span style='color:brown;'>Area of Specialisation:</span> " + ind.toProperCase() + "</p> </div> </div> </div>";
            }else{
                buffer += "<div class='item'> <div class='content'> <a class='ui blue small opportunity_link' style='color: blue !important; font-size: 13px !important' data-id='" + v + "' data-source='search' data-type='"+k.attrs.source+"'><i class='chevron right icon'></i>" + k.attrs.subject.toProperCase() + "</a> <div class='description'> <p>"+k.attrs.description.toProperCase()+"</p><p><span style='color:brown;'>Closes by:</span> " + k.attrs.deadline + " | <span style='color:brown;'>Location:</span> " + k.attrs.location.toProperCase() + " <span style='color:brown;'></p> </div> </div> </div>";
            }

            });
            buffer += "</div>";
            $("#search_results").html(buffer);




        } else {
            $("#search_results").html(response.message);

        }
        $("#search_results").removeClass("loading");
        $(".member_link").on("click", function () {
            search.member(this);
        });
        $(".opportunity_link").on("click", function () {
            search.opportunity(this);
        });
    });

};

search.opportunity = function (el) {
    $.redirect("posts", {id: $(el).data("id"),source:$(el).data("source")}, "post");
};

search.member = function (el) {
    $.redirect("member", {id: $(el).data("id"),source:$(el).data("source")}, "post");
};

search.load();


search.propSort = function(myArray,prop, desc) {
    myArray.sort(function(a, b) {
        if (a[prop] < b[prop])
            return desc ? 1 : -1;
        if (a[prop] > b[prop])
            return desc ? -1 : 1;
        return 0;
    });
}

String.prototype.toProperCase = function () {
    return this.replace(/\w\S*/g, function (txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
};