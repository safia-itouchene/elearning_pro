<?php 
   
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
	include("inc/fonction.php");
	include("inc/db.php");
	?>
	<header class="header trans_300">
		<?php 	
		$url = $_SERVER["REQUEST_URI"]; 
		if($url === '/elearning_pro/index.php' || $url === "/elearning_pro/"){?>
	     <div class="top_nav">
			  <div id='link'>
			      <ul>
				      <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
				      <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
				      <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
				      <li><a href="#"><i class="fa-brands fa-skype"></i></a></li>
				      <li><a href="#"><i class="fa-brands fa-github"></i></a></li>
                  </ul>
		     </div>
		</div>
		<?php }?>
		<!--End Top Nav-->
      <nav>
	  <div class="main_nav_container">
				<div class="row">
					   <div  class="col-lg-12 text-right">
						  
						        <div class="logo_container">
							          <a href="index.php">Next<b>Level</b></a>
						        </div>
						         <div class="menu">
								      <ul class='menu_right'>
					                     <li><a href="#">Languges</a></li>
				                         <li><a href="blog.php">Blogs</a></li>
				                         <li><a href="about_us.php">À propos NEXTLEVEL</a></li>
							         </ul>
                                    
									  <ul class='menu_left'> 
									     
										  <?php
										   $j=0;
									 if(isset($_SESSION['id_user'])){
										
										 demande_enseignement();
										 $id_user=$_SESSION['id_user'];
										 $get_cart=$con->prepare("select * from panier where id_user='$id_user'");
										 $get_cart->setFetchMode(PDO:: FETCH_ASSOC);
										 $get_cart->execute();

										 $get_ens=$con->prepare("select * from enseignant where id_user='$id_user'");
										 $get_ens->setFetchMode(PDO:: FETCH_ASSOC);
										 $get_ens->execute();
										 $count=$get_ens->rowCount();
										 if($count == 1){
										    echo ' <li class="bessnis"><a href="cours.php">Enseigner sur NEXTLEVEL</a></li>';
										}else{
											echo ' <li style="cursor: pointer;" class="bessnis" data-toggle="modal" data-target="#demande">Enseigner sur NEXTLEVEL</li>';
										 }
										 while($row=$get_cart->fetch()){
											   $j++;
										 }
									           echo '<li id="some_div" class="checkout"><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span id="checkout_items" class="checkout_items">'. $j.'</span></a></li>';
											   
										}else{
                                               echo '<li class="checkout"><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span id="checkout_items" class="checkout_items">0</span></a></li>';
										}
									 ?>
										<?php  if(isset($_SESSION['id_user'])){
											   $id_user=$_SESSION['id_user'];
											   $get_user=$con->prepare("select * from user where id_user='$id_user'");
											   $get_user->setFetchMode(PDO:: FETCH_ASSOC);
											   $get_user->execute();
											   $row=$get_user->fetch();
                                          echo' 
										 
										  <li><div class="profile-photo">
												   <img  src="images/'.$row['user_image'].'">
												   <div class="dropdown-content">
												        <a href="profile.php?profile"><i class="fa-solid fa-circle-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a>
												        <a href="profile.php?msg"><i class="fa-regular fa-envelope"></i>&nbsp;&nbsp;&nbsp;&nbsp;Message</a>
												        <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
												   </div>
										      </div>
									      </li>
										  ';
										}else{ ?>
									</ul>
									<?php
									      echo " <ul class='menu_user'>
									  
										  <div class='login'>
											 <a href='se_connecter.php'>Se connecter</a>
										   </div>
										   <div class='singin'>
											  <a href='inscrire.php'>S' inscrire</a>
										   </div>
									  </ul>";
									
									  } ?>

								 </div>
                       </div>
                </div>
     </div>
	  </nav>
	</header>
<!------------------------------------------------------->
<div class="modal fade" id="demande" tabindex="-1" role="dialog" aria-labelledby="demandeLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="demandeLabel">Demande d'enseignement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   <?php
        $id_user=$_SESSION['id_user'];

        $get_demande=$con->prepare("select * from demande_enseignement where id_user='$id_user'");
		$get_demande->setFetchMode(PDO:: FETCH_ASSOC);
		$get_demande->execute();
		$count=$get_demande->rowCount();

		if($count == 1){
		    $res=$get_demande->fetch();
		    $resultat= $res['resultat'];

			if($resultat==0){
		
   ?>
      <div class="modal-body">
        <form  method='post'>
           <h3 style="text-align: center;">La demande est en attente</h3>
		   <img style="margin-left:20%; width:300px; height:300px;" src="images/wait.PNG" alt="">
        </form>
      </div>
	  <?php }else{  if($resultat==1)?>
		<div class="modal-body">
        <form  method='post'>
           <h3  style="text-align: center;">La demande est refusée</h3>
		   <img style="margin-left:20%; width:300px; height:300px;" src="images/no.PNG" alt="">
		   <button style="float:right"  name='try_agine' type="submit" class="btn btn-primary">Essayer plus tard</button>
        </form>
		<?php
		    if(isset($_POST['try_agine'])){
				$del=$con->prepare("delete from demande_enseignement where id_user='$id_user'");
				$del->execute();
				echo'<script> location.href ="index.php";</script>';
			} 
		?>
      </div>
	  <?php }?>
     <?php }else{?>
		<div class="modal-body">
        <form  method='post' enctype="multipart/form-data"  class="needs-validation" novalidate  id="bootstrapForm">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Niveau Académique :</label>
            <input type="text" name='niveau_acad' class="form-control" id="recipient-name" required>
			
            <div class="invalid-feedback">Entrez votre Niveau Académique</div>

			<label for="recipient-name" class="col-form-label">La langue(s) que vous souhaitez enseigner :</label>
            <input type="text" name='lang' class="form-control" id="recipient-name" required>
			
            <div class="invalid-feedback">Entrez La langue(s) que vous souhaitez enseigner</div>

			<label for="recipient-name" class="col-form-label">Votre niveau dans cette langue :</label>
            <select id="cars" name="level" class="form-control" required>
                <?php echo view_option_sub_cat();?>
           </select>
		   <div class="invalid-feedback">Niveau</div>

		    <label for="recipient-name" class="col-form-label"> Certificats prouvant votre niveau :</label>
            <input type="file" name='certificat' class="form-control" id="recipient-name" required>

          

          </div>
          <button name='demande_enseignement' type="submit" class="btn btn-primary" >Envoyer</button>
        </form>
      </div>
	  <?php }?>
    </div>
  </div>
</div>

<!--*************************************************************-->
<script>
	function update() {
  $.get("response.php", function(data) {
    $("#some_div").html(data);
    window.setTimeout(update,1);
  });
}
</script>

<script>
	
function validateForm()                                 
                 { 
                     var femail = document.forms["emyForm"]["niveau_acad"];         
                     if (femail.value == ""){ 
                         document.getElementById('nv').innerHTML="Champ obligatoire";  
                         catName.focus(); 
                         return false; 
                     }else{
                          document.getElementById('nv').innerHTML="";  
                     }
                 }


(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
				 
</script>