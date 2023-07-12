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
</head>
<body>
<div class="super_container">
    <?php
        include("inc/db.php");
	      include("inc/header.php");
        if(isset($_GET['id'])){
          $id=$_GET['id'];
        }
        $get_cour=$con->prepare("select * from course where  id_cours='$id'");
        $get_cour->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cour->execute();
        $row=$get_cour->fetch();
        $id_cat=$row['id_cat'];
        $id_subc=$row['id_sub_cat'];
        $id_ens=$row['id_user'];

        $get_cat=$con->prepare("select * from cat where  cat_id='$id_cat'");
        $get_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cat->execute();
        $row_cat=$get_cat->fetch();

        $get_subc=$con->prepare("select * from sub_cat where  sub_cat_id='$id_subc'");
        $get_subc->setFetchMode(PDO:: FETCH_ASSOC);
        $get_subc->execute();
        $subcat_row=$get_subc->fetch();

        $get_ens=$con->prepare("select id_user  from enseignant where id_enseignant='$id_ens'");
        $get_ens->setFetchMode(PDO:: FETCH_ASSOC);
        $get_ens->execute();
        $row_ens=$get_ens->fetch();

        $id_user=$row_ens['id_user'];

        $get_atoure=$con->prepare("select * from user where  id_user ='$id_user'");
        $get_atoure->setFetchMode(PDO:: FETCH_ASSOC);
        $get_atoure->execute();
        $row_atoure=$get_atoure->fetch();  
    ?>
		 <div class="cour_details">
			 <div  class="details_part_one">
                  <div  class="cour_intro">
					        <div data-toggle="modal" data-target="#intro" class="bagr">
							</div>
					       <a data-toggle="modal" data-target="#intro" ><i class="fa-solid fa-play"></i></a>
					       <img  width='320' height='200' src="images/<?php echo $row['cover']?>" alt="">
                  
                           <div class="details_max">
                              <h3><?php echo $row['price']?>&nbsp;DA</h3>
                              <h5 style=" margin-left:5%;  margin-bottom:-4%; text-decoration: line-through;  color:#ff7782;"><?php echo $row['price_r']?>&nbsp;DA</h5>

                          <?php  if(isset($_SESSION['id_user'])){?>
                  <form  method='post' enctype="multipart/form-data">
                              <button name='add_cart' id='add_cart'>Ajouté au panier</button><br>
                    </form>
                    <?php }else {?>
                         <button data-toggle="modal" data-target="#modalLoginForm" data-whatever="@mdo"  id='add_cart'>Ajouté au panier</button><br>
                      <?php }?>
                            </div>
                           <div class="list_com">
                              <b>Ce cours comprend :</b><br>
                               <i class="fa-regular fa-circle-play"></i> :&nbsp;&nbsp;2 Vidéo<br>
                               <i class="fa-regular fa-file-lines"></i>  :&nbsp;&nbsp;2 articles<br>
                               <i class="fa-solid fa-clock"></i>         :&nbsp;&nbsp;1 heures<br>
                               <i class="fa-solid fa-mobile-screen"></i> :&nbsp;&nbsp;Accès sur PC<br>
                               <i class="fa-solid fa-infinity"></i>      :&nbsp;&nbsp;Accès illimité<br>
                               <i class="fa-solid fa-trophy"></i>        :&nbsp;&nbsp;Quiz<br>
                              </div>           
				                 </div>
                  <div class="details_left">
                      <div class='cat'><a href="category.php?id_cat=<?php echo $row_cat['cat_id'];?>"><?php echo $row_cat['cat_name']?></a> > <?php echo $subcat_row['sub_cat_name']?></div>
                      <h3><?php echo $row['title']?></h3>
                      <p><?php echo $row['short_description']?></p>
                      
                <!------------------------------------------------------------------------------->
                <div class="review">
    					       <div id='aver_nbr' class="text-warning">
    						          <b><span id="average">0.0</span> / 5</b>
                     </div>
    				         <div>
    					          <i class="fas fa-star star-light mr-1 main_s"></i>
                        <i class="fas fa-star star-light mr-1 main_s"></i>
                        <i class="fas fa-star star-light mr-1 main_s"></i>
                        <i class="fas fa-star star-light mr-1 main_s"></i>
                        <i class="fas fa-star star-light mr-1 main_s"></i>
	    			        	</div>
    					        <div class='nbr_review'><span id="total">0</span> Review</div>      
    				    </div>
                <!------------------------------------------------------------------------------->
                      <h6>Créé par : <a href='view_profile.php?profile&id_profile=<?php echo $row['id_user'];?>'><?php echo $row_atoure['nome'];?>&nbsp;&nbsp;<?php echo $row_atoure['prenom'];?></a></h6>
                      <div class='time'>
                           <i class="fa-solid fa-circle-exclamation"></i>&nbsp;&nbsp;Dernière mise à jour :<?php echo $row['date_cours']?>
                      </div>
                  </div>
			 </div>
            <div class="details_part_tow">
                <h4>Description</h4>
                <p> Are you ready to master the English language? Are you tired of learning the same simple topics and never really getting better at English speaking or English grammar? This course will fix all those problems. This has been one of the top Udemy English courses for many years, and that is because we care about our students.<span id="dots">...</span><span id="more">The English master course covers all areas of English learning. English grammar, English speaking, and English writing (punctuation). There are over 35 hours of videos lessons, hundreds of examples and practice problems, and full-length PDFs..</span></p>
                <button onclick="myFunction()" id="myBtn">Read more</button>

        <!--------------------------------------------------------------------------------------------------->
        <?php
           $get_section=$con->prepare("select * from section where id_cour='$id'");
           $get_section->setFetchMode(PDO:: FETCH_ASSOC);
           $get_section->execute();
           $i=1;
           ?>
        <div class="contenu_du_cours">
            <h4>Contenu du cours</h4>
            <h6>5 sections •  Durée totale: 1</h6><hr>
            <?php
                while($row_section=$get_section->fetch()){
                  $id_section=$row_section['id_section'];
                  $get_lecon=$con->prepare("select * from lecon where id_section='$id_section'");
                  $get_lecon->setFetchMode(PDO:: FETCH_ASSOC);
                  $get_lecon->execute();
                  $j=1;
            ?>
               <div class="accordion"><b>Section <?php echo $i++;?>:</b>&nbsp;&nbsp; <?php echo $row_section['title'];?></div>
                   <div class="panel">
                        <div class="content">
                        <?php
                  while($row_lecon=$get_lecon->fetch()){

                  $type=$row_lecon['type'];
                  if($type == 1){
                        $icon='<i class="fa-regular fa-circle-play"></i>';
                  }else{
                      if($type == 2){
                         $icon='<i class="fa-regular fa-file-pdf"></i>';
                      }else{
                          if( $type == 3){
                              $icon='<i class="fa-regular fa-image"></i>';
                          }else{
                              if($type == 4){
                                  $icon='<i class="fa-regular fa-file-lines"></i>';  
                              }
                          }
                      }
                  }
             ?>
                    <?php 
                        $count =0;
                        if(isset($_SESSION['id_user'])){

                        $id_u=$_SESSION['id_user'];
                        $get_paiement=$con->prepare("select * from paiement where id_user='$id_u' and id_cour='$id'");
                        $get_paiement->setFetchMode(PDO:: FETCH_ASSOC);
                        $get_paiement->execute();
                        $count=$get_paiement->rowCount();}
                        if($count !=0 || $row['price'] ==0){
                    ?>
                    
                    <ul class="afficher_lecon">
                        <div>&nbsp;&nbsp;<?php echo $icon;?>&nbsp;&nbsp;</div>
                        <div><h6>Lecon <?php echo $j++;?>:&nbsp;&nbsp;</h6></div>
                        <div data-toggle="modal" data-target="#<?php echo $row_lecon['id']?>" data-whatever="@mdo"><?php echo $row_lecon['title'] ;?></div>
                    </ul>
                    <?php } elseif($count ==0 && $row['price'] !=0 ){ ?>
<!--------------------------------------------------------------------------------------->
                    <ul class="afficher_lecon">
                        <div>&nbsp;&nbsp;<?php echo $icon;?>&nbsp;&nbsp;</div>
                        <div><h6>Lecon <?php echo $j++;?>:&nbsp;&nbsp;</h6></div>
                        <div><?php echo $row_lecon['title'] ;?> </div>
                        <div style="float: right;  margin-right:2%;  font-size:10px;"><i class="fa-solid fa-lock"></i></div>
                    </ul>
                    <?php } ?>
<!----------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="<?php echo $row_lecon['id']?>" tabindex="-1" role="dialog" aria-labelledby="sectionLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sectionLabel"><?php echo $row_lecon['title'] ;?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  method='post'>
            <?php
                if($row_lecon['type'] ==1){
            ?>
            <video class="vediolecon" width="780px" height="400px" controls="controls" >
                  <source src="images/<?php echo $row_lecon['file']?>" type="video/mp4"> 
            </video>
            <?php } else {
                       if($row_lecon['type'] ==2){
            ?>
              <iframe src="images/<?php echo $row_lecon['file']?>" width="100%" height="500px">
              </iframe>
          <?php }else {
                       if($row_lecon['type'] ==3){
          ?>
           <img width="780px" height="400px" src="images/<?php echo $row_lecon['file']?>" alt="">
          <?php }else{
                   if($row_lecon['type'] ==4){
          ?>
           <iframe src="images/<?php echo $row_lecon['file']?>" width="100%" height="500px">
           </iframe>
          <?php }}} }?>
        </form>
      </div>
    </div>
  </div>
</div>
<!--------------------------------------------------------------------------------------------------->
                    <?php }?> 
                    <?php
                  $get_quize=$con->prepare("select * from quize where id_section=' $id_section'");
                  $get_quize->setFetchMode(PDO:: FETCH_ASSOC);
                  $get_quize->execute();
                  $k=1;
                  while($row_quize=$get_quize->fetch()){   
                  if($count !=0 || ($row['price'] ==0 && isset($_SESSION['id_user']))){ 
            ?>
                <ul class="afficher_lecon">
                  <div>&nbsp;&nbsp;<i class="fa-solid fa-question"></i> &nbsp;&nbsp;</div>
                  <div><h6>Quize <?php echo $k++;?>:&nbsp;&nbsp;</h6></div>
                  <div><a href="quize.php?id_quize=<?php echo $row_quize['id_quize'];?>"><?php echo $row_quize['titre'];?></a></div>
               </ul>
               <?php }elseif($count ==0 && $row['price'] !=0 ){?>
               <ul class="afficher_lecon">
                  <div>&nbsp;&nbsp;<i class="fa-solid fa-question"></i> &nbsp;&nbsp;</div>
                  <div><h6>Quize <?php echo $k++;?>:&nbsp;&nbsp;</h6></div>
                  <div><a><?php echo $row_quize['titre'];?></a></div>
                  <div style="float: right;  margin-right:2%;  font-size:10px;"><i class="fa-solid fa-lock"></i></div>
               </ul>
               <?php  }elseif($row['price'] ==0 && !isset($_SESSION['id_user'])){?>
                <ul class="afficher_lecon">
                  <div>&nbsp;&nbsp;<i class="fa-solid fa-question"></i> &nbsp;&nbsp;</div>
                  <div><h6>Quize <?php echo $k++;?>:&nbsp;&nbsp;</h6></div>
                  <div data-toggle="modal" data-target="#modalLoginForm" data-whatever="@mdo"><a><?php echo $row_quize['titre'];?></a></div>
                
               </ul>
             <?php  } }?>
                       </div></div><hr>
         <?php }?>
