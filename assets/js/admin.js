var admin = admin || {};

admin.ready = function () {
    $(".upgrade").hide();
    $("select").dropdown();
    $("#admin_upload_csv").on("click",function(){
        $("#upload_csv").trigger("submit");
    });

    $("#blog_update_btn").on("click", function () {
        admin.updateBlog(this);
    });
    $("#resend_all_btn").on("click",function(){
        admin.resendAllInvites(this);
    });

    $("#blog_status").dropdown();
    $("#blog_form_content").html('');
    $("#new_blog_btn").on("click", function () {
        $("#blog_update_btn").hide();
        $("#blog_add_btn").show();
        $("#blog_modal").modal({
            closable: false,
            onHidden: function () {
                $("#blog_status").val('');
                $("#blog_subject").val('');
                $("#blog_form_content").html('');
                $("*[data-type='blogs']").trigger("click");
            },
            onApprove: function () {
                admin.newBlog();
                return false;
            }
        }).modal("show");
    });
    $("#login_form").submit(function (event) {
        admin.login();
        event.preventDefault();
    });

        $(".admin_link").on("click", function () {
        $(".admin_link").removeClass('active');
        $(this).addClass("active");
        var type = $(this).data("type");
        $(".admin_segment").hide();
        $("#" + type + "_segment").show();
        switch (type) {
            case "blogs":
                admin.fetchBlogs();
                break;
            case "members":
                admin.fetchMembers();
                break;
            case "subscriptions":
                admin.fetchSubcriptions();
                break;
            case "sent":
                admin.fetchSent();
                break;
            case "promo":
                admin.fetchPromo();
                break;
            case "deactive":
                admin.fetchDeactive();
                break;
            
             default:
                break;
        }

    });

    admin.fetchBlogs();
};

admin.login = function () {
    // alert("login");
    // return;
    var data = {
        "function": "adminLogin",
        "username": $("#login_email").val(),
        "password": $("#login_password").val()
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        if (response.status === "failed") {
            alert(response.message);
        } else {
            $.redirect("dashboard");
        }
    });
};

admin.fetchBlogs = function () {
    var data = {
        "function": "getBlogs"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        var strMsg = "";
        if (response.status === "success") {
            if (response.data.length) {
                strMsg += "<table id='myTable1' class='ui  striped table'> <thead> <tr> <th>#</th><th>DATE POSTED</th> <th>TITLE</th> <th>STATUS</th><th></th><th></th></tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
                    strMsg += "<tr><td>" + (v + 1) + "</td><td>" + k.date_posted + "</td><td>" + k.title + "</td><td>" + k.status + "</td><td><a href='#' class='blog_link' data-id='" + k.id + "'>view</a></td><td><a href='#' class='notify_link' data-id='" + k.id + "'>send email notifications</a></td></tr>";
                });
                strMsg += "</tbody></table>";
            } else {
                strMsg = "<p>No blog post found</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }
        $("#blog_content").html(strMsg);
        // bind view
        $(".blog_link").on("click", function () {
            admin.viewBlog(this);
        });
        // send notifications
        $(".notify_link").on("click", function () {
            admin.sendNotifications(this);
        });

    });
};


admin.fetchSent = function(){
    var data = {
        "function" : "allSentInvites"
    };
        sendRequest.postJSON(data, "controller/app.php", function (response) {
        var strMsg = "";
        if (response.status === "success") {
            if (response.data.length) {
                strMsg += "<table class='ui  striped table'> <thead> <tr> <th>#</th><th>SENT BY</th> <th>SENT TO</th> <th>DATE SENT</th></tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
                    strMsg += "<tr><td>" + (v + 1) + "</td><td>" + k.sent_by + "</td><td>" + k.sent_to + "</td><td>" + k.date_sent + "</td></tr>";
                });
                strMsg += "</tbody></table>";
            } else {
                strMsg = "<p>No sent invites found</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }
        $("#sent_content").html(strMsg);
        $("#sent_content").removeClass("loading");

        
    });
};


function doaction(val){
   
   pro = confirm("Do you want to upgrade all?");
   
   if(pro !== false){
        document.getElementById("form-id").submit();
   }
  




}

