<?php  session_start(); ?>
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
<link rel="stylesheet" type="text/css" href="styles/profile.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>
<?php
require 'inc/db.php';




?>
<body>
<style>
    body{
        background: #f5f6f9;
}


</style>
<div  class="super_container">
    <?php
        
	      include("inc/header.php");
        include("inc/db.php");
     
        
    
        $sessionId = $_SESSION["id_user"];
        $user = $con->prepare("SELECT * FROM user WHERE id_user = $sessionId");

    ?>

    <div class="edit_profile">
        <div class="list_op">
          <ul>
            <li><a href="profile.php?profile"><i class="fa-regular fa-pen-to-square"></i>Modifier Profile</a><br></li>
            <li ><a href="profile.php?msg"><i class="fa-regular fa-envelope"></i>Chat</a><br></li>
            <li ><a href="profile.php?password"><i class="fa-solid fa-lock"></i>réinitialiser mot de passe</a><br></li>
            <li ><a href="profile.php?following"><i class="fa-solid fa-users"></i>following</a><br></li>
            <li><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a><br></li>
          </ul>
        </div>
        <?php if(isset($_GET['profile'])){?>
  <div class="view_op">

<div class="profil">      
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
    </div>
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
        echo'<script> location.href ="profile.php?profile";</script>';
    }
   
    ?>
        <?php
            user_info();
         ?>
    </div>
    </div>
    <?php } ?>
