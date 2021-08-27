<?php
include 'db/conf.php';
session_start();

if(!$_SESSION['username']){
    header("location: register.php");
}

$account_holder = $_SESSION['username'];

$stmt = "SELECT * FROM registration WHERE email = '".$account_holder."' ";

$result = mysqli_query($conn, $stmt);

$fetch = mysqli_num_rows($result);

$fetchAll = mysqli_fetch_assoc($result);



$name = $fetchAll['fullname'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome</title>
    
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

<div class="container mb-3">

<h5 class="animated fadeInDown mt-5 text-center text-primary">Hello <?php echo $name;?></h5>
<p class="animated fadeInDown mt-3 text-center text-muted" style="font-size: 14px"><a href="logout.php" style="text-decoration: none"><i class="fa fa-power-off text-danger"></i> Logout</a></p>

<div class="container col-md-6 mt-2 animated bounceIn">
    <p class="display-3 text-info text-center">Thank you for <br> attending <br> the 2 days seminar. Cheers!!</p>
</div>

    
</div>




<footer style="background-color: #f1f1f1;height: 100px; padding-bottom: 3px mt-5">
<div >
    <div class="container animated fadeInUp text-center">
        <p style="font-size: 14px; margin-top: 10px; padding-top:15px" class="text-muted">Copyright &copy; 2019 Agbowa Youth</p> <p style="font-size: 14px;" class="text-muted">Designed with <i class="fa fa-heart text-danger"></i> by Adebambo</p>

    </div>
</div>
</footer>
    <!-- Script -->
    <script src="js/jquery.min.js"></script>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>