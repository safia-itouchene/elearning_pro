<?php
// ajouter catégirie
function add_cat(){
    include("inc/db.php");
if(isset($_POST['add_cat'])){
     $cat_name= $_POST['cat_name'];
     
     $file=$_FILES['cover'];
     $fileName = $_FILES['cover']['name'];
     $fileTmpName = $_FILES['cover']['tmp_name'];
     $fileExt =explode('.', $fileName);
     $fileActualExt =strtolower(end($fileExt));
     $allowed =array('jpg', 'jpeg', 'png');
     $fileNameNew = uniqid('',true).".".$fileActualExt;
     $fileDestination = 'images/'.$fileNameNew;
     move_uploaded_file($fileTmpName , $fileDestination);

     $check=$con->prepare("select * from cat where cat_name='$cat_name'");
     $check->setFetchMode(PDO:: FETCH_ASSOC);
     $check->execute();
     $count=$check->rowCount();

     if($count!=0){
        echo"<script>alert('La langue existe déjà')</script>";
} else{
       $add_cat=$con->prepare("insert into cat(cat_name,image)values('$cat_name','$fileNameNew')");
   if($add_cat->execute()){
    echo"<script>alert('Langue ajoutée avec succès')</script>";
    echo'<script> location.href ="index.php?cat";</script>';
   }else{
     echo"<script>alert('Erreur ...')</script>";
   }
}
}
}

function view_cat(){
    include("inc/db.php");
    $get_cat=$con->prepare("select * from cat");
    $get_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $get_cat->execute();
    $i=1;
    while($row=$get_cat->fetch()):
           echo "<tr>
                      <td><img style='width:80px;height:50px; margin-left:32%;' src='images/".$row['image']."'></td>
                      <td>".$row['cat_name']."</td>
                      <td><a id='edit-icon' href='index.php?cat&edit_cat=".$row['cat_id']."'><i style='font-size:17px;' class='fa-regular fa-pen-to-square'></i></a></td>
                      <td><a id='del-icon'  href='index.php?cat&del_cat=".$row['cat_id']."'><i style='font-size:17px;' class='fa-solid fa-trash-can '></i></a></td>
                </tr>";
    endwhile;
   /*pour supprimer un cat*/
    if(isset($_GET['del_cat'])){
        $id=$_GET['del_cat'];
        $del=$con->prepare("delete from cat where cat_id='$id'");
        
        $get_cour=$con->prepare("select * from course where  id_cat='$id'");
        $get_cour->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cour->execute();

        while($crow=$get_cour->fetch()):
            $id_cour=$crow['id_cours'];
            $delet_cour=$con->prepare("delete from course where id_cours='$id_cour'");
            $delet_cour->execute();


            $get_section=$con->prepare("select * from section where id_cour='$id_cour'");
            $get_section->setFetchMode(PDO:: FETCH_ASSOC);
            $get_section->execute();

            while($row=$get_section->fetch()):
                $id_section=$row['id_section'];
                $delet_section=$con->prepare("delete from section where id_section='$id_section'");
                $delet_section->execute();

                $get_lecon=$con->prepare("select * from lecon where id_section='$id_section'");
                $get_lecon->setFetchMode(PDO:: FETCH_ASSOC);
                $get_lecon->execute();
                while($row_lecon=$get_lecon->fetch()):
                   $id_lecon=$row_lecon['id'];
                   $delet_lecon=$con->prepare("delete from lecon where id='$id_lecon'");
                   $delet_lecon->execute();
                endwhile;

                $get_quiz=$con->prepare("select * from quize where id_section='$id_section'");
                $get_quiz->setFetchMode(PDO:: FETCH_ASSOC);
                $get_quiz->execute();
                while($row_quiz=$get_quiz->fetch()):
                    $id_quiz=$row_quiz['id_quize'];
                    $delet_quiz=$con->prepare("delete from quize where id_quize='$id_quiz'");
                    $delet_quiz->execute();
                    
                    $get_q=$con->prepare("select * from question where id_quize='$id_quiz'");
                    $get_q->setFetchMode(PDO:: FETCH_ASSOC);
                    $get_q->execute();
                    while($row_q=$get_q->fetch()):
                        $id_q=$row_q['id_question'];
                        $delet_q=$con->prepare("delete from question where id_question='$id_q'");
                        $delet_q->execute();
                    endwhile;

                 endwhile;

           endwhile;

        endwhile;


        if($del->execute()){
            echo"<script>alert('La suppression a été effectuée')</script>";
            echo'<script> location.href ="index.php?cat";</script>';
            
        }else{
            echo"<script>alert('Erreur ...')</script>";
        }
    }
}
/*************************EDIT******************/
function edit_cat(){
    include("inc/db.php");
    
if(isset($_GET['edit_cat'])){
$id=$_GET['edit_cat'];
$get_cat=$con->prepare("select * from cat where cat_id='$id'");
$get_cat->setFetchMode(PDO:: FETCH_ASSOC);
$get_cat->execute();
$row=$get_cat->fetch();
 echo" <h2 id='title'>Edit Category</h2>
<form id='edit_form' method='post' enctype='multipart/form-data' class='file_f' name='myForm4' onsubmit='return validateForm4()'>
      <span style='margin-left:0%;' class='error' id='errorprecategory'></span>
      <input type='text'  name='cat_name' value='".$row['cat_name']."' placeholder='Enter Category Name'/>
      <img id='file-ip-3-preview' style='margin-left:-40%;' width = 90 height = 90   src='images/".$row['image']."' alt=''>   
      <input type='file' name='flag' id='file-ip-3' accept='image/*' onchange='showPreview3(event);'>
      <center><button name='edit_cat'> Edit Category</button> </center>
 </form>";

 if(isset($_POST['edit_cat'])){
      $cat_name=$_POST['cat_name'];

      $file=$_FILES['flag'];
      $fileName = $_FILES['flag']['name'];
      $fileTmpName = $_FILES['flag']['tmp_name'];
      $fileExt =explode('.', $fileName);
      $fileActualExt =strtolower(end($fileExt));
      $allowed =array('jpg', 'jpeg', 'png');
      $fileNameNew = uniqid('',true).".".$fileActualExt;
      $fileDestination = 'images/'.$fileNameNew;
      move_uploaded_file($fileTmpName , $fileDestination);

      $check=$con->prepare("select * from cat where cat_name='$cat_name' and cat_id !='$id'");
      $check->setFetchMode(PDO:: FETCH_ASSOC);
      $check->execute();
      $count=$check->rowCount();

      if($count!=0){
        echo"<script>alert('La langue existe déjà')</script>";
 } else{
      if($_FILES['flag']['size']!=0){
        $up=$con->prepare("update cat set cat_name='$cat_name' , image='$fileNameNew' where cat_id='$id'");
      }elseif($_FILES['flag']['size']==0){
        $up=$con->prepare("update cat set cat_name='$cat_name' where cat_id='$id'");
      }
    
      if($up->execute()){
          echo"<script>alert('Langue modifier avec succès')</script>";
          echo'<script> location.href ="index.php?cat";</script>';
      }else{
        echo"<script>alert('Erreur ...')</script>";
      }
    }
 }
}
}

