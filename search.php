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
<style>
    .grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  grid-gap: 20px;
  align-items: stretch;
}

.grid > article {
  border: 1px solid #ccc;
}

.grid > article img {
  width: 100%;
}

.grid .text {
  padding: 20px;
}

</style>

<body>

<div class="super_container">
    <?php
	      include("inc/header.php");
	?>
  <?php
       $search="";
	    if(isset($_POST['search'])){
			    $search=$_POST['query'];
	  	}
	?>
                   <div class="sarecg_re">
						<div class='search'>
					        	<form action="search.php" method="post">
									 <input class="input" type="search" name="query" placeholder="Que voulez-vous apprendre?" value="<?php echo $search;?>">
									 <button class="button" name="search"><b>Explorer</b></button>
								</form>
	          </div>

     
<div class="resultat_t">
<div class="container">
  <main class="grid">
  <?php
        if($search !=""){
         include("inc/db.php");
         $get_search=$con->prepare("select * from cat where cat_name like '%$search%'");
         $get_search->setFetchMode(PDO:: FETCH_ASSOC);
         $get_search->execute();
         $count= $get_search->rowCount();
         if( $count != 0){

         
         while($row=$get_search->fetch()){
               $id_cat=$row['cat_id'];
               $get_cour=$con->prepare("select * from course where id_cat='$id_cat'");
               $get_cour->setFetchMode(PDO:: FETCH_ASSOC);
               $get_cour->execute();
               $sub_count= $get_cour->rowCount();
               
                 
                
               while($sub_row=$get_cour->fetch()){       
      ?>
    <article>
      <img src="images/<?php echo $sub_row['cover']  ?>" alt="Sample photo">
      <div class="text">
          <h6> <a href="single.php?id=<?php echo $sub_row['id_cours'] ?>"><?php echo $sub_row['title'] ?></a></h6>
         <?php
            display_satr($sub_row['id_cours']);
         ?>
        
      </div>
    </article>

    <?php  }} }}?>
           <?php
              if($search == ""){?>
                <div class="noresualt">
                       <img src="images/search.svg" alt="">
                  <p>Non resualt...</p>
                </div>
             <?php }elseif ($count == 0) { ?>
               <div class="noresualt">
                      <img src="images/search.svg" alt="">
                      <p>Non resualt...</p>
                </div>
              <?php }elseif($sub_count ==0 ) {?>
                <div class="noresualt">
                      <img src="images/search.svg" alt="">
                      <p>Non resualt...</p>
                </div>
              <?php } ?>
  </main>
</div>
                        </div>
      </div>				
</div>
<script>
	let input = document.querySelector(".input");
let button = document.querySelector(".button");

button.disabled = true;

input.addEventListener("change", stateHandle);

function stateHandle() {
	if (document.querySelector(".input").value === "") {
		button.disabled = true;
	} else {
		button.disabled = false;
	}
}

	</script>
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
