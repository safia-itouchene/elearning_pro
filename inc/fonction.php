 <?php
     function view_cat(){
        include("inc/db.php");
        $get_cat=$con->prepare("select * from cat");
        $get_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cat->execute();
        $i=0;
        while($row=$get_cat->fetch()):
                echo '<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=.'.$row['cat_name'].'>'.$row['cat_name'].'</li>';
        endwhile;
    }
 
     function view_cour()
    {   
        include("Admin/inc/db.php");
        $get_cour=$con->prepare("select * from course");
        $get_cour->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cour->execute();
        $i=0;
        while(($row=$get_cour->fetch()) && $i<10):
            $id=$row['id_cat'];
            $get_cat=$con->prepare("select cat_name from cat where cat_id='$id'");
            $get_cat->setFetchMode(PDO:: FETCH_ASSOC);
            $get_cat->execute();
            $sub_row=$get_cat->fetch(); 
            echo '<a  href="single.php?id='.$row['id_cours'].'">
            <div id="this" class="product-item '.$sub_row['cat_name'].'">
                <div class="product product_filter">
                     <div class="product_image">
                        <img src="images/'.$row["cover"].'" alt="">
                     </div></a>
                     <div class="favorite"></div>
                     <div class="product_info">
                     <a href="single.php?id='.$row['id_cours'].'"><h6 class="product_name">'.$row["title"].'</h6></a>
                        <div>'.$sub_row['cat_name'].'</div>';
                        display_satr($row['id_cours']);
                        echo'<div class="product_price">$'.$row["price"].'</div>
                    </div>
              </div>
            </div>
           
            ';
            $i++;
        endwhile;
      
    }

    function display_satr($id){
            include("inc/db.php");
            $get_star=$con->prepare("select * from review_table where id_cour='$id'");
            $get_star->setFetchMode(PDO:: FETCH_ASSOC);
            $get_star->execute();
            $somme=0;
            $nbr_user=0;
            $total=0;
            while($row=$get_star->fetch()){
                $somme=$somme+$row['user_rating'];
                $nbr_user++;
            }

            if($nbr_user!=0){
            $total=$somme/$nbr_user;
            }else{
                $total=0;
            }

            if($total == 0){
                echo '
                <i class="fas fa-star star-light  mr-1 main_star"></i>
                <i class="fas fa-star star-light mr-1 main_star"></i>
                <i class="fas fa-star star-light mr-1 main_star"></i>
                <i class="fas fa-star star-light mr-1 main_star"></i>
                <i class="fas fa-star star-light mr-1 main_star"></i>';
            }else{

                if($total> 0 && $total<=1){
                    echo '
                    <i class="fas fa-star  mr-1 checked"></i>
                    <i class="fas fa-star star-light mr-1 main_star"></i>
                    <i class="fas fa-star star-light mr-1 main_star"></i>
                    <i class="fas fa-star star-light mr-1 main_star"></i>
                    <i class="fas fa-star star-light mr-1 main_star"></i>';
                }else{
                    if($total> 1 && $total<=2){
                        echo '
                        <i class="fas fa-star  mr-1 checked"></i>
                        <i class="fas fa-star  mr-1 checked"></i>
                        <i class="fas fa-star star-light mr-1 "></i>
                        <i class="fas fa-star star-light mr-1 "></i>
                        <i class="fas fa-star star-light mr-1 "></i>';}
                 if($total> 2 && $total<=3){
                            echo '
                            <i class="fas fa-star  mr-1 checked"></i>
                            <i class="fas fa-star  mr-1 checked"></i>
                            <i class="fas fa-star  mr-1 checked"></i>
                            <i class="fas fa-star star-light mr-1 "></i>
                            <i class="fas fa-star star-light mr-1 "></i>';
                    }else{
                       if($total> 3 && $total<=4){
                                echo '
                                <i class="fas fa-star  mr-1 checked"></i>
                                <i class="fas fa-star  mr-1 checked"></i>
                                <i class="fas fa-star  mr-1 checked"></i>
                                <i class="fas fa-star  mr-1 checked"></i>
                                <i class="fas fa-star star-light mr-1 "></i>';
                            }else{
                                if($total> 4 && $total<=5){
                                    echo '
                                    <i class="fas fa-star  mr-1 checked"></i>
                                    <i class="fas fa-star  mr-1 checked"></i>
                                    <i class="fas fa-star  mr-1 checked"></i>
                                    <i class="fas fa-star  mr-1 checked"></i>
                                    <i class="fas fa-star  mr-1 checked"></i>';
                                }

                            }

                        }
               

                }
                
            }
                
        
    }
    function view_best_cour(){
        include("inc/db.php");
        $get_cour=$con->prepare("select * from course");
        $get_cour->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cour->execute();
        while($row=$get_cour->fetch()):
            $id=$row['id_cat'];
            $get_cat=$con->prepare("select cat_name from cat where cat_id='$id'");
            $get_cat->setFetchMode(PDO:: FETCH_ASSOC);
            $get_cat->execute();
            $sub_row=$get_cat->fetch();
            // <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"></div>
            echo '
            <div class="owl-item product_slider_item">
            <div class="product-item">
                <div class="product discount">
                    <div class="product_image">
                       <a href="single.php?id='.$row['id_cours'].'">
                        <img src="images/'.$row["cover"].'" alt=""></a>
                    </div>
                    <div class="favorite favorite_left"></div> 
                    <div class="product_info">
                        <h6 class="product_name"><a href="single.php?id='.$row['id_cours'].'">'.$row["title"].'</a></h6>';
                           display_satr($row['id_cours']);
                        echo'<div class="product_price">'.$row["price"].' DA</div>
                    </div>
                </div>
            </div>
        </div>
            ';
            
        endwhile;

    }
 
     function inscrire_user(){
        include("Admin/inc/db.php");
        if(isset($_POST['inscrire_user'])){

            $nome=$_POST["nome"];
            $prenom=$_POST["prenom"];
            $email=$_POST["email"];
            $password=$_POST["password"];
            $image="defult.png";
            $check=$con->prepare("select * from user where email='$email'");
            $check->setFetchMode(PDO:: FETCH_ASSOC);
            $check->execute();
            $count=$check->rowCount();
       
            if($count==1){
                echo"<script>alert('email exist deja')</script>";
                exit();
       } else{
           if(!empty($nome) && !empty($prenom) &&!empty($email) &&!empty($password)){
            $inscrire_user=$con->prepare("insert into user(nome,prenom,email,password,user_image)values('$nome','$prenom','$email','$password','$image')");
            if($inscrire_user->execute()){
                echo"<script>alert('Compte créé avec succès')</script>";
                echo'<script> location.href ="se_connecter.php";</script>';
                exit();
            }
           }else{
               exit();
           } 
       }
        }
       
    }
  
    function user_info(){
        include("inc/db.php");
        $id_user=$_SESSION['id_user'];
        $get_user=$con->prepare("select * from user where id_user='$id_user'");
        $get_user->setFetchMode(PDO:: FETCH_ASSOC);
        $get_user->execute();
        $row=$get_user->fetch();
        echo'
        <form method="post" class="needs-validation" novalidate>
       
         
        <hr class="border-light m-0">

        <div class="card-body">
            <div class="form-group">
                <label class="form-label">Nom</label>
                <input name="nome" type="text" class="form-control mb-1" value='.$row['nome'].' required>
                <div class="invalid-feedback">Champ obligatoire</div>

            </div>
          <div class="form-group">
               <label class="form-label">Prenom</label>
               <input name="prenom"type="text" class="form-control" value='.$row['prenom'].' required>
               <div class="invalid-feedback">Champ obligatoire</div>

          </div>
          <div class="form-group">
               <label class="form-label">E mail</label>
              <input name="email" type="text" class="form-control mb-1" value="'.$row['email'].'" required/>
              <div class="invalid-feedback">Champ obligatoire</div>

          </div>
       </div>
       <div id="text-r" class="text-right mt-3 mr-10">
            <button name="save" type="submit" class="btn btn-primary">Enregistrer</button>
      </div>
</form>
  
';

if(isset($_POST['save'])){
   
    $nome=$_POST['nome'];
    $prenom=$_POST['prenom'];
    $email=$_POST['email'];
    $check=$con->prepare("select email from user where id_user !='$id_user' and email ='$email'");
    $check->setFetchMode(PDO:: FETCH_ASSOC);
    $check->execute();
    $count=$check->rowCount();
    if($count == 0){
       $up=$con->prepare("update user set nome='$nome' ,prenom='$prenom' ,email='$email' where id_user='$id_user'");
       $up->execute();
    }else{
        echo"<script>alert('Email exist')</script>";
    }

    echo'<script> location.href ="profile.php?profile";</script>';

}
    }
    function reset_password(){
        include("inc/db.php");

   
  if(isset($_POST['reset_password'])){
    $id_user=$_SESSION['id_user'];
    $actuel_password=$_POST['actuel_password'];
    $nvu_password=$_POST['nvu_password'];
    $cnv_password=$_POST['cnv_password'];
    
    $get_password=$con->prepare("select password from user where id_user='$id_user'");
    $get_password->setFetchMode(PDO:: FETCH_ASSOC);
    $get_password->execute();

    $row=$get_password->fetch();
    $password=$row['password'];

    if($password == $actuel_password){
        if($nvu_password == $cnv_password){
               $up=$con->prepare("update user set password='$cnv_password' where id_user ='$id_user'");
            if($up->execute()){
                echo"<script>alert('Modifié')</script>";
                echo'<script> location.href ="profile.php?password";</script>';
            }else{
                echo"<script>alert('Non Modifié ...')</script>";
            }
        }else{
                echo"<script>alert('Non Modifié ...')</script>";
        }
    }else{
               echo"<script>alert('Non Modifié ...')</script>";
    }
   }
}


    function view_option_cat(){
        include("Admin/inc/db.php");
        $get_cat=$con->prepare("select * from cat");
        $get_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cat->execute();
        $i=0;
        while($row=$get_cat->fetch()):
                echo '<option value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>';
        endwhile;
    }
    function view_option_sub_cat(){
        include("Admin/inc/db.php");
        $get_cat=$con->prepare("select * from sub_cat");
        $get_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cat->execute();
        $i=0;
        while($row=$get_cat->fetch()):
                echo '<option value="'.$row['sub_cat_id'].'">'.$row['sub_cat_name'].'</option>';
        endwhile;
    }

    function ajouter_cours(){
        include("inc/db.php");
        if(isset($_POST['confirmes'])){
             $id_user=$_SESSION['id_user'];

             $get_ens=$con->prepare("select id_enseignant  from enseignant where id_user='$id_user'");
             $get_ens->setFetchMode(PDO:: FETCH_ASSOC);
             $get_ens->execute();
             $row_ens=$get_ens->fetch();

             $id_ens=$row_ens['id_enseignant'];

             $title=$_POST['title'];
             $cat=$_POST['cat'];
             $sub_cat=$_POST['sub_cat'];
             $mini_des=$_POST['mini_des'];
             $description=$_POST['description'];
             $price=$_POST['price'];
             $price_r=$_POST['price_r'];
            // $video_intro=$_FILES['video_intro'];
        
             $date=date("Y.m.d");
             //*********************Video************************* */

             $video=$_FILES['video_intro'];
             $videoName = $_FILES['video_intro']['name'];
             $videoTmpName = $_FILES['video_intro']['tmp_name'];
             $videoExt =explode('.', $videoName);
             $videoActualExt =strtolower(end($videoExt));
             $allowedvideo =array('mp4');
             $videoNameNew = uniqid('',true).".".$videoActualExt;
             $videoDestination = 'images/'.$videoNameNew;
             move_uploaded_file($videoTmpName , $videoDestination);
                        
             /***************************************************** */
             $file=$_FILES['cover'];
             $fileName = $_FILES['cover']['name'];
             $fileTmpName = $_FILES['cover']['tmp_name'];
             $fileExt =explode('.', $fileName);
             $fileActualExt =strtolower(end($fileExt));
             $allowed =array('jpg', 'jpeg', 'png');
             $fileNameNew = uniqid('',true).".".$fileActualExt;
             $fileDestination = 'images/'.$fileNameNew;
             move_uploaded_file($fileTmpName , $fileDestination);
                          
             $ajouter_cours=$con->prepare("insert into course(title,short_description,description,price,cover,date_cours,video_intro,id_user,id_cat,id_sub_cat,price_r)values('$title','$mini_des','$description','$price','$fileNameNew','$date','$videoNameNew','$id_ens','$cat','$sub_cat','$price_r') ");
             
             if($ajouter_cours->execute()){
                  echo"<script>alert('Cours ajouté avec succès')</script>";
                  echo'<script> location.href ="cours.php";</script>';
             }
        }
    }


     function afficher_mes_cours(){
        include("inc/db.php");
        $id_user=$_SESSION['id_user'];
        
        $get_ens=$con->prepare("select id_enseignant  from enseignant where id_user='$id_user'");
        $get_ens->setFetchMode(PDO:: FETCH_ASSOC);
        $get_ens->execute();
        $row_ens=$get_ens->fetch();
        $id_ens=$row_ens['id_enseignant'];

        $get_cour=$con->prepare("select * from course where id_user='$id_ens'");
        $get_cour->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cour->execute();
        $i=1;
        while($row=$get_cour->fetch()){
            $cat_id=$row['id_cat'];
            $get_c=$con->prepare("select * from cat where cat_id='$cat_id'");
            $get_c->setFetchMode(PDO:: FETCH_ASSOC);
            $get_c->execute();
            $row_c=$get_c->fetch();
            echo '<tbody>
            <tr><form method="post">
              <td scope="row">'.$i++.'</td>
              <td><a href="course_manager.php?course_manager&id_cour='.$row['id_cours'].'">'.$row['title'].'</a></td>
              <td>'.$row['price'].'$</td>
              <td>'.$row_c['cat_name'].'</td>
              <td style="font-size:16px; cursor: pointer; color:#41f1b5;" data-toggle="modal" data-target="#coure'.$row['id_cours'].'"><i class="fa-regular fa-pen-to-square"></i></td>
              <td ><button name="delet_cour" type="submit" style="font-size:16px; cursor: pointer; color:#ff7782; border: none;background: none;"><i class="fa-regular fa-trash-can"></i></button></td>
              <input type="hidden" name="id_cours" value="'.$row['id_cours'].'"/>
              </form></tr>
          </tbody>';

          echo'<div class="modal fade" id="coure'.$row['id_cours'].'" tabindex="-1" role="dialog" aria-labelledby="quizeLabel" aria-hidden="true">
          <div class="modal-dialog" style="max-width:58%;" role="document" >
            <div class="modal-content">
              <div class="modal-header" >
                <h5 class="modal-title" id="quizeLabel">Ajouter Quize</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
            ';
              /************************************************************************************************************ */
                 echo'
        <form method="post" enctype="multipart/form-data"    class="needs-validation" novalidate>   
             <div>
                 <ul class="nav nav-tabs">
                   <li class="nav-item">
                     <a class="nav-link active" data-toggle="tab" href="#editbasique'.$row['id_cours'].'"><i class="fa-solid fa-pencil"></i>&nbsp;&nbsp;&nbsp;Basique</a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#cat'.$row['id_cours'].'"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Langage et  Niveau</a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#medias'.$row['id_cours'].'"><i class="fa-solid fa-video"></i>&nbsp;&nbsp;&nbsp;Médias</a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#tarification'.$row['id_cours'].'"><i class="fa-solid fa-dollar-sign"></i>&nbsp;&nbsp;&nbsp;Prix</a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#finir'.$row['id_cours'].'"><i class="fa-solid fa-check-double"></i>&nbsp;&nbsp;&nbsp;Finir</a>
                   </li>
                   
                 </ul>
                 <div class="tab-content">
                     <div class="tab-pane container active" id="editbasique'.$row['id_cours'].'">  
                            <label for="recipient-name" class="col-form-label">Titre:</label>    
                            <input class="form-control" type="text"  name="edit_title"  value="'.$row['title'].'" required/>
                            <label for="recipient-name" class="col-form-label">Mini Descrption:</label>
                            <textarea  class="form-control" name="edit_mini_des" id="mini_des"  cols="30" rows="10" required>'.$row['short_description'].'</textarea>
                            <label for="recipient-name" class="col-form-label">Descreption:</label>
                            <textarea style="height:130px;" class="form-control" name="edit_description" id="description"  cols="30" rows="10" required>'.$row['description'].'</textarea>
                           ';
                          
                             echo'
                            </div>
                      <div class="tab-pane container fade" id="medias'.$row['id_cours'].'">
                      <p>Video Introsction</p>
                           <video class="vediocour"  width="320" height="150" controls="controls" >
                                  <source src="images/'.$row['video_intro'].'"  type="video/mp4" > 
                           </video><br><br>

                            <input type="file" name="edit_video_intro" accept=".mp4,.3gp,.wmv.mkv,.flv" id="videoUpload" class="form-control" />
                            <img  width = auto height = 150 src="images/'.$row['cover'].'"  class="file-ip-1-preview"><br><br>
                            <input type="file" name="edit_cover" class="form-control" id="file-ip-1" accept="image/*" onchange="showPreview(event);"/>
                     </div> 
             <div class="tab-pane container fade" id="tarification'.$row['id_cours'].'">
                  <p>Prix ​​du cours ($)</p>
                  <input type="number" class="form-control" id="price" name="edit_price" placeholder="Enter Course Course Price" min="0"  value="'.$row['price'].'" required>
                  <p>Prix ​​réduit ($)</p>
                  <input type="number" class="form-control" id="price" name="edit_price_r" placeholder="Enter Course Course Price" min="0"  value="'.$row['price_r'].'" required> 
             </div>

             <div class="tab-pane container fade" id="cat'.$row['id_cours'].'">
             <label for="recipient-name" class="col-form-label">Langage:</label><br><br>
             <select name="cat_op_edit" class="form-control" id="recipient-name"  name="" id="" required>';
             $get_cat=$con->prepare("select * from cat");
             $get_cat->setFetchMode(PDO:: FETCH_ASSOC);
             $get_cat->execute();
            
             while($s_row=$get_cat->fetch()):
                     echo '<option ';
                        if($s_row['cat_id'] == $row['id_cat']){
                            echo 'selected';
                        }
                     echo' value="'.$s_row['cat_id'].'">'.$s_row['cat_name'].'</option>';
             endwhile;
             echo'</select>
             <label for="recipient-name" class="col-form-label">Niveau:</label><br><br>
             <select id="cars" name="scat_op_edit" class="form-control" required>';
             $get_sub_cat=$con->prepare("select * from sub_cat");
             $get_sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
             $get_sub_cat->execute();
            
             while($sb_row=$get_sub_cat->fetch()):
                     echo '<option ';
                        if($sb_row['sub_cat_id'] == $row['id_sub_cat']){
                            echo 'selected';
                        }
                     echo' value="'.$sb_row['sub_cat_id'].'">'.$sb_row['sub_cat_name'].'</option>';
             endwhile;
              echo'</select>
             </div>

             <div class="tab-pane container fade" id="finir'.$row['id_cours'].'">
                  <p>Merci! Vous n êtes qu à un clic</p>
             <div>
                 <img src="images/finir.PNG" alt="">
                 <input type="hidden" name="id_cours" value="'.$row['id_cours'].'"/>
                 <button class="btn btn-primary  text-uppercase fw-bold" name="confirmes_edit">confirmés</button>
            </div>
            </div>
            </div>
            </div>
        </form>';
        echo'
        
        </div>
        </div>
        </div>
       </div>';
        }
     }

     function edit_cour(){

        include("inc/db.php");
        
        if(isset($_POST['confirmes_edit'])){
            $id_cour=$_POST['id_cours'];
            $title=$_POST['edit_title'];
            $mini_des=$_POST['edit_mini_des'];
            $description=$_POST['edit_description'];
            $cat=$_POST['cat_op_edit'];
            $sub_cat=$_POST['scat_op_edit'];
            $price=$_POST['edit_price'];
            $price_r=$_POST['edit_price_r'];

           //*************************Video**********************************/

            $video=$_FILES['edit_video_intro'];
            $videoName = $_FILES['edit_video_intro']['name'];
            $videoTmpName = $_FILES['edit_video_intro']['tmp_name'];
            $videoExt =explode('.', $videoName);
            $videoActualExt =strtolower(end($videoExt));
            $allowedvideo =array('mp4');
            $videoNameNew = uniqid('',true).".".$videoActualExt;
            $videoDestination = 'images/'.$videoNameNew;
            move_uploaded_file($videoTmpName , $videoDestination);
                       
            /***************************************************** */
            $file=$_FILES['edit_cover'];
            $fileName = $_FILES['edit_cover']['name'];
            $fileTmpName = $_FILES['edit_cover']['tmp_name'];
            $fileExt =explode('.', $fileName);
            $fileActualExt =strtolower(end($fileExt));
            $allowed =array('jpg', 'jpeg', 'png');
            $fileNameNew = uniqid('',true).".".$fileActualExt;
            $fileDestination = 'images/'.$fileNameNew;
            move_uploaded_file($fileTmpName , $fileDestination);
            
            if($_FILES['edit_video_intro']['size']==0 && $_FILES['edit_cover']['size']==0){
                $up=$con->prepare("update course set  title='$title',short_description='$mini_des',description='$description',price='$price',price_r='$price_r',
                id_cat='$cat',id_sub_cat='$sub_cat' where id_cours='$id_cour'");

            }elseif($_FILES['edit_video_intro']['size'] == 0){
                $up=$con->prepare("update course set  title='$title',short_description='$mini_des',description='$description',price='$price',price_r='$price_r',
                id_cat='$cat',id_sub_cat='$sub_cat',cover='$fileNameNew' where id_cours='$id_cour'");

            }elseif($_FILES['edit_cover']['size'] == 0){
                $up=$con->prepare("update course set  title='$title',short_description='$mini_des',description='$description',price='$price',price_r='$price_r',
                id_cat='$cat',id_sub_cat='$sub_cat',video_intro='$videoNameNew' where id_cours='$id_cour'");
            }else{
                $up=$con->prepare("update course set  title='$title',short_description='$mini_des',description='$description',price='$price',price_r='$price_r',
                id_cat='$cat',id_sub_cat='$sub_cat',video_intro='$videoNameNew',cover='$fileNameNew' where id_cours='$id_cour'");
            }
            if($up->execute()){
                echo"<script>alert('Le cours a été modifié avec succès')</script>";
            }
                echo'<script> location.href ="cours.php";</script>';
        }
     }
     function delet_cour(){
          include("inc/db.php");
          if(isset($_POST['delet_cour'])){
            $id_cour=$_POST['id_cours'];
            $delet=$con->prepare("delete from course where id_cours  ='$id_cour'");
            
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
             
            if($delet->execute()){
               echo"<script>alert('Le cours a été supprimé avec succès.')</script>";
            }
               echo'<script> location.href ="cours.php";</script>';
          }
     }
    function ajouter_section(){
        include("inc/db.php");
        if(isset($_GET['id_cour'])){
            $id=$_GET['id_cour'];
        }
        if(isset($_POST['ajouter_section'])){
            $title=$_POST['section'];
            $ajouter_section=$con->prepare("insert into section(title,id_cour)values('$title','$id')");
            $ajouter_section->execute();
            echo'<script> location.href ="course_manager.php?course_manager&id_cour='.$id.'";</script>';
        }
    }
     /*
    function afficher_section(){
        include("inc/db.php");
        $get_section=$con->prepare("select * from section");
        $get_section->setFetchMode(PDO:: FETCH_ASSOC);
        $get_section->execute();
        $i=1;
       while($row=$get_section->fetch()){
        echo' 
       
        <div class="afficher_section">
           <div><h5>Section '.$i++.':</h5></div>
           <div><p>'.$row['title'].'</p></div>
             <div id="right"><i class="fa-regular fa-trash-can"></i></div> 
             <div id="right_too"><i class="fa-regular fa-pen-to-square"></i></div>';
                   afficher_lecon($row['id_section']);
       echo '</div>';
       }  
    }*/
    function afficher_section(){
        include("inc/db.php");
        if(isset($_GET['id_cour'])){
            $id=$_GET['id_cour'];
        }
        $get_section=$con->prepare("select * from section  where id_cour='$id'");
        $get_section->setFetchMode(PDO:: FETCH_ASSOC);
        $get_section->execute();
        $i=1;
      
       while($row=$get_section->fetch()){
        
        echo '<form  method="post" enctype="multipart/form-data" style="margin-right: 1%;">
                       <div id="right"><button name="delet_section" type="submit" style="font-size:16px; cursor: pointer; color:#ff7782; border: none;background: none;"><i class="fa-regular fa-trash-can"></i></button></div> 
                       <div id="right_too"style="font-size:16px; cursor: pointer;"  data-toggle="modal" data-target="#section'.$row['id_section'].'"><i class="fa-regular fa-pen-to-square"></i></div>
                       <input type="hidden" name="id_section" value="'.$row['id_section'].'"/>
              </form>
            <div  class="accordion" style="width:50%;  "><b>Section '.$i++.':</b>&nbsp;&nbsp;'.$row['title'].'
            </div>
            <div class="panel">
            <div class="content">';
                  afficher_lecon($row['id_section']);
                  afficher_quize($row['id_section']);
           echo' </div></div><hr>
        ';

        echo '<div class="modal fade" id="section'.$row['id_section'].'" tabindex="-1" role="dialog" aria-labelledby="quizeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="quizeLabel">Ajouter Quize</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form  method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Title:</label>
                  <input type="text" name="title" class="form-control" id="recipient-name" value="'.$row['title'].'" required> 
                  <div class="invalid-feedback">Champ obligatoire</div>
                </div>
                <input type="hidden" name="id_section" value="'.$row['id_section'].'"/>
                <button name="edit_section" type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            </div>
          </div>
        </div>
      </div> 
      ';
       }  
}
    function delet_section(){
        include("inc/db.php");
        if(isset($_GET['id_cour'])){
            $id=$_GET['id_cour'];
        
         if(isset($_POST['delet_section'])){
              $id_section=$_POST['id_section'];
              $delet=$con->prepare("delete from section where id_section ='$id_section'");
           if($delet->execute()){
              echo"<script>alert('La section a été supprimée avec succès.')</script>";
           }
              echo'<script> location.href ="course_manager.php?course_manager&id_cour='.$id.'";</script>';
        }
    } 
}
    function edit_section(){
        include("inc/db.php");
        if(isset($_GET['id_cour'])){
            $id=$_GET['id_cour'];
        
        if(isset($_POST['edit_section'])){
           $id_section=$_POST['id_section'];
           $title=$_POST['title'];
           $up=$con->prepare("update section set title='$title' where id_section ='$id_section'");
            
           if($up->execute()){
            echo"<script>alert('La section a été modifié avec succès.')</script>";
           }
             echo'<script> location.href ="course_manager.php?course_manager&id_cour='.$id.'";</script>';
        }
    } 
}

    function view_option_section(){
        include("inc/db.php");
        
        if(isset($_GET['id_cour'])){
            $id=$_GET['id_cour'];
        }
        $get_cat=$con->prepare("select * from section where id_cour='$id'");
        $get_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cat->execute();
        $i=0;
        while($row=$get_cat->fetch()):
                echo '<option value="'.$row['id_section'].'">'.$row['title'].'</option>';
        endwhile;
    }

    function ajouter_lecon(){
        include("inc/db.php");
        if(isset($_GET['id_cour'])){
            $id_course=$_GET['id_cour'];
        
        if(isset($_POST['ajouter_lecon'])){
            $title=$_POST['lecon'];
            $id_section=$_POST['op_section'];
            $type=$_POST['op_type'];
            $date=date("Y.m.d");
            /******************************************************/
            $file=$_FILES['file_lecon'];
            $fileName = $_FILES['file_lecon']['name'];
            $fileTmpName = $_FILES['file_lecon']['tmp_name'];
            $fileExt =explode('.', $fileName);
            $fileActualExt =strtolower(end($fileExt));
            $allowedfile =array('');
            $fileNameNew = uniqid('',true).".".$fileActualExt;
            $fileDestination = 'images/'.$fileNameNew;
            move_uploaded_file($fileTmpName , $fileDestination);
            /*******************************************************/
            $ajouter_lecon=$con->prepare("insert into lecon(id_course,id_section,title,type,file,date)values('$id_course','$id_section','$title','$type','$fileNameNew','$date')");
            
            if($ajouter_lecon->execute()){
                echo"<script>alert('Leçon ajoutée avec succès.')</script>";
            }
                echo'<script> location.href ="course_manager.php?course_manager&id_cour='.$id_course.'";</script>';
        }
    }
    }
    
    function afficher_lecon($id){
        include("inc/db.php");
        if(isset($_GET['id_cour'])){
            $id_cour=$_GET['id_cour'];
        }
        $get_lecon=$con->prepare("select * from lecon where id_section='$id'");
        $get_lecon->setFetchMode(PDO:: FETCH_ASSOC);
        $get_lecon->execute();
        $i=1;
       while($row=$get_lecon->fetch()){
        $type=$row['type'];
        if($type == 1){
              $icon='<i class="fa-regular fa-circle-play"></i>';
        }else{
            if($type == 2){
               $icon='<i class="fa-regular fa-file-pdf"></i>';
            }else{
                if( $type == 3){
                    $icon='<i class="fa-regular fa-image"></i>';
                }else{
                    if($type == 4){
                        $icon='<i class="fa-regular fa-file-lines"></i>';  
                    }
                }
            }
        }
        echo'  <form  method="post" enctype="multipart/form-data">
        <ul class="afficher_lecon">
       
             <div>&nbsp;&nbsp;'.$icon.'&nbsp;&nbsp;</div>
             <div><h6>Lecon '.$i++.':&nbsp;&nbsp;</h6></div>
             <div data-toggle="modal" data-target="#lecon'.$row['id'].'">'.$row['title'].'</div>
             <div id="right"><button name="delet_lecon" type="submit" style="font-size:16px; cursor: pointer; color:#ff7782; border: none;background: none;"><i class="fa-regular fa-trash-can"></i></button></div> 
             <input type="hidden" name="id_lecon" value="'.$row['id'].'"/>
             <div id="right_too" style="font-size:16px; cursor: pointer;"  data-toggle="modal" data-target="#lecon'.$row['id'].'"><i class="fa-regular fa-pen-to-square"></i></div>
       
        </ul>  </form>';

        echo '<div class="modal fade" id="lecon'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="leconLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="leconLabel">Ajouter Leçon</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form  method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
              
                  <label for="recipient-name" class="col-form-label">Title:</label>
                  <input type="text" name="elecon" class="form-control" id="recipient-name" value="'.$row['title'].'" required>
                  <div class="invalid-feedback">Champ obligatoire</div>
                  <label for="recipient-name" class="col-form-label">Section:</label><br>
                   <select name="eop_section" class="form-control" id="recipient-name"  name="" id="">';
                   $get_cat=$con->prepare("select * from section where id_cour='$id_cour'");
                   $get_cat->setFetchMode(PDO:: FETCH_ASSOC);
                   $get_cat->execute();
                  
                   while($s_row=$get_cat->fetch()):
                           echo '<option ';
                              if($s_row['id_section'] == $row['id_section']){
                                  echo 'selected';
                              }
                           echo' value="'.$s_row['id_section'].'">'.$s_row['title'].'</option>';
                   endwhile;
                   echo'</select>
              
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Type:</label><br>
                   <select name="eop_type" class="form-control" id="recipient-name"  name="" id="">
                       <option value="1"';
                         if($row['type']=="1"){
                             echo'selected';
                         }
                        echo'>Video</option>
                       <option value="2"';
                       if($row['type']=="2"){
                        echo'selected';
                    }
                       echo'>Pdf file</option>
                       <option value="3"';
                       if($row['type']=="3"){
                        echo'selected';
                    }
                       echo'>Image</option>
                       <option value="4"';
                       if($row['type']=="4"){
                        echo'selected';
                    }
                       echo'>Docemment</option>
                   </select>
                </div>
               <div class="form-group">';
               if($row['type']=="1"){
                 echo'<video class="editelecon" width="70%" height="140px" controls="controls">
                         <source src="images/'.$row['file'].'" type="video/mp4"> 
                      </video>';

                }elseif($row['type']=="2" || $row['type']=="4"){
                    echo'<iframe src="images/'.$row['file'].'" width="70%" height="140px">
                         </iframe>';
                }elseif($row['type']=="3"){
                    echo'<img src="images/'.$row['file'].'" width="70%" height="140px">
                         </img>';
                }
                 echo'<input type="file" name="efile_lecon" accept="" class="form-control"/>
                </div>
                <input type="hidden" name="id_lecon" value="'.$row['id'].'"/>
                <button name="edit_lecon" type="submit" class="btn btn-primary">Edit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      ';
       }  
    }
    function ajouter_panier($id){
        include("inc/db.php");
            $id_user=$_SESSION['id_user'];
            $check=$con->prepare("select * from panier where id_cour='$id' and id_user=' $id_user'");
            $check->setFetchMode(PDO:: FETCH_ASSOC);
            $check->execute();
            $count=$check->rowCount();
            if($count==0){
                $ajouter_panier=$con->prepare("insert into panier(id_user,id_cour)values('$id_user','$id')");
                $ajouter_panier->execute();
            } 
            echo'<script>
                location.reload();
                return false;
              </script>';
    }
    function edit_lecon(){
        include("inc/db.php");
        if(isset($_GET['id_cour'])){
            $id=$_GET['id_cour'];
        
        if(isset($_POST['edit_lecon'])){

            $id_lecon=$_POST['id_lecon'];
            $title=$_POST['elecon'];
            $id_section=$_POST['eop_section'];
            $type=$_POST['eop_type'];
            $date=date("Y.m.d");
            /******************************************************/
            
            $file=$_FILES['efile_lecon'];
            $fileName = $_FILES['efile_lecon']['name'];
            $fileTmpName = $_FILES['efile_lecon']['tmp_name'];
            $fileExt =explode('.', $fileName);
            $fileActualExt =strtolower(end($fileExt));
            $allowedfile =array('');
            $fileNameNew = uniqid('',true).".".$fileActualExt;
            $fileDestination = 'images/'.$fileNameNew;
            move_uploaded_file($fileTmpName , $fileDestination);
            /*******************************************************/
          
            if($_FILES['efile_lecon']['size']==0){
                $ajouter_lecon=$con->prepare("update lecon set id_course='$id',id_section='$id_section',title='$title',type='$type',date='$date'  where id='$id_lecon'");
            }elseif($_FILES['efile_lecon']['size'] != 0){
                $ajouter_lecon=$con->prepare("update lecon set id_course='$id',id_section='$id_section',title='$title',type='$type',file='$fileNameNew',date='$date'  where id='$id_lecon'");
            }
            if($ajouter_lecon->execute()){
                echo"<script>alert('Leçon modifié avec succès.')</script>";
            }
            
            echo'<script> location.href ="course_manager.php?course_manager&id_cour='.$id.'";</script>';
        }
    }
    }
   function delet_lecon(){
    if(isset($_GET['id_cour'])){
        $id=$_GET['id_cour'];
    }
       include("inc/db.php");
       if(isset($_POST['delet_lecon'])){
             $id_lecon=$_POST['id_lecon'];
             $delet=$con->prepare("delete from lecon where id ='$id_lecon'");
             if($delet->execute()){
                echo"<script>alert('Leçon supprimer avec succès.')</script>";
             }
                echo'<script> location.href ="course_manager.php?course_manager&id_cour='.$id.'";</script>';
       }

   }
    function display_user(){
        include("inc/db.php");
        $get_user=$con->prepare("select * from 	user");
        $get_user->setFetchMode(PDO:: FETCH_ASSOC);
        $get_user->execute();
        while($row=$get_user->fetch()){
                    echo '<li class="contact"><form method="post"><a href="profile.php?msg&id='.$row['id_user'].'">
					<div class="wrap">
                        <img width =60 height =60 src="images/'.$row['user_image'].'" alt="">
						<div class="meta">
							<p class="name">'.$row['nome'].'</p>
						</div>
					</div>
                    </a></form></li>';
        }
    }

    function  get_chat(){
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            echo "<h2>".$id."</h2>";  
        }
    }

    function display_msg(){
        include("inc/db.php");
        $id_surc=$_SESSION['id_user'];
        if(isset($_GET['id'])){
            $id_des=$_GET['id'];

        $get_sent=$con->prepare("select * from 	messages");
        $get_sent->setFetchMode(PDO:: FETCH_ASSOC);
        $get_sent->execute();

        /*$get_replies=$con->prepare("select * from 	messages where id_surce='$id_des' and id_dest='$id_surc'");
        $get_replies->setFetchMode(PDO:: FETCH_ASSOC);
        $get_replies->execute();*/
  
        while($row=$get_sent->fetch()){
            if($row['id_surce'] ==$id_surc && $row['id_dest']==$id_des ){
                echo '<li class="sent">
                <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                <p>'.$row['msg'].'</p>
            </li>';
            }else{
                if($row['id_surce'] ==$id_des && $row['id_dest']==$id_surc){
                    echo' <li class="replies">
                <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                <p>'.$row['msg'].'</p>
              </li>';
            
                }
            }

        }
   
    }else{
        echo '';
    }
    }

    function demande_enseignement(){
        include("inc/db.php");
        $id_user=$_SESSION['id_user'];
        if(isset($_POST['demande_enseignement'])){
            $niveau_acad=$_POST['niveau_acad'];
            $lang=$_POST['lang'];
            $level=$_POST['level'];

             $file=$_FILES['certificat'];
             $fileName = $_FILES['certificat']['name'];
             $fileTmpName = $_FILES['certificat']['tmp_name'];
             $fileExt =explode('.', $fileName);
             $fileActualExt =strtolower(end($fileExt));
             $allowed =array('pdf');
             $fileNameNew = uniqid('',true).".".$fileActualExt;
             $fileDestination = 'images/'.$fileNameNew;
             move_uploaded_file($fileTmpName , $fileDestination);
              
             $demande_enseignement=$con->prepare("insert into demande_enseignement(id_user,niveau_acad,niveau,lang,file)values('$id_user','$niveau_acad','$level','$lang','$fileNameNew')");
            
             if( $demande_enseignement->execute()){
                echo"<script>alert('Demande envoyée...')</script>";
             }
          
        }
    } 


    function ajouter_quize(){
        include("inc/db.php");
        if(isset($_GET['id_cour'])){
            $id=$_GET['id_cour'];
        }
        if(isset($_POST['ajouter_quize'])){
            $title_quize=$_POST['title_quize'];
            $id_section=$_POST['section_quize'];
            $ajouter_quize=$con->prepare("insert into quize(id_section,titre)values('$id_section','$title_quize')");
            
            if($ajouter_quize->execute()){
                echo"<script>alert('Quiz ajouté avec succès.')</script>";
                echo'<script> location.href ="course_manager.php?course_manager&id_cour='.$id.'";</script>';

            }
        }
    }

    function afficher_quize($id){
        include("inc/db.php");
      
        if(isset($_GET['id_cour'])){
            $id_cour=$_GET['id_cour'];
        }
        $get_quize=$con->prepare("select * from quize where id_section='$id'");
        $get_quize->setFetchMode(PDO:: FETCH_ASSOC);
        $get_quize->execute();
        
        $i=1; 
        
       while($row=$get_quize->fetch()){
        echo' <form  method="post" enctype="multipart/form-data" >
        <ul class="afficher_lecon">
             
             <div>&nbsp;&nbsp;<i class="fa-solid fa-question"></i> &nbsp;&nbsp;</div>
             <div><h6>Quize '.$i++.':&nbsp;&nbsp;</h6></div>
             <div><a href="course_manager.php?edit_quiz='.$row['id_quize'].'">'.$row['titre'].'</a></div>
             <div id="right"><button name="delet_quiz" type="submit" style="font-size:16px; cursor: pointer; color:#ff7782; border: none;background: none;"><i class="fa-regular fa-trash-can"></i></button></div> 
             <div id="right_too" data-toggle="modal" data-target="#quiz'.$row['id_quize'].'" style="font-size:16px; cursor: pointer;"><i class="fa-regular fa-pen-to-square"></i></div>
             <input type="hidden" name="id_quize" value="'.$row['id_quize'].'"/>
             </ul></form> ';

        echo'<div class="modal fade" id="quiz'.$row['id_quize'].'" tabindex="-1" role="dialog" aria-labelledby="quizeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="quizeLabel">Ajouter Quize</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form  method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">Title:</label>
                <input type="text" name="quiz_titre" class="form-control" id="recipient-name" value="'.$row['titre'].'" required>
                <div class="invalid-feedback">Champ obligatoire</div>

                ';

                echo'<label for="recipient-name" class="col-form-label">Section:</label><br>
                <select name="q_section" class="form-control" id="recipient-name"  name="" id="">';
                $get_cat=$con->prepare("select * from section where id_cour='$id_cour'");
                $get_cat->setFetchMode(PDO:: FETCH_ASSOC);
                $get_cat->execute();
               
                while($s_row=$get_cat->fetch()):
                        echo '<option ';
                           if($s_row['id_section'] == $row['id_section']){
                               echo 'selected';
                           }
                        echo' value="'.$s_row['id_section'].'">'.$s_row['title'].'</option>';
                endwhile;

                  echo'</select>';
                  echo' 
                </div>
                <input type="hidden" name="id_quize" value="'.$row['id_quize'].'"/>
                <button name="edit_quiz" type="submit" class="btn btn-primary">Edit</button>
            </form>
            </div>
          </div>
        </div>
      </div> ';
       }  
    }

    function quize_edit(){
        include("inc/db.php");
        if(isset($_GET['id_cour'])){
            $id=$_GET['id_cour'];
        }
        if(isset($_POST['edit_quiz'])){
            $id_quiz=$_POST['id_quize'];
            $titre=$_POST['quiz_titre'];
            $id_section=$_POST['q_section'];
            $up=$con->prepare("update quize set id_section='$id_section' , titre='$titre' where id_quize='$id_quiz'");
            if($up->execute()){
                echo"<script>alert('quiz modifié avec succès.')</script>";
            }
                echo'<script> location.href ="course_manager.php?course_manager&id_cour='.$id.'";</script>';
        }

    }

    function delet_quiz(){
        include("inc/db.php");
        if(isset($_GET['id_cour'])){
            $id=$_GET['id_cour'];
        }
        if(isset($_POST['delet_quiz'])){
            $id_quiz=$_POST['id_quize'];
            $delet=$con->prepare("delete from quize where id_quize ='$id_quiz'");

            $get_question=$con->prepare("select * from question where id_quize='$id_quiz'");
            $get_question->setFetchMode(PDO:: FETCH_ASSOC);
            $get_question->execute();

            while($row=$get_question->fetch()){
                  $id_qestion=$row['id_question'];
                  $delet_q=$con->prepare("delete from question where id_question ='$id_qestion'");
                  $delet_q->execute();
            }
            if($delet->execute()){
               echo"<script>alert('quiz supprimé avec succès.')</script>";
            }
               echo'<script> location.href ="course_manager.php?course_manager&id_cour='.$id.'";</script>';
        }
    }
    //<option selected disabled>Choose one</option>
    function view_option_quize(){
        include("Admin/inc/db.php");
        if(isset($_GET['id_cour'])){
            $id=$_GET['id_cour'];
        }
        $get_section=$con->prepare("select * from section where id_cour='$id'");
        $get_section->setFetchMode(PDO:: FETCH_ASSOC);
        $get_section->execute();
        
        while($row=$get_section->fetch()):
            $id_section=$row['id_section'];
            echo'<option selected disabled>'.$row['title'].'</option>';
             
            $get_quize=$con->prepare("select * from quize where id_section='$id_section'");
            $get_quize->setFetchMode(PDO:: FETCH_ASSOC);
            $get_quize->execute();
            while($sub_row=$get_quize->fetch()):
                 echo '<option style="color:#007bff;" value="'.$sub_row['id_quize'].'">'.$sub_row['titre'].'</option>';
            endwhile;
        endwhile;
    }

    function add_question(){
        include("inc/db.php");
        if(isset($_GET['edit_quiz'])){
        if(isset($_POST['add_question'])){
           $id_quize=$_GET['edit_quiz'];
           $question=$_POST['question'];
           $reponse1=$_POST['add_reponse1'];
           $reponse2=$_POST['add_reponse2'];
           $reponse3=$_POST['add_reponse3'];
           $reponse4=$_POST['add_reponse4'];

           $expl=$_POST['expl'];

           $reponse=$_POST['reponse'];
           if($reponse==1){
               $bonne_reponse= $reponse1;
           }elseif($reponse==2){
               $bonne_reponse= $reponse2;
           }elseif($reponse==3){
               $bonne_reponse= $reponse3;
           }else{
               $bonne_reponse= $reponse4;
           } 
          
            $file=$_FILES['audio'];
            $fileName = $_FILES['audio']['name'];
            $fileTmpName = $_FILES['audio']['tmp_name'];
            $fileExt =explode('.', $fileName);
            $fileActualExt =strtolower(end($fileExt));
            $allowedfile =array('');
            $fileNameNew = uniqid('',true).".".$fileActualExt;
            $fileDestination = 'images/'.$fileNameNew;
            move_uploaded_file($fileTmpName , $fileDestination);

            $ajouter_question=$con->prepare("insert into question(id_quize,question,reponse1,reponse2,reponse3,reponse4,bonne_reponse,accessoires,explication,type) values('$id_quize','$question','$reponse1','$reponse2','$reponse3','$reponse4','$bonne_reponse','$fileNameNew','$expl','$fileActualExt')");
            if($ajouter_question->execute()){
                echo"<script>alert('Question ajoutée avec succès.')</script>";
            }
                echo'<script> location.href ="course_manager.php?edit_quiz='.$id_quize.'";</script>';
        }
    }
    }
    
    function valider_reponses($id){
        include("inc/db.php");
         if(isset($_POST['valider_reponses'])){
            $id_user=$_SESSION['id_user'];
            $get_question=$con->prepare("select * from question where id_quize='$id'");
            $get_question->setFetchMode(PDO:: FETCH_ASSOC);
            $get_question->execute();
             $i=1;

             $check=$con->prepare("select * from quize_reponse where id_quiz='$id' and id_user='$id_user'");
             $check->setFetchMode(PDO:: FETCH_ASSOC);
             $check->execute();
             $count=$check->rowCount();
             
            if($count == 0){
            while($sub_row=$get_question->fetch()){
                   $id_question=$sub_row['id_question'];
                   $reponse_user=$_POST[$sub_row['id_question']];
                   $ajouter_ans=$con->prepare("insert into quize_reponse(id_user,id_quiz,id_question,reponse_user)values('$id_user','$id','$id_question','$reponse_user')");
                   $ajouter_ans->execute();
            }
        }else{
            while($sub_row=$get_question->fetch()){
                $id_question=$sub_row['id_question'];
                $check=$con->prepare("select * from quize_reponse where id_question='$id_question' and id_user='$id_user'");
                $check->setFetchMode(PDO:: FETCH_ASSOC);
                $check->execute();
                $reponse_row=$check->fetch();
                $id_reponse=$reponse_row['id_reponse'];

                $reponse_user=$_POST[$sub_row['id_question']];
                $up_ans=$con->prepare("update quize_reponse set reponse_user='$reponse_user' where  id_reponse='$id_reponse'");
                $up_ans->execute();
                
         }
        }
                   echo'<script> location.href ="quize_reponse.php?id_quiz='.$id.'";</script>';
    }
}


   function edit_question(){
        include("inc/db.php");
        if(isset($_GET['edit_quiz'])){
            $id=$_GET['edit_quiz'];
        
        if(isset($_POST['edit_question'])){
             $id_question=$_POST['id_question'];
             $question=$_POST['question'];
             $reponse1=$_POST['reponse1'];
             $reponse2=$_POST['reponse2'];
             $reponse3=$_POST['reponse3'];
             $reponse4=$_POST['reponse4'];
             $bonne_reponse=$_POST[$id_question];

             $expll=$_POST['expll'];
             $file=$_FILES['eaudio'];
             $fileName = $_FILES['eaudio']['name'];
             $fileTmpName = $_FILES['eaudio']['tmp_name'];
             $fileExt =explode('.', $fileName);
             $fileActualExt =strtolower(end($fileExt));
             $allowedfile =array('');
             $fileNameNew = uniqid('',true).".".$fileActualExt;
             $fileDestination = 'images/'.$fileNameNew;
             move_uploaded_file($fileTmpName , $fileDestination);

             $up=$con->prepare("update question set question='$question', reponse1='$reponse1',reponse2='$reponse2',reponse3='$reponse3',reponse4='$reponse4',bonne_reponse='$bonne_reponse',accessoires='$fileNameNew',explication='$expll',type='$fileActualExt' where id_question ='$id_question'");
            
             if($up->execute()){
                echo"<script>alert('Question modifié avec succès.')</script>";
             }
               echo'<script> location.href ="course_manager.php?edit_quiz='.$id.'";</script>';
        }
    }
   }

   function delet_question(){
    include("inc/db.php");
    if(isset($_GET['edit_quiz'])){
        $id=$_GET['edit_quiz'];
         if(isset($_POST['delet_question'])){
             $id_question=$_POST['id_question'];
             $delet=$con->prepare("delete from question where id_question ='$id_question'");
             if($delet->execute()){
                echo"<script>alert('quiz supprimé avec succès.')</script>";
             }
                echo'<script> location.href ="course_manager.php?edit_quiz='.$id.'";</script>';
         }
        }
   }

    function paiement(){
        include("inc/db.php");
        if(isset($_POST['checkout'])){
            $id_user=$_SESSION['id_user'];
            $cardname=$_POST['cardname'];
            $expmonth=$_POST['expmonth'];
            $cardnumber=$_POST['cardnumber'];
            $expyear=$_POST['expyear'];
            $cvv=$_POST['cvv'];

            $get_panier=$con->prepare("select * from panier where id_user='$id_user'");
            $get_panier->setFetchMode(PDO:: FETCH_ASSOC);
            $get_panier->execute();
            while($row=$get_panier->fetch()){
                  $id_cour=$row['id_cour'];
                  $checkout=$con->prepare("insert into paiement(cardname,cardnumber,expyear,expmonth,id_cour,id_user)values('$cardname','$cardnumber','$expyear','$expmonth','$id_cour','$id_user')");
                  $checkout->execute();
            }
                $delet=$con->prepare("delete from panier where id_user='$id_user'");
                if($delet->execute()){
                    echo"<script>alert('Votre achat a été complété avec succès.')</script>";
                    echo'<script> location.href ="cart.php";</script>';
                }
                
                
        }
    }

   function add_follow($id_ens){
        include("inc/db.php");
        $id_user=$_SESSION['id_user'];
        $ajouter_follow=$con->prepare("insert into followers(id_ens,id_user) values('$id_ens','$id_user')");
        if($ajouter_follow->execute()){
            echo"<script>alert('Added')</script>";
        }
    }

    function delet_follow($id_ens){
        include("inc/db.php");
        $id_user=$_SESSION['id_user'];
        $delet_f=$con->prepare("delete from followers where id_ens='$id_ens' and id_user='$id_user'");
        $delet_f->execute();
    }
?>



