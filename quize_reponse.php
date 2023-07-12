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
   <div class="quize_reponse">
      <?php
            $id_quiz=$_GET['id_quiz'];
            $get_quiz=$con->prepare("select * from quize where id_quize='$id_quiz'");
            $get_quiz->setFetchMode(PDO:: FETCH_ASSOC);
            $get_quiz->execute();
            $row=$get_quiz->fetch();
        ?>

        <h3>Résultats du Quiz: <?php echo $row['titre']?></h3>
       
       
        <div class="reponse">
        <?php
             $id_user=$_SESSION['id_user'];
             $get_question=$con->prepare("select * from question where 	id_quize='$id_quiz'");
             $get_question->setFetchMode(PDO:: FETCH_ASSOC);
             $get_question->execute();
             $count=$get_question->rowCount();
             $i=0;
             while($sub_row=$get_question->fetch()){
                $id_question=$sub_row['id_question'];
                $quize_reponse=$con->prepare("select * from quize_reponse where id_question=' $id_question' and id_user='$id_user'");
                $quize_reponse->setFetchMode(PDO:: FETCH_ASSOC);
                $quize_reponse->execute();
                while($reponse_row= $quize_reponse->fetch()){
                    if($reponse_row['reponse_user']==$sub_row['bonne_reponse']){
                         $i++;
                    }
                }}
                    if($i/$count == 1){
                         $icon="&#128526;";
                    }else{
                        if($i/$count < 0.5){
                            $icon="&#128528;";
                        }else{
                            $icon="&#128515;";
                        }
                    }
                ?>
            <h3>Résultat : <b><?php echo $i?>/<?php echo $count?></b><?php echo $icon ?></h3>

            <div class="resultat">
            <?php
             $id_user=$_SESSION['id_user'];
             $get_question=$con->prepare("select * from question where 	id_quize='$id_quiz'");
             $get_question->setFetchMode(PDO:: FETCH_ASSOC);
             $get_question->execute();
             $count=$get_question->rowCount();
             $i=0;
             while($sub_row=$get_question->fetch()){
                $id_question=$sub_row['id_question'];
                $quize_reponse=$con->prepare("select * from quize_reponse where id_question=' $id_question' and id_user='$id_user'");
                $quize_reponse->setFetchMode(PDO:: FETCH_ASSOC);
                $quize_reponse->execute();
                while($reponse_row= $quize_reponse->fetch()){        
        ?>            
                     <h5><?php echo $sub_row['question']?></h5> 
                     <p class="<?php if($sub_row['reponse1'] == $sub_row['bonne_reponse']){ echo "vrai";}else{if($sub_row['reponse1']==$reponse_row['reponse_user']){echo "faux";}else{ echo "reponse_faux";}}?>"> <i class="fa-solid fa-circle-dot"></i>&nbsp;&nbsp;<?php echo $sub_row['reponse1']?></p>
                     <p class="<?php if($sub_row['reponse2'] == $sub_row['bonne_reponse']){ echo "vrai";}else{if($sub_row['reponse2']==$reponse_row['reponse_user']){echo "faux";}else{ echo "reponse_faux";}}?>"> <i class="fa-solid fa-circle-dot"></i>&nbsp;&nbsp;<?php echo $sub_row['reponse2']?></p>
                     <p class="<?php if($sub_row['reponse3'] == $sub_row['bonne_reponse']){ echo "vrai";}else{ if($sub_row['reponse3']==$reponse_row['reponse_user']){echo "faux";}else{ echo "reponse_faux";}}?>"> <i class="fa-solid fa-circle-dot"></i>&nbsp;&nbsp;<?php echo $sub_row['reponse3']?></p>
                     <p class="<?php if($sub_row['reponse4'] == $sub_row['bonne_reponse']){ echo "vrai";}else{ if($sub_row['reponse4']==$reponse_row['reponse_user']){echo "faux";}else{ echo "reponse_faux";}}?>"> <i class="fa-solid fa-circle-dot"></i>&nbsp;&nbsp;<?php echo $sub_row['reponse4']?></p>
                     <div class="demonstration">
                          <?php echo $sub_row['explication']?>
                     </div>
                     <?php } 
                    
                }?>
             </div>
            
        </div>
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
