<?php 
    session_start();
    if(isset($_GET['action']) && $_GET['action']=="add"){
        $id=intval($_GET['id']);
        $userId=$_SESSION['id'];
        $cpr="SELECT * FROM cart WHERE productId={$id} AND userId={$userId}";
        $qu=mysqli_query($con,$cpr);
        if(mysqli_num_rows($qu)==1){ //if the product is already present, then +1
            $aa="UPDATE cart SET quantity=quantity+1 WHERE productId={$id}";
            $sqlprova=mysqli_query($con,$aa);
            header('location:index.php'); 
    	} else {     //else add the given product to cart by selecting it from the product database
    		$sql_p="SELECT * FROM products WHERE id={$id}";
            $query_p=mysqli_query($con,$sql_p);
    		if(mysqli_num_rows($query_p)!=0){
                if(isset($_SESSION['login'])) {   
                    $qury=mysqli_query($con,"insert into cart(userId,productId,quantity) values('$userId','$id', 1)");
                } 
                header('location:index.php');
    		}else{
    			echo "Product ID e' invalido";//questo e' inutile perche' chiave esterna, controllo che non fallisca
    		}
    	}
    }
    ?>
<div class="top-bar animate-dropdown">
    <div class="container">
        <div class="header-top-inner">
            <div class="cnt-account">
                <ul class="list-unstyled">
                <li><a href="index.php"><em class="icon fa fa-home"></em>Home</a></li>
                    <?php if(isset($_SESSION['login']))
                        {   ?>
                    <li><a href="show_profile.php"><em class="icon fa fa-user"></em>Il mio Profilo</a></li>
                    <li><a href="update_profile.php"><em class="icon fa fa-edit"></em>Aggiorna Profilo</a></li>
                    <li><a href="logout.php"><em class="icon fa fa-sign-out"></em>Logout</a></li>
                    <?php } else { ?>
                    <li><a href="login.php"><em class="icon fa fa-sign-in"></em>Login</a></li>
                    <li><a href="registration.php"><em class="icon fa fa-sign-in"></em>Registrati</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="main-header">
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
            <div class="logo">
                <a href="index.php">
                    <h2>
                        <div class="item">
                <a href="index.php" class="image">
                <img data-echo="images/logo.jpg" src="images/blank.gif" alt="">
                </a>	</h2>
                </a>
                </div>		
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 top-search-holder">
                <div class="search-area">
                    <form name="search" method="post" action="search-result.php">
                        <input class="search-field" placeholder="Cerca qui..." name="product" required="required" />
                        <button class="search-button" type="submit" name="search"></button>    
                    </form>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
                <?php                             
                $uid=$_SESSION['id'];
                $mql="SELECT * FROM cart WHERE cart.userid='$uid'";
                $muery=mysqli_query($con, $mql);
                if(mysqli_num_rows($muery)>0) {
                        
                    	?>
                <div class="dropdown dropdown-cart">
                    
                    <ul class="dropdown-menu">
                        <?php
                            $sql = "SELECT products.productImage1 , products.productName ,
                            products.id, cart.productId, cart.quantity as qty, products.productPrice,
                            products.shippingCharge FROM products  JOIN cart ON cart.productid=products.id WHERE cart.userid='$uid' ORDER BY products.id DESC";
                            
                            $query = mysqli_query($con,$sql);
                            $totalprice=0;
                            $totalqunty=0;
                            if(!empty($query)){
                                while($row = mysqli_fetch_array($query)){
                                    $quantity=$row['qty'];
                                    $subtotal= $quantity*$row['productPrice']+$row['shippingCharge'];
                                    $totalprice += $subtotal;
                                    $_SESSION['qnty']=$totalqunty+=$quantity;
                            
                            ?>
                        <li>
                            <div class="cart-item product-summary">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="image">
                                            <img src="images/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" width="35" height="50" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo $row['productName']; ?></a></h3>
                                        <div class="price">€<?php echo $row['productPrice']+$row['shippingCharge']; ?>*<?php echo $row['qty']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php } }?>
                            <div class="clearfix"></div>
                            <hr>
                            <div class="clearfix cart-total">
                                <div class="pull-right">
                                    <span class="text">Totale:</span><span class='price'>€<?php echo $_SESSION['tp']="$totalprice". ".00"; ?></span>
                                </div>
                                <div class="clearfix"></div>
                                <a href="my-cart.php" class="btn btn-upper btn-primary btn-block m-t-20">Il mio carrello</a>	
                            </div>
                        </li>
                    </ul>
                    <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                        <div class="items-cart-inner">
                            <div class="total-price-basket">
                                <span class="lbl">carrello -</span>
                                <span class="total-price">
                                <span class="sign">€</span>
                                <span class="value"><?php 
                                if (isset($_SESSION['tp'])) {
                                    echo $_SESSION['tp']; 
                                } else { echo (string)"0";
                                }?></span>
                                </span>
                            </div>
                            <div class="basket">
                                <em class="glyphicon glyphicon-shopping-cart"></em>
                            </div>
                            <div class="basket-item-count"><span class="count"><?php 
                            if (isset($_SESSION['qnty'])) {
                                echo $_SESSION['qnty'];
                            } else { echo (string)"0";
                            }?></span></div>
                        </div>
                    </a>
                </div>
                <?php } else if (!isset($_SESSION['login'])) { ?>
                    <div class="dropdown dropdown-cart">
                    <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                        <div class="items-cart-inner">
                            <div class="total-price-basket">
                                <span class="lbl">carrello -</span>
                                <span class="total-price">
                                <span class="sign">€</span>
                                <span class="value">00.00</span>
                                </span>
                            </div>
                            <div class="basket">
                                <em class="glyphicon glyphicon-shopping-cart"></em>
                            </div>
                            <div class="basket-item-count"><span class="count">0</span></div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="cart-item product-summary">
                                <div class="row">
                                    <div class="col-xs-12">
                                        Devi effettuare il login per poter usufruire del carrello!
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="clearfix cart-total">
                                <div class="clearfix"></div>
                                <a href="login.php" class="btn btn-upper btn-primary btn-block m-t-20">Vai al login</a>	
                            </div>
                        </li>
                    </ul>
                </div>
                <?php } else { ?>
                <div class="dropdown dropdown-cart">
                    <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                        <div class="items-cart-inner">
                            <div class="total-price-basket">
                                <span class="lbl">carrello -</span>
                                <span class="total-price">
                                <span class="sign">€</span>
                                <span class="value">00.00</span>
                                </span>
                            </div>
                            <div class="basket">
                                <em class="glyphicon glyphicon-shopping-cart"></em>
                            </div>
                            <div class="basket-item-count"><span class="count">0</span></div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="cart-item product-summary">
                                <div class="row">
                                    <div class="col-xs-12">
                                        Il tuo carrello e' vuoto. Vai a riempirlo!
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="clearfix cart-total">
                                <div class="clearfix"></div>
                                <a href="index.php" class="btn btn-upper btn-primary btn-block m-t-20">Continua lo Shopping</a>	
                            </div>
                        </li>
                    </ul>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                    <div class="nav-outer">
                        <ul class="nav navbar-nav">
                            <li class="active dropdown yamm-fw">
                                <a href="index.php" data-hover="dropdown" class="dropdown-toggle">Home</a>
                            </li>
                            <?php $sql=mysqli_query($con,"select id,categoryName from category limit 6");
                                while($row=mysqli_fetch_array($sql))
                                {
                                    ?>
                            <li class="dropdown yamm">
                                <a href="category.php?cid=<?php echo $row['id'];?>"> <?php echo $row['categoryName'];?></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>