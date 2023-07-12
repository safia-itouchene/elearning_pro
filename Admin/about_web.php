<div class="admin_compte">
<?php
require 'inc/db.php';
$_SESSION["id"] = 1; // User's session
$sessionId = $_SESSION["id"];
$user = $con->prepare("SELECT * FROM tb_admin WHERE id = $sessionId");

?>
<!---------------------------------------------------------------------------------------->
<div class="tab">
    <button class="tablinks" onclick="openTab(event, 'media')" id="defaultOpen">Réseaux sociaux</button>
    <button class="tablinks" onclick="openTab(event, 'about_us')">À propos du Web</button>
    <button class="tablinks" onclick="openTab(event, 'web_img')">modifier le logo</button>
</div>

<!-- Tab content -->
    <?php
    include("inc/db.php");
        $get_data=$con->prepare("select * from about_web");
        $get_data->setFetchMode(PDO:: FETCH_ASSOC);
        $get_data->execute();
        $row=$get_data->fetch();
    ?>
      <div id="media" class="tabcontent">
          <?php
             echo save_media();
          ?>
      </div>

      <div id="about_us" class="tabcontent">
         <?php
            echo save_about_us();
         ?>
      </div>
      
      <div id="web_img" class="tabcontent">
          <?php
             echo save_afficharge();
          ?>
        
      </div>
     
<!---------------------------------------------------------------------------------------->
</div>

