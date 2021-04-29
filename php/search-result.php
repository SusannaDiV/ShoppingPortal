<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    $_SESSION['find']="%{$_POST['product']}%"; 
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
        <title>Risultati della ricerca</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link href="css/lightbox.css" rel="stylesheet">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                        <div class="side-menu animate-dropdown outer-bottom-xs">
                            <div class="side-menu animate-dropdown outer-bottom-xs">
                                <div class="head"><em class="icon fa fa-align-justify fa-fw"></em>Sottocategorie</div>
                                <nav class="yamm megamenu-horizontal" role="navigation">
                                    <ul class="nav">
                                        <li class="dropdown menu-item">
                                            <?php $sql=mysqli_query($con,"select id,subcategory from subcategory");
                                                while($row=mysqli_fetch_array($sql)) {
                                                    ?>
                                            <a href="sub-category.php?scid=<?php echo $row['id'];?>" class="dropdown-toggle"><i class="icon fa fa-leaf fa-fw"></i>
                                            <?php echo $row['subcategory'];?></a>
                                            <?php }?>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="sidebar-module-container">
                            <h3 class="section-title">Acquista prodotti in</h3>
                            <div class="sidebar-filter">
                                <div class="sidebar-widget wow fadeInUp outer-bottom-xs ">
                                    <div class="widget-header m-t-20">
                                        <h4 class="widget-title">Categorie</h4>
                                    </div>
                                    <div class="sidebar-widget-body m-t-10">
                                        <?php $sql=mysqli_query($con,"select id,categoryName  from category");
                                            while($row=mysqli_fetch_array($sql)) {
                                                ?>
                                        <div class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a href="category.php?cid=<?php echo $row['id'];?>"  class="accordion-toggle collapsed">
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
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <p>
                                        <label for="amount">Filtra i prodotti per il prezzo:</label>
                                        <span id="amount" class="amount"></span>
                                    </p>
                                    <div id="slider-range">
                                        <style type="text/css">.ui-widget-header{background: #2ba65f;}</style>
                                    </div>
                                    <br>
                                    <table class="table table-striped" id="tableData">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('includes/footer.php');?>
        <script src="js/jquery.easing-1.3.min.js"></script>
        <script src="js/bootstrap-slider.min.js"></script>
        <script type="text/javascript" src="js/lightbox.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
        <script src="js/scripts.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                var v1 = 0;
                var v2 = 70;

                $("#slider-range").slider({
                    range: true,
                    min: 0,
                    max: 70,
                    values: [v1, v2],
                    slide: function(event, ui) {
                        $("#amount").html( "€" + ui.values[ 0 ] + " - €" + ui.values[ 1 ] );
                        v1 = ui.values[ 0 ];
                        v2 = ui.values[ 1 ];
                        loadRecords(v1, v2);
                    }
                });

                $("#amount").html("€" + $("#slider-range" ).slider( "values", 0 ) + " - €" + $("#slider-range").slider("values", 1));

                function loadRecords(range1, range2){
                    $.ajax({
                        url : "search.php",
                        type: "POST",
                        data : {minPrezzo : range1, maxPrezzo : range2}, 
                        cache:false,
                        success:function(result){
                            $("#tableData tbody").html(result);
                        }
                    });
                }
                loadRecords(v1, v2);
            });
        </script>
    </body>
</html>