/*fonctio pour select les  cat*/
function select_cat(){
    include("inc/db.php");
    $get_cat=$con->prepare("select * from cat");
    $get_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $get_cat->execute();
    while($row=$get_cat->fetch()):
           echo"<option value='".$row['cat_id']."'>".$row['cat_name']."</option>";
    endwhile;
}


    /*fonction pour ajouter sub cat */
    function add_sub_cat(){
        include("inc/db.php");
if(isset($_POST['add_sub_cat'])){
         $sub_cat_name= $_POST['sub_cat_name'];
         $check=$con->prepare("select * from sub_cat where sub_cat_name='$sub_cat_name'");
         $check->setFetchMode(PDO:: FETCH_ASSOC);
         $check->execute();
         $count=$check->rowCount();
  
         if($count!=0){
            echo"<script>alert('Niveau  existe déjà')</script>";
    } else{
           $add_cat=$con->prepare("insert into sub_cat(sub_cat_name)values('$sub_cat_name')");
       if($add_cat->execute()){
            echo"<script>alert('Niveau ajouté avec succès')</script>";
            echo'<script> location.href ="index.php?sub_cat";</script>';
       }else{
            echo"<script>alert('Erreur ...')</script>";
       }
    }
}
}

function view_sub_cat(){
    include("inc/db.php");
    $get_cat=$con->prepare("select * from sub_cat");
    $get_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $get_cat->execute();
    $i=1;
    while($row=$get_cat->fetch()):
           echo "<tr>
                      <td>".$i++."</td>
                      <td>".$row['sub_cat_name']."</td>
                      <td><a id='edit-icon' href='index.php?sub_cat&edit_sub_cat=".$row['sub_cat_id']."'><i style='font-size:17px;' class='fa-regular fa-pen-to-square'></i></a></td>
                      <td><a id='del-icon' href='index.php?sub_cat&del_sub_cat=".$row['sub_cat_id']."'><i style='font-size:17px;' class='fa-solid fa-trash-can '></i></a></td>
                </tr>";
    endwhile;
       /*pour supprimer un cat*/
       if(isset($_GET['del_sub_cat'])){
        $id=$_GET['del_sub_cat'];
        $del=$con->prepare("delete from sub_cat where sub_cat_id='$id'");

        $get_cour=$con->prepare("select * from course where  id_sub_cat='$id'");
        $get_cour->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cour->execute();

        while($crow=$get_cour->fetch()):
            $id_cour=$crow['id_cours'];
            $delet_cour=$con->prepare("delete from course where id_cours='$id_cour'");
            $delet_cour->execute();


            $get_section=$con->prepare("select * from section where id_cour='$id_cour'");
            $get_section->setFetchMode(PDO:: FETCH_ASSOC);
            $get_section->execute();

            while($row=$get_section->fetch()):
                $id_section=$row['id_section'];
                $delet_section=$con->prepare("delete from section where id_section='$id_section'");
                $delet_section->execute();

                $get_lecon=$con->prepare("select * from lecon where id_section='$id_section'");
                $get_lecon->setFetchMode(PDO:: FETCH_ASSOC);
                $get_lecon->execute();
                while($row_lecon=$get_lecon->fetch()):
                   $id_lecon=$row_lecon['id'];
                   $delet_lecon=$con->prepare("delete from lecon where id='$id_lecon'");
                   $delet_lecon->execute();
                endwhile;

                $get_quiz=$con->prepare("select * from quize where id_section='$id_section'");
                $get_quiz->setFetchMode(PDO:: FETCH_ASSOC);
                $get_quiz->execute();
                while($row_quiz=$get_quiz->fetch()):
                    $id_quiz=$row_quiz['id_quize'];
                    $delet_quiz=$con->prepare("delete from quize where id_quize='$id_quiz'");
                    $delet_quiz->execute();
                    
                    $get_q=$con->prepare("select * from question where id_quize='$id_quiz'");
                    $get_q->setFetchMode(PDO:: FETCH_ASSOC);
                    $get_q->execute();
                    while($row_q=$get_q->fetch()):
                        $id_q=$row_q['id_question'];
                        $delet_q=$con->prepare("delete from question where id_question='$id_q'");
                        $delet_q->execute();
                    endwhile;

                 endwhile;

           endwhile;

        endwhile;
      

        if($del->execute()){
            echo"<script>alert('La suppression a été effectuée')</script>";
            echo'<script> location.href ="index.php?sub_cat";</script>';
        }else{
            echo"<script>alert('Erreur ...')</script>";
        }
    }
}


