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
    ?>
<div class="allblogs">
<div class="container">
	<div class="card-columns">

    <div class="card p-3">
			<blockquote class="card-block card-blockquote">
				<p>Changer l apprentissage pour le mieux Que vous vouliez apprendre ou partager ce que vous savez, vous êtes au bon endroit. En tant que destination mondiale pour l apprentissage en ligne, nous connectons les gens grâce à la connaissance.</p>
				<footer>
					
				</footer>
			</blockquote>
		</div>

		<?php 
		     $get_blog=$con->prepare("select * from tb_blog");
			 $get_blog->setFetchMode(PDO:: FETCH_ASSOC);
			 $get_blog->execute();
			 while($row=$get_blog->fetch()){
		?>
		<div class="card">
			<img alt="Card image cap" class="card-img-top img-fluid" src="Admin/images/<?php echo $row['blog_image']?>">
			<div class="p-3 card-block"><a href="blog_detail.php?blog&id_blog=<?php echo $row['id_blog']?>">
				<h4 class="card-title"><?php echo $row['blog_title']?></h4></a>
				<p class="card-text"><?php echo $row['blog_sub_title']?></p>
				<p style="color:black;'"><?php echo $row['blog_date']?></p>
			</div>
		</div>
  <?php }?>

	</div>	
</div>


</div>

     <?php
          include("inc/footer.php");
	?>
</div>
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