</div> 
<!---------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Connectez-vous pour une meilleure expérience.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ml-10">
           <img src="images/happy.svg" width="200" height="200" style="margin-left:25%;" alt=""> 
      </div>
      <div class="modal-footer d-flex justify-content-center">
           <a href="se_connecter.php" class="btn btn-default">Se connecter </a>
           <a href="inscrire.php.php" class="btn btn-default">S' inscrire</a>
      </div>
    </div>
  </div>
</div>


<!----------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="intro" tabindex="-1" role="dialog" aria-labelledby="sectionLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sectionLabel">Intro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  method='post'>
            <video width="780px" height="400px" controls="controls" id="htmlVideo">
                  <source src="images/<?php echo $row['video_intro']?>" type="video/mp4"> 
            </video>
        </form>
      </div>
    </div>
  </div>
</div>
<!---------------------------------------------------------------------------------------------------------->
</div>
</div>
<!------------------------------------------------------------------------------------------------------->

<!------------------------------------------------------------------------------------------------------->
  <div class="review_user">
       <?php     
          include("review.php");
       ?>
  </div>
</div>

<?php     
          include("inc/footer.php");
          if(isset($_POST['add_cart'])){
            if(isset($_SESSION['id_user'])){
             echo ajouter_panier($id);
          }}
?>
<script> 
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}
</script> 
<script>
const accordion = document.getElementsByClassName('container');
for (i=0; i<accordion.length; i++) {
    accordion[i].('addEventListenerclick', function () {
         this.classList.toggle('active');
  })
}
  </script>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

$(document).ready(function() {
  $('.modal').on('hidden.bs.modal', function() {
    var html5Video = document.getElementById("htmlVideo");
    if (html5Video != null) {
      html5Video.pause();
      html5Video.currentTime = 0;
    }
  });
});

$(document).ready(function() {
  $('.modal').on('hidden.bs.modal', function() {
    var html = document.getElementsByClassName("vediolecon");
    for (i=0; i<html.length; i++) {
    if (html[i] != null) {
      html[i].pause();
      html[i].currentTime = 0;
    }
    }
  });
});


</script>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>
</body>

</html>
