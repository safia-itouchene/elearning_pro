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
          if(isset($_GET['id_blog'])){
             $id_blog=$_GET['id_blog'];
             $get_blog=$con->prepare("select * from tb_blog where id_blog='$id_blog'");
			 $get_blog->setFetchMode(PDO:: FETCH_ASSOC);
			 $get_blog->execute();
             $row=$get_blog->fetch();
          }
    ?>

    
<div class="blog_detail">
<div class="container pb50">
    <div class="row">
        <div class="col-md-9 mb40">
            <article>
                <div class="articlimg">
                <img width=90 height=90 src="Admin/images/<?php echo $row['blog_image']?>" alt="" class="img-fluid mb30"></div>
                <div class="post-content">
                    <h3><?php echo $row['blog_title']?></h3>
                    <p><?php echo $row['blog_sub_title']?></p>
                    <ul class="post-meta list-inline">
                        <li class="list-inline-item">
                            <a>NEXTLEVEL</a>
                        </li>
                        <li class="list-inline-item">
                            <a><?php echo $row['blog_date']?></a>
                        </li>
                    </ul>
                   
                    <p class="lead"><?php echo $row['blog_cont']?></p>
                   
               
              </div>

            </div>         
                </div>
            </article>
            <!-- post article-->

        </div>
    
           
        </div>
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