function edit_sub_cat(){
    include("inc/db.php");
    
if(isset($_GET['edit_sub_cat'])){
$id=$_GET['edit_sub_cat'];

$get_cat=$con->prepare("select * from sub_cat where sub_cat_id='$id'");
$get_cat->setFetchMode(PDO:: FETCH_ASSOC);
$get_cat->execute();
$row=$get_cat->fetch();



 echo" <h2 id='title'>Edit Sub Category</h2>
<form id='edit_form' method='post' enctype='multipart/form-data'>
     <input type='text'  name='sub_cat_name' value='".$row['sub_cat_name']."' placeholder='Enter Category Name'/>
     <center style='margin-top:15%;'><button name='sub_edit_cat'> Edit Category</button> </center>
</form>"; 

 if(isset($_POST['sub_edit_cat'])){
      $cat_name=$_POST['sub_cat_name'];
      
      $check=$con->prepare("select * from sub_cat where sub_cat_name='$cat_name' and sub_cat_id  !='$id'");
      $check->setFetchMode(PDO:: FETCH_ASSOC);
      $check->execute();
      $count=$check->rowCount();
      if($count == 0){

        $up=$con->prepare("update sub_cat set sub_cat_name='$cat_name' where sub_cat_id='$id'");
        if($up->execute()){
            echo"<script>alert('Niveau modifier avec succès')</script>";
            echo'<script> location.href ="index.php?sub_cat";</script>';
        }else{
            echo"<script>alert('Erreur ...')</script>";
        }
      }else{
        echo"<script>alert('Niveau  existe déjà')</script>";
      }
     
}
}


}




