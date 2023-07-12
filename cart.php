<!DOCTYPE html>
<html lang="en">
<head>
<title>E Learning</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/fontawesome-free-6.1.1-web/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
<link rel="stylesheet" type="text/css" href="styles/cart.css">
</head>

<body>

<div class="super_container">
    <?php
	      include("inc/header.php");
    ?> 
<div class='test'>
 <div class="container pb-5 mt-n2 mt-md-n3">
    <div class="row">

        <div class="col-xl-9 col-md-8">
            <h2 class='title'>Panier</h2>
            <!-- Item ---->
 <?php
    $count=0;
    $total=0;
    if(isset($_SESSION['id_user'])){ 
     $id_user=$_SESSION['id_user'];
     $get_panier=$con->prepare("select * from panier where id_user='$id_user'");
     $get_panier->setFetchMode(PDO:: FETCH_ASSOC);
     $get_panier->execute();
     $count=$get_panier->rowCount();
         if($count !=0){
            while($row=$get_panier->fetch()){   
                $id_cour=$row['id_cour'];
                $get_cour=$con->prepare("select * from course where id_cours='$id_cour'");
                $get_cour->setFetchMode(PDO:: FETCH_ASSOC);
                $get_cour->execute();
                $sub_row=$get_cour->fetch();

                $id_cat=$sub_row['id_cat'];
                $get_cat=$con->prepare("select cat_name from cat where cat_id='$id_cat'");
                $get_cat->setFetchMode(PDO:: FETCH_ASSOC);
                $get_cat->execute();
                $cat_row=$get_cat->fetch();  
                echo "<form  method='post'>";
?>          
            <div class="d-sm-flex justify-content-between my-0 pb-0 border-bottom">
                <div class="media d-block d-sm-flex text-center text-sm-left">
                    <a class="cart-item-thumb mx-auto mr-sm-4" href="#">
                        <img src="images/<?php echo $sub_row['cover']?>" alt=""></a>
                    <div class="media-body pt-3">
                        <h3 class="product-card-title font-weight-semibold border-0 pb-0"><a href="#"><?php echo $sub_row['title']?></a></h3>
                        <div class="font-size-sm"><?php echo $cat_row['cat_name']?></div>
                        <div class="font-size-lg text-primary pt-0"><?php echo $sub_row['price']?>  DA</div>
                    </div>
                   
                </div>
                <div class='flaot_sup'><button name='del_p'><i class="fa-solid fa-x"></i></button></div>
            </div>  <hr>
            <?php  echo"<input type='hidden' name='id_p' value='".$row['id']."'/>";
                   $total=$sub_row['price']+$total;echo'</from>'; }
                ?>
        </div>
            
        <?php
        if(isset($_POST['del_p'])){
           $id_p=$_POST['id_p'];
           $delet_p=$con->prepare("delete from panier where id='$id_p'");
           $delet_p->execute();
           echo'<script> location.href ="cart.php";</script>';
        }
           
        ?>
            
      

        <div class="col-xl-3 col-md-4 pt-5 pt-md-0 pt-10">
            <h4 class='total_price'>Total:</h4>
            <div class="h3 font-weight-semibold text-center py-3"><?php echo $total;?> DA</div>
            
            <div class="btn btn-primary btn-block" type="button"  data-toggle="modal" data-target="#ckekout" data-whatever="@getbootstrap">
              Proceed to Checkout</div>
        </div>
            
        <?php } ?>
<!----------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="ckekout" tabindex="-1" role="dialog" aria-labelledby="questionLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="questionLabel">Ajouter Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
             </div>
              <div class="modal-body">
         <form method='post' class="needs-validation" novalidate>
          <div>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe" required>
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September" required>
            <div id="cvv" class="row">
              <div class='lable'>
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018" required>
              </div>
              <div>
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352" required>
              </div>
           </div>
           <button name="checkout" class="btn btn-primary">save</button>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
<!---------------------------------------------------------------------------------------->
<?php paiement(); }?>
<?php if($count==0){?>
      <div class="empty_panier">
              <img style="width:450px; height:450px;"src="images/cart3.png" alt="">
      </div>
   <?php } ?>
</div> 
</div>
</div> 
</div> 
<?php
  include("inc/footer.php");
?>


<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>
</body>

</html>