// Fetch Promo
admin.fetchPromo = function () {
    var data = {
        "function": "getPromo"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
            
        
        var strMsg = "";
        if (response.status === "success") {
            if (response.data.length) {
                
                
                // console.log(response.data);
                
                strMsg += "<form method='POST' action='../views/promoall.php' id='form-id'><table id='myTable2' class='ui  striped table'> <thead> <tr> <th>#</th><th><img src='https://img.icons8.com/ultraviolet/40/000000/nui2.png' class='check' style='width: 20px; height:20px; cursor:pointer' onclick='doaction(1);'><img src='https://img.icons8.com/ultraviolet/40/000000/nui2.png' class='uncheck' style='width: 20px; height:20px; cursor:pointer; display:none;' onclick='doaction(2);'></th><th>FIRST NAME</th> <th>LAST NAME</th> <th>EMAIL</th><th>PERCENTAGE</th><th>PROMO STATE</th><th>DATE</th><th></th><th></th></tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
                    
  var dateString = k.last;
dateString = new Date(dateString).toUTCString();
dateString = dateString.split(' ').slice(0, 4).join(' ');
// console.log(dateString); 

                    // console.log(k);
                    
                    
                    // if(k.state == 1 && k.promo_state == 2){
                    //     strMsg += "<tr><td>" + (v + 1) + "</td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.email + "</td><td>" + k.percent + "</td><td><img src='https://img.icons8.com/bubbles/50/000000/verified-account.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td>" + k.date_added + "</td><td><a href='#' class='member_link  interest_ref' data-id='" + k.login_id + "'>View Profile</a></td><td><a href='#' data-id='" + k.login_id + "' class='subscription_link'>Add Subscription</a></td></tr>";
                    // }
                    if(k.state == 1 && k.sub_status === 0 && k.promo_state == 2){
                        strMsg += "<tr><td>" + (v + 1) + "</td><td><input class='promoid' type='text' name='login_id[]' value='"+k.login_id+"' style='display:none'></td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.email + "</td><td>" + k.percent + "</td><td><img src='https://img.icons8.com/bubbles/50/000000/verified-account.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td>" + k.date_added + "</td><td><a href='#' class='member_link  interest_ref' data-id='" + k.login_id + "'>View Profile</a></td><td></td></tr>";
                    }
                    else if(k.state == 1 && k.promo_state == 2 && k.sub_status === 0){
                        strMsg += "<tr><td>" + (v + 1) + "</td><td><input class='promoid' type='text' name='login_id[]' value='"+k.login_id+"' style='display:none'></td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.email + "</td><td>" + k.percent + "</td><td><img src='https://img.icons8.com/bubbles/50/000000/verified-account.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td>" + k.date_added + "</td><td><a href='#' class='member_link  interest_ref' data-id='" + k.login_id + "'>View Profile</a></td><td><a href='#' data-id='" + k.login_id + "' class='subscription_link'>Add Subscription</a></td></tr>";
                    }
                    
                    else if(k.state == 1 && k.promo_state === 0){
                        strMsg += "<tr><td>" + (v + 1) + "</td><td><input class='promoid' type='text' name='login_id[]' value='"+k.login_id+"' style='display:none'></td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.email + "</td><td>" + k.percent + "</td><td><img src='https://img.icons8.com/dusk/64/000000/unverified-account.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td>" + k.date_added + "</td><td><a href='#' class='member_link  interest_ref' data-id='" + k.login_id + "'>View Profile</a></td><td><a href='#' data-id='" + k.login_id + "' class='subscription_link'>Add Subscription</a></td></tr>";
                    }
                    else{
                    strMsg += "<tr><td>" + (v + 1) + "</td><td><input class='promoid' type='text' name='login_id[]' value='"+k.login_id+"' style='display:none'></td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.email + "</td><td>" + k.percent + "</td><td><img src='https://img.icons8.com/dusk/64/000000/unverified-account.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td>" + k.date_added + "</td><td><a href='#' class='member_link  interest_ref' data-id='" + k.login_id + "'>View Profile</a></td><td><a href='#' data-id='" + k.login_id + "' class='subscription_link'>Add Subscription</a></td></tr>";
                    }
                });
                strMsg += "</tbody></table></form>";
            } else {
                strMsg = "<p>Promo contest not ready</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }
        $("#promo_content").html(strMsg);
        $(".interest_ref").on("click", function () {
            admin.viewMember($(this));
        });
        $(".subscription_link").on("click", function () {
            var firstname = $(this).parent().prev().prev().prev().prev().prev().prev().text();
            var lastname = $(this).parent().prev().prev().prev().prev().prev().text();
            var email = $(this).parent().prev().prev().prev().text();
            $("#subscription_modal_header").text("New Subscription for " + firstname + " " + lastname);
            $("#email_addy").val(email);
            $("#member").val($(this).data("id"));
            admin.addSubscription();
        });

        $(".member_link").on("click", function () {
            admin.viewMember(this);
        });
    });
};