function admin_compte(){
    include("inc/db.php");
    $id=$_SESSION['id_user'];
    $get_con=$con->prepare("select * from user where id_user='$id'");
    $get_con->setFetchMode(PDO:: FETCH_ASSOC);
    $get_con->execute();
    $row=$get_con->fetch();

    echo" 
    <form method='post' id='propile_info'>
    <table>
      <tr>
        <td><h2>E mail</h2></td>
        <td> <input type='email' value='".$row['email']."' name='email'></td>
      </tr>
      <tr>
        <td><h2>Le Nom</h2></td>
        <td> <input type='text' value='".$row['nome']."' name='nom'></td>
      </tr>
      <tr>
        <td><h2>Le Prenom</h2></td>
        <td> <input type='text' value='".$row['prenom']."' name='prenom'></td>
      </tr>
    </table>
    <button  type='submit'  name='save'>SAVE</button>
 </form>";
 
  if(isset($_POST['save'])){
    $email=$_POST['email'];
    $nom=$_POST['nom'];
  
    $prenom=$_POST['prenom']; 
    $check=$con->prepare("select email from user where id !='$id' and email ='$email'");
    $check->setFetchMode(PDO:: FETCH_ASSOC);
    $check->execute();
    $count=$check->rowCount();

    if($count==0){
        $up=$con->prepare("update user set email='$email',nome='$nom',prenom='$prenom' where id ='$id'");
    }else{
        echo"<script>alert('email existe')</script>";
        echo "<script>window.open('index.php?admin_compte','self')</script>";

    }
     
    if($up->execute()){
        echo "<script>window.open('index.php?admin_compte','self')</script>";
    }
}
}
   function reset_password(){
    include("inc/db.php");
    $get_con=$con->prepare("select * from user");
    $get_con->setFetchMode(PDO:: FETCH_ASSOC);
    $get_con->execute();
    $row=$get_con->fetch();
    echo" 
    <form method='post' id='propile_info' style='margin-top:10%'>
    <table>
      <tr>
        <td><h2>Mot de passe actuel</h2></td>
        <td> <input type='text' name='nom'></td>
      </tr>
      <tr>
        <td><h2>Nouveau mot de passe</h2></td>
        <td> <input type='text'  name='prenom'></td>
      </tr>
      <tr>
        <td><h2>Répété mot de passe</h2></td>
        <td> <input type='password'  name='password'></td>
      </tr>
    </table>
    <button  style='margin-left:532px;' type='submit' >SAVE</button>
 </form>";
 
 
}
/********************************Add Blog***********************/
 function save_media(){
    include("inc/db.php");
    $get_data=$con->prepare("select * from about_web");
    $get_data->setFetchMode(PDO:: FETCH_ASSOC);
    $get_data->execute();
    $row=$get_data->fetch();
    echo'
<form method="post" id="propile_info"  name="blogFormabout" onsubmit="return validateblogFormabout()">
    <br><label for="recipient-name"><i class="fa-brands fa-github"></i>&nbsp;&nbsp;&nbsp;Github</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="margin-left:0%;" class="error" id="errorurl1"></span> <br>
    <input type="url" name="url1"  id="recipient-name" value="'.$row["url1"].'"> 
    <br><label for="recipient-name" ><i class="fa-brands fa-youtube"></i>&nbsp;&nbsp;&nbsp;Youtube &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="margin-left:0%;" class="error" id="errorurl2"></span></label> <br>
    <input type="url" name="url2"  id="recipient-name" value="'.$row["url2"].'"> 
    <br><label for="recipient-name" ><i class="fa-brands fa-facebook"></i>&nbsp;&nbsp;&nbsp;Facebook &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="margin-left:0%;" class="error" id="errorurl3"></span></label> <br>
    <input type="url" name="url3"  id="recipient-name" value="'.$row["url3"].'"> 
    <br><label for="recipient-name" ><i class="fa-brands fa-twitter"></i>&nbsp;&nbsp;&nbsp;Twitter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="margin-left:0%;" class="error" id="errorurl4"></span></label> <br>
    <input type="url" name="url4"  id="recipient-name" value="'.$row["url4"].'"> 
    <br><label for="recipient-name" ><i class="fa-brands fa-instagram"></i>&nbsp;&nbsp;&nbsp;Instagram &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="margin-left:0%;" class="error" id="errorurl5"></span></label> <br>
    <input type="url" name="url5" id="recipient-name" value="'.$row["url5"].'">
    <button style=" margin-left:75%;"  type="submit"  name="save_media">SAVE</button>
</form>';
     if(isset($_POST['save_media'])){
        $url1=$_POST['url1'];
        $url2=$_POST['url2'];
        $url3=$_POST['url3'];
        $url4=$_POST['url4'];
        $url5=$_POST['url5'];

        $update=$con->prepare("update about_web set url1='$url1',url2='$url2',url3='$url3',url4='$url4',url5='$url5'");
        if($update->execute()){
            echo"<script>alert('Modifié ...')</script>";
            echo'<script> location.href ="index.php?about_web";</script>';
        }
    } 
 }

    function save_about_us(){
        include("inc/db.php");
        $get_data=$con->prepare("select * from about_web");
        $get_data->setFetchMode(PDO:: FETCH_ASSOC);
        $get_data->execute();
        $row=$get_data->fetch();

        echo '
        <form method="post" >
           <br><h1>&nbsp;&nbsp;&nbsp;À propos De Nous</h1> <br>
           <textarea name="about_us" id="" cols="30" rows="10" placeholder="Pourquoi Nous ?">'.$row['about_us'].'</textarea>
           <button  type="submit"  name="save_about_us">SAVE</button>
        </form>
        ';
        if(isset($_POST['save_about_us'])){
            $about_us=$_POST['about_us'];
          //  echo"<script>alert('$about_us')</script>";
            $update=$con->prepare("update about_web set about_us ='$about_us'");

            if($update->execute()){
                echo"<script>alert('Modifié ...')</script>";
                echo'<script> location.href ="index.php?about_web";</script>';
            }
        }
    }

    function save_afficharge(){
        include("inc/db.php");
        $get_data=$con->prepare("select * from about_web");
        $get_data->setFetchMode(PDO:: FETCH_ASSOC);
        $get_data->execute();
        $row=$get_data->fetch();

        echo '<form method="post" enctype="multipart/form-data"> 
      <div>
        <h3>Modifier le logo du site.</h3>
        <img id="file-ip-1-preview" width = 100 height = 100   src="images/'.$row["logo"].'" alt="">
        <label for="file-ip-1">uplod image</label><br>
        <input type="file" name="logo" id="file-ip-1" accept="image/*" onchange="showPreview(event);">
      </div>
      <div class="pic">
           <img style=" margin-bottom:10%;" id="file-ip-2-preview" width = 100 height = 100  src="images/'.$row["cover"].'" alt="">
           <label for="file-ip-2">uplod image</label><br>
           <input  type="file" name="cover" id="file-ip-2" accept="image/*" onchange="showPreview2(event);" >
        </div>
        <button  type="submit"  name="save_aff" onclick="myFunction_set()">SAVE</button>
        </form>';
       

        if(isset($_POST['save_aff'])){
            $logo=$_FILES['logo'];
            $logoName = $_FILES['logo']['name'];
            $logoTmpName = $_FILES['logo']['tmp_name'];
            $logoExt =explode('.', $logoName);
            $logoActualExt =strtolower(end($logoExt));
            $allowed =array('jpg', 'jpeg', 'png');
            $logoNameNew = uniqid('',true).".".$logoActualExt;
            $logoDestination = 'images/'.$logoNameNew;
            move_uploaded_file($logoTmpName , $logoDestination);

            $file=$_FILES['cover'];
            $fileName = $_FILES['cover']['name'];
            $fileTmpName = $_FILES['cover']['tmp_name'];
            $fileExt =explode('.', $fileName);
            $fileActualExt =strtolower(end($fileExt));
            $allowed =array('jpg', 'jpeg', 'png');
            $fileNameNew = uniqid('',true).".".$fileActualExt;
            $fileDestination = 'images/'.$fileNameNew;
            move_uploaded_file($fileTmpName , $fileDestination);
            
            if($_FILES['logo']['size']!=0  && $_FILES['cover']['size']!=0 ){
                $update=$con->prepare("update about_web set cover='$fileNameNew', logo='$logoNameNew'");
                if($update->execute()){
                    echo"<script>alert('Modifié ...')</script>";
                    echo'<script> location.href ="index.php?about_web";</script>';
                }
            }elseif($_FILES['logo']['size']!=0  && $_FILES['cover']['size']==0){
                $update=$con->prepare("update about_web set logo='$logoNameNew'");
                if($update->execute()){
                    echo"<script>alert('Modifié ...')</script>";
                    echo'<script> location.href ="index.php?about_web";</script>';
                }
            }elseif($_FILES['logo']['size']==0  && $_FILES['cover']['size']!=0){
                $update=$con->prepare("update about_web set cover='$fileNameNew'");
                if($update->execute()){
                    echo"<script>alert('Modifié ...')</script>";
                    echo'<script> location.href ="index.php?about_web";</script>';
                }
            }
        }
    }
    function add_blog(){

        include("inc/db.php");
        $id=$_SESSION['id_user'];
        if(isset($_POST['add_blog'])){
             $blog_title=$_POST["blog_title"];
             $blog_sub_title=$_POST["blog_sub_title"];
             $blog_cont=$_POST['blog_cont'];
             $blog_date=date("Y.m.d");


             $file=$_FILES['cover'];
             $fileName = $_FILES['cover']['name'];
             $fileTmpName = $_FILES['cover']['tmp_name'];
             $fileExt =explode('.', $fileName);
             $fileActualExt =strtolower(end($fileExt));
             $allowed =array('jpg', 'jpeg', 'png');
             $fileNameNew = uniqid('',true).".".$fileActualExt;
             $fileDestination = 'images/'.$fileNameNew;
             move_uploaded_file($fileTmpName , $fileDestination);
        
           
             $add_blog=$con->prepare("insert into tb_blog(id_admin,blog_title,blog_sub_title,blog_cont,blog_image,blog_date)values('$id','$blog_title','$blog_sub_title','$blog_cont','$fileNameNew','$blog_date')");
           
             if($add_blog->execute()){
                echo"<script>alert('blog ajouté avec succès')</script>";
                echo'<script> location.href ="index.php?afficher_blog";</script>';
            }else{
                echo"<script>alert('Erreur ...')</script>";
            }
            
        }

    }
