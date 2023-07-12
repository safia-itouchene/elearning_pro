
	<div class="fs_menu_overlay"></div>
	<div class="hamburger_menu">
		<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="hamburger_menu_content text-right">
			<ul class="menu_top_nav">
				<li class="menu_item has-children">
					<a href="#">
						usd
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="menu_selection">
						<li><a href="#">cad</a></li>
						<li><a href="#">aud</a></li>
						<li><a href="#">eur</a></li>
						<li><a href="#">gbp</a></li>
					</ul>
				</li>
				<li class="menu_item has-children">
					<a href="#">
						English
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="menu_selection">
						<li><a href="#">French</a></li>
						<li><a href="#">Italian</a></li>
						<li><a href="#">German</a></li>
						<li><a href="#">Spanish</a></li>
					</ul>
				</li>
				<li class="menu_item has-children">
					<a href="#">
						My Account
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="menu_selection">
						<li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
						<li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
					</ul>
				</li>
				<li class="menu_item"><a href="#">home</a></li>
				<li class="menu_item"><a href="#">shop</a></li>
				<li class="menu_item"><a href="#">promotion</a></li>
				<li class="menu_item"><a href="#">pages</a></li>
				<li class="menu_item"><a href="#">blog</a></li>
				<li class="menu_item"><a href="#">contact</a></li>
			</ul>
		</div>
	</div>

	<!-- Slider -->
     <?php
	     $get_cover=$con->prepare("select * from about_web about_web");
		 $get_cover->setFetchMode(PDO:: FETCH_ASSOC);
		 $get_cover->execute();
		 $crow=$get_cover->fetch();
	 ?>
	<div class="main_slider" style="background-image:url(Admin/images/<?php echo $crow['cover'];?>);">
		<div class="container fill_height">
			<div class="row align-items-center fill_height">
				<div class="col">
					<div class="main_slider_content">
						<h7>Apprenez étape par étape avec des tuteurs natifs.</h7>
						<h2>Parlez n'importe quelle langue en toute confiance.</h2>
						<div class='search'>
						<form action="search.php" method="post">
									 <input class="input" type="search" name="query" placeholder="Que voulez-vous apprendre?">
									 <button class="button" name="search"><b>Explorer</b></button>
								</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    
	<!-- Banner -->
	<div class="banner">
		<div class="container">
	<div class="row">
				<div class="col">
					<div class="product_slider_container">
						<div class="owl-carousel owl-theme product_slider">
						<?php
					     $get_c=$con->prepare("select * from cat");
						 $get_c->setFetchMode(PDO:: FETCH_ASSOC);
						 $get_c->execute();
						 while($row=$get_c->fetch()){
					 ?>
				<div  class="owl-item ">
				<div class="col-md-2">
					<a href="category.php?id_cat=<?php echo $row['cat_id'];?>">
					<div class="banner_item align-items-center" style=" margin-right: 5%;background-image:url(Admin/images/<?php echo $row['image'];?>);">
						<div class="banner_category">
						</div>
					</div></a>
                </div></div>
                <?php } ?>
	             </div>
				<div style="top:15%;" class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
				   <i class="fa fa-chevron-left" aria-hidden="true"></i>
				</div>
				<div style="top:12%;" class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
					<i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

	
	<!-- New Arrivals -->

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				
					<div class="section_title new_arrivals_title">
						<h3>Meilleurs Language Tutorials</h3>
					</div>
				
			</div>
			<div class="row align-items-center">
				<div>
					<div class="new_arrivals_sorting">
						<ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
                        <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*">All</li>
							 <?php
                                echo view_cat();
                             ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div  class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
						       <?php
                                   echo view_cour();
                               ?>
					</div>
					</div>
			</div>
		</div>
	</div>
<!----------------------------------------------------------------------------------------------------------------------->

