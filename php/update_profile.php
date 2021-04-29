<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(!isset($_SESSION['login'])) {   
    	header('location:index.php');
    } else {
    	if(isset($_POST['submit'])) {
    		$first_name=$_POST['firstname'];
            $last_name=$_POST['lastname'];
            $email=$_POST['email'];
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $stmt_e=$con->prepare("update users set email=? where id=?");
                $stmt_e->bind_param("si", $email, $_SESSION['id']);
                $stmt_e->execute();
                $stmt_e->close();
            } else {
                echo "<script>alert('Formato email non valido');</script>";
            }
            if (isset($_POST['contactno'])) {
                $contactno=trim($_POST['contactno']);
                $stmt_c=$con->prepare("update users set contactno=? where id=?");
                $stmt_c->bind_param("ii", $contactno, $_SESSION['id']);
                $stmt_c->execute();
                $stmt_c->close();
            } else {
                $contactno=null;
            }
            if (isset($_POST['shippingAddress'])) {
                $shippingAddress=trim($_POST['shippingAddress']);                
                $stmt_ad=$con->prepare("update users set shippingAddress=? where id=?");
                $stmt_ad->bind_param("si", $shippingAddress, $_SESSION['id']);
                $stmt_ad->execute();
                $stmt_ad->close();
            } else {
                $shippingAddress=null;
            }
            if (isset($_POST['aboutme'])) {
                $aboutme=trim($_POST['aboutme']);
                $stmt_ab=$con->prepare("update users set aboutme=? where id=?");
                $stmt_ab->bind_param("si", $aboutme, $_SESSION['id']);
                $stmt_ab->execute();
                $stmt_ab->close();
            } else {
                $aboutme=null;
            }
            $stmt=$con->prepare("update users set firstname=?,lastname=? where id=?");
            $stmt->bind_param("ssi", $first_name, $last_name, $_SESSION['id']);
            $stmt->execute();
            $stmt->close();
        }
    	if(isset($_POST['submitpwd'])) {
            $stmt_p=$con->prepare("SELECT * FROM users WHERE id=?");
            $stmt_p->bind_param("i", $_SESSION['id']);
            $stmt_p->execute();
            $res=$stmt_p->get_result();
            $stmt_p->close();
            $row=$res->fetch_assoc();
			if(password_verify($_POST['cpass'], $row["password"])) {
                $stmt=$con->prepare("update users set password=? where id=?");
                $stmt->bind_param("s", password_hash($_POST['newpass'], PASSWORD_DEFAULT), $_SESSION['id']);
                $stmt->execute();
				echo "<script>alert('Password cambiata con successo');</script>";
				header('location:update_profile.php');
			} else {
				echo "<script>alert('Password corrente sbagliata!');</script>";
			}
    	}//FARE UNA SOLA QUERY!!!!!!!!!!!!!!!!!!!
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
        <title>Aggiorna Profilo</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link href="css/lightbox.css" rel="stylesheet">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="images/favicon.ico">
        <script type="text/javascript">
            function valid()
            {
            if(document.chngpwd.cpass.value=="")
            {
            alert("Il campo della password corrente non puo' essere vuoto!");
            document.chngpwd.cpass.focus();
            return false;
            }
            else if(document.chngpwd.newpass.value=="")
            {
            alert("Il campo della nuova password non puo' essere vuoto!");
            document.chngpwd.newpass.focus();
            return false;
            }
            else if(document.chngpwd.cnfpass.value=="")
            {
            alert("Il campo della conferma password non puo' essere vuoto!");
            document.chngpwd.cnfpass.focus();
            return false;
            }
            else if(document.chngpwd.newpass.value!= document.chngpwd.cnfpass.value)
            {
            alert("La nuova password e la conferma password non combaciano!");
            document.chngpwd.cnfpass.focus();
            return false;
            }
            return true;
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
                        <li class='active'>Aggiorna Profilo</li>
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
                                            <span>1</span>Modifica profilo
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 already-registered-login">
                                                    <?php
                                                        $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
                                                        while($row=mysqli_fetch_array($query)) {
                                                        ?>
                                                    <form class="register-form" role="form" method="post">
                                                        <div class="form-group">
                                                            <label class="info-title" for="firstname">Nome <span>*</span></label>
                                                            <input type="text" class="form-control unicase-form-control text-input" value="<?php echo $row['firstname'];?>" id="name" name="firstname" required="required">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="info-title" for="lastname">Cognome <span>*</span></label>
                                                            <input type="text" class="form-control unicase-form-control text-input" value="<?php echo $row['lastname'];?>" id="name" name="lastname" required="required">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="info-title" for="email">Indirizzo Email <span>*</span></label>
                                                            <input type="email" class="form-control unicase-form-control text-input"  value="<?php echo $row['email'];?>" id="email" name="email" required="required">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="info-title" for="Contact No.">Numero di telefono</label>
                                                            <input type="text" class="form-control unicase-form-control text-input" id="contactno" name="contactno" value="<?php echo $row['contactno'];?>"  maxlength="10">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="info-title">Indirizzo di spedizione</label>
                                                            <input type="text" class="form-control unicase-form-control text-input" id="shippingAddress" name="shippingAddress" value="<?php echo $row['shippingAddress'];?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="info-title">Su di me</label>
                                                            <input type="text" class="form-control unicase-form-control text-input" id="aboutme" name="aboutme" value="<?php echo $row['aboutme'];?>">
                                                        </div>
                                                        <button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button">Update</button>
                                                    </form>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default checkout-step-02">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">
                                            <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
                                            <span>2</span>Cambia Password
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <form class="register-form" role="form" method="post" name="chngpwd" onSubmit="return valid();">
                                                <div class="form-group">
                                                    <label class="info-title" for="Password Corrente">Password Corrente <span>*</span></label>
                                                    <input type="password" class="form-control unicase-form-control text-input" id="cpass" name="cpass" required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="Nuova Password">Nuova Password <span>*</span></label>
                                                    <input type="password" class="form-control unicase-form-control text-input" id="newpass" name="newpass" required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="Conferma Password">Conferma Password <span>*</span></label>
                                                    <input type="password" class="form-control unicase-form-control text-input" id="cnfpass" name="cnfpass" required="required">
                                                </div>
                                                <button type="submit" name="submitpwd" class="btn-upper btn btn-primary checkout-page-button">Cambia </button>
                                            </form>
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