/********************************Afficher Blog***********************/

          function afficher_blog(){
            include("inc/db.php");
            $id=$_SESSION['id_user'];
            $get_blog=$con->prepare("select * from tb_blog where id_admin='$id'");
            $get_blog->setFetchMode(PDO:: FETCH_ASSOC);
            $get_blog->execute();
            $i=1;
            while($row=$get_blog->fetch()):
                   echo "<tr><td id='image_blog'><img  src='images/";
                   echo $row['blog_image'];
                   echo"'></img></td>
                              <td>".$row['blog_title']."</td>
                              <td><a id='view-icon'  href='../blog_detail.php?blog&id_blog=".$row['id_blog']."'><i style='font-size:17px;' class='fa-solid fa-eye'></i></a></td>
                              <td><a id='edit-icon' href='index.php?afficher_blog&edit_blog=".$row['id_blog']."'><i style='font-size:17px;' class='fa-regular fa-pen-to-square'></i></a></td>
                              <td><a id='del-icon'  href='index.php?afficher_blog&del_blog=".$row['id_blog']."'><i style='font-size:17px;' class='fa-solid fa-trash-can '></i></a></td>
                        </tr>";
            endwhile;
           /*pour supprimer un cat*/
            if(isset($_GET['del_blog'])){
                $id=$_GET['del_blog'];
                $del=$con->prepare("delete from tb_blog where id_blog='$id'");
                if($del->execute()){
                    echo"<script>alert('La suppression a été effectuée')</script>";  
                    echo'<script> location.href ="index.php?afficher_blog";</script>';
                }else{
                    echo"<script>alert('Erreur ...')</script>";
                }
            }
          }

