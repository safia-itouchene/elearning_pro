<style>

</style>

<main>
<?php if(isset($_GET['id_dem'])){
         $id_dem=$_GET['id_dem'];
         $get_dem=$con->prepare("select * from demande_enseignement where id='$id_dem'");
         $get_dem->setFetchMode(PDO:: FETCH_ASSOC);
         $get_dem->execute();
         $row=$get_dem->fetch();
    ?> 
         <div class="preuv">
              <iframe src="../images/<?php echo $row['file'];?>" frameborder="0"></iframe>
         </div>
        
    <?php   }else{?>
<div class='demandes'  id="table-cat">
                   <table style="width:1000px; margin-left:33px;">
                       <thead>
                           <tr>
                               <th>Nom & prenom</th>
                               <th>Niveau Académique</th>
                               <th>enseigner?</th>
                               <th>PDF</th>
                               
                               <th>Action</th>
                               <th>Action</th>
                           </tr>
                        </thead>
                           <?php echo demande()?>
                       
                     </table>

                     
</div>



<?php } ?>
</main>

