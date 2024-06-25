<?php 
require_once ('db.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funda of Web IT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container">
        <div class="row">


            <!-- Brand List  -->
            <div class="col-md-3">
                <form action="" method="GET">
                    <div class="card shadow mt-3">
                        <div class="card-header">
                            <h5>Filter 
                                <button type="submit" class="btn btn-primary btn-sm float-end">Search</button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Brand List</h6>
                            <hr>
                            <?php

                                $brand_query = "SELECT * FROM a_brands";
                                $brand_query_run  = mysqli_query($con, $brand_query);

                                if(mysqli_num_rows($brand_query_run) > 0)
                                {
                                    foreach($brand_query_run as $brandlist)
                                    {
                                        $checked = [];
                                        if(isset($_GET['brands']))
                                        {
                                            $checked = $_GET['brands'];
                                        }
                                        ?>
                                            <div>
                                                <input type="checkbox" name="brands[]" value="<?= $brandlist['id']; ?>" 
                                                    <?php if(in_array($brandlist['id'], $checked)){ echo "checked"; } ?>
                                                 />
                                                <?= $brandlist['name']; ?>
                                            </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "No Brands Found";
                                }
                            ?>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Brand Items - Products -->
            <div class="col-md-9 mt-3">
                <div class="card ">
                    <div class="card-body row">
                        <?php
                            if(isset($_GET['brands']))
                            {
                                $branchecked = [];
                                $branchecked = $_GET['brands'];
                                foreach($branchecked as $rowbrand)
                                {
                                    // echo $rowbrand;
                                    $products = "SELECT * FROM product WHERE brand_id IN ($rowbrand)";
                                    $products_run = mysqli_query($con, $products);
                                    if(mysqli_num_rows($products_run) > 0)
                                    {
                                        foreach($products_run as $proditems) :
                                            ?>
<div class="card" >
          
          <img class="card-img-top" src="product_img/<?php echo $proditems['pimg']; ?>" style="height: 200px;" alt="Card image"></a>
          <div class="card-body">
            <h4 class="card-title"><?php echo $proditems['pname']; ?></h4>
            <p class="card-text">Rs: <?php echo $proditems['pprice']; ?></p>
            <?php
      if(isset($_SESSION['cid']))
       {

      ?>
   <form action="ins-cart.php" method="post">
     <p><input type="number" name="qty" value="1" min="1" style="width: 60px;"></p>
     <input type="hidden" name="pid" value="<?php echo $proditems['id']; ?>">
     <input type="hidden" name="price" value="<?php echo $proditems['pprice']; ?>">
     <input type="submit" name="act" value="Sepete Ekle" class="btn btn-primary">
   </form>
 <?php  } else {
   ?>
 <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#logi">Satın almak için giriş yap</a>
  <?php
 }
  ?>
            
                                            <?php
                                        endforeach;
                                    }
                                }
                            }
                            else
                            {
                                $products = "SELECT * FROM product";
                                $products_run = mysqli_query($con, $products);
                                if(mysqli_num_rows($products_run) > 0)
                                {
                                    foreach($products_run as $proditems) :
                                        ?>
         <div class="card" >
          
          <img class="card-img-top" src="product_img/<?php echo $proditems['pimg']; ?>" style="height: 200px;" alt="Card image"></a>
          <div class="card-body">
            <h4 class="card-title"><?php echo $proditems['pname']; ?></h4>
            <p class="card-text">Rs: <?php echo $proditems['pprice']; ?></p>
            <?php
      if(isset($_SESSION['cid']))
       {

      ?>
   <form action="ins-cart.php" method="post">
     <p><input type="number" name="qty" value="1" min="1" style="width: 60px;"></p>
     <input type="hidden" name="pid" value="<?php echo $proditems['id']; ?>">
     <input type="hidden" name="price" value="<?php echo $proditems['pprice']; ?>">
     <input type="submit" name="act" value="Sepete Ekle" class="btn btn-primary">
   </form>
 <?php  } else {
   ?>
 <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#logi">Satın almak için giriş yap</a>
  <?php
 }
  ?> <?php
                                    endforeach;
                                }
                                else
                                {
                                    echo "No Items Found";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>