/************************Edit Blog************************/
      function edit_blog(){
           include("inc/db.php");
        if(isset($_GET['edit_blog'])){
            $id=$_GET['edit_blog'];
            $get_blog=$con->prepare("select * from tb_blog where id_blog='$id'");
            $get_blog->setFetchMode(PDO:: FETCH_ASSOC);
            $get_blog->execute();
            $row=$get_blog->fetch();

            echo "<div class='edit_blog'>
            <form  method='post' enctype='multipart/form-data'  name='blogForm' onsubmit='return validateblogFormedit()'>
            <h1>Add New Blog</h1> 
            <span style='margin-left:0%;' class='error' id='errorblog_title'></span>
            <input type='text' name='blog_title'  placeholder='Enter Blog Title' value='".$row['blog_title']."'>

            <span style='margin-left:0%;' class='error' id='errorsub_title'></span>
            <input type='text' name='blog_sub_title'  placeholder='Enter Sub Title'  value='".$row['blog_sub_title']."'>
           
            <img id='file-ip-3-preview' width = 140 height = 140   src='images/".$row['blog_image']."' alt=''>
        
            <label for='file-ip-3'>Upload Image</label>
            <input type='file' name='blog_image' id='file-ip-3' accept='image/*' onchange='showPreview3(event);'>
             
            <span style='margin-left:0%;' class='error' id='errorsub_txt'></span>
            <textarea name='blog_cont' id='' cols='30' rows='10' placeholder='Create New Blog'>".$row['blog_cont']."</textarea>
            <button   name='modifer_blog'>Modifier</button>
            </form>
   </div>";
           
        }
        if(isset($_POST['modifer_blog'])){
            $blog_title=$_POST['blog_title'];
            $blog_sub_title=$_POST['blog_sub_title'];
            $blog_cont=$_POST['blog_cont'];
            $blog_image=$_FILES['blog_image']['name'];
              if(empty($blog_image)){
                $up=$con->prepare("update tb_blog set blog_title='$blog_title',blog_sub_title='$blog_sub_title' ,blog_cont='$blog_cont' where id_blog ='$id'");
            }else{
                $up=$con->prepare("update tb_blog set blog_title='$blog_title',blog_sub_title='$blog_sub_title' ,blog_cont='$blog_cont',blog_image='$blog_image' where id_blog ='$id'");
            }
              if($up->execute()){
                echo "<script>alert('Modifié ...')</script>";  
                echo'<script> location.href ="index.php?afficher_blog";</script>';
            }else{
                echo"<script>alert('Erreur ...')</script>"; 
            }
        }
       
       

      }
