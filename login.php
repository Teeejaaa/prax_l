<?php
session_start();
include './db.php';
?>


<!DOCTYPE html>
<html lang="en">

<title>Přihlášení</title>
<?php 
include "./header.php";
?>

<body>



<main id="main">

   
<div class="breadcrumbs" data-aos="fade-in">
  <div class="container">
    <h2>Přihlášení</h2>
    <p>#text_maybe</p>
  </div>
</div>


<section id="contact" class="contact">

  <div class="container" data-aos="fade-up">

    <div class="row mt-5">

      <div class="col-lg-4">
        <div class="info">
          <div class="address">
            <i class="bi bi-geo-alt"></i>
            <h4>Informace o tobě</h4>
           
          </div>

          <div class="email">
            <i class="bi bi-envelope"></i>
            <h4>Heslo</h4>

          </div>

        </div>

      </div>

      <div class="col-lg-8 mt-5 mt-lg-0">

        <form action="./login.php" method="post" role="form" class="php-email-form">
          <div class="form-group mt-3">
              <input type="email" class="form-control" name="email" id="email" placeholder="tvůj email" required>
          </div>
          <div class="form-group mt-3">
              <input type="password" name="heslo" class="form-control" id="heslo" placeholder="tvá heslo" required>
          </div>

          <div class="my-3">
                <div id="error-message" class="error-message"></div>
                <div id="sent-message" class="sent-message"></div>
              </div>
    
          <p>Ještě nejsi zaregistrivaný?<a href="./register.php" > Zaregistruj se...</a></p>

          <div class="text-center"><button type="submit" name="prihlas">Přihlásit se</button></div>
        </form>

      </div>

    </div>

  </div>
</section>

</main>

  <?php
  include "./downmenu.php";
  ?>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>


  <script src="assets/js/main.js"></script>


  <?php
    if(isset($_POST["prihlas"]))
    {
        $query=$conn->prepare("select email,heslo,opravneni,idUz from users where email = ?");
        $query->bind_param("s",$_POST["email"]);
        $query->execute();
        $query->store_result();
        $query->bind_result($email,$heslo,$opravneni,$idUz);
        $vysledek=$query->fetch();
        $query->close();
       if(password_verify($_POST["heslo"],$heslo))
       {
        $_SESSION["email"]=$_POST["email"];
        $_SESSION["opravneni"]=$opravneni;
        $_SESSION["idUz"]=$idUz;
        echo '<script> document.getElementById("sent-message").innerHTML = "Úspěšně jste se přihlásili."; </script>';
       }
       else
       {
        echo '<script> document.getElementById("error-message").innerHTML = "Chybné přihlašovací údaje."; </script>';
       }




        
    }

  ?>
</body>
<?php
include "./menu.php"; 
?>
</html>