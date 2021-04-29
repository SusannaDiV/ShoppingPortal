<?php 
    session_start();
    error_reporting(0);
    include('includes/config.php');
    $quantity=$_POST['quantity'];
    $userId=$_SESSION['id'];
    $mql="SELECT * FROM cart WHERE cart.userid='$userId'";
    $muery=mysqli_query($con, $mql);
    if(isset($_POST['submit']) && mysqli_num_rows($muery)>0) {   //fa l'update
        if (isset($_SESSION['login'])) {   
            $quey=mysqli_query($con,"DELETE FROM cart WHERE userId = '$userId'");   
        }                                                                           
    	foreach($_POST['quantity'] as $key => $val){
    		if($val==0) {
    			$query=mysqli_query($con,"DELETE FROM cart WHERE productId = '$key'");
    		} else {
                if(isset($_SESSION['login'])) {   
                    $query=mysqli_query($con,"insert into cart(userId,productId,quantity) values('$userId','$key','$val')"); 
                }
            }
		}
    }//SANIFISCARE KEY
    // Codice per rimuovere un prodotto dal carrello
    if(isset($_POST['remove_code']) && mysqli_num_rows($muery)>0) {
        foreach($_POST['remove_code'] as $key) {
            if(isset($_SESSION['login'])) {   
                $query=mysqli_query($con,"DELETE FROM cart WHERE productId = '$key'");
            }
    	}
    }
    // Codice per il checkout
    if(isset($_POST['ordersubmit'])) {   	
        if(!isset($_SESSION['login'])) {   
            header('location:login.php');
        } else {
           $query=mysqli_query($con,"DELETE FROM cart WHERE userId = '$userId'");
           header('location:index.php');
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
        <title>Il mio carrello</title>
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
                        <li><a href="#">Home</a></li>
                        <li class='active'>Carrello</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="body-content outer-top-xs">
            <div class="container">
                <div class="row inner-bottom-sm">
                    <div class="shopping-cart">
                        <div class="col-md-12 col-sm-12 shopping-cart-table ">
                            <div class="table-responsive">
                                <form name="cart" method="post">
                                    <?php
                                        $mql="SELECT * FROM cart WHERE cart.userid='$userId'";
                                        $muery=mysqli_query($con, $mql);
                                        if(mysqli_num_rows($muery)==0) {
                                            echo "Il tuo carrello e' vuoto.";
                                        } else {
                                        	?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th id="cart-romove" class="cart-romove item">Rimuovi</th>
                                                <th id="cart-description" class="cart-description item">Immagine</th>
                                                <th id="cart-product-name" class="cart-product-name item">Nome prodotto</th>
                                                <th id="cart-qty" class="cart-qty item">Quantità</th>
                                                <th id="cart-sub-total" class="cart-sub-total item">Prezzo al pezzo</th>
                                                <th id="cart-sub-total" class="cart-sub-total item">Spedizione</th>
                                                <th id="cart-total" class="cart-total last-item">Totale (€)</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7">
                                                    <div class="shopping-cart-btn">
                                                        <span class="">
                                                        <a href="index.php" class="btn btn-upper btn-primary outer-left-xs">Continua lo shopping</a>
                                                        <input type="submit" name="submit" value="Aggiorna carrello" class="btn btn-upper btn-primary pull-right outer-right-xs">
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                $sql1 = "SELECT * FROM cart ";     //selects the user's cart
                                                $query1=mysqli_query($con,$sql1);
                                                if (!empty($query1)) {    //if the user's cart isn't empty
                                                    while($row = mysqli_fetch_array($query1)){
                                                        $query = mysqli_query($con,"SELECT products.productImage1, products.productName,
                                                        products.id, cart.productId, cart.quantity as qty, products.productPrice, products.shippingCharge 
                                                         FROM products JOIN cart ON cart.productid=products.id WHERE cart.userid='$userId' ORDER BY products.id DESC"); //selects all the products in the current user's cart
                                                    } 
                                                    $totalprice=0;
                                                    $totalqunty=0;
                                                    if (!empty($query)) {
                                                    	while ($row = mysqli_fetch_array($query)) { //for each product
                                                            $quantity=$row['qty'];
                                                            $subtotal= $quantity*$row['productPrice']+$row['shippingCharge'];
                                                            $totalprice += $subtotal;  
                                                            $_SESSION['qnty']=$totalqunty+=$quantity;
                                                    ?>
                                            <tr>
                                                <td class="remove-item"><input type="checkbox" name="remove_code[]" value="<?php echo htmlentities($row['id']);?>" /></td>
                                                <td class="cart-image">
                                                    <a class="entry-thumbnail" href="detail.html">
                                                        <img src="images/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" alt="" width="114" height="146">
                                                    </a>
                                                </td>
                                                <td class="cart-product-name-info">
                                                    <h4 class='cart-product-description'><a href="product-details.php?pid=<?php echo htmlentities($pd=$row['id']);?>" ><?php echo $row['productName'];?></a></h4>
                                                </td>
                                                <td class="cart-product-quantity">
                                                    <div class="quant-input">
                                                        <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><em class="icon fa fa-sort-asc"></em></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><em class="icon fa fa-sort-desc"></em></span></div>
                                                        </div>
                                                        <input type="number" value="<?php echo $row['qty']; ?>" name="quantity[<?php echo $row['id']; ?>]">
                                                    </div>
                                                </td>
                                                <td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo $row['productPrice']; ?>.00</span></td>
                                                <td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo $row['shippingCharge']; ?>.00</span></td>
                                                <td class="cart-product-grand-total"><span class="cart-grand-total-price"><?php echo $row['qty']*$row['productPrice']+$row['shippingCharge']; ?>.00</span></td>
                                            </tr>
                                            <?php } 
                                                } 
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8 estimate-ship-tax">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>
                                        <?php if (isset($_SESSION['login'])) { ?>
                                        <span class="estimate-title">Indirizzo di spedizione</span>
                                        </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td>
                                        <div class="form-group">
                                        <?php $qry=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
                                            while ($rt=mysqli_fetch_array($qry)) {
                                                if ($rt['shippingAddress']==NULL) {
                                                    echo 'Nessun indirizzo specificato, daremo in beneficienza i prodotti acquistati. Puoi aggiungere e/o modificare il tuo indirizzo di spedizione alla pagina Aggiorna Profilo.';
                                                } else {
                                                    echo htmlentities($rt['shippingAddress'])."<br />";
                                                }
                                            }  
                                            ?>
                                        </div>
                                        <?php } ?>
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4 col-sm-12 cart-shopping-total">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>
                                        <div class="cart-grand-total">
                                        Totale<span class="inner-left-md"><?php echo $_SESSION['tp']="$totalprice". ".00 €"; ?></span> 
                                        </div>
                                        </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td>
                                        <div class="cart-checkout-btn pull-right">
                                        <button type="submit" name="ordersubmit" class="btn btn-primary">PROCEDI AL PAGAMENTO</button>
                                        </div>
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php } ?>
                            </div>			
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php include('includes/footer.php');?>
    </body>
</html>