/***********************************Afficher User************************ */

function view_user(){
    include("inc/db.php");
    $id=$_SESSION['id_user'];
    $get_user=$con->prepare("select * from user where id_user !='$id' ");
    $get_user->setFetchMode(PDO:: FETCH_ASSOC);
    $get_user->execute();
    $i=1;
    while($row=$get_user->fetch()):
        echo "<form method='post'><tr><td id='image_user'><img  src='../images/";
        echo $row['user_image'];
        echo"'></img></td>
                   <td>".$row['nome']."</td>
                   <td>".$row['prenom']."</td>
                   <td>".$row['email']."</td>
                   <input type='hidden' name='id_user' value='".$row['id_user']."'/>
                   <td><button id='del-icon' name='del_user'><i style='font-size:17px;;' class='fa-solid fa-trash-can '></i></button></td>
             </tr></form>";
 endwhile;
   /*pour supprimer un cat*/
    if(isset($_POST['del_user'])){
        $id_user=$_POST['id_user'];
        $del=$con->prepare("delete from user  where id_user ='$id_user'");

        $delet_d=$con->prepare("delete from demande_enseignement where id_user='$id_user'");
        $delet_d->execute();

        $get_ens=$con->prepare("select * from enseignant where id_user='$id_user'");
        $get_ens->setFetchMode(PDO:: FETCH_ASSOC);
        $get_ens->execute();
        $row_ens=$get_ens->fetch();
        $ens=$get_ens->rowCount();
        
       

        if($ens != 0){
            $id_ens=$row_ens['id_enseignant'];
            $del_ens=$con->prepare("delete from enseignant where id_enseignant='$id_ens'");
            $del_ens->execute();

            $delet_f=$con->prepare("delete from followers where id_ens='$id_ens'");
            $delet_f->execute();

        }
       

        if($del->execute()){
            echo"<script>alert('La suppression a été effectuée')</script>";  
            echo'<script> location.href ="index.php?user";</script>'; 
        }else{
            echo"<script>alert('Erreur ...')</script>"; 
        }
    }

}



