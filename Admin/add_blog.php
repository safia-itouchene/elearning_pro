<div class="add_blog">

<form  method='post' enctype='multipart/form-data' name='blogForm' onsubmit='return validateblogForm()'>
               <h1> Ajouter Niveau Blog</h1> 

               <span style='margin-left:0%;' class='error' id='errorblog_title'></span>
               <input type='text'   name='blog_title'  placeholder='Enter Blog Title'>

               <span style='margin-left:0%;' class='error' id='errorsub_title'></span>
               <input type='text'  name='blog_sub_title'  placeholder='Enter Sub Title'>
               <img id="file-ip-1-preview"/>
               <label for="file-ip-1">Upload Image</label>
               <span style='margin-left:0%;' class='error' id='errorsub_cover'></span>
               <input type="file" name='cover' id="file-ip-1" accept="image/*" onchange="showPreview(event);">
               <span style='margin-left:0%;' class='error' id='errorsub_txt'></span>
               <textarea name='blog_cont' id='' cols='30' rows='10' placeholder='Create New Blog'></textarea>
               <button   name='add_blog'>Ajouter</button>
          </form>
</div>
<?php echo add_blog();?>

