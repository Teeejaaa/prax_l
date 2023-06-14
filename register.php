<?php
session_start();
include "./db.php";
include './recaptcha_config.php';



?>

<!DOCTYPE html>
<html lang="en">

<title>Registrace</title>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>
<?php 

include "./header.php";
?>

<body>

<?php
include "./menu.php"; 
?>

  <main id="main">

   
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>Registrace</h2>
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

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Jsi živ?</h4>
               
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="./register.php" method="post" class="php-email-form">

              <div class="form-group mt-3">
              <input type="email" class="form-control" name="email" id="email" placeholder="tvůj email" required>
                </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="password" name="heslo" class="form-control" id="heslo" placeholder="tvé heslo" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="password" class="form-control" name="heslo_znovu" id="heslo_znovu" placeholder="tvé heslo znovu" required>
                </div>
              </div>
              <div class="form-group mt-3">

            <?php echo '<div class="g-recaptcha" data-sitekey="'.recaptcha_config::GOOGLE_RECAPTCHA_SITE_KEY.'"></div>'; ?>
                <br>              
              <p>Už jsi zaregistrovaný?<a href="./login.php" > Přihlaš se...</a></p>
                </div>
              <div class="my-3">
                <div id="error-message" class="error-message"></div>
                <div id="sent-message" class="sent-message"></div>
              </div>
              <div class="text-center"><button type="submit" name="registrovat">Registrovat se</button></div>
              
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


if(isset($_POST["registrovat"]))
{
    $recaptcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.recaptcha_config::GOOGLE_RECAPTCHA_SECRET_KEY.'&response=' . $_POST['g-recaptcha-response']));
    if ($recaptcha->{'success'} == 'true') 
    {
            
   
        if(str_contains($_POST["email"],"@spseiostrava.cz"))
        {
            if(strlen($_POST["heslo"])>=8)
            {
                if(($_POST["heslo"])==($_POST["heslo_znovu"]))
                {
                    $query=$conn->prepare("select email from users where email = ?");
                    $query->bind_param("s",$_POST["email"]);
                    $query->execute();
                    $query->store_result();
                    $vysledek=$query->fetch();
                    $query->close();
                        if($vysledek==NULL)
                        {
                            $heslo=password_hash($_POST["heslo"],PASSWORD_DEFAULT);

                            $query=$conn->prepare("insert into users(email,heslo) values(?,?)");
                            $query->bind_param("ss",$_POST["email"],$heslo);
                            $query->execute();
                            $vysledek=$query->store_result();
                            $query->close();
                                    if($vysledek==TRUE)
                                    {
                                      echo '<script> document.getElementById("sent-message").innerHTML = "Úspěšně ses zaregistroval. Vítej!"; </script>';
                                    }

                        }
                        else
                        {
                          echo '<script> document.getElementById("error-message").innerHTML = "Uživatel již existuje."; </script>';
                        }
                }
                else
                {
                  echo '<script> document.getElementById("error-message").innerHTML = "Hesla se neshodují."; </script>';
                } 
            
            }
            else
            {
              echo '<script> document.getElementById("error-message").innerHTML = "Heslo musí obsahovat minimálně 8 znaků."; </script>';  

            }
        
        }
        else
        {
          echo '<script> document.getElementById("error-message").innerHTML = "Použijte školní email."; </script>';
        }

    }
    else 
    {
      echo '<script> document.getElementById("error-message").innerHTML = "Jsi si jisty, že žiješ?"; </script>';
    }
}

?>
</body>

</html>