function view_ens(){
    include("inc/db.php");
     
    $get_ens=$con->prepare("select * from enseignant");
    $get_ens->setFetchMode(PDO:: FETCH_ASSOC);
    $get_ens->execute();
    while($sub_row=$get_ens->fetch()){
        $id_user=$sub_row['id_user'];
        $get_user=$con->prepare("select * from user where id_user='$id_user'");
        $get_user->setFetchMode(PDO:: FETCH_ASSOC);
        $get_user->execute();
        $row=$get_user->fetch();

        echo "<tr><td id='image_user'><img  src='../images/";
        echo $row['user_image'];
        echo"'></img></td>
                   <td>".$row['nome']."</td>
                   <td>".$row['prenom']."</td>
                   <td>".$sub_row['niveau_acad']."</td>
                   <form  method='post'>
                   <input type='hidden' name='id_ens' value='".$sub_row['id_enseignant']."'/>
                   <td><button name='delet_ens'><i style='font-size:17px; color:#ff7782;' class='fa-solid fa-trash-can '></i></button></td></form>
             </tr>";
    }
    
    if(isset($_POST['delet_ens'])){
        $id_ens=$_POST['id_ens'];
        $del=$con->prepare("delete from enseignant where id_enseignant='$id_ens'");

        $get_cour=$con->prepare("select * from course where id_user='$id_ens'");
        $get_cour->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cour->execute();

        while($crow=$get_cour->fetch()):
            $id_cour=$crow['id_cours'];
            $delet_cour=$con->prepare("delete from course where id_cours='$id_cour'");
            $delet_cour->execute();


            $get_section=$con->prepare("select * from section where id_cour='$id_cour'");
            $get_section->setFetchMode(PDO:: FETCH_ASSOC);
            $get_section->execute();

            while($row=$get_section->fetch()):
                $id_section=$row['id_section'];
                $delet_section=$con->prepare("delete from section where id_section='$id_section'");
                $delet_section->execute();

                $get_lecon=$con->prepare("select * from lecon where id_section='$id_section'");
                $get_lecon->setFetchMode(PDO:: FETCH_ASSOC);
                $get_lecon->execute();
                while($row_lecon=$get_lecon->fetch()):
                   $id_lecon=$row_lecon['id'];
                   $delet_lecon=$con->prepare("delete from lecon where id='$id_lecon'");
                   $delet_lecon->execute();
                endwhile;

                $get_quiz=$con->prepare("select * from quize where id_section='$id_section'");
                $get_quiz->setFetchMode(PDO:: FETCH_ASSOC);
                $get_quiz->execute();
                while($row_quiz=$get_quiz->fetch()):
                    $id_quiz=$row_quiz['id_quize'];
                    $delet_quiz=$con->prepare("delete from quize where id_quize='$id_quiz'");
                    $delet_quiz->execute();
                    
                    $get_q=$con->prepare("select * from question where id_quize='$id_quiz'");
                    $get_q->setFetchMode(PDO:: FETCH_ASSOC);
                    $get_q->execute();
                    while($row_q=$get_q->fetch()):
                        $id_q=$row_q['id_question'];
                        $delet_q=$con->prepare("delete from question where id_question='$id_q'");
                        $delet_q->execute();
                    endwhile;

                 endwhile;

           endwhile;

        endwhile;
        
        $delet_f=$con->prepare("delete from followers where id_ens='$id_ens'");
        $delet_f->execute();
        
        if($del->execute()){
            echo"<script>alert('La suppression a été effectuée')</script>"; 
            echo'<script> location.href ="index.php?ens";</script>'; 
        }else{
            echo"<script>alert('Erreur ...')</script>"; 
        }
    }
}


function demande(){
    include("inc/db.php");
    $get_dem=$con->prepare("select * from demande_enseignement where resultat='0'");
    $get_dem->setFetchMode(PDO:: FETCH_ASSOC);
    $get_dem->execute();
    
    while($row=$get_dem->fetch()){
           $id_user=$row['id_user'];
           $get_user=$con->prepare("select * from user where id_user ='$id_user'");
           $get_user->setFetchMode(PDO:: FETCH_ASSOC);
           $get_user->execute();
           $sub_row=$get_user->fetch();
    
   echo"<tr> 
             <td>".$sub_row['nome']."&nbsp;&nbsp;&nbsp;".$sub_row['prenom']."</td>
             <td>".$row['niveau_acad']."</td>
             <td>".$row['lang']."</td>
            
             <td><a href='index.php?demande&id_dem=".$row['id']."'>filepdf</a></td>
             <form  method='post'>
             <td id='acc'> <button   name='acc'>Accepter</button></td>
             <td id='ref'> <button   name='ref'>Refuser</button></td>
             <input type='hidden' name='id_demand' value='".$row['id']."'/>
             <input type='hidden' name='niveau_acad' value='".$row['niveau_acad']."'/>
             <input type='hidden' name='id_user' value='".$row['id_user']."'/>
             </form>
        </tr>
        ";
    }
    
    if(isset($_POST['acc'])){
        $niveux=$_POST['niveau_acad'];
        $id_demand=$_POST['id_demand'];
        $id_u=$_POST['id_user'];
        $add_ens=$con->prepare("insert into enseignant(id_user,niveau_acad)values('$id_u','$niveux')");
        $add_ens->execute();
        $del=$con->prepare("delete from demande_enseignement where id='$id_demand'");
        if($del->execute()){
            echo"<script>alert('La demande a été acceptée.')</script>";
            echo'<script> location.href ="index.php?demande";</script>';
        }
   }

   if(isset($_POST['ref'])){
    $id_demand=$_POST['id_demand'];
    $up=$con->prepare("update demande_enseignement set resultat='1' where id='$id_demand'");
    if($up->execute()){
        echo"<script>alert('demande a été refusé')</script>";
        echo'<script> location.href ="index.php?demande";</script>';
    }
}

}
   
?>