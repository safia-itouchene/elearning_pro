<main>

<!--*******************************************************************-->
<?php if(isset($_GET['edit_cat'])){ 
          
            echo edit_cat();

            }else{?>
      <div id="table-cat">
<!--*******************************************************************-->
           <details>
                   <summary><h3>Ajouter Langage</h3></summary>
                   <form method="post" enctype="multipart/form-data" name='myForm3' onsubmit='return validateForm3()'>
                          <img id="file-ip-1-preview"/>
                          <label for="file-ip-1">Upload Image</label><br><br>
                          <span style='margin-top:2%;' class='error' id='errorpreuploadimage'></span>
                          <input type="file" name='cover' id="file-ip-1" accept="image/*" onchange="showPreview(event);">
                          <span style='margin-left:0%; color:#ff7782;' class='error' id='errorprecategory_name'></span>
                          <input type="text"  name="cat_name" placeholder="Enter Category Name"/>
                          <center><button name='add_cat'> Ajouter Langage</button></center>
                    </form>
                </details><br>
                   <table>
                       <thead>
                           <tr>
                               <th>Image</th>
                               <th>Nom</th>
                               <th>Modifier</th>
                               <th>Supprimer</th>
                           </tr>
                       </thead>
                       
                           <?php echo view_cat();?>
                       
                   </table>
        </div>
                   <?php } ?>
</main>
<?php
  echo add_cat();
?>