// Fetch Deactivated
admin.fetchDeactive = function () {
    var data = {
        "function": "getDeactivate"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
            
        
        var strMsg = "";
        if (response.status === "success") {
            if (response.data.length) {
                strMsg += "<table id='myTable2' class='ui  striped table'> <thead> <tr> <th>#</th><th>LOGIN ID</th> <th>USERNAME</th> <th>EMAIL</th><th>DATE REMOVED</th><th></th></tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
  var dateString = k.date_removed;
dateString = new Date(dateString).toUTCString();
dateString = dateString.split(' ').slice(0, 4).join(' ');
// console.log(dateString); 

                    // console.log(k);
                    
                    if(k.login_id != ""){
                        strMsg += "<tr><td>" + (v + 1) + "</td><td>" + k.login_id + "</td><td>" + k.username + "</td><td>" + k.email + "</td><td>" + dateString + "</td><td><a href='#' data-id='" + k.login_id + "' onclick='activateUser("+k.login_id+");'><img src='https://img.icons8.com/ultraviolet/40/000000/shutdown.png' style='width: 20px; height: 20px'></a></td></tr>";
                    }

                });
                strMsg += "</tbody></table>";
            } else {
                strMsg = "<p>No deactivated user yet</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }
        $("#deactive_content").html(strMsg);
        $(".interest_ref").on("click", function () {
            admin.viewMember($(this));
        });
        $(".subscription_link").on("click", function () {
            var firstname = $(this).parent().prev().prev().prev().prev().prev().prev().text();
            var lastname = $(this).parent().prev().prev().prev().prev().prev().text();
            var email = $(this).parent().prev().prev().prev().text();
            $("#subscription_modal_header").text("New Subscription for " + firstname + " " + lastname);
            $("#email_addy").val(email);
            $("#member").val($(this).data("id"));
            admin.addSubscription();
        });

        $(".member_link").on("click", function () {
            admin.viewMember(this);
        });
    });
};


function activateUser(thislogid){
    
    // console.log(thislogid);
    swal({
  title: "Are you sure?",
  text: "You are about to activate user to Pro-Filr",
  icon: "info",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      var data = {
          "thislogid": thislogid,
          "function": "updateLogin"
      };
      
      sendRequest.postJSON(data, "controller/app.php", function(response){
          
          console.log(data);
          
         if(response.status === "success"){
             swal(response.message, {
                  icon: "success",
                });
         }else {
            swal("Whoops!!!",response.message, "error");
          }
          
      });
   
  } 
});
}

// Deactivate User
function deactivateUser(thisuserid){
    
    console.log(thisuserid);
    swal({
  title: "Are you sure?",
  text: "You are about to de-activate user on Pro-Filr",
  icon: "info",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      var data = {
          "thisuserid": thisuserid,
          "function": "deactivateLogin"
      };
      
      sendRequest.postJSON(data, "controller/app.php", function(response){
          
          console.log(response.data);
          
         if(response.status === "success"){
             swal(response.message, {
                  icon: "success",
                });
         }else {
            swal("Whoops!!!",response.message, "error");
          }
          
      });
   
  } 
});
}




