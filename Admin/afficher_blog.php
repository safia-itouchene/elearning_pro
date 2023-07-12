<main>
<?php if(isset($_GET['edit_blog'])){ 
          
          echo edit_blog();
    }else{?>
<div   id="table-cat">
       <h2>All Bloggs</h2> 
                   <table style="width: 920px">
                       <thead>
                           <tr>
                               <th>Image</th>
                               <th>Titre</th>
                               <th>Voir</th>
                               <th>Modifier</th>
                               <th>Supprimer</th>
                           </tr>
                        </thead>
                           <?php echo afficher_blog()?>
                     </table>
</div>
<?php } ?>
</main>