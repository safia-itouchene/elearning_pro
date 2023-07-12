<?php    include("inc/db.php");
         session_start();
         if(isset($_SESSION['id_user'])){ 

             $idsession=$_SESSION['id_user'];
             $get_admin=$con->prepare("select * from tb_admin where id_user='$idsession'");
             $get_admin->setFetchMode(PDO:: FETCH_ASSOC);
             $get_admin->execute();
             $admin=$get_admin->rowCount();
             if($admin == 1){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Home</title>
    <link href="fontawesome-free-6.1.1-web/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include("inc/navtop.php");?>
<div class="contanier">
      <?php 
         include("inc/aside.php");
         include("inc/main.php");
         include("inc/rightpage.php");
       ?>
</div>

</body>
<script type="text/javascript" src="js/script.js"></script>

</html>

<?php }elseif($admin == 0){
     header('location:../index.php');}
}?>
