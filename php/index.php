<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    ?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="Bio Shop Liguria">
        <meta name="author" content="Susanna Di Vita">
        <meta name="keywords" content="Bio, Shop, Liguria">
        <meta name="robots" content="all">
        <title>Bio Liguria Shop</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/owl.transitions.css">
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
        <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="furniture-container homepage-container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
                        <?php include('includes/side-menu.php');?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                        <div id="hero" class="homepage-slider3">
                            <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                                <div class="full-width-slider">
                                    <div class="item" style="background-image: url(images/sliders/slider1.png);">
                                    </div>
                                </div>
                                <div class="full-width-slider">
                                    <div class="item full-width-slider" style="background-image: url(images/sliders/slider2.png);">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info-boxes wow fadeInUp">
                            <div class="info-boxes-inner">
                                <div class="row">
                                    <div class="col-md-6 col-sm-4 col-lg-4">
                                        <div class="info-box">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <em class="icon fa fa-dollar"></em>
                                                </div>
                                                <div class="col-xs-10">
                                                    <h4 class="info-box-heading green">Risparmia</h4>
                                                </div>
                                            </div>
                                            <h6 class="text">sui prodotti bio, dop e igp liguri</h6>
                                        </div>
                                    </div>
                                    <div class="hidden-md col-sm-4 col-lg-4">
                                        <div class="info-box">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <em class="icon fa fa-truck"></em>
                                                </div>
                                                <div class="col-xs-10">
                                                    <h4 class="info-box-heading orange">Free shipping</h4>
                                                </div>
                                            </div>
                                            <h6 class="text">su molti dei nostri prodotti </h6>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-4 col-lg-4">
                                        <div class="info-box">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <em class="icon fa fa-gift"></em>
                                                </div>
                                                <div class="col-xs-10">
                                                    <h4 class="info-box-heading red">Idee regalo</h4>
                                                </div>
                                            </div>
                                            <h6 class="text">Solo il meglio per i tuoi cari</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="product-tabs-slider" class="scroll-tabs inner-bottom-vs  wow fadeInUp">
                    <div class="more-info-tab clearfix">
                        <h3 class="new-product-title pull-left">In vetrina</h3>
                        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                            <li class="active"><a href="#all" data-toggle="tab">Tutto</a></li>
                            <li><a href="#alimentari" data-toggle="tab">Alimentari</a></li>
                            <li><a href="#cosmesi" data-toggle="tab">Cosmetici</a></li>
                        </ul>
                    </div>
                    <div class="tab-content outer-top-xs">
                        <div class="tab-pane in active" id="all">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                    <?php
                                        $ret=mysqli_query($con,"select * from products");
                                        while ($row=mysqli_fetch_array($ret)) {
                                        ?>
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                        <img alt="productimage" src="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
                                                    <div class="product-price">	
                                                        <span class="price">
                                                        € <?php echo htmlentities($row['productPrice']);?>			</span>
                                                        <span class="price-before-discount">€ <?php echo htmlentities($row['productPriceBeforeDiscount']);?>	</span>
                                                    </div>
                                                </div>
                                                <?php if(isset($_SESSION['login'])) { ?>
                                                <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Aggiungi al carrello</a></div>
                                                <?php  }?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="alimentari">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                    <?php
                                        $ret=mysqli_query($con,"select * from products where category=1 order by id desc");
                                        while ($row=mysqli_fetch_array($ret)) {
                                        ?>
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                        <img alt="cat1img" src="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
                                                    <div class="product-price">	
                                                        <span class="price">
                                                        € <?php echo htmlentities($row['productPrice']);?>			</span>
                                                        <span class="price-before-discount">€ <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                                                    </div>
                                                </div>
                                                <?php if(isset($_SESSION['login'])) { ?>
                                                <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Aggiungi al carrello</a></div>
                                                <?php  }?>                                            
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="cosmesi">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                    <?php
                                        $ret=mysqli_query($con,"select * from products where category=4");
                                        while ($row=mysqli_fetch_array($ret)) {
                                        ?>
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                        <img alt="cat4img" src="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
                                                    <div class="product-price">	
                                                        <span class="price">
                                                        € <?php echo htmlentities($row['productPrice']);?>			</span>
                                                        <span class="price-before-discount">€ <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                                                    </div>
                                                </div>
                                                <?php if(isset($_SESSION['login'])) { ?>
                                                <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Aggiungi al carrello</a></div>
                                                <?php  }?>                                            
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sections prod-slider-small outer-top-small">
                    <div class="row">
                        <div class="col-md-6">
                            <section class="section">
                                <h3 class="section-title">Salse tipiche</h3>
                                <div class="owl-carousel homepage-owl-carousel custom-carousel outer-top-xs owl-theme" data-item="2">
                                    <?php
                                        $ret=mysqli_query($con,"select * from products where category=1 and subCategory=2");
                                        while ($row=mysqli_fetch_array($ret)) {
                                        ?>
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img alt="cat1sub2img" src="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300"></a>
                                                    </div>
                                                </div>
                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
                                                    <div class="product-price">	
                                                        <span class="price">
                                                        € <?php echo htmlentities($row['productPrice']);?>			</span>
                                                        <span class="price-before-discount">€ <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                                                    </div>
                                                </div>
                                                <?php if(isset($_SESSION['login'])) { ?>
                                                <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Aggiungi al carrello</a></div>
                                                <?php }?>                                            
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6">
                            <section class="section">
                                <h3 class="section-title">Vini</h3>
                                <div class="owl-carousel homepage-owl-carousel custom-carousel outer-top-xs owl-theme" data-item="2">
                                    <?php
                                        $ret=mysqli_query($con,"select * from products where category=2");
                                        while ($row=mysqli_fetch_array($ret)) {
                                        ?>
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img alt="cat2image" src="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="300" height="300"></a>
                                                    </div>
                                                </div>
                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
                                                    <div class="product-price">	
                                                        <span class="price">
                                                        € <?php echo htmlentities($row['productPrice']);?>			</span>
                                                        <span class="price-before-discount">€ <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                                                    </div>
                                                </div>
                                                <?php if(isset($_SESSION['login'])) { ?>
                                                <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Aggiungi al carrello</a></div>
                                                <?php }?>                                            
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <section class="section featured-product inner-xs wow fadeInUp">
                    <h3 class="section-title">Pesto</h3>
                    <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
                        <?php
                            $ret=mysqli_query($con,"select * from products where category=1 and subcategory=1");
                            while ($row=mysqli_fetch_array($ret)) {
                            ?>
                        <div class="item">
                            <div class="products">
                                <div class="product">
                                    <div class="product-micro">
                                        <div class="row product-micro-row">
                                            <div class="col col-xs-6">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-lightbox="image-1" data-title="<?php echo htmlentities($row['productName']);?>">
                                                            <img alt="productimage1" src="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" width="170" height="174" alt="">
                                                            <div class="zoom-overlay"></div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col col-xs-6">
                                                <div class="product-info">
                                                    <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
                                                    <div class="product-price">	
                                                        <span class="price">
                                                        € <?php echo htmlentities($row['productPrice']);?>
                                                        </span>
                                                    </div>
                                                    <?php if(isset($_SESSION['login'])) { ?>
                                                    <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Aggiungi al carrello</a></div>
                                                    <?php  }?>                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </section>
            </div>
        </div>
        <?php include('includes/footer.php');?>
    </body>
</html>