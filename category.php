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
<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
</head>

<body>

<div class="super_container">
    <?php
	        include("inc/header.php");
		    include("inc/db.php");
		    if(isset($_GET['id_cat'])){
				$id_cat=$_GET['id_cat'];
				$get_c=$con->prepare("select * from cat where cat_id='$id_cat'");
				$get_c->setFetchMode(PDO:: FETCH_ASSOC);
				$get_c->execute();
				$row=$get_c->fetch();
			}
			
		  ?> 

		  
          <div class='category'>
             <h3>Cours sur le sujet <span><?php echo $row['cat_name']?></span></h3>
          </div>

		  
		  <?php
				$get_sc=$con->prepare("select * from sub_cat");
				$get_sc->setFetchMode(PDO:: FETCH_ASSOC);
				$get_sc->execute();
				while($sub_row=$get_sc->fetch()){
					$id_sub_cat=$sub_row['sub_cat_id'];
		  ?> 
        
		
<div class="best_sellers">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="product_slider_container">
                       <h4 style="color:#007bff;"><?php echo $sub_row['sub_cat_name']; ?></h4>
						
					       <?php
							   $get_cour=$con->prepare("select * from course where   id_cat='$id_cat' and id_sub_cat='$id_sub_cat'");
							   $get_cour->setFetchMode(PDO:: FETCH_ASSOC);
							   $get_cour->execute();
							   $count=$get_cour->rowCount();
						   ?>
					    
					       <div class="owl-carousel owl-theme product_slider">
						        
						   <?php
						        if($count != 0){
                                while($cour_row=$get_cour->fetch()):
                            ?>
                              <div class="owl-item product_slider_item">
                              <div class="product-item">
                              <div class="product discount">
                              <div class="product_image">
                                 <img src="images/<?php echo $cour_row["cover"];?>" alt="">
                              </div>
                              <div class="favorite favorite_left"></div> 
                              <div class="product_info">
                              <h6 class="product_name"><a href="single.php?id=<?php echo $cour_row['id_cours']?>"><?php echo $cour_row["title"]?></a></h6>
                               <?php display_satr($cour_row['id_cours']); ?>
                               <div class="product_price"><?php echo $cour_row["price"];?></div>
                              </div>
                              </div>
                              </div>
                              </div>
                           <?php  endwhile; ?>

						   </div>
						   <div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
							   <i class="fa fa-chevron-left" aria-hidden="true"></i>
						   </div>
						   <div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
							   <i class="fa fa-chevron-right" aria-hidden="true"></i>
						   </div>
					</div>

					<?php }else{?>
							 <img style="margin-left:190%;" src="images/cart4.png" alt="">
				    <?php }?>

				</div>
			</div>
		</div>
	</div>
<?php }?>
	

</div>
<?php
    include("inc/footer.php");
?>
<script type="text/javascript" src="js/autoUpdate.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>				
<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>
</body>

</html>
