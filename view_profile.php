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
<link rel="stylesheet" href="fullcalendar/lib/main.min.css">
<script src="fullcalendar/lib/main.min.js"></script>
</head>
<style>
    body{
        background: #f5f6f9;
}
.mes_cours_online{
  margin-left:25%;

}
</style>
<body>
<?php
   include("inc/db.php");
   if(isset($_GET['id_profile'])){
     $id_ens=$_GET['id_profile'];

     $get_ens=$con->prepare("select * from 	enseignant where id_enseignant ='$id_ens'");
     $get_ens->setFetchMode(PDO:: FETCH_ASSOC);
     $get_ens->execute();
     $row_ens=$get_ens->fetch();

     $id_user=$row_ens['id_user'];
     $get_user=$con->prepare("select * from 	user where id_user ='$id_user'");
     $get_user->setFetchMode(PDO:: FETCH_ASSOC);
     $get_user->execute();
     $row_sub=$get_user->fetch();



  }
?>
<div class="super_container">
    <?php
	      include("inc/header.php");
    ?>
<div class="view_profile">
  <div class="left_page">
           <div class="profile_ens">
                 <img src="images/<?php echo $row_sub['user_image']; ?>"alt="">
                 <p><?php echo $row_sub['nome'];echo'&nbsp;&nbsp;';echo $row_sub['prenom']; ?>  <i class="fa-solid fa-circle-check"></i></p>
		   </div>
          <form   method='post'>
            <?php
                 if(isset($_SESSION['id_user'])){
                 if($_SESSION['id_user']!=$row_sub['id_user']){
                     $idsession=$_SESSION['id_user'];
                     $get_follower=$con->prepare("select * from 	followers where id_user ='$idsession' and 	id_ens ='$id_ens'");
                     $get_follower->setFetchMode(PDO:: FETCH_ASSOC);
                     $get_follower->execute();
                     $count=$get_follower->rowCount();
                     if($count == 0){
            ?>
           <div class="follow_msg">
                 <button name="follow"  ><i class="fa-solid fa-plus"></i>Follow</button>
           </div>
           <?php }else{ ?>
            <div class="follow_msg">
                 <button name="unfollow">UnFollow</button>
           </div>
           <?php }}}?>
               
         
        </form>
           <div class="bio">
                  <b>About Me:</b><br>
                  <i class="fa-solid fa-users"></i>            :&nbsp;&nbsp;5 followers<br>
                  <i class="fa-solid fa-graduation-cap"></i>   :&nbsp;&nbsp;licence en langue Anglais<br>
                  <i class="fa-regular fa-comment-dots"></i>   :&nbsp;&nbsp; English Level C2 <br>
                  <i class="fa-regular fa-circle-play"></i>    :&nbsp;&nbsp;6 cours<br><br>
           
          </div>
           <div class="social-media-icons col-xs-12">
                 <b>Follow Me:</b>
            <ul class="list-inline col-xs-12">
              <a href="#"><i class="fa-brands fa-github fa-2x"></i></a>
              <a href="#"><i class="fa-brands fa-youtube fa-2x"></i></a>
              <a href="#"><i class="fa-brands fa-facebook fa-2x"></i></a>
              <a href="#"><i class="fa-brands fa-discord fa-2x"></i></a>
              <a href="#"><i class="fa-brands fa-twitter fa-2x"></i></a> 
              <a href="#"><i class="fa-brands fa-instagram fa-2x"></i></a>              
            </ul>
          </div>

      </div>
</div>
<div class="mes_cours_online">

<div class="container">

  <?php
        $get_cour=$con->prepare("select * from course where id_user='$id_ens'");
        $get_cour->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cour->execute();
       
        while($row=$get_cour->fetch()){

          $id=$row['id_cat'];
          $get_cat=$con->prepare("select cat_name from cat where cat_id='$id'");
          $get_cat->setFetchMode(PDO:: FETCH_ASSOC);
          $get_cat->execute();
          $sub_row=$get_cat->fetch(); 
  ?>
  <div style="width:250px; margin-left:-25px;" class="card">
    <div class="card__header">
    <a href="single.php?id=<?php echo $row['id_cours']?>"> <img src="images/<?php echo $row["cover"];?>" alt="card__image" class="card__image" width="600"></a>
      <h5  style="font-size:13px; margin-left:5%; margin-top:4%;"><a href="single.php?id=<?php echo $row['id_cours']?>"><?php echo $row["title"];?></a></h5>
      <div style=" margin-left:5%; margin-bottom: -2%;" calss="star_c">
        <?php display_satr($row['id_cours']);?>
     </div>
    <div class="card__body">
      <span style=" font-size:15px;"><?php echo $row["price"];?>&nbsp;&nbsp;DA   <span style="color: #ff7782;  font-size:15px;text-decoration: line-through;">&nbsp;&nbsp;<?php echo $row["price_r"];?>&nbsp;&nbsp;DA</span> </span>
      <span><?php echo $sub_row['cat_name']; ?> </span>
    </div>
    </div>
  </div>
  
<?php }?>

  <?php
     if(isset($_POST['follow'])){
        add_follow($id_ens);
     }
     if(isset($_POST['unfollow'])){
      delet_follow($id_ens);
   }
  ?>




</div>


</div> 


<script>

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'resourceTimelineWeek'
  });
  calendar.render();
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
