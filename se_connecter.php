<?php
   session_start(); 
   include("inc/db.php");

if(isset($_POST['login'])){
            
              $email=$_POST['email'];
              $password=$_POST['password'];
               
              $check=$con->prepare("select * from user where email='$email' and password='$password'");
              $check->setFetchMode(PDO:: FETCH_ASSOC);
              $check->execute();
              $count=$check->rowCount();
              $row=$check->fetch();
              
              if($count==1){
                   
                   $_SESSION["id_user"]=$row['id_user'];
                   $_SESSION["email"]=$_POST["email"];
            
                   $idsession=$_SESSION["id_user"];
                 

                   $get_admin=$con->prepare("select * from tb_admin where id_user='$idsession'");
                   $get_admin->setFetchMode(PDO:: FETCH_ASSOC);
                   $get_admin->execute();
                   $admin=$get_admin->rowCount();
                   if($admin ==0){
                        header('location:index.php');
                  }elseif($admin == 1){
                        header('location:admin/index.php?main');
                  }
              }elseif($count == 0){
                echo"<script>alert('Compte non trouvé')</script>";
                
              }
        }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>E Learning</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/fontawesome-free-6.1.1-web/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
</head>
<style>
  
.slit-in-vertical {
	-webkit-animation: slit-in-vertical 0.45s ease-out both;
	        animation: slit-in-vertical 0.45s ease-out both;
}

@-webkit-keyframes slit-in-vertical {
  0% {
    -webkit-transform: translateZ(-800px) rotateY(90deg);
            transform: translateZ(-800px) rotateY(90deg);
    opacity: 0;
  }
  54% {
    -webkit-transform: translateZ(-160px) rotateY(87deg);
            transform: translateZ(-160px) rotateY(87deg);
    opacity: 1;
  }
  100% {
    -webkit-transform: translateZ(0) rotateY(0);
            transform: translateZ(0) rotateY(0);
  }
}
@keyframes slit-in-vertical {
  0% {
    -webkit-transform: translateZ(-800px) rotateY(90deg);
            transform: translateZ(-800px) rotateY(90deg);
    opacity: 0;
  }
  54% {
    -webkit-transform: translateZ(-160px) rotateY(87deg);
            transform: translateZ(-160px) rotateY(87deg);
    opacity: 1;
  }
  100% {
    -webkit-transform: translateZ(0) rotateY(0);
            transform: translateZ(0) rotateY(0);
  }
}

/*---------------#region Alert--------------- */

#dialogoverlay{
  display: none;
  opacity: .8;
  position: fixed;
  top: 0px;
  left: 0px;
  background: #707070;
  width: 100%;
  z-index: 10;
}

#dialogbox{
  display: none;
  position: absolute;
  background: rgb(0, 47, 43);
  border-radius:7px; 
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.575);
  transition: 0.3s;
  width: 40%;
  z-index: 10;
  top:0;
  left: 0;
  right: 0;
  margin: auto;
}

#dialogbox:hover {
  box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.911);
}

.container {
  padding: 2px 16px;
}

.pure-material-button-contained {
  position: relative;
  display: inline-block;
  box-sizing: border-box;
  border: none;
  border-radius: 4px;
  padding: 0 16px;
  min-width: 64px;
  height: 36px;
  vertical-align: middle;
  text-align: center;
  text-overflow: ellipsis;
  text-transform: uppercase;
  color: rgb(var(--pure-material-onprimary-rgb, 255, 255, 255));
  background-color: rgb(var(--pure-material-primary-rgb, 0, 77, 70));
  /* background-color: rgb(1, 47, 61) */
  box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
  font-family: var(--pure-material-font, "Roboto", "Segoe UI", BlinkMacSystemFont, system-ui, -apple-system);
  font-size: 14px;
  font-weight: 500;
  line-height: 36px;
  overflow: hidden;
  outline: none;
  cursor: pointer;
  transition: box-shadow 0.2s;
}

.pure-material-button-contained::-moz-focus-inner {
  border: none;
}

/* ---------------Overlay--------------- */

.pure-material-button-contained::before {
  content: "";
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgb(var(--pure-material-onprimary-rgb, 255, 255, 255));
  opacity: 0;
  transition: opacity 0.2s;
}

