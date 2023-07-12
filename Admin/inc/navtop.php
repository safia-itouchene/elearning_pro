<?php
  include("inc/fonction.php");
  include("inc/db.php");
  if(isset($_SESSION['id_user'])){
    $id=$_SESSION['id_user'];
    $get_user=$con->prepare("select * from user where id_user='$id'");
    $get_user->setFetchMode(PDO:: FETCH_ASSOC);
    $get_user->execute();
    $row=$get_user->fetch();
    $image=$row['user_image'];
}
?>
<div class="navtop">
    <div class="logo"><a href="../index.php">
        <h1>NEXT<span style="color:#007bff">LEVEL</span></h1></a>
    </div>
    <div class="laft-top">
            <div class="theme-btn">
            <span class="active"><i class="fa-solid fa-sun"></i></span>
                <span><i class="fa-solid fa-moon"></i></span>
    </div>
    </div>        
    <div class="profile">
         <img src="../images/<?php echo $image;?>" alt="">
         <div class="dropdown-content">
				<a href="index.php?admin_compte"><i class="fa-solid fa-circle-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a>
				<a href="index.php?main"><i class="fa-solid fa-square-poll-horizontal"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dachbord</a>
				<a href="../logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
		 </div>
    </div>       
</div>





