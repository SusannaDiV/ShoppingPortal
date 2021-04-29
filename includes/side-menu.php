<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><em class="icon fa fa-align-justify fa-fw"></em> Categorie</div>
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
            <li class="dropdown menu-item">
                <?php $sql=mysqli_query($con,"select id,categoryName  from category");
                    while($row=mysqli_fetch_array($sql))
                    {
                        ?>
                <a href="category.php?cid=<?php echo $row['id'];?>" class="dropdown-toggle"><em class="icon fa fa-leaf fa-fw"></em>
                <?php echo $row['categoryName'];?></a>
                <?php }?>
            </li>
        </ul>
    </nav>
</div>