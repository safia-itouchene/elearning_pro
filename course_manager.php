<?php session_start();?>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
               <li><i class="fa-solid fa-plus"></i><a href='add_cours.php'>Ajouter Cours</a></li>
           </ul>
</div>

     
<?php  if(isset($_GET['edit_quiz'])){
        $id_quize=$_GET['edit_quiz'];
?>
    <div class="main_page">
          <h3>Quize Manager</h3>
          <button type="button"  data-toggle="modal" data-target="#question" data-whatever="@getbootstrap">Ajouter  Question</button>
      </div>
<!---------------------------------------------------------------->
<div class="modal fade" id="question" tabindex="-1" role="dialog" aria-labelledby="questionLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:58%;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="questionLabel">Ajouter Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
</div>
<div class="modal-body"><!---
      <form method='post' enctype="multipart/form-data">  
            <label  for="recipient-name" class="col-form-label">Ajouter audio:</label>
            <input type="file" name='question' class="form-control" id="recipient-name" ><br>
           
            <input type="text" name='question' class="form-control" id="recipient-name" placeholder="Question"><br>
           
            <input type="text" name='add_reponse1' class="form-control" id="recipient-name" placeholder="Réponse N°1"><br>
          
            <input type="text" name='add_reponse2' class="form-control" id="recipient-name" placeholder="Réponse N°2"><br>
            
            <input type="text" name='add_reponse3' class="form-control" id="recipient-name"placeholder="Réponse N°3"><br>
            
            <input type="text" name='add_reponse4' class="form-control" id="recipient-name" placeholder="Réponse N°4"><br>
            <input type="text" name='add_reponse4' class="form-control" id="recipient-name" placeholder="Réponse N°4">
            <label  for="recipient-name" class="col-form-label">Entrez la bonne réponse:</label><br>
            
            <input type="radio"  name="reponse" value="1">
            <label for="reponse1">Réponse N°1</label>&nbsp;&nbsp;&nbsp;
            <input type="radio"  name="reponse" value="2">
            <label for="reponse2">Réponse N°2</label>&nbsp;&nbsp;&nbsp;
            <input type="radio"  name="reponse" value="3">
            <label for="reponse3">Réponse N°3</label>&nbsp;&nbsp;&nbsp;
            <input type="radio"  name="reponse" value="4">
            <label for="reponse4">Réponse N°4</label>&nbsp;&nbsp;&nbsp;
            <button name='add_question' type="submit" class="btn btn-primary">Ajouter</button>
</form>--->

<form method='post' enctype="multipart/form-data" class="needs-validation" novalidate>  
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Question</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Accessoires</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Finir</a>
  </li>
</ul>
<div  class="tab-content" id="myTabContent">
  <div style="margin-top:-5%;" class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
           <label  for="recipient-name" class="col-form-label">	Question:</label>
           <input type="text" name='question' class="form-control" id="recipient-name" required>
           <label  for="recipient-name" class="col-form-label">	Réponse N°1:</label>
           <input type="text" name='add_reponse1' class="form-control" id="recipient-name" required >
           <label  for="recipient-name" class="col-form-label">	Réponse N°2:</label>
           <input type="text" name='add_reponse2' class="form-control" id="recipient-name" required>
           <label  for="recipient-name" class="col-form-label">	Réponse N°3:</label>
           <input type="text" name='add_reponse3' class="form-control" id="recipient-name" required>
           <label  for="recipient-name" class="col-form-label">	Réponse N°4:</label>
           <input type="text" name='add_reponse4' class="form-control" id="recipient-name" required>
         
           <label  for="recipient-name" class="col-form-label">Entrez la bonne réponse:</label><br>
           
           <input type="radio"  name="reponse" value="1" required>
           <label for="reponse1">Réponse N°1</label>&nbsp;&nbsp;&nbsp;
           <input type="radio"  name="reponse" value="2" required>
           <label for="reponse2">Réponse N°2</label>&nbsp;&nbsp;&nbsp;
           <input type="radio"  name="reponse" value="3" required>
           <label for="reponse3">Réponse N°3</label>&nbsp;&nbsp;&nbsp;
           <input type="radio"  name="reponse" value="4" required>
           <label for="reponse4">Réponse N°4</label>&nbsp;&nbsp;&nbsp;
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <label  for="recipient-name" class="col-form-label">Ajouter audio /vedio/image:</label>
          <input style="width:95%;" type="file" name='audio' class="form-control" id="recipient-name" ><br>
          <label  for="recipient-name" class="col-form-label">demostration:</label>
          <textarea class="form-control" name='expl' id='mini_des'  cols='30' rows='10' required></textarea>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
       <p>Merci! Vous n'êtes qu'à un clic</p>
       <div>
           <img src="images/finir.PNG" alt="">
           <button name='add_question' type="submit" class="btn btn-primary">Ajouter</button>
       </div>
  </div>
</div>
</form>

     </div>
    </div>
  </div>
</div>

<!----------------------------------------------------------------->
   <div class="course_manager">
   <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col" style="width:80%;">Qustion</th>
      <th scope="col">Edit</th>
      <th scope="col">Delet</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $get_question=$con->prepare("select * from question where id_quize='$id_quize'");
        $get_question->setFetchMode(PDO:: FETCH_ASSOC);
        $get_question->execute();
         $k=1;
         while($row=$get_question->fetch()){
    ?>
    <form method='post'>
    <tr>
      <th scope="row"><?php echo $k++;?></th>
      <td data-toggle="modal" data-target="#<?php echo $row['id_question'];?>"  ><?php echo $row['question'];?></td>
      <td style="text-align: center; cursor: pointer; color:#41f1b5;" data-toggle="modal" data-target="#<?php echo $row['id_question'];?>"><i class="fa-solid fa-pen-to-square"></i></td>
      <td style="text-align: center;"><button style="cursor: pointer; color:#ff7782; border: none;background: none;" type="submit" name='delet_question'><i class="fa-solid fa-trash-can"></i></button></td>
    </tr>
    <input type="hidden" name="id_question" value="<?php echo $row['id_question'];?>"/></form>

<!--------------------------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="<?php echo $row['id_question'];?>" tabindex="-1" role="dialog" aria-labelledby="leconLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:58%;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="leconLabel">Ajouter Leçon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  method='post' enctype="multipart/form-data" class="needs-validation" novalidate>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#ehome<?php echo $row['id_question'];?>" role="tab" aria-controls="home" aria-selected="true">Question</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#eprofile<?php echo $row['id_question'];?>" role="tab" aria-controls="profile" aria-selected="false">Accessoires</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#econtact<?php echo $row['id_question'];?>" role="tab" aria-controls="contact" aria-selected="false">Finir</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div  style="margin-top:-5%;" class="tab-pane fade show active" id="ehome<?php echo $row['id_question'];?>" role="tabpanel" aria-labelledby="home-tab">
      
<label  for="recipient-name" class="col-form-label">	Question:</label>
<input type="text" name='question' class="form-control" id="recipient-name" value='<?php echo $row['question']?>' required>
<label  for="recipient-name" class="col-form-label">Réponse N°1:</label>
<input type="text" name='reponse1' class="form-control" id="recipient-name" value='<?php echo $row['reponse1']?>' required>
<label  for="recipient-name" class="col-form-label">Réponse N°2:</label>
<input type="text" name='reponse2' class="form-control" id="recipient-name" value='<?php echo $row['reponse2']?>' required>
<label  for="recipient-name" class="col-form-label">Réponse N°3:</label>
<input type="text" name='reponse3' class="form-control" id="recipient-name" value='<?php echo $row['reponse3']?>' required>
<label  for="recipient-name" class="col-form-label">Réponse N°4:</label>
<input type="text" name='reponse4' class="form-control" id="recipient-name" value='<?php echo $row['reponse4']?>' required>
<label  for="recipient-name" class="col-form-label">Entrez la bonne réponse:</label><br>

<input type="radio"  name="<?php echo $row['id_question']?>" value="<?php echo $row['reponse1']?>"   
    <?php
        if($row['reponse1'] ==$row['bonne_reponse']){
           echo 'checked';
        }
    ?>
>
<label for="reponse1">Réponse N°1</label>&nbsp;&nbsp;&nbsp;
<input type="radio"  name="<?php echo $row['id_question']?>" value="<?php echo $row['reponse2']?>"   
<?php
        if($row['reponse2'] ==$row['bonne_reponse']){
           echo 'checked';
        }
    ?>
>
<label for="reponse2">Réponse N°2</label>&nbsp;&nbsp;&nbsp;
<input type="radio"  name="<?php echo $row['id_question']?>" value="<?php echo $row['reponse3']?>"   
    <?php
        if($row['reponse3'] ==$row['bonne_reponse']){
           echo 'checked';
        }
    ?>
>
<label for="reponse3">Réponse N°3</label>&nbsp;&nbsp;&nbsp;
<input type="radio"  name="<?php echo $row['id_question']?>" value="<?php echo $row['reponse4']?>" 
    <?php
        if($row['reponse4'] ==$row['bonne_reponse']){
           echo 'checked';
        }
    ?>
>
<label for="reponse4">Réponse N°4</label>&nbsp;&nbsp;&nbsp;

<input type="hidden" name="id_question" value="<?php echo $row['id_question'];?>"/>
    
  </div>
  <div class="tab-pane fade" id="eprofile<?php echo $row['id_question'];?>" role="tabpanel" aria-labelledby="profile-tab">
  <?php if(!empty($row['accessoires'])){ 
           if($row['type']=='wav'){   
        ?>
        <audio style="	margin-left:18%;" controls>
            <source src="horse.ogg" type="audio/ogg">
            <source src="images/<?php echo $row['accessoires']?>" type="audio/mpeg">
             Your browser does not support the audio element.
        </audio><br>
        <?php }elseif($row['type']=='mp4'){ ?>
           <video  style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px; 	margin-left:18%;"  width="300px" height="170px" controls="controls" >
                  <source src="images/<?php echo $row['accessoires']?>" type="video/mp4"> 
            </video><br>
         <?php }elseif($row['type']=='png' || $row['type']=='jpg'){ ?>
               <img style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px; 	margin-left:18%;" width="300px" height="170px" src="images/<?php echo $row['accessoires']?>" alt=""><br>
        <?php } ?>
        <?php } ?>
          <label  for="recipient-name" class="col-form-label">Edit audio /vedio:</label>
          <input style="width:95%;" type="file" name='eaudio' class="form-control" id="recipient-name" ><br>
          <label  for="recipient-name" class="col-form-label">demostration:</label>
          <textarea class="form-control" name='expll' id='mini_des'  cols='30' rows='20' required><?php echo $row['explication'];?></textarea>
  </div>
  <div class="tab-pane fade" id="econtact<?php echo $row['id_question'];?>" role="tabpanel" aria-labelledby="contact-tab">
       <p>Merci! Vous n'êtes qu'à un clic</p>
       <div>
           <img src="images/finir.PNG" alt="">
           <button name='edit_question' type="submit" class="btn btn-primary">Ajouter</button>
       </div>
  </div>
</div>
           
        </form>
      </div>
    </div>
  </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------>
<?php } 
   add_question();
   edit_question();
   delet_question();
?>
  </tbody>
</table>
</div>
<?php }else{?>
  <?php
       if(isset($_GET['id_cour'])){
          $q=$_GET['id_cour'];
       }
    ?>
  <div class="main_page">
          <h3>Course Manager</h3>
      </div>
<div class="course_manager">
<!---------------------------------------------------------------------------------------------------------------->
<div class="buttons">
<button type="button"  data-toggle="modal" data-target="#section"      data-whatever="@mdo">Ajouter Section</button>
<button type="button"  data-toggle="modal" data-target="#lecon"        data-whatever="@fat">Ajouter Leçon</button>
<button type="button"  data-toggle="modal" data-target="#quize" data-whatever="@getbootstrap">Ajouter  Quiz</button>
<a  href="single.php?id=<?php echo $q ;?>"><button type="button"  data-toggle="modal" data-target="" data-whatever="@getbootstrap">visiter cours</button></a>
</div>
<div class="modal fade" id="section" tabindex="-1" role="dialog" aria-labelledby="sectionLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sectionLabel">Ajouter Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  method='post'   class="needs-validation" novalidate>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Titre:</label>
            <input type="text" name='section' class="form-control" id="recipient-name" required>
            <div class="invalid-feedback">Champ obligatoire</div>
          </div>
          <button name='ajouter_section' type="submit" class="btn btn-primary">Ajouter</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!------------------------------------------------------------------------------------------------------------>
<div class="modal fade" id="quize" tabindex="-1" role="dialog" aria-labelledby="quizeLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="quizeLabel">Ajouter Quize</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  method='post' class="needs-validation" novalidate>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Title:</label>
            <input type="text" name='title_quize' class="form-control" id="recipient-name" required>
            <div class="invalid-feedback">Champ obligatoire</div>
            <label for="recipient-name" class="col-form-label">Section:</label><br>
             <select name='section_quize' class="form-control" id="recipient-name"  name="" id="">
                <?php view_option_section();?>
             </select>
          </div>
          <button name='ajouter_quize' type="submit" class="btn btn-primary">Ajouter</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="question" tabindex="-1" role="dialog" aria-labelledby="questionLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="questionLabel">Ajouter Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
</div>
<div class="modal-body">
<form method='post' enctype="multipart/form-data">   
       
</form>
</div>
    </div>
  </div>
</div>
<!------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="lecon" tabindex="-1" role="dialog" aria-labelledby="leconLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="leconLabel">Ajouter Leçon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  method='post' enctype="multipart/form-data" class="needs-validation" novalidate>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Titre:</label>
            <input type="text" name='lecon' class="form-control" id="recipient-name" required>
            <div class="invalid-feedback">Champ obligatoire</div>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Section:</label><br>
             <select name='op_section' class="form-control" id="recipient-name"  name="" id="">
                <?php view_option_section();?>
             </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Type de leçon:</label><br>
             <select name='op_type' class="form-control" id="recipient-name"  name="" id="">
                 <option value='1'>Video</option>
                 <option value='2'>Pdf file</option>
                 <option value='3'>Image</option>
                 <option value='4'>Docemment</option>
             </select>
          </div>
         <div class="form-group">
             <label  for="recipient-name" class="col-form-label">Leçon:</label><br>
             <input type="file" name='file_lecon' accept="" id='videoUpload' class="form-control" required/>
             <div class="invalid-feedback">Champ obligatoire</div>
          </div>
          <button name='ajouter_lecon' type="submit" class="btn btn-primary">Ajouter</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!------------------------------------------------------------------------------------------------------------->
<div class="row_section">
   <?php  
       afficher_section();
       ajouter_lecon();
       ajouter_quize();
       edit_section();
       delet_section();
       edit_lecon();
       delet_lecon();
       quize_edit();
       delet_quiz();
   ?>
   
</div>
</div>

<!--------------------------------------------------------------------------------------------------------------->

<!--------------------------------------------------------------------------------------------------------------->


</div>
<?php
   ajouter_section();
}
?>

<script>


const accordion = document.getElementsByClassName('container');
for (i=0; i<accordion.length; i++) {
  accordion[i].addEventListener('click', function () {
    this.classList.toggle('active')
  })
}

var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}


$(document).ready(function() {
  $('.modal').on('hidden.bs.modal', function() {
    var html = document.getElementsByClassName("editelecon");
    for (i=0; i<html.length; i++) {
    if (html[i] != null) {
        html[i].pause();
        html[i].currentTime = 0;
    }
    }
  });
});

   
 /*   function addTextInput() {
    var x = document.createElement("INPUT");
    x.setAttribute("type", "text");
    x.setAttribute("name", "textInput");
    x.setAttribute("value", "You Just added a text field");
    document.getElementById("myForm").appendChild(x)
}*/



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