/* Ripple */
.pure-material-button-contained::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 50%;
  border-radius: 50%;
  padding: 50%;
  width: 32px; /* Safari */
  height: 32px; /* Safari */
  background-color: rgb(var(--pure-material-onprimary-rgb, 255, 255, 255));
  opacity: 0;
  transform: translate(-50%, -50%) scale(1);
  transition: opacity 1s, transform 0.5s;
}

/* Hover, Focus */
.pure-material-button-contained:hover,
.pure-material-button-contained:focus {
  box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.2), 0 4px 5px 0 rgba(0, 0, 0, 0.14), 0 1px 10px 0 rgba(0, 0, 0, 0.12);
}

.pure-material-button-contained:hover::before {
  opacity: 0.08;
}

.pure-material-button-contained:focus::before {
  opacity: 0.24;
}

.pure-material-button-contained:hover:focus::before {
  opacity: 0.3;
}

/* Active */
.pure-material-button-contained:active {
  box-shadow: 0 5px 5px -3px rgba(0, 0, 0, 0.2), 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12);
}

.pure-material-button-contained:active::after {
  opacity: 0.32;
  transform: translate(-50%, -50%) scale(0);
  transition: transform 0s;
}

/* Disabled */
.pure-material-button-contained:disabled {
  color: rgba(var(--pure-material-onsurface-rgb, 0, 0, 0), 0.38);
  background-color: rgba(var(--pure-material-onsurface-rgb, 0, 0, 0), 0.12);
  box-shadow: none;
  cursor: initial;
}

.pure-material-button-contained:disabled::before {
  opacity: 0;
}

.pure-material-button-contained:disabled::after {
  opacity: 0;
}

#dialogbox > div{ 
  background:#FFF; 
  margin:8px; 
}

#dialogbox > div > #dialogboxhead{ 
  background: rgb(0, 77, 70); 
  font-size:19px; 
  padding:10px; 
  color:rgb(255, 255, 255); 
  font-family: Verdana, Geneva, Tahoma, sans-serif ;
}

#dialogbox > div > #dialogboxbody{ 
  background:rgb(0, 47, 43); 
  padding:20px; 
  color:#FFF; 
  font-family: Verdana, Geneva, Tahoma, sans-serif ;
}

#dialogbox > div > #dialogboxfoot{ 
  background: rgb(0, 47, 43); 
  padding:10px; 
  text-align:right; 
}
/*#endregion Alert*/
</style>
<body>

<div class="super_container">
    <?php
	     include("inc/header.php");
    ?> 
    <div class="login_t">
    <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
               <h7 class="card-title text-center ml-3 fw-light fs-5"><b>Connectez-vous à votre compte E learning!</b></h7>
            <h5 class="card-title text-center mt-2 fw-light fs-5">Se connecter</h5>
            <form method="post"   class="needs-validation" novalidate>
              <div class="form-floating mb-3">
                <input type="email" name='email' class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <div class="invalid-feedback">Entrez votre Eamil</div>
              </div>
              <div class="form-floating mb-3">
                <input type="password" name='password'class="form-control" id="floatingPassword" placeholder="Password" required>
                <div class="invalid-feedback">Entrez votre Mot de pass</div>
              </div>
              <div class="d-grid">
                <button name="login" class="btn btn-primary  text-uppercase"  type="submit">Se connecter</button>
              </div>
            </form>
              <div>
                  <p class=" text-muted mt-3 mb-0"> Vous n'avez pas de compte ? <a href="inscrire.php" class="fw-bold text-body"><u>S'inscrire</u></a></p>
              </div>
              <hr class="my-4">
              <div class="d-grid mb-2">
                <button class="btn btn-danger btn-sm btn-block" type="submit">
                  <i class="fab fa-google me-2"></i> Sign in with Google
                </button>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-sm btn-block" type="submit">
                  <i class="fab fa-facebook-f me-2"></i> <span>Sign in with Facebook</span>
                </button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
 
<?php
          include("inc/footer.php");
?>
</div>

<script>
  
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();


</script>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>
</body>

</html>
