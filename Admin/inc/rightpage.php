<?php
  include("inc/db.php");
?>
  <!--RIGHT PAGE-->
  <div class="right">
                 <!--END TOP-->
<?php if(!isset($_GET['cat'])&&!isset($_GET['sub_cat']) &&!isset($_GET['about_web'])&&!isset($_GET['message'])&&!isset($_GET['admin_compte'])&&!isset($_GET['add_blog'])&&!isset($_GET['afficher_blog'])&&!isset($_GET['user'])&&!isset($_GET['demande'])&&!isset($_GET['ens'])){ ?>
                <?php
                    $get_demande=$con->prepare("select * from demande_enseignement");
                    $get_demande->setFetchMode(PDO:: FETCH_ASSOC);
                    $get_demande->execute();
                    $k=0;
                    while(($row=$get_demande->fetch()) && $k<4){
                         $id_user=$row['id_user'];
                   
                         $get_user=$con->prepare("select * from user where id_user ='$id_user'");
                         $get_user->setFetchMode(PDO:: FETCH_ASSOC);
                         $get_user->execute();
                         $sub_row=$get_user->fetch();
                         if($row['resultat'] == 0){
                 ?> 
                    <div class="recent-update">
                      <div class="updates">
                         <div class="update">
                             <div class="profile-photo">
                                  <img src="../images/<?php echo $sub_row['user_image']?>" alt="">
                             </div>
                             <div style=" margin-left:5%;margin-top:5%;" class="message">
                              <b><?php echo $sub_row['nome'];echo '    '; echo $sub_row['prenom'];?></b><p> <?php echo $row['niveau_acad']?></p>  
                              </div>
                         </div>
                      </div>
                    </div>
                    <?php } $k++;}  ?>
                     
                 <a href="index.php?demande">Show All</a>
<?php }  ?>
           </div>
