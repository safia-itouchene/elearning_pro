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
<link rel="stylesheet" type="text/css" href="styles/cart.css">
</head>
 <style>
     body{
        background: #f5f6f9;
     }
 </style>
<body>
    <?php
	      include("inc/header.php");
    ?> 
<!----------------------------------------------------------------------------------------------------------->

<div class="img_quz">
    <img src="images/quize_qu.png" alt="">
</div>
<div class="quize">
<?php
           if(isset($_GET['id_quize'])){
               $id_quize=$_GET['id_quize'];
               $get_quize=$con->prepare("select * from quize where id_quize='$id_quize'");
               $get_quize->setFetchMode(PDO:: FETCH_ASSOC);
               $get_quize->execute();
               $row=$get_quize->fetch();
        ?>
    <h3>Quize : <?php echo $row['titre'];?></h3>
         <?php
                $get_question=$con->prepare("select * from question where 	id_quize='$id_quize'");
                $get_question->setFetchMode(PDO:: FETCH_ASSOC);
                $get_question->execute();
                while($sub_row=$get_question->fetch()){
                    $i=1;
                    $bonne_reponse=$sub_row['bonne_reponse'];
         ?>
    <div class="question">
<form  method="post">

       <?php if(!empty($sub_row['accessoires'])){ 
           if($sub_row['type']=='wav'){   
        ?>
        <audio controls>
            <source src="horse.ogg" type="audio/ogg">
            <source src="images/<?php echo $sub_row['accessoires']?>" type="audio/mpeg">
             Your browser does not support the audio element.
        </audio>
        <?php }elseif($sub_row['type']=='mp4'){ ?>
           <video  style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;  border-radius:20px;	"  width="300px" height="170px" controls="controls" >
                  <source src="images/<?php echo $sub_row['accessoires']?>" type="video/mp4"> 
            </video><br><br>
         <?php }elseif($sub_row['type']=='png' || $sub_row['type']=='jpg'){ ?>
               <img style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px; border-radius:20px;	" width="300px" height="170px" src="images/<?php echo $sub_row['accessoires']?>" alt=""><br><br>
        <?php } ?>
        <?php } ?>
        <h4><?php echo $sub_row['question'];?></h4>
        <input type="radio" id="huey" name="<?php echo $sub_row['id_question']?>" value="<?php echo $sub_row['reponse1']?>" >
        <label for="<?php echo $sub_row['reponse1']?>"><?php echo $sub_row['reponse1']?></label><br>

        <input type="radio" id="huey" name="<?php echo $sub_row['id_question']?>" value="<?php echo $sub_row['reponse2']?>" >
        <label for="<?php echo $sub_row['reponse1']?>"><?php echo $sub_row['reponse2']?></label><br>

        <input type="radio" id="huey" name="<?php echo $sub_row['id_question']?>" value="<?php echo $sub_row['reponse3']?>" >
        <label for="<?php echo $sub_row['reponse1']?>"><?php echo $sub_row['reponse3']?></label><br>

        <input type="radio" id="huey" name="<?php echo $sub_row['id_question']?>" value="<?php echo $sub_row['reponse4']?>" >
        <label for="<?php echo $sub_row['reponse1']?>"><?php echo $sub_row['reponse4']?></label><br>
    </div>
    <?php $i++; } }?>
    <button style="margin-bottom: 5%;" type="submit" name='valider_reponses' class="btn btn-primary">Valider les réponses</button>
</form>
</div></div>
</div>
<?php
    valider_reponses($id_quize);   
?>


<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>
</body>

</html>
