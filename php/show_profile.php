<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if (!isset($_SESSION['login'])) {   
    	header('location:index.php');
    } else {
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
        <title>Il mio account</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link href="css/lightbox.css" rel="stylesheet">
        <link rel="stylesheet" href="css/animate.min.css">
        
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
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
                        <li class='active'>Il mio profilo</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="body-content outer-top-bd">
        <div class="container">
            <div class="checkout-box inner-bottom-sm">
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel-group checkout-steps" id="accordion">
                            <div class="panel panel-default checkout-step-01">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">
                                        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                                        <span>1</span>Il mio profilo
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <h4>Informazioni personali</h4><br>
                                            <div class="col-md-12 col-sm-12 already-registered-login">
                                                <?php
                                                    $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
                                                    while($row=mysqli_fetch_array($query))
                                                    {
                                                    ?>
                                                <form class="register-form" role="form" method="post">
                                                    <div class="form-group">
                                                        <label class="info-title" for="firstname">Nome <span>*</span></label>
                                                        <br><strong><?php echo $row['firstname'];?></strong>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title" for="lastname">Cognome <span>*</span></label>
                                                        <br><strong><?php echo $row['lastname'];?></strong>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title" for="email">Indirizzo Email <span>*</span></label>
                                                        <br><strong><?php echo $row['email'];?></strong>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title">Numero di telefono</label>
                                                        <br><strong><?php echo $row['contactno'];?></strong>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title">Indirizzo di spedizione</label>
                                                        <br><strong><?php echo $row['shippingAddress'];?></strong>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title">Su di me</label>
                                                        <br><strong><?php echo $row['aboutme'];?></strong>
                                                    </div>
                                                    <a href="update_profile.php" class="btn-upper btn btn-primary checkout-page-button">Update</a>
                                                </form>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('includes/footer.php');?>
    </body>
</html>
<?php } ?>