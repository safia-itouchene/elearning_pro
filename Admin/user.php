<main>
  <?php  if(isset($_GET['ens'])){?>
    <div  id="table-cat">
                   <table>
                       <thead>
                           <tr>
                               <th>Profile</th>
                               <th>Nome</th>
                               <th>Prenome</th>
                               <th>E-mail</th>
                              
                               <th>Delet</th>
                           </tr>
                        </thead>
                      <?php   echo view_ens(); ?>
                     </table>
</div>
<?php   
  }else{?>
<div  id="table-cat">
                   <table>
                       <thead>
                           <tr>
                               <th>Profile</th>
                               <th>Nome</th>
                               <th>Prenome</th>
                               <th>E-mail</th>
                              
                               <th>Supprimer</th>
                           </tr>
                        </thead>
                      <?php  echo view_user(); ?>
                     </table>
</div>
<?php }?>
</main>