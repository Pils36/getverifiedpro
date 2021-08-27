var search = search || {};

search.load = function () {
    if ($("#query").text()) {
        $("#search_input").val($("#query").text());
        //$(".search_main").trigger("click");
        search.search();
    }
    $(".search_main").on("click", function () {
        // get search result
        if (!$("#search_input").val()) {
            return;
        }
        $("#query").text($("#search_input").val());
        search.search();

    });
}

search.search = function () {
    var data = {
        "function": "search",
        "query": $("#search_input").val()
    };
    sendRequest.postJSON(data, "../helpers/loader.php", function (response) {
        //alert(response);
        $("#search_results").addClass("loading");
        if (response.data) {
            buffer = "<div class='ui divided items'>";
            $.each(response.data, function (v, k) {
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


                buffer += "<div class='item'> <div class='content'> <a class='ui blue small header member_link' data-account='" + k.attrs.account + "'><i class='chevron right icon'></i>" + k.attrs.firstname.toProperCase() + " " + k.attrs.lastname.toProperCase() + "</a> <div class='description'> <p><span style='color:brown;'>Profession:</span> " + prof.toProperCase() + " | <span style='color:brown;'>Country:</span> " + coun.toProperCase() + " | <span style='color:brown;'>Area of Specialisation:</span> " + ind.toProperCase() + "</p> </div> </div> </div>";
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
    });

}

search.member = function (el) {
    $.redirect("member.php", {id: $(el).data("account")}, "post", "_blank");
}

search.load();


String.prototype.toProperCase = function () {
    return this.replace(/\w\S*/g, function (txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
};