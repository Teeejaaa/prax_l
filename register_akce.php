<?php
session_start();
include "./db.php";
include './recaptcha_config.php';

if(!isset($_SESSION["email"]))
{
    header("Location: ./login.php");
    die();


}

    $query1=$conn->prepare("select registrace.idProg,program.nazev,registrace.idReg from registrace inner join program on registrace.idProg = program.idProg where registrace.idUz = ? order by program.nazev ASC");
    $query1->bind_param("i",$_SESSION["idUz"]);
    $query1->execute();
    $query1->store_result();
    $query1->bind_result($idProg1,$nazev1,$idReg1);
    $akcikarray=array();
    while($akcik=$query1->fetch())
        {
            $akcikarray[$idReg1]["nazev1"]=$nazev1;
            $akcikarray[$idReg1]["idProg1"]=$idProg1;
            $akcikarray[$idReg1]["idReg1"]=$idReg1;

        }
      
    $query1->close();


if(isset($_POST["reg"]))
{
    $query=$conn->prepare("select idProg,nazev from program where registrace = 1 and idProg = ? order by nazev ASC");
    $query->bind_param("s",$_POST["akce"]);
    $query->execute();
    $query->store_result();
    $vysledek=$query->fetch();
    $query->close();

        if($vysledek==TRUE)
        {
            $query=$conn->prepare("select idReg from registrace where idUz = ? and idProg = ?");
            $query->bind_param("ii",$_POST["user_id"],$_POST["akce"]);
            $query->execute();
            $query->store_result();
            $vysledek=$query->fetch();
            $query->close();
             
                if($vysledek!=TRUE)
                {
                    $query=$conn->prepare("insert into registrace(idUz,idProg,poznamka) values(?,?,?)");
                    $query->bind_param("iis",$_POST["user_id"],$_POST["akce"],$_POST["pozn"]);
                    $query->execute();
                    $vysledek=$query->store_result();
                    $query->close();
                    header("Location: ./regiter_akce.php");
                }
                else
                {
                    echo "uz ses tu registrovanej";
                }


        }
        else 
        {
            echo "Zetku přestaň";
        }

}

$query=$conn->prepare("select idProg,nazev from program where registrace = 1 order by nazev ASC");
$query->execute();
$query->store_result();
$query->bind_result($idProg,$nazev);



?>

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
        <h2>Registrace na akci</h2>
        <p></p>
      </div>
    </div>

  
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Výběr akce</h4>
               
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Tvé osobní poznamky</h4>

              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="./register_akce.php" method="post" class="php-email-form">

              <div class="form-group mt-3">
              
                    <select class="form-control" name="akce" id="akce">
                            <?php
                            while($akcik=$query->fetch())
                            {
                                if((isset($_GET["idPred"]))&&($_GET["idPred"]==$idPred))
                                {
                                    echo '<option value="'.$idPred.'" selected="selected" >'.$nazev.'</option>';
                                }
                                else
                                {
                                    echo '<option value="'.$idPred.'" >'.$nazev.'</option>'; 
                                }

                            }
                            
                            
                            $query->close();
                            ?>
                            
                    </select>

                </div>
                <?php

                    $query=$conn->prepare("select idPred,nazev from prednaska;");
                    $query->execute();
                    $query->store_result();
                    $query->bind_result($idPred,$nazev);
            if($idProg=4)
                { echo '<div class="row">';
                    while($akcik=$query->fetch())
                    {
                        if((isset($_GET["idPred"]))&&($_GET["idPred"]==$idPred))
                        {
                            echo '<div class="col-md-6 form-group"><option value="'.$idPred.'" selected="selected" >'.$nazev.'</option> </div>';
                        }
                        else
                        {
                            echo '<option value="'.$idPred.'" >'.$nazev.'</option>'; 
                        }

                    }
                    echo'
                
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="poznamka" id="poznamka" placeholder="poznámka" required>
                </div>
            </div>  
                    ';
                }
                else {
                    echo'
                <div class="row">
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                      <input type="text" class="form-control" name="poznamka" id="poznamka" placeholder="poznámka" required>
                    </div>
                </div>';

                }
                $query->close();
                ?>



              <div class="text-center"><button type="submit" name="reg_akce">Registrovat se na akci</button></div>
              
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