admin.fetchMembers = function () {
    var data = {
        "function": "getMembers"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {

        var strMsg = "";
        if (response.status === "success") {
            if (response.data.length) {
                strMsg += "<table id='myTable2' class='ui  striped table'> <thead> <tr> <th>#</th><th></th><th>FIRST NAME</th> <th>LAST NAME</th> <th>COUNTRY</th><th>EMAIL</th><th>INDUSTRY</th><th>SPECIALIZATION</th><th>LAST SEEN</th><th>STATUS</th><th>SIGNUP DATE</th><th></th><th></th></tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
  var dateString = k.last;
dateString = new Date(dateString).toUTCString();
dateString = dateString.split(' ').slice(0, 4).join(' ');
// console.log(dateString);                  
                    // console.log(k.status);
                    if(k.status == 1){
                        strMsg += "<tr><td>" + (v + 1) + "</td><td><a href='#' data-id='" + k.no + "' onclick='deactivateUser("+k.no+")'><img src='https://img.icons8.com/color/48/000000/shutdown.png' style='width: 20px; height: 20px'></a></td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.country + "</td><td>" + k.email + "</td><td>" + k.industry + "</td><td>" + k.specialization + "</td><td style='color:#9d9d9d'>now</td><td><img src='https://img.icons8.com/color/48/000000/id-verified.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td>" + k.date_created + "</td><td><a href='#' class='member_link  interest_ref' data-id='" + k.no + "'>View Profile</a></td><td><a href='#' data-id='" + k.no + "' class='subscription_link'>Add Subscription</a></td></tr>";
                    }
                    else{
                    strMsg += "<tr><td>" + (v + 1) + "</td><td><a href='#' data-id='" + k.no + "' onclick='deactivateUser("+k.no+")'><img src='https://img.icons8.com/color/48/000000/shutdown.png' style='width: 20px; height: 20px'></a></td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.country + "</td><td>" + k.email + "</td><td>" + k.industry + "</td><td>" + k.specialization + "</td><td style='color:#9d9d9d'>" + dateString + "</td><td><img src='https://img.icons8.com/color/48/000000/id-not-verified.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td>" + k.date_created + "</td><td><a href='#' class='member_link  interest_ref' data-id='" + k.no + "'>View Profile</a></td><td><a href='#' data-id='" + k.no + "' class='subscription_link'>Add Subscription</a></td></tr>";
                    }
                });
                strMsg += "</tbody></table>";
            } else {
                strMsg = "<p>No blog post found</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }
        $("#members_content").html(strMsg);
        $(".interest_ref").on("click", function () {
            admin.viewMember($(this));
        });
        $(".subscription_link").on("click", function () {
            var firstname = $(this).parent().prev().prev().prev().prev().prev().prev().text();
            var lastname = $(this).parent().prev().prev().prev().prev().prev().text();
            var email = $(this).parent().prev().prev().prev().text();
            $("#subscription_modal_header").text("New Subscription for " + firstname + " " + lastname);
            $("#email_addy").val(email);
            $("#member").val($(this).data("id"));
            admin.addSubscription();
        });

        $(".member_link").on("click", function () {
            admin.viewMember(this);
        });
    });
};

admin.viewMember = function (el) {
    // alert($(el).data("id"));
    // redirect to member page
    // $.redirect("member", {id: $(el).data("account"),source:$(el).data("source")}, "post");
    // console.log('the element is', el);
    // console.log('the id is', $(el).data("id"));
    $.redirect("member", {id: $(el).data("id"),source:$(el).data("source")}, "post", '_blank');
};

admin.addSubscription = function () {
    $("#subscription_modal").modal({
        closable: false,
        onApprove: function () {
            admin.proccessSub();
            return false;
        }
    }).modal("show");
};

function subModal(thisid, thisoption){
    
    console.log(thisid, thisoption);
    swal({
  title: "Are you sure?",
  text: "You are about to change user subscription",
  icon: "info",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      var data = {
          "thisid": thisid,
          "thisoption": thisoption,
          "function": "updateSubscriber"
      };
      
      sendRequest.postJSON(data, "controller/app.php", function(response){
        //   console.log(response.data);
          
         if(response.status === "updated"){
             swal("Updated successfully", {
                  icon: "success",
                });
         }else {
            swal("Whoops!!!","Users subscription plan failed", "error");
          }
          
      });
   
  } 
});
}

