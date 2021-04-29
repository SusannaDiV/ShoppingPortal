<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(isset($_POST['submit'])) {
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $email=$_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $password=password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $stmt=$con->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $firstname, $lastname, $email, $password);
            if ($stmt->execute()) {
                $extra="login.php";
                $host=$_SERVER['HTTP_HOST'];
                $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
                header("location:http://$host$uri/$extra");
                $stmt->close();
            } else {
                echo "<script>alert('Errore di connessione al database');</script>";
            }
        } else {
            echo "<script>alert('Formato email non valido');</script>";
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
        <title>Registrazione | Bio Liguria Shop</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link href="css/lightbox.css" rel="stylesheet">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="images/favicon.ico">
        <script type="text/javascript">
            function valid() {
                if(document.register.password.value!= document.register.confirm.value) {
                    alert("I campi di Password e Conferma Password non corrispondono!");
                    document.register.confirm.focus();
                    return false;
                }
            return true;
            }
        </script>
        <script>
            function userAvailability() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "check_availability.php",
                    data:'email='+$("#email").val(),
                    type: "POST",
                    success:function(data) {
                        $("#user-availability-status1").html(data);
                        $("#loaderIcon").hide();
                    },
                    error:function (){}
                });
            }
        </script>
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
                        <li class='active'>Registrazione</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="body-content outer-top-bd">
            <div class="container">
                <div class="sign-in-page inner-bottom-sm">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 create-new-account">
                            <h4 class="checkout-subtitle">Crea un nuovo account</h4>
                            <p class="text title-tag-line">Crea il tuo account personale.</p>
                            <form action="registration.php" class="register-form outer-top-xs" role="form" method="post" name="register" onSubmit="return valid();">
                                <div class="form-group">
                                    <label class="info-title" for="firstname">Nome <span>*</span></label>
                                    <input type="text" class="form-control unicase-form-control text-input" id="firstname" name="firstname" required="required">
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="lastname">Cognome <span>*</span></label>
                                    <input type="text" class="form-control unicase-form-control text-input" id="lastname" name="lastname" required="required">
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="email">Email <span>*</span></label>
                                    <input type="email" class="form-control unicase-form-control text-input" id="email" onBlur="userAvailability()" name="email" required >
                                    <span id="user-availability-status1" style="font-size:12px;"></span>
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="password">Password <span>*</span></label>
                                    <input type="password" class="form-control unicase-form-control text-input" id="password" name="pass"  required >
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="confirm">Conferma Password <span>*</span></label>
                                    <input type="password" class="form-control unicase-form-control text-input" id="confirm" name="confirm" required >
                                </div>
                                <input type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button" id="submit" />
                            </form>
                            <span class="checkout-subtitle outer-top-xs">Registrati oggi e potrai: </span>
                            <div class="checkbox">
                                <label class="checkbox">Aggiungere, rimuovere e modificare i prodotti nel carrello.</label>
                                <label class="checkbox">Acquistare il meglio dei prodotti genovesi certificati BIO.</label>
                                <label class="checkbox">Donare in beneficienza o spedire a casa tua i prodotti acquistati.</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('includes/footer.php');?>
    </body>
</html>