<aside>
               <div class="asidebar">
                     <a href="index.php?main">
                       <i class="fa-solid fa-square-poll-horizontal"></i>
                       <h3>Home</h3>
                     </a>
                   <!--  <a href="index.php?admin_compte">
                     <i class="fa-solid fa-user"></i>
                        <h3>Mon Compte</h3>
                     </a>-->
                   
                    <a href="index.php?cat" >
                        <i class="fa-solid fa-shapes"></i>
                        <h3>Langages</h3>
                     </a>
                     <a href="index.php?sub_cat" >
                     <i class="fa-solid fa-list-ol"></i>
                        <h3>Niveaux</h3>
                     </a>
                     <a href="index.php?demande" >
                     <i class="fa-solid fa-chalkboard-user fa-1x"></i>
                        <h3>Demandes</h3>
                     </a>
                     <a href="index.php?add_blog" >
                     <i class="fa-solid fa-plus"></i>
                        <h3>Ajouter Blog</h3>
                     </a>
                     <a href="index.php?afficher_blog" >
                     <i class="fa-solid fa-spell-check"></i>
                        <h3>Tous blogs</h3>
                     </a>
                     <a href="index.php?about_web" >
                     <i class="fa-solid fa-gears"></i>
                        <h3>Paramètre</h3>
                     </a>
                     <a href="index.php?user" >
                     <i class="fa-solid fa-users"></i>
                        <h3>Utilisateurs</h3>
                     </a>
                     <a href="index.php?ens" >
                     <i class="fa-solid fa-users"></i>
                        <h3>Enseignants</h3>
                     </a>
                     <a href="../logout.php" >
                     <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <h3>logout</h3>
                     </a>
               </div>
           </aside> 
           <?php
           
/*if click on categ*/
      if(isset($_GET['cat'])){
          include("cat.php");
      }
      if(isset($_GET['sub_cat'])){
         include("sub_cat.php");
     }
     if(isset($_GET['about_web'])){
      include("about_web.php");
  }
     if(isset($_GET['demande'])){
      include("demande.php");
}
     if(isset($_GET['admin_compte'])){
     include("admin_compte.php");
}
     if(isset($_GET['add_blog'])){
     include("add_blog.php");
}
    if(isset($_GET['afficher_blog'])){
    include("afficher_blog.php");
}
    if(isset($_GET['user'])){
    include("user.php");
}
if(isset($_GET['ens'])){
   include("user.php");
}
?>