// function subModal(thisId){
//     console.log(thisId);
//     $("#subscription_modal").modal({
//         closable: true,
//         onApprove: function () {
//             admin.proccessSubupdate();
//             return false;
//         }
//     }).modal("show");
// }


// admin.proccessSubupdate = function () {
//     var data = {
//         "function": "updateSubscriber",
//         // "plan": $("#subscription_plan").val(),
//         // "member": $("#member").val()
//     };

//     sendRequest.postJSON(data, "controller/app.php", function (response) {
//         swal(response.message);
//     });
// };

function deletethis(thisitem){
    
    // console.log(thisitem);
    swal({
  title: "Are you sure?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      var data = {
          "thisemail": thisitem,
          "function": "removeSubscriber"
      };
      
      sendRequest.postJSON(data, "controller/app.php", function(response){
        //   console.log(response.data);
          
         if(response.status === "deleted"){
             swal("Deleted successfully", {
                  icon: "success",
                });
         }else {
            swal("Whoops!!!","User not downgraded", "error");
          }
          
      });
   
  } 
});
}




admin.fetchSubcriptions = function () {
    var data = {
        "function": "getSubscriptions"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        var strMsg = "";
        if (response.status === "success") {
            if (response.data.length) {
                strMsg += "<table id='myTable3' class='ui  striped table'> <thead> <tr> <th>#</th><th>FIRST NAME</th> <th>LAST NAME</th> <th>EMAIL</th><th>EXPIRY DATE</th><th>LAST SEEN</th><th>OPTION</th><th>STATE</th><th>SUBSCRIPTION DATE</th><th>STATUS</th><th>ACTION</th><th></th></tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
                    
                    console.log(response.data);
                    
                    var dateString = k.last;
dateString = new Date(dateString).toUTCString();
dateString = dateString.split(' ').slice(0, 4).join(' ');

var exp = k.expiry_date;
exp = new Date(exp).toUTCString();
exp = exp.split(' ').slice(0, 4).join(' ');
// console.log(k);


// Counter
var endDate = new Date(k.expiry_date).getTime();

    var now = new Date().getTime();
    var t = endDate - now;
    
var days = 0;
var hours = 0;
var minute = 0;
var second = 0;

//Process
days = Math.floor(t / (1000 * 60 * 60 * 24));
hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
minute = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
second = Math.floor((t % (1000 * 60)) / 1000);
        
setInterval(function() {
    var now = new Date().getTime();
    var t = endDate - now;
    
    days = Math.floor(t / (1000 * 60 * 60 * 24));
hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
minute = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
second = Math.floor((t % (1000 * 60)) / 1000);
    
    if (t >= 0) {
        
        
 
        $("td#res"+(v+1)+".timer>#days").html(days+"<span class='label'>DAYS </span>");

        $("td#res"+(v+1)+".timer>#hour").html(("0"+hours).slice(-2) + "<span class='label'>HR(S)</span>");

        $("td#res"+(v+1)+".timer>#minute").html(("0"+minute).slice(-2) + "<span class='label'>MIN(S)</span>");

        $("td#res"+(v+1)+".timer>#second").html(("0"+second).slice(-2) + "<span class='label'>SEC(S)</span>");
    
    } else {
        
        $(".timer").html("The countdown is over!");
    
    }
}, 1000);


                    // console.log(k.state);
                    if(k.state == 1 && k.options == 0){
                        strMsg += "<tr><td name='time'>" + (v + 1) + "</td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.email + "</td><td id='res"+(v + 1)+"' class='timer'><span id='days'>"+days+" </span><span id='hour'>"+hours+":</span><span id='minute'>"+minute+":</span><span id='second'>"+second+"</span></td><td style='color:#9d9d9d'>now</td><td><img src='https://img.icons8.com/color/48/000000/id-verified.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td style='font-size: 10px; color: green'>Okay with current plan</td><td>" + k.subscription_date + "</td><td>" + k.status + "</td><td style='cursor: pointer' onclick=deletethis('"+k.email+"')><img style='width: 30px; height: 30px;' src='https://img.icons8.com/ios/50/000000/remove-administrator-filled.png'></td><td></td></tr>";
                    
                    }
                    else if(k.state == 1 && k.options == 2){
                        strMsg += "<tr><td name='time'>" + (v + 1) + "</td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.email + "</td><td id='res"+(v + 1)+"' class='timer'><span id='days'>"+days+" </span><span id='hour'>"+hours+":</span><span id='minute'>"+minute+":</span><span id='second'>"+second+"</span></td><td style='color:#9d9d9d'>now</td><td><img src='https://img.icons8.com/color/48/000000/id-verified.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td style='font-size: 10px; color: blue'>Change to $100/Annum </td><td>" + k.subscription_date + "</td><td>" + k.status + "</td><td style='cursor: pointer' onclick=deletethis('"+k.email+"')><img style='width: 30px; height: 30px;' src='https://img.icons8.com/ios/50/000000/remove-administrator-filled.png'></td><td><a style='font-size:10px' href='#' data-id='" + k.no + "' class='subscription_link' onclick='subModal("+k.no+", "+k.options+");'>Change Subscription</a></td></tr>";
                    }
                    else if(k.state == 1 && k.options == 1){
                        strMsg += "<tr><td name='time'>" + (v + 1) + "</td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.email + "</td><td id='res"+(v + 1)+"' class='timer'><span id='days'>"+days+" </span><span id='hour'>"+hours+":</span><span id='minute'>"+minute+":</span><span id='second'>"+second+"</span></td><td style='color:#9d9d9d'>now</td><td><img src='https://img.icons8.com/color/48/000000/id-verified.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td style='font-size: 10px; color: darkorange'>Change to $10/Month </td><td>" + k.subscription_date + "</td><td>" + k.status + "</td><td style='cursor: pointer' onclick=deletethis('"+k.email+"')><img style='width: 30px; height: 30px;' src='https://img.icons8.com/ios/50/000000/remove-administrator-filled.png'></td><td><a style='font-size:10px' href='#' data-id='" + k.no + "' class='subscription_link' onclick='subModal("+k.no+", "+k.options+");'>Change Subscription</a></td></tr>";
                    }
                    else if(k.state == 1 && k.options == 3){
                        strMsg += "<tr><td name='time'>" + (v + 1) + "</td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.email + "</td><td id='res"+(v + 1)+"' class='timer'><span id='days'>"+days+" </span><span id='hour'>"+hours+":</span><span id='minute'>"+minute+":</span><span id='second'>"+second+"</span></td><td style='color:#9d9d9d'>now</td><td><img src='https://img.icons8.com/color/48/000000/id-verified.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td style='font-size: 10px; color: red'>Change to Basic Free </td><td>" + k.subscription_date + "</td><td>" + k.status + "</td><td style='cursor: pointer' onclick=deletethis('"+k.email+"')><img style='width: 30px; height: 30px;' src='https://img.icons8.com/ios/50/000000/remove-administrator-filled.png'></td><td><a style='font-size:10px' href='#' data-id='" + k.no + "' class='subscription_link' onclick='subModal("+k.no+", "+k.options+");'>Change Subscription</a></td></tr>";
                    }
                    else if(k.state == 0 && k.options == 0){
                        strMsg += "<tr><td name='time'>" + (v + 1) + "</td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.email + "</td><td id='res"+(v + 1)+"' class='timer'><span id='days'>"+days+" </span><span id='hour'>"+hours+":</span><span id='minute'>"+minute+":</span><span id='second'>"+second+"</span></td><td style='color:#9d9d9d'>"+dateString+"</td><td><img src='https://img.icons8.com/color/48/000000/id-not-verified.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td style='font-size: 10px; color: green'>Okay with current plan</td><td>" + k.subscription_date + "</td><td>" + k.status + "</td><td style='cursor: pointer' onclick=deletethis('"+k.email+"')><img style='width: 30px; height: 30px;' src='https://img.icons8.com/ios/50/000000/remove-administrator-filled.png'></td><td></td></tr>";
                    }
                    else if(k.state == 0 && k.options == 2){
                        strMsg += "<tr><td name='time'>" + (v + 1) + "</td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.email + "</td><td id='res"+(v + 1)+"' class='timer'><span id='days'>"+days+" </span><span id='hour'>"+hours+":</span><span id='minute'>"+minute+":</span><span id='second'>"+second+"</span></td><td style='color:#9d9d9d'>"+dateString+"</td><td><img src='https://img.icons8.com/color/48/000000/id-not-verified.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td style='font-size: 10px; color: blue'>Change to $100/Annum </td><td>" + k.subscription_date + "</td><td>" + k.status + "</td><td style='cursor: pointer' onclick=deletethis('"+k.email+"')><img style='width: 30px; height: 30px;' src='https://img.icons8.com/ios/50/000000/remove-administrator-filled.png'></td><td><a style='font-size:10px' href='#' data-id='" + k.no + "' class='subscription_link' onclick='subModal("+k.no+", "+k.options+");'>Change Subscription</a></td></tr>";
                    }
                    else if(k.state == 0 && k.options == 1){
                        strMsg += "<tr><td name='time'>" + (v + 1) + "</td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.email + "</td><td id='res"+(v + 1)+"' class='timer'><span id='days'>"+days+" </span><span id='hour'>"+hours+":</span><span id='minute'>"+minute+":</span><span id='second'>"+second+"</span></td><td style='color:#9d9d9d'>"+dateString+"</td><td><img src='https://img.icons8.com/color/48/000000/id-not-verified.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td style='font-size: 10px; color: darkorange'>Change to $10/Month </td><td>" + k.subscription_date + "</td><td>" + k.status + "</td><td style='cursor: pointer' onclick=deletethis('"+k.email+"')><img style='width: 30px; height: 30px;' src='https://img.icons8.com/ios/50/000000/remove-administrator-filled.png'></td><td><a style='font-size:10px' href='#' data-id='" + k.no + "' class='subscription_link' onclick='subModal("+k.no+", "+k.options+");'>Change Subscription</a></td></tr>";
                    }
                    else if(k.state == 0 && k.options == 3){
                        strMsg += "<tr><td name='time'>" + (v + 1) + "</td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.email + "</td><td id='res"+(v + 1)+" class='timer'><span id='days'>"+days+" </span><span id='hour'>"+hours+":</span><span id='minute'>"+minute+":</span><span id='second'>"+second+"</span></td><td style='color:#9d9d9d'>"+dateString+"</td><td><img src='https://img.icons8.com/color/48/000000/id-not-verified.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td style='font-size: 10px; color: red'>Change to Basic Free </td><td>" + k.subscription_date + "</td><td>" + k.status + "</td><td style='cursor: pointer' onclick=deletethis('"+k.email+"')><img style='width: 30px; height: 30px;' src='https://img.icons8.com/ios/50/000000/remove-administrator-filled.png'></td><td><a style='font-size:10px' href='#' data-id='" + k.no + "' class='subscription_link' onclick='subModal("+k.no+", "+k.options+");'>Change Subscription</a></td></tr>";
                    }
                    
                    
                });
                strMsg += "</tbody></table>";
                
            } else {
                strMsg = "<p>No blog post found</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }
        $("#subscriptions_content").html(strMsg);
    });

};

