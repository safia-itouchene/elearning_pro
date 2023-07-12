<?php
     $x=0;
     $y=0;
     $z=0;
     $get_ens=$con->prepare("select * from enseignant");
     $get_ens->setFetchMode(PDO:: FETCH_ASSOC);
     $get_ens->execute();
     $ens=$get_ens->rowCount();

     $get_user=$con->prepare("select * from user");
     $get_user->setFetchMode(PDO:: FETCH_ASSOC);
     $get_user->execute();
     $users=$get_user->rowCount();
     
     if($users != 0){
        $x= ($ens*100)/$users;
        $y=100-$x;
     }
    

     $get_cour=$con->prepare("select * from course");
     $get_cour->setFetchMode(PDO:: FETCH_ASSOC);
     $get_cour->execute();
     $cour=$get_cour->rowCount();

     
     $get_fcour=$con->prepare("select * from course where price='0'");
     $get_fcour->setFetchMode(PDO:: FETCH_ASSOC);
     $get_fcour->execute();
     $fcour=$get_fcour->rowCount();
     if($cour !=0) {
        $z=($fcour*100)/$cour;
     }
     

?>

<?php if(!isset($_GET['cat'])&& !isset($_GET['sub_cat'])&&!isset($_GET['about_web'])&&!isset($_GET['message'])&&!isset($_GET['admin_compte'])&&!isset($_GET['add_blog'])&&!isset($_GET['afficher_blog'])&&!isset($_GET['user'])&&!isset($_GET['demande'])&&!isset($_GET['ens'])){ ?>
<main>
            <h1>Statistiques</h1>
            <div class="insights">
                <div class="sales">
                <i class="fa-solid fa-chart-line"></i> 
                    <div class="middle">
                         <div class="left">
                             <h3>Nombre d'enseignants</h3>
                             <h1><?php echo $ens;?></h1>
                         </div>
                         <div class="progress">
                                  <h1><?php echo (int)$x;?>%</h1>
                             </div>
                         
                    </div>
                      
               </div>
               <!--END TOP SELLES-->
               <div class="icome">
               <i class="fa-solid fa-chart-simple"></i>  
                    <div class="middle">
                         <div class="left">
                             <h3>Nombre des cours</h3>
                             <h1><?php echo $cour;?></h1>
                         </div>
                             <div class="progress">
                                <h1><?php echo (int)$z;?>%</h1>
                                <p>free cours</p>
                             </div>
                         
                    </div>
                      
               </div>
               <!--END TOP SELLES-->

               <div class="expenses">
               <i class="fa-solid fa-chart-pie"></i>  
                    <div class="middle">
                         <div class="left">
                             <h3>Nombre des utilisateurs</h3>
                             <h1><?php echo $users;?></h1>
                        </div>
                             <div class="progress">
                                   <h1><?php echo (int)$y;?>%</h1>
                             </div>
                         
                    </div>
                      
               </div>
               <!--END TOP SELLES-->
             </div>

             <!--MAIN 2-->
                <div class="recent-orders">
                   <h2>Tout Les Admins</h2> 
                 
                   <table>
                       <thead>
                           <tr>
                               <th>Profile</th>
                               <th> Nom</th>
                               <th>PRENOM</th>
                               <th>Email</th>
                           </tr>
                       </thead>
                        <tbody>
                        <?php
                            $get_admin=$con->prepare("select * from tb_admin ");
                            $get_admin->setFetchMode(PDO:: FETCH_ASSOC);
                            $get_admin->execute();
                       while($row=$get_admin->fetch()){
                             $id_user=$row['id_user'];
                             $get_user=$con->prepare("select * from user where id_user='$id_user'");
                             $get_user->setFetchMode(PDO:: FETCH_ASSOC);
                             $get_user->execute();
                             $sub_row=$get_user->fetch();

                   ?>
                            <tr>
                                <td id='image_user'><img src="../images/<?php echo $sub_row['user_image'];?>" alt=""></td>
                                <td><?php echo $sub_row['nome'];?></td>
                                <td><?php echo $sub_row['prenom'];?></td>
                                <td><?php echo $sub_row['email'];?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                   </table>
                </div>
</main>
<?php }  ?>
