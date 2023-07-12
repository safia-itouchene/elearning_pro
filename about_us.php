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
<div class="about_us">
        <section>
            <div class = "image">
               <img src="images/about2.png">
            </div>
            <?php
                 $get_about=$con->prepare("select * from about_web");
                 $get_about->setFetchMode(PDO:: FETCH_ASSOC);
                 $get_about->execute();
                 $row=$get_about->fetch();
            ?>

            <div class = "content">
                <h2>NEXT<b style="color:#007bff;">LEVEL</b></h2>
                <span><!-- line here --></span> 
                
                <p><?php echo $row['about_us'];?></p>
               
                <ul class = "icons">
                      <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
				      <li><a href="<?php echo $row['url1'];?>"><i class="fa-brands fa-twitter"></i></a></li>
				      <li><a href="<?php echo $row['yrl2'];?>"><i class="fa-brands fa-instagram"></i></a></li>
				      <li><a href="<?php echo $row['url3'];?>"><i class="fa-brands fa-skype"></i></a></li>
				      <li><a href="<?php echo $row['url4'];?>"><i class="fa-brands fa-github"></i></a></li>

                </ul>
            </div>
        </section><br><br></div>
        </div>
    </body>
</html>