admin.newBlog = function () {
    var data = {
        "function": "newBlog",
        "status": $("#blog_status").val(),
        "title": $("#blog_subject").val(),
        "content": $("#blog_form_content").html()
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        alert(response.message);
        if (response.status === "success") {
            $("#blog_modal").modal("hide");

        }
    });
};

admin.viewBlog = function (el) {
    //alert($(el).data("id"));
    var data = {
        "function": "viewBlog",
        "id": $(el).data("id")
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        if (response.status === "success") {
            $("#blog_form").find("#blog_status").val(response.data.status).change();
            $("#blog_form").find("#blog_subject").val(response.data.title).change();
            $("#blog_form_content").html(response.data.content);
            $("#blog_update_btn").data("id", response.data.id);
            $("#blog_add_btn").hide();
            $("#blog_update_btn").show();
            $("#blog_modal").modal({
                closable: false
            }).modal("show");
        }

    });
};

// Fetch Admin Trigger member
admin.fetchAdminInvite = function(){
    var data = {
        "function" : "fetchAdminInvite"
    }
    
    sendRequest.postJSON(data, "controller/app.php", function(response){
       
       console.log(response.data);
       
       var strMsg = "";
        if (response.status === "success") {
            if (response.data.length) {
                strMsg += "<table id='myTable2' class='ui  striped table'> <thead> <tr> <th>#</th><th>FIRST NAME</th> <th>LAST NAME</th> <th>COUNTRY</th><th>EMAIL</th><th>INDUSTRY</th><th>SPECIALIZATION</th><th>LAST SEEN</th><th>STATUS</th><th>SIGNUP DATE</th><th></th><th></th></tr> </thead> <tbody>";
                $.each(response.data, function (v, k) {
  var dateString = k.last;
dateString = new Date(dateString).toUTCString();
dateString = dateString.split(' ').slice(0, 4).join(' ');
// console.log(dateString);                  
                    // console.log(k.status);
                    if(k.status == 1){
                        strMsg += "<tr><td>" + (v + 1) + "</td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.country + "</td><td>" + k.email + "</td><td>" + k.industry + "</td><td>" + k.specialization + "</td><td style='color:#9d9d9d'>now</td><td><img src='https://img.icons8.com/color/48/000000/id-verified.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td>" + k.date_created + "</td><td><a href='#' class='member_link  interest_ref' data-id='" + k.no + "'>View Profile</a></td><td><a href='#' data-id='" + k.no + "' class='subscription_link'>Add Subscription</a></td></tr>";
                    }
                    else{
                    strMsg += "<tr><td>" + (v + 1) + "</td><td>" + k.firstname + "</td><td>" + k.lastname + "</td><td>" + k.country + "</td><td>" + k.email + "</td><td>" + k.industry + "</td><td>" + k.specialization + "</td><td style='color:#9d9d9d'>" + dateString + "</td><td><img src='https://img.icons8.com/color/48/000000/id-not-verified.png' style='width: 20px; height:20px; position: relative; top: 0px;left:0px; right:0px;bottom:0px;'></td><td>" + k.date_created + "</td><td><a href='#' class='member_link  interest_ref' data-id='" + k.no + "'>View Profile</a></td><td><a href='#' data-id='" + k.no + "' class='subscription_link'>Add Subscription</a></td></tr>";
                    }
                });
                strMsg += "</tbody></table>";
            } else {
                strMsg = "<p>No blog post found</p>";
            }

        } else {
            strMsg = "<p>" + response.message + "</p>";
        }
        $("#members_content").html(strMsg);
        $(".interest_ref").on("click", function () {
            admin.viewMember($(this));
        });
        $(".subscription_link").on("click", function () {
            var firstname = $(this).parent().prev().prev().prev().prev().prev().prev().text();
            var lastname = $(this).parent().prev().prev().prev().prev().prev().text();
            var email = $(this).parent().prev().prev().prev().text();
            $("#subscription_modal_header").text("New Subscription for " + firstname + " " + lastname);
            $("#email_addy").val(email);
            $("#member").val($(this).data("id"));
            admin.addSubscription();
        });

        $(".member_link").on("click", function () {
            admin.viewMember(this);
        });
        
    });
}


admin.sendNotifications = function(el){
    var data = {
        "function" : "sendBlogNotifications",
        "id" : $(el).data("id")
    }
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        alert(response.message);

    });
}

admin.updateBlog = function ($el) {
    var data = {
        "function": "updateBlog",
        "status": $("#blog_status").val(),
        "title": $("#blog_subject").val(),
        "content": $("#blog_form_content").html(),
        "id": $($el).data("id")
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        alert(response.message);
    });
};

admin.resendAllInvites = function($el){
    var data = {
        "function" : "resendAllInvites"
    };
    sendRequest.postJSON(data, "controller/app.php", function (response) {
        alert(response.message);
    });

};

admin.proccessSub = function () {
    var data = {
        "function": "newSubscription",
        "plan": $("#subscription_plan").val(),
        "member": $("#member").val()
    };

    sendRequest.postJSON(data, "controller/app.php", function (response) {
        alert(response.message);
    });
};


admin.ready();