<?php
include 'db/conf.php';
session_start();

if(isset($_POST['submit'])){

    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $passkey = md5($_POST['password']);

    $stmt = "SELECT * FROM registration WHERE email = '".$email."'";

    $result = mysqli_query($conn, $stmt);

    $fetch = mysqli_num_rows($result);

    if($fetch > 0){
        $error = "<div class='alert alert-danger text-center animated fadeInDown remove'><small>User already Exists!</small></div>";
    }
    else{
        $stmt = "INSERT INTO registration (`fullname`, `email`, `password`) VALUE ('".$name."', '".$email."', '".$passkey."')";
        $stmts = $conn->query($stmt);

        if($stmts === TRUE){
            $success = "<div class='alert alert-success text-center animated fadeInRight remove'><small>Successfully Registered!. Redirecting in 10sec</small></div>";
            header("refresh: 10; url = login.php");
        }
        else{
            $fail = "<div class='alert alert-info text-center animated fadeInDown remove'>Error: " . $sql . "<br>" . $conn->error ."</div>";
        }
        
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration Form</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="https://pbs.twimg.com/profile_images/1066615196993708032/gw1SJ7uQ_400x400.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="css/animate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet">


    <style>
        .nav-link{margin-left: 40px;}
        .nav-link.active{background-color: #d5195e; padding: 10px; color:#fff !important; font-weight: bold;}
        .nav-link:hover{background-color: #d5195e; padding: 10px; color: #fff !important; font-weight: bold}
        .form-box{background: #f1f1f1; padding: 30px; border-radius: 6px;}

        body::-webkit-scrollbar{width: 6px;}
        body::-webkit-scrollbar-track{background: #f1f1f1;}
        body::-webkit-scrollbar-thumb{background: #d5195e;}
        body::-webkit-scrollbar-thumb:hover{background: #d5195e;}

    </style>
    
</head>
<body>

        <!-- Contains the Navigation and header components -->
        <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="container">
            <a class="navbar-brand" href="#"><span style="font-family: Yanone Kaffeesatz; font-size: 30px; color: #d5195e">Agbowa Dev. Team</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto" style="text-transform: uppercase; font-size: 13px;">
                <li class="nav-item active">
                    <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Services
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">HTML</a>
                    <a class="dropdown-item" href="#">CSS</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Python</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            </div>
            </nav>            
        </header>

<div class="container">



    <h1 class="animated fadeInUp text-center mt-5">Registration</h1>
    <div class="container col-md-6">

    <?php if(isset($success)){echo $success;}if(isset($error)){echo $error;}if(isset($fail)){echo $fail;}?>
    <form method="POST" action="register.php" class="animated fadeInUp form-box">
    <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="fullname" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter name">
            <small id="nameHelp" class="form-text text-muted error-name" style="display:none; color: red !important;">Name field is required</small>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted error-email" style="display:none; color: red !important;">E-mail field is required</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="Enter password">
            <small id="emailHelp" class="form-text text-muted error" style="display:none; color: red !important;">Minimum of 8 characters</small>
            
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="check">
            <label class="form-check-label" name="check" for="check">Accept Terms and Conditions</label>
            <small id="checkHelp" class="form-text text-muted error-box" style="display:none; color: red !important;">You must checkbox</small>
        </div>
        <br>
        <button type="submit" id="btn_submit" name="submit" class="btn btn-danger" style="width: 100%">Submit</button>
        <small class="mt-5">Already Registered? <span class="display-4" style="font-size: 15px"><a href="login.php" style="text-decoration: none">Login</a></span></small>
    </form>
    </div>
</div>





    <!-- Script -->
    <script src="js/jquery.min.js"></script>

    <script>
    $(".remove").show().delay(7000).fadeOut();
        var name = $("#name").val();
        var email = $("#email").val();
        var passkey = $("#password").val();

        
        $("#btn_submit").click(function(el){
            if($("#password").val().length < 8){
            el.preventDefault();
            $(".error").show().delay(5000).fadeOut();
        }
        else if($("#name").val() == ""){
            el.preventDefault();
            $(".error-name").show().delay(5000).fadeOut();
        }
        else if($("#email").val() == ""){
            el.preventDefault();
            $(".error-email").show().delay(5000).fadeOut();
        }
        else if($("input[type='checkbox']").prop("checked") == false){
                el.preventDefault();
                $(".error-box").show().delay(5000).fadeOut();
        }
        else{
    
            document.getElementById("btn_submit").innerHTML = "Please Wait...";
            
        }
        });
        
    </script>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>