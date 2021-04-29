<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    $cid=intval($_GET['scid']);
    ?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <<meta name="description" content="Bio Shop Liguria">
        <meta name="author" content="Susanna Di Vita">
        <meta name="keywords" content="Bio, Shop, Liguria">
        <meta name="robots" content="all">
        <title>Sottocategorie prodotti</title>
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
        </div>
        <div class="body-content outer-top-xs">
            <div class='container'>
                <div class='row outer-bottom-sm'>
                    <div class='col-md-3 sidebar'>
                        <div class="sidebar-module-container">
                            <h3 class="section-title">Acquista prodotti in</h3>
                            <div class="sidebar-filter">
                                <div class="sidebar-widget wow fadeInUp outer-bottom-xs ">
                                    <div class="widget-header m-t-20">
                                        <h4 class="widget-title">Categorie</h4>
                                    </div>
                                    <div class="sidebar-widget-body m-t-10">
                                        <?php $sql=mysqli_query($con,"select id,categoryName from category");
                                            while($row=mysqli_fetch_array($sql)) {
                                                ?>
                                        <div class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a href="category.php?cid=<?php echo $row['id'];?>" class="accordion-toggle collapsed">
                                                    <?php echo $row['categoryName'];?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-9'>
                        <div id="category" class="category-carousel hidden-xs">
                            <div class="container-fluid">
                                <div class="caption vertical-top text-left">
                                    <div class="big-text">
                                        <br />
                                    </div>
                                    <?php $sql=mysqli_query($con,"select subcategory from subcategory where id='$cid'");
                                        while ($row=mysqli_fetch_array($sql)) {
                                        ?>
                                    <h2><?php echo htmlentities($row['subcategory']);?></h2>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="search-result-container">
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane active " id="grid-container">
                                    <div class="category-product  inner-top-vs">
                                        <div class="row">
                                            <?php
                                                $ret=mysqli_query($con,"select * from products where subCategory='$cid'");
                                                $num=mysqli_num_rows($ret);
                                                if ($num>0) {
                                                    while ($row=mysqli_fetch_array($ret)) {?>							
                                            <div class="col-sm-6 col-md-4 wow fadeInUp">
                                                <div class="products">
                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img  src="images/blank.gif" data-echo="images/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" alt="" width="200" height="300"></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
                                                            <div class="product-price">	
                                                                <span class="price">€ <?php echo htmlentities($row['productPrice']);?></span>
                                                                <span class="price-before-discount">€ <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>								
                                                            </div>
                                                        </div>
                                                        <div class="cart clearfix animate-effect">
                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    <?php if(isset($_SESSION['login'])) { ?>
                                                                    <li class="add-cart-button btn-group">
                                                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"><em class="fa fa-shopping-cart"></em></button>
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
                                            <?php } } else {?>	
                                            <div class="col-sm-6 col-md-4 wow fadeInUp">
                                                <h3>Sottocategoria vuota.</h3>
                                            </div>
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
        <?php include('includes/footer.php');?>
    </body>
</html>