<!------------------------------------------------------------------------------------------------------------->
<?php if(isset($_GET['password'])){?>
   
        <div class="view_op">
        
        <form   method='post'  class="needs-validation" novalidate>
            <div class="space">
              <label class="form-label">Mot de passe actuel</label>
              <input name="actuel_password" type="password" class="form-control" required>
              <div class="invalid-feedback"> Champ obligatoire</div>

              <label class="form-label">Nouveau mot de passe</label>
              <input name="nvu_password" type="password" class="form-control" required>
              <div class="invalid-feedback"> Champ obligatoire</div>

           
              <label class="form-label">confirmer mot de passe</label>
              <input name="cnv_password" type="password" class="form-control" required>
              <div class="invalid-feedback"> Champ obligatoire</div>

           
            <button name="reset_password"  type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
       </form>
      </div>
     
     <?php reset_password(); } ?>
     <?php if(isset($_GET['following'])){?>
   
     <div class="view_op">
      
         <ul>
         <?php
             $get_follo=$con->prepare("select * from followers where id_user='$sessionId'");
             $get_follo->setFetchMode(PDO:: FETCH_ASSOC);
             $get_follo->execute();
             $coun=$get_follo->rowCount();
               if($coun !=0){

               
           
             while($row_fo=$get_follo->fetch()){
                  $ide=$row_fo['id_ens'];
 
                  $gete=$con->prepare("select * from enseignant where id_enseignant='$ide'");
                  $gete->setFetchMode(PDO:: FETCH_ASSOC);
                  $gete->execute();
                  $rowe=$gete->fetch();
                  $idu=$rowe['id_user'];
 
                  $getuser=$con->prepare("select * from user where id_user ='$idu'");
                  $getuser->setFetchMode(PDO:: FETCH_ASSOC);
                  $getuser->execute();
                  $rowuser=$getuser->fetch();
               
       ?>
            <form   method='post'>
           <li>
               <img src="images/<?php echo $rowuser['user_image']?>" alt="">
               <div><h5><?php echo $rowuser['nome']; echo " "; echo $rowuser['prenom'];?></h5><p><?php echo $rowe['niveau_acad']?></p></div>
              
                  <button name="unfollow" class="btn btn-primary">Unfollow</button>
              
           </li><hr>
           </form>
           <?php  } }else{?>
                <img style="margin-left:33%;margin-top:15%; width:230px; height:230px;" src="images/cart4.png" alt="">
            <?php  } 
            
            if(isset($_POST['unfollow'])){
              delet_follow($ide);
           }
            ?>
         </ul>
     
    
 </div>
     <?php  } ?>
     <?php if(isset($_GET['msg'])){?>
     <div class="chat_msg">
      <!--------------------------------------------------------------------------------------------------------->
      <body>
  <div class="container">
    <div  class="row">

      <section class="discussions" >
        <div class="discussion search">
          <div class="searchbar">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="text" placeholder="Search..."></input>
          </div>
        </div>

        <div  style="overflow:hidden; overflow-y:scroll; height:500px; width:100%;">

        <?php
            $get_follow=$con->prepare("select * from followers where id_user='$sessionId'");
            $get_follow->setFetchMode(PDO:: FETCH_ASSOC);
            $get_follow->execute();
           
            while($row_f=$get_follow->fetch()){
                 $id_ens=$row_f['id_ens'];

                 $get_ens=$con->prepare("select * from enseignant where id_enseignant='$id_ens'");
                 $get_ens->setFetchMode(PDO:: FETCH_ASSOC);
                 $get_ens->execute();
                 $row_ens=$get_ens->fetch();
                 $id_user=$row_ens['id_user'];

                 $get_user=$con->prepare("select * from user where id_user ='$id_user'");
                 $get_user->setFetchMode(PDO:: FETCH_ASSOC);
                 $get_user->execute();
                 $row_user=$get_user->fetch();
        ?>
        <div  class="discussion">
          <div class="photo">
            <a href="profile.php?msg&id_des=<?php echo $row_user['id_user'];?>">
                 <img src="images/<?php echo $row_user['user_image'];?>" alt="">
            </a>
            <div class="online"><i class="fa-solid fa-star"></i></div>
          </div>
          <div class="desc-contact">
            <p class="name"><?php echo $row_user['nome']; echo "&nbsp;&nbsp;"; echo $row_user['prenom'];?></p>
            <p class="message">...</p>
          </div>
        </div>
        <?php } ?>



        <?php
             $get_e=$con->prepare("select * from enseignant where id_user='$sessionId'");
             $get_e->setFetchMode(PDO:: FETCH_ASSOC);
             $get_e->execute();
             $row_e=$get_e->fetch();
             $count_e= $get_e->rowCount();

             if($count_e == 1){
             $id_e=$row_e['id_enseignant'];

             $get_fol=$con->prepare("select * from followers where id_ens='$id_e'");
             $get_fol->setFetchMode(PDO:: FETCH_ASSOC);
             $get_fol->execute();

            while($row_fol=$get_fol->fetch()){
                 $id_u=$row_fol['id_user'];

                 $get_u=$con->prepare("select * from user where id_user ='$id_u'");
                 $get_u->setFetchMode(PDO:: FETCH_ASSOC);
                 $get_u->execute();
                 $row_u=$get_u->fetch();
        ?>
        <div  class="discussion">
          <div class="photo">
            <a href="profile.php?msg&id_des=<?php echo $row_fol['id_user'];?>">
                 <img src="images/<?php echo $row_u['user_image'];?>" alt="">
            </a>
            <div class="online"><i class="fa-solid fa-graduation-cap"></i></div>
          </div>
          <div class="desc-contact">
            <p class="name"><?php echo $row_u['nome']; echo "&nbsp;&nbsp;"; echo $row_u['prenom'];?></p>
            <p class="message">... </p>
          </div>
        </div>
        <?php } }?>

        <!--<div class="discussion">
          <div class="photo" style="background-image: url(https://i.pinimg.com/originals/a9/26/52/a926525d966c9479c18d3b4f8e64b434.jpg);">
            <div class="online"></div>
          </div>
          <div class="desc-contact">
            <p class="name">Dave Corlew</p>
            <p class="message">Let's meet for a coffee or something today ?</p>
          </div>
         
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1497551060073-4c5ab6435f12?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=667&q=80);">
          </div>
          <div class="desc-contact">
            <p class="name">Jerome Seiber</p>
            <p class="message">I've sent you the annual report</p>
          </div>
         
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://card.thomasdaubenton.com/img/photo.jpg);">
            <div class="online"></div>
          </div>
          <div class="desc-contact">
            <p class="name">Thomas Dbtn</p>
            <p class="message">See you tomorrow ! 🙂</p>
          </div>
          
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1553514029-1318c9127859?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80);">
          </div>
          <div class="desc-contact">
            <p class="name">Elsie Amador</p>
            <p class="message">What the f**k is going on ?</p>
          </div>
          
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1541747157478-3222166cf342?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=967&q=80);">
          </div>
          <div class="desc-contact">
            <p class="name">Billy Southard</p>
            <p class="message">Ahahah 😂</p>
          </div>
        
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1435348773030-a1d74f568bc2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1050&q=80);">
            <div class="online"></div>
          </div>
          <div class="desc-contact">
            <p class="name">Paul Walker</p>
            <p class="message">You can't see me</p>
          </div>
        
        </div>-->
      </section>
      <section class="chat">
    
          <?php

              if(isset($_GET['id_des'])){
                  $id_des=$_GET['id_des'];

                 
                    $get_us=$con->prepare("select * from 	user where id_user='$id_des'");
                    $get_us->setFetchMode(PDO:: FETCH_ASSOC);
                    $get_us->execute();
                    $row_ap=$get_us->fetch();

                    $image=$row_ap['user_image'];
                    $nom=$row_ap['nome'];
                    $prenom=$row_ap['prenom'];

                  

              }else{
                $image="bl.PNG";
                $nom="";
                $prenom="";
              }

            
          ?>
      <div class="head_chat"> 
                <img src="images/<?php echo $image;?>" alt="">
                <p><?php echo $nom; echo " "; echo $prenom;?></p>
         </div>
        <div id="data" class="messages-chat" style="overflow:hidden; overflow-y:scroll; height:350px; width:97.5%;">
            <?php
                if(isset($_GET['id_des'])){
                  $id_des=$_GET['id_des'];
                  $get_sent=$con->prepare("select * from 	messages");
                  $get_sent->setFetchMode(PDO:: FETCH_ASSOC);
                  $get_sent->execute();


                  while($row=$get_sent->fetch()){

                    if($row['id_surce'] ==$id_des && $row['id_dest']==$sessionId  ){
                        echo '<div class="message">
                             <div class="photo_des">
                                   <img src="images/'.$image.'" alt="">
                             </div>
                             <p class="text">'.$row['msg'].'</p>
                           </div>';
                    }else{
                        if($row['id_surce'] ==$sessionId && $row['id_dest']==$id_des){
                            echo' <div class="message text-only">
                            <div class="response">
                              <p class="text"> '.$row['msg'].' </p>
                            </div>
                          </div>';
                    
                        }
                    }
        
                }
                }
            ?>
        <!--  <div class="message">
            <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
              <div class="online"></div>
            </div>
            <p class="text"> Hi, how are you ? </p>
          </div>
          
          <div class="message text-only">
            <p class="text"> What are you doing tonight ? Want to go take a drink ?</p>
          </div>
          <div class="message text-only">
            <p class="text"> What are you doing tonight ? Want to go take a drink ?</p>
          </div>
          <div class="message text-only">
            <p class="text"> What are you doing tonight ? Want to go take a drink ?</p>
          </div>
          <div class="message text-only">
            <p class="text"> What are you doing tonight ? Want to go take a drink ?</p>
          </div>
          <div class="message text-only">
            <p class="text"> What are you doing tonight ? Want to go take a drink ?</p>
          </div>
          <p class="time"> 14h58</p>

          <div class="message text-only">
            <div class="response">
              <p class="text"> Hey Megan ! It's been a while 😃</p>
            </div>
          </div>
          <div class="message text-only">
            <div class="response">
              <p class="text"> When can we meet ?</p>
            </div>
          </div>
          <p class="response-time time"> 15h04</p>
          <div class="message">
            <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
              <div class="online"></div>
            </div>
            <p class="text"> 9 pm at the bar if possible 😳</p>
          </div>
          <p class="time"> 15h09</p>-->
        </div>
        <form action="" method="post">
        <div class="footer-chat">
          <i class="icon fa fa-smile-o clickable" style="font-size:25pt;" aria-hidden="true"></i>
          <input type="text" class="write-message" name='msg' placeholder="Type your message here"></input>
          <button class="sand"  name='send_msg'> <i class="fa fa-paper-plane " aria-hidden="true"></i></button>
        </div>
        </form>
        </div>
      </section>
    </div>
  </div>
</body>
      <!--------------------------------------------------------------------------------------------------------->
     </div>
     <?php  } ?>
<!------------------------------------------------------------------------------------------------------------->
      <?php
        //   include("inc/footer.php");
      ?>
</div>

<?php
    if(isset($_GET['id_des'])){
		   $id_des=$_GET['id_des'];
	}
   if (isset($_POST["send_msg"])) {
	       $msg=$_POST['msg'];
		     $add_msg=$con->prepare("insert into messages(id_surce,id_dest,msg)values('$sessionId', '$id_des','$msg')");
		     $add_msg->setFetchMode(PDO:: FETCH_ASSOC);
         $add_msg->execute();
   }
?>
<script>
 var objDiv = document.getElementById("data");
objDiv.scrollTop = objDiv.scrollHeight;


$('#data').click(function() {
    location.reload();
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
