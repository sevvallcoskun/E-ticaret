<?php
session_start();
include("inc/db.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Anasayfa</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<div class="container">

      <header class="row">

      	<navbar class="col-md-12">
<?php include("inc/menu.php"); ?>

      	</navbar>

      </header>




 <div class="row pw">
 	<aside class="col-md-3">
  <div class="tc">

    <div id="xyz"></div>

  </div>

 		<ul class="list-group">
  <li class="list-group-item active">Product Category</li>
<?php
              $sel="SELECT * FROM category WHERE parent_id='0'";
              $rs=$con->query($sel);
              while($row=$rs->fetch_assoc()){
              ?>
  <li class="list-group-item" data-toggle="collapse" data-target="#sc<?php echo $row['id'];?>"><?php echo $row['name'] ?></li>

  <div class="collapse" id="sc<?php echo $row['id'];?>">

  <?php
                $pid=$row['id'];
                $selc="SELECT * FROM category WHERE parent_id='$pid'";
              $rsc=$con->query($selc);
              while($rowc=$rsc->fetch_assoc()){

                ?>
<li class="list-group-item " ><?php echo $rowc['name']; ?></li>

            <?php }  ?>
        </div>

<?php  } ?>

</ul>
 	</aside>

 	<section class="col-md-9">
 		<div class="row">

 			<?php
      $sel="SELECT * FROM product WHERE cat='3'";
      $rs=$con->query($sel);
      while($row=$rs->fetch_assoc()){
      ?>
 			<article class="col-md-4">
 				<div class="card" >
          
  <img class="card-img-top" src="product_img/<?php echo $row['pimg']; ?>" style="height: 200px;" alt="Card image"></a>
  <div class="card-body">
    <h4 class="card-title"><?php echo $row['pname']; ?></h4>
    <p class="card-text">Rs: <?php echo $row['pprice']; ?></p>
    <?php
      if(isset($_SESSION['cid']))
       {

      ?>
   <form action="ins-cart.php" method="post">
     <p><input type="number" name="qty" value="1" min="1" style="width: 60px;"></p>
     <input type="hidden" name="pid" value="<?php echo $row['id']; ?>">
     <input type="hidden" name="price" value="<?php echo $row['pprice']; ?>">
     <input type="submit" name="act" value="Sepete Ekle" class="btn btn-primary">
   </form>
 <?php  } else {?>
 <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#logi">Satın almak için giriş yap</a>
  <?php
 }
  ?>


  </div>
</div>

 			</article>
 			 <?php
       }
      ?>
 		</div>

 	</section>

 </div>
	</div>

<div class="modal" id="logi">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Giriş Yap</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <form action="lc.php" method="post">


          <p>Telefon Numarası veya Email</p>
          <p><input type="text" name="uname" class="form-control"></p>
          <p>Şifre</p>
          <p><input type="password" name="pass" class="form-control"></p>
          <p><input type="submit" name="save" value="Sign In" class="btn btn-primary"></p>
       </form>
      </div>


    </div>
  </div>
</div>

<div class="modal" id="signu">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Üye Ol</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <form action="reg.php" method="post" onsubmit="return vali();">
         <p>Ad<p>
          <p><input type="text" name="name" class="form-control"></p>
          <p>Email</p>
          <p><input type="email" name="email" class="form-control"></p>
          <p>Telefon Numarası</p>
          <p><input type="text" name="phone" class="form-control"></p>
          <p>Şifre</p>
          <p><input type="password" name="pass" id="pass" class="form-control"></p>
          <p>Şifreyi Onayla</p>
          <p><input type="password" name="cpass" id="cpass" class="form-control"></p>
          <p><input type="submit" name="save" value="Sign Up" class="btn btn-success"></p>
       </form>
      </div>


    </div>
  </div>
</div>
<script >
  function vali(){
    var pass=document.getElementById("pass").value;
    var cpass=document.getElementById("cpass").value;
    if(pass!=cpass){
      alert("Şifre Eşleşmedi");
      return false;
    }
  }
</script>
</body>
</html>
