
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

<body>

<div class="super_container">
    <?php
	      include("inc/header.php");
    ?> 
    <div class="inscrire">
    <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
               <h7 class="card-title text-center ml-3 fw-light fs-5"><b>Inscrivez-vous et commencez à apprendre !</b></h7>
               <h5 class="card-title text-center mt-2 fw-light fs-5">S'inscrire</h5>
            <form  method='post'  class="needs-validation" novalidate>
        <div class="form-floating mb-3">
            <input name="nome" type="text" class="form-control" id="floatingInput" placeholder="Nome" required>
            <div class="invalid-feedback">Entrez votre Nom</div>
          </div>
          <div class="form-floating mb-3">
            <input name="prenom" type="text" class="form-control" id="floatingInput" placeholder="Prenom" required>
            <div class="invalid-feedback">Entrez votre Prenom</div>
          </div>
          <div class="form-floating mb-3">
            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
            <div class="invalid-feedback">Entrez votre Email</div>
          </div>

          <div class="form-floating mb-3">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
            <div class="invalid-feedback">Entrez votre Mot de pass</div>
          </div>
          <div class="d-grid">
            <button name="inscrire_user" class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">S' inscrire</button>
          </div>
          <div>
              <p class=" text-muted mt-3 mb-0"> Vous avez déjà un compte ? <a href="se_connecter.php" class="fw-bold text-body"><u>Se connecter</u></a></p>
          </div>
          <hr class="my-4">
        </form>
          </div>
        </div>
      </div>
    </div>
  </div>
     </div>
     <?php
          include("inc/footer.php");
	?>
    <?php
       echo inscrire_user();
    ?>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>
</body>

</html>