<!----------------------------------------------------------------------------------------------------------------------->
	<!-- Deal of the week -->
	<div class="benefit">
		<div class="container">
			<div class="row benefit_row">
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa-solid fa-medal"></i></div>
						<div class="benefit_content">
							<h6>Tuteurs experts</h6>
							<p>Trouvez des locuteurs natifs et des tuteurs privés certifiés</p>
						</div>
					</div>
				</div>

				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa-solid fa-shield-halved"></i></div>
						<div class="benefit_content">
							<h6>Profils vérifiés</h6>
							<p>Nous vérifions et confirmons soigneusement le profil de chaque tuteur</p>
						</div>
					</div>
				</div>
				
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa-solid fa-circle-user"></i></div>
						<div class="benefit_content">
							<h6>Apprenez à tout moment</h6>
							<p>Prenez des cours en ligne au moment idéal pour votre emploi du temps chargé</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa-solid fa-money-bill-1"></i></div>
						<div class="benefit_content">
							<h6>Prix ​​abordables</h6>
							<p>Choisissez un tuteur expérimenté qui correspond à votre budget</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Best Sellers -->

	<div class="best_sellers">
		<div class="container">
			<div class="row">
				
					<div class="section_title new_arrivals_title">
						<h3>Une large sélection de cours</h3>
					</div>
				
			</div>
			<div class="row">
				<div class="col">
					<div class="product_slider_container">
						<div class="owl-carousel owl-theme product_slider">
						          <?php
                                   echo view_best_cour();
                                  ?>
						</div>

						<!-- Slider Navigation -->

						<div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Benefit -->

	<div class="benefit">
		<div class="container">
			<div class="row benefit_row">
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa-solid fa-circle-play"></i></div>
						<div class="benefit_content">
							<p>Obtenez des compétences à la demande grâce à plus de 185 000 cours vidéo</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa-solid fa-star"></i></div>
						<div class="benefit_content">
							<p>Choisissez des cours enseignés par des formateurs confirmés</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa-solid fa-earth-africa"></i></div>
						<div class="benefit_content">
							<p>Immerse yourself in a new culture Connect with language experts from around the world</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa-solid fa-infinity"></i></div>
						<div class="benefit_content">
							<p>Apprenez à votre rythme et bénéficiez d'un accès illimité sur mobile et ordinateur de bureau</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!----------------------------------------------------------------------->
    <div class="top_ens">



	</div>
	<!-- Blogs -->

	<div class="blogs">
		 
       <div class="section_title new_arrivals_title">
		    <h3>Espace  Articles et blogs</h3>
	    </div>


<div class="projcard-container">
    <?php
	    include("inc/db.php");
	    $get_blog=$con->prepare("select * from tb_blog");
		$get_blog->setFetchMode(PDO:: FETCH_ASSOC);
		$get_blog->execute();
		$i=0;
		while(($row_blog=$get_blog->fetch()) && $i<3){
	?>
  <div class="projcard projcard-blue">
    <div class="projcard-innerbox">
      <img class="projcard-img" src="Admin/images/<?php echo $row_blog['blog_image'];?>"/>
      <div class="projcard-textbox">
        <div class="projcard-title"><a href="blog_detail.php?blog&id_blog=<?php echo $row_blog['id_blog'];?>"><?php echo $row_blog['blog_title'];?></a></div><br>
        <p><?php echo $row_blog['blog_date']?></p>
        <div class="projcard-description"><?php echo $row_blog['blog_sub_title'];?></div>
      </div>
    </div>
  </div>
  
  
 <?php $i++; } ?>
  
  
  




	</div>
	


          

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
						<p>Abonnez-vous pour recevoir des notifications sur un nouveau cours</p>
					</div>
				</div>
				<div class="col-lg-6">
					<form action="post">
						<div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
							<input id="newsletter_email" type="email" placeholder="Your email" required="required" data-error="Valid email is required.">
							<button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">subscribe</button>
						</div>
					</form>
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