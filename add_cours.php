<?php //session_start();?>
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
               <li><i class="fa-solid fa-plus"></i><a href='add_cours.php'>Add Course</a></li>
           </ul>
      </div>
      <div class="main_page">
          <h3>Ajouter des cours</h3>
      </div>
<form method='post' enctype="multipart/form-data" class="needs-validation" novalidate>   
<div class="cour_section">
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#basique"><i class="fa-solid fa-pencil"></i>&nbsp;&nbsp;&nbsp;Basique</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#cat"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Langage et  Niveau</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#medias"><i class="fa-solid fa-video"></i>&nbsp;&nbsp;&nbsp;Médias</a>
  </li>
 
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#tarification"><i class="fa-solid fa-dollar-sign"></i>&nbsp;&nbsp;&nbsp;Prix</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#finir"><i class="fa-solid fa-check-double"></i>&nbsp;&nbsp;&nbsp;Finir</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">

  <div class="tab-pane container active" id="basique">
   
  <p>Titre</p><input class="form-control" type='text'  name='title' required>
  <br><p>Mini Description</p> <textarea class="form-control" name='mini_des' id='mini_des'  cols='30' rows='10' required></textarea>
    <br><p>Description</p><textarea style="height:130px;" class="form-control" name='description' id='description'  cols='30' rows='10'required ></textarea>
  </div>
  <div class="tab-pane container fade" id="tarification">
        <p>Prix ​​du cours ($)</p>
        <input  type="number" class="form-control" id="price" name="price" placeholder="Enter Course Course Price" min="0" required>
        <p>Prix avant  ​​réduit ($)</p>
       <input type="number" class="form-control" id="price" name="price_r" placeholder="Enter Course Course Price" min="0" required> 
  </div>

  <div class="tab-pane container fade" id="cat">
          <p for="recipient-name" class="col-form-label">Langage:</p><br>
          <select id="cars" name="cat" class="form-control" required>
                   <?php echo view_option_cat();?>
           </select>
           <p for="recipient-name" class="col-form-label">Niveau:</p><br>
          <select id="cars" name="sub_cat" class="form-control" required>
                <?php echo view_option_sub_cat();?>
           </select>
       
  </div>


  <div class="tab-pane container fade" id="medias">
          <p>Video Introsction</p>
          <input type="file" name='video_intro' accept=".mp4,.3gp,.wmv.mkv,.flv" id='videoUpload' class="form-control" required />
       <div id='video_into'>
           <video  width="320" height="240" controls>
               Your browser does not support the video tag.
           </video>
       </div>
      <!--<input type="file" accept=".mp4,.3gp,.wmv.mkv,.flv" id='videoUpload' class="form-control" />-->
    <!---------------------------------------------------------------->
    <div class="center">
      <div class="form-input">
      <div class="preview">
        <img id="file-ip-1-preview">
        <label for="file-ip-1">Upload Image</label>
        <input type="file" name='cover' id="file-ip-1" accept="image/*" onchange="showPreview(event);" required>
        <p>Best size:600X600</p>
      </div>
   </div>
 </div> 
 </div> 

    <!----------------------------------------------------------------->
   
  <div class="tab-pane container fade" id="finir">
       <p>Merci! Vous n'êtes qu'à un clic</p>
     <div>
       <img src="images/finir.PNG" alt="">
       <button name='confirmes'>confirmés</button>
       </div>
  </div>
    
  </div>

</div>

</form>       
</div>
<?php
     
 ?> 
 <?php
     ajouter_cours();
 ?> 
<script>
  function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    preview.src = src;
    preview.style.display = "block";
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