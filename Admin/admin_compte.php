<div class="admin_compte">
<?php
require 'inc/db.php';
// User's session
$sessionId = $_SESSION['id_user'];
$user = $con->prepare("SELECT * FROM user WHERE id_user = $sessionId");
?>
<!---------------------------------------------------------------------------------------->
<div class="tab">
<button class="tablinks" onclick="openCity(event, 'info')" id="defaultOpen">Information Personnels</button>
<button class="tablinks" onclick="openCity(event, 'media')">Changer Le Mot De Passe</button>
</div>

<!-- Tab content -->
<div id="info" class="tabcontent">
<form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
      <div class="upload">
        <?php
        $user = $con->prepare("SELECT * FROM user WHERE id_user = $sessionId");
        $user->setFetchMode(PDO:: FETCH_ASSOC);
        $user->execute();
        $row=$user->fetch();
        $id =$row['id_user'];
        $name =$row['nome'];
        $image =$row['user_image'];
        ?>
        <img src="../images/<?php echo $image; ?>" width = 100 height = 100 title="<?php echo $image; ?>">
        <div class="round">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="name" value="<?php echo $name; ?>">
          <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
          <span class="material-icons-sharp">photo_camera</span>
        </div>
      </div>
    </form>
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
      if (!in_array($imageExtension, $validImageExtension)){
        echo
        "
        <script>
          alert('Invalid Image Extension');
          document.location.href = '../updateimageprofile';
        </script>
        ";
      }
      elseif ($imageSize > 1200000){
        echo
        "
        <script>
          alert('Image Size Is Too Large');
          document.location.href = '../updateimageprofile';
        </script>
        ";
      }
      else{
        $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
        $newImageName .= '.' . $imageExtension;
        $query =$con->prepare("update tb_admin set image ='$newImageName' where id = '$id'");
        move_uploaded_file($tmpName, 'images/' . $newImageName);
        if($query->execute()){
          echo "<script>window.open('index.php?admin_compte','self')</script>";
      }
       
      }
    }
     echo admin_compte();
    ?>
  
</div>

<div id="media" class="tabcontent">
   <?php echo reset_password();?>
</div>
<!---------------------------------------------------------------------------------------->
</div>
