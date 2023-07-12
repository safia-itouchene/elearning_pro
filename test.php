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

<body>
<style>
    body{
        background: #f5f6f9;
}
</style>
<div class="super_container">
    <?php
	      include("inc/header.php");
    ?>
<div class="container light-style flex-grow-1 container-p-y">
<div class="profile">

<div class="card overflow-hidden">
<div class="row no-gutters row-bordered row-border-light">

    <div class="col-md-3 pt-0">
      <div class="list-group list-group-flush account-settings-links">
        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
        <a class="list-group-item list-group-item-action" data-toggle="list" href="#profil_enseignant">Mon profil d'enseignant</a>
        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
      </div>
    </div>
<div class="col-md-9">
  <div class="tab-content">
  <div class="tab-pane fade active show" id="account-general">
     <!------------------account-general----------------------->
     <div class="about-user">
<?php
require 'inc/db.php';

$sessionId = $_SESSION["id_user"];
$user = $con->prepare("SELECT * FROM user WHERE id_user = $sessionId");

?>

<form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
      <div class="upload">
        <?php
        $user = $con->prepare("SELECT * FROM user WHERE id_user= $sessionId");
        $user->setFetchMode(PDO:: FETCH_ASSOC);
        $user->execute();
        $row=$user->fetch();
        $id =$row['id_user'];
        $name =$row['nome'];
        $image =$row['user_image'];
        $email=$row['email'];
        ?>
        <img src="images/<?php echo $image; ?>" width =125 height = 125 title="<?php echo $image; ?>">
       
        <div class="round">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="name" value="<?php echo $name; ?>">
          <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
        </div>
      </div>
    </form>
    <i class="fa-solid fa-camera"></i>
    <script type="text/javascript">
          document.getElementById("image").onchange = function(){
          document.getElementById("form").submit();
      };
    </script>
    <?php
    if(isset($_FILES["image"]["name"])){

      $id = $_POST["id"];
      $name = $_POST["name"];
      $imageName = $_FILES["image"]["name"];
      $imageSize = $_FILES["image"]["size"];
      $tmpName = $_FILES["image"]["tmp_name"];

      // Image validation
      $validImageExtension = ['jpg', 'jpeg', 'png'];
      $imageExtension = explode('.', $imageName);
      $imageExtension = strtolower(end($imageExtension));
      
        $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
        $newImageName .= '.' . $imageExtension;
        $query =$con->prepare("update user set user_image ='$newImageName' where id_user = $id");
        move_uploaded_file($tmpName, 'images/' . $newImageName);
        $query->execute();
    }
   
    ?>
    </div>


     <!-------------------------------------------------------->
           <?php
             user_info();
           ?>
      </div>
    <!------------------account-general----------------------->
    
    <div class="tab-pane fade" id="account-change-password">
        <div class="card-body pb-2">
            <div class="form-group">
              <label class="form-label">Current password</label>
              <input type="password" class="form-control">
            </div>
            <div class="form-group">
              <label class="form-label">New password</label>
              <input type="password" class="form-control">
            </div>
            <div class="form-group">
              <label class="form-label">Repeat new password</label>
              <input type="password" class="form-control">
            </div>
         </div>
    </div>

 <!------------------end change password----------------------->
 <!------------------account-general----------------------->
    
 <div class="tab-pane fade" id="profil_enseignant">
        <div class="card-body pb-2"> 
          
           <label>Votre Niveau Académique</label>
           <h4 class="form-control" type='text'>Enseigne la langue Anglaise</h4>
           <label>Vous enseignerez</label>
           <h4 class="form-control" type='text'>Anglaise</h4>
           <label>Votre Niveau dans cette langue</label>
           <h4 class="form-control" type='text'>LEVEL C1</h4>
           <button name='ajouter_section' type="submit" class="btn btn-primary " data-toggle="modal" data-target="#github">Ajouter Vos Médias Sociaux</button>
   </div>
         </div>
    </div>

 <!------------------end change password----------------------->
</div>
</div>
</div>
</div>
</div>
</div>
<!------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="github" tabindex="-1" role="dialog" aria-labelledby="sectionLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sectionLabel">AJOUTEZ VOS MÉDIAS SOCIAUX</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  method='post'>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i class="fa-brands fa-github"></i>&nbsp;&nbsp;&nbsp;Github</label>
            <input type="url" name='section' class="form-control" id="recipient-name">
            <label for="recipient-name" class="col-form-label"><i class="fa-brands fa-youtube"></i>&nbsp;&nbsp;&nbsp;Youtube</label>
            <input type="url" name='section' class="form-control" id="recipient-name">
            <label for="recipient-name" class="col-form-label"><i class="fa-brands fa-facebook"></i>&nbsp;&nbsp;&nbsp;Facebook</label>
            <input type="url" name='section' class="form-control" id="recipient-name">
            <label for="recipient-name" class="col-form-label"><i class="fa-brands fa-discord"></i>&nbsp;&nbsp;&nbsp;Discord</label>
            <input type="url" name='section' class="form-control" id="recipient-name">
            <label for="recipient-name" class="col-form-label"><i class="fa-brands fa-twitter"></i>&nbsp;&nbsp;&nbsp;Twitter</label>
            <input type="url" name='section' class="form-control" id="recipient-name">
            <label for="recipient-name" class="col-form-label"><i class="fa-brands fa-instagram"></i>&nbsp;&nbsp;&nbsp;Instagram</label>
            <input type="url" name='section' class="form-control" id="recipient-name">
          </div>
          <button name='ajouter_section' type="submit" class="btn btn-primary">Ajouter</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!------------------------------------------------------------------------------------------------------------->
      <?php
           include("inc/footer.php");
      ?>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>
</body>

</html>
