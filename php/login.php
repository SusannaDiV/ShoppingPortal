<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(isset($_POST['submit'])) {
    	$email=$_POST['email'];
        $password=$_POST['pass'];
        $stmt=$con->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res=$stmt->get_result();
        $stmt->close();
        $row=$res->fetch_assoc();
        if (!empty($row) && password_verify($password, $row["password"])) {
            $extra="index.php";
            $_SESSION['login']=$_POST['email'];
            $_SESSION['id']=$row['id'];
            $host=$_SERVER['HTTP_HOST'];
            $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/$extra");
            exit();
    	} else 	{
    		$extra="login.php";
    		$host=$_SERVER['HTTP_HOST'];
    		$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    		header("location:login.php");
    		$_SESSION['errmsg']="Email o password scorretta.";
    		exit();
    	}
    }
    ?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="Bio Shop Liguria">
        <meta name="author" content="Susanna Di Vita">
        <meta name="keywords" content="Bio, Shop, Liguria">
        <meta name="robots" content="all">
        <title>Login | Bio Liguria Shop</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link href="css/lightbox.css" rel="stylesheet">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="images/favicon.ico">
    </head>
    <body class="cnt-home">
        <header class="header-style-1">
            <?php include('includes/main-header.php');?>
        </header>
        <div class="breadcrumb">
            <div class="container">
                <div class="breadcrumb-inner">
                    <ul class="list-inline list-unstyled">
                        <li><a href="index.php">Home</a></li>
                        <li class='active'>Login</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="body-content outer-top-bd">
            <div class="container">
                <div class="sign-in-page inner-bottom-md">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 sign-in">
                            <h4 class="">Log in</h4>
                            <p class="">Benvenuto, inserisci email e password del tuo account.</p>
                            <form class="register-form outer-top-xs" action="login.php" method="post">
                                <span style="color:red;" >
                                <?php
                                    echo htmlentities($_SESSION['errmsg']);
                                    ?>
                                </span>
                                <div class="form-group">
                                    <label class="info-title" >Email <span>*</span></label>
                                    <input type="email" name="email" class="form-control unicase-form-control text-input"  >
                                </div>
                                <div class="form-group">
                                    <label class="info-title" >Password <span>*</span></label>
                                    <input type="password" name="pass" class="form-control unicase-form-control text-input"  >
                                </div>
                                <input type="submit" class="btn-upper btn btn-primary checkout-page-button" name="submit" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('includes/footer.php');?>
    </body>
</html>