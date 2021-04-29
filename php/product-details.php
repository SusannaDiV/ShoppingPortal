<?php 
    session_start();
    error_reporting(0);
    include('includes/config.php');
    $pid=intval($_GET['pid']);
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
        <title>Dettagli Prodotto</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link href="css/lightbox.css" rel="stylesheet">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/rateit.css">
        <link rel="stylesheet" href="css/config.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="images/favicon.ico">
    </head>
    <body class="cnt-home">
        <header class="header-style-1">
            <?php include('includes/top-header.php');?>
            <?php include('includes/main-header.php');?>
            <?php include('includes/menu-bar.php');?>
        </header>
        <div class="breadcrumb">
            <div class="container">
                <div class="breadcrumb-inner">
                    <?php
                        $ret=mysqli_query($con,"select category.categoryName as catname,subCategory.subcategory as subcatname,products.productName as pname from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory where products.id='$pid'");
                        while ($rw=mysqli_fetch_array($ret)) {
                        ?>
                    <ul class="list-inline list-unstyled">
                        <a class='home-breadcrumb' href="index.php">Home /</a>
                        <?php echo htmlentities($rw['catname']);?>  /
                        <?php echo htmlentities($rw['subcatname']);?>  /
                        <a class='active'><?php echo htmlentities($rw['pname']);?></a>
                    </ul>
                    <?php }?>
                </div>
            </div>
        </div>
        <div class="body-content outer-top-xs">
            <div class='container'>
                <div class='row single-product outer-bottom-sm '>
                    <div class='col-md-3 sidebar'>
                        <div class="sidebar-module-container">
                            <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                                <h3 class="section-title">Categorie</h3>
                                <div class="sidebar-widget-body m-t-10">
                                    <div class="accordion">
                                        <?php $sql=mysqli_query($con,"select id,categoryName  from category");
                                            while($row=mysqli_fetch_array($sql))
                                            {
                                                ?>
                                        <div class="accordion-group">
                                            <div class="accordion-heading">
                                                <a href="category.php?cid=<?php echo $row['id'];?>"  class="accordion-toggle collapsed">
                                                <?php echo $row['categoryName'];?>
                                                </a>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $ret=mysqli_query($con,"select * from products where id='$pid'");
                        while($row=mysqli_fetch_array($ret))
                        {
                        ?>
                    <div class='col-md-9'>
                        <div class="row  wow fadeInUp">
                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">
                                    <div id="owl-single-product">
                                        <div class="single-product-gallery-item" id="slide1">
                                            <a data-box="image-1" data-title="<?php echo htmlentities($row['productName']);?>" href="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>">
                                            <img class="img-responsive" alt="" src="images/blank.gif" data-echo="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" width="370" height="350" />
                                            </a>
                                        </div>
                                        <div class="single-product-gallery-item" id="slide1">
                                            <a data-lightbox="image-1" data-title="<?php echo htmlentities($row['productName']);?>" href="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>">
                                            <img class="img-responsive" alt="" src="images/blank.gif" data-echo="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" width="370" height="350" />
                                            </a>
                                        </div>
                                        <div class="single-product-gallery-item" id="slide2">
                                            <a data-lightbox="image-1" data-title="Gallery" href="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage2']);?>">
                                            <img class="img-responsive" alt="" src="images/blank.gif" data-echo="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage2']);?>" />
                                            </a>
                                        </div>
                                        <div class="single-product-gallery-item" id="slide3">
                                            <a data-lightbox="image-1" data-title="Gallery" href="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage3']);?>">
                                            <img class="img-responsive" alt="" src="images/blank.gif" data-echo="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage3']);?>" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="single-product-gallery-thumbs gallery-thumbs">
                                        <div id="owl-single-product-thumbnails">
                                            <div class="item">
                                                <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
                                                <img class="img-responsive"  alt="" src="images/blank.gif" data-echo="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" />
                                                </a>
                                            </div>
                                            <div class="item">
                                                <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="2" href="#slide2">
                                                <img class="img-responsive" width="85" alt="" src="images/blank.gif" data-echo="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage2']);?>"/>
                                                </a>
                                            </div>
                                            <div class="item">
                                                <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="3" href="#slide3">
                                                <img class="img-responsive" width="85" alt="" src="images/blank.gif" data-echo="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage3']);?>" height="200" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name"><?php echo htmlentities($row['productName']);?></h1>
                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="stock-box">
                                                    <span class="label">Produttore :</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    <span class="value"><?php echo htmlentities($row['productCompany']);?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="stock-box">
                                                    <span class="label">Spedizione :</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    <span class="value"><?php 
                                                        if($row['shippingCharge']==0) {
                                                        	echo "Gratis";
                                                        } else {
                                                        	echo htmlentities($row['shippingCharge']);
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-container info-container m-t-20">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="price-box">
                                                    <span class="price">€ <?php echo htmlentities($row['productPrice']);?></span>
                                                    <span class="price-strike">€ <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                                                </div>
                                            </div>
                                       
                                        </div>
                                    </div>
                                    <div class="quantity-container info-container">
                                        <div class="row">                                                       
                                            <div class="col-sm-7"><?php if(strlen($_SESSION['login'])!=0) { ?> 
                                                <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> AGGIUNGI AL CARRELLO</a>
                                            <?php  }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                            <div class="row">
                                <div class="col-sm-3">
                                    <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                        <li class="active"><a data-toggle="tab" href="#description">DESCRIZIONE</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-9">
                                    <div class="tab-content">
                                        <div id="description" class="tab-pane in active">
                                            <div class="product-tab">
                                                <p class="text"><?php echo $row['productDescription'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $cid=$row['category'];
                            $subcid=$row['subCategory']; } ?>
                        <section class="section featured-product wow fadeInUp">
                            <h3 class="section-title">Ti potrebbe anche interessare </h3>
                            <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                                <?php 
                                    $qry=mysqli_query($con,"select * from products where subCategory='$subcid' and category='$cid'");
                                    while($rw=mysqli_fetch_array($qry))
                                    {
                                    			?>	
                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image">
                                                    <a href="product-details.php?pid=<?php echo htmlentities($rw['id']);?>"><img  src="images/blank.gif" data-echo="images/productimages/<?php echo htmlentities($rw['id']);?>/<?php echo htmlentities($rw['productImage1']);?>" width="150" height="240" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="product-info text-left">
                                                <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($rw['id']);?>"><?php echo htmlentities($rw['productName']);?></a></h3>
                                                <div class="description"></div>
                                                <div class="product-price">	
                                                    <span class="price">
                                                    € <?php echo htmlentities($rw['productPrice']);?>			</span>
                                                    <span class="price-before-discount">€ 
                                                    <?php echo htmlentities($rw['productPriceBeforeDiscount']);?></span>
                                                </div>
                                            </div>
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                    <?php if(strlen($_SESSION['login'])!=0) { ?>
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                                            <i class="fa fa-shopping-cart"></i>													
                                                            </button>
                                                            <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>">
                                                            <button class="btn btn-primary" type="button" onSubmit="return valid();">Aggiungi al carrello</button></a>
                                                            <?php } ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </section>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php include('includes/brands-slider.php');?>
            </div>
        </div>
        <?php include('includes/footer.php');?>
    </body>
</html>