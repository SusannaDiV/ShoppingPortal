<?php	    
    session_start();
    include_once('includes/config.php');
    
    if (isset($_POST['minPrezzo']) && isset($_POST['maxPrezzo'])) {
    	$minPrezzo = $_POST['minPrezzo'];
    	$maxPrezzo = $_POST['maxPrezzo'];
    	$find = $_SESSION['find'];
		$stmt = $con->prepare("SELECT * FROM products WHERE productName like ? AND productPrice BETWEEN '$minPrezzo' AND '$maxPrezzo'");
		$stmt->bind_param("s", $find);
		$stmt->execute();
		$res = $stmt->get_result();
    }
    else {
    	$minPrezzo = "";
    	$maxPrezzo = "";
    }
    
    if (mysqli_num_rows($res) > 0) {
    	while($row = $res->fetch_assoc()){?>
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
							<div class="description"></div>
							<div class="product-price">	
								<span class="price">
								€ <?php echo htmlentities($row['productPrice']);?>			</span>
								<span class="price-before-discount">€ <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
							</div>
						</div>
						<div class="cart clearfix animate-effect">
							<div class="action">
								<ul class="list-unstyled">
								<?php if(isset($_SESSION['login'])) { ?>
									<li class="add-cart-button btn-group">
										<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
										<i class="fa fa-shopping-cart"></i>													
										</button>
										<a href="category.php?page=product&action=add&id=<?php echo $row['id']; ?>">
										<button class="btn btn-primary" type="button">Aggiungi al carrello</button></a>	
										<?php } ?>	
				
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		} 
	} else {   ?>                     
		<h3>Nessun prodotto trovato.</h3>
<?php } ?>