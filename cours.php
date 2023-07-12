<?php
   session_start();  
?>
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
<style>
    body{
        background: #f5f6f9;
}
</style>
<body>
<?php
    include("inc/header.php");
    include("inc/db.php");
    $id_user=$_SESSION['id_user'];
    $get_user=$con->prepare("select * from user where id_user='$id_user'");
    $get_user->setFetchMode(PDO:: FETCH_ASSOC);
    $get_user->execute();
    $row=$get_user->fetch();
    $nome=$row['nome'];
    $prenome=$row['prenom'];
    $image=$row['user_image'];
?>

<div class="dashbord">
  
      <div class="left_page">
           <div class="profile_ens">
                 <img src="images/<?php echo $image ?>"alt="">
                 <p><?php //echo $nome; echo'&nbsp;&nbsp;'; echo $prenome; ?></p>
		   </div>
           <ul class='menu_ens'>
               <li><i class="fa-solid fa-box-archive"></i><a href='cours.php'>Mes Cours</a></li>
               <li><i class="fa-solid fa-plus"></i><a href='add_cours.php'>Ajouter Cours</a></li>
           </ul>
      </div>
     
      <div class="cour_data">
          <div class="nmb_cours">
                 <i class="fa-solid fa-video"></i><p>Nombre de cours</p><p>6</p>
          </div>
          <div class="num_free_cours">
               <i class="fa-solid fa-star"></i><p>Cours gratuits</p><p>0</p>
          </div>
          <div class="num_sall_cours">
               <i class="fa-solid fa-users"></i><p>Nombre de followers</p><p>5</p> 
          </div>
          <div class="activ_cours">
                 <i class="fa-solid fa-chart-line"></i><p>Cours actifs</p><p>5</p>
          </div>
      </div>
      <div class="cour_section">
             
 <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titre</th>
      <th scope="col">Prix</th>
      <th scope="col">Langage</th>
      <th>Modifier</th>
      <th>Suppr</th>
    </tr>
  </thead>
       <?php
            afficher_mes_cours();
            edit_cour();
            delet_cour();
       ?>
</table>
      </div>
     
</div>

<script>
function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementsByClassName("file-ip-1-preview");
    for (i=0; i<preview.length; i++) {
    preview[i].src = src;
    preview[i].style.display = "block";
  }
  }
}

document.getElementById("videoUpload")
.onchange = function(event) {
  let file = event.target.files[0];
  let blobURL = URL.createObjectURL(file);
  var videoInto  = document.getElementById("video_into");
  document.querySelector("video").src = blobURL;
  videoInto.style.display = "block";
}


$(document).ready(function() {
  $('.modal').on('hidden.bs.modal', function() {
    var html = document.getElementsByClassName("vediocour");
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