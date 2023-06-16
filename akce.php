<?php
session_start();
include "./db.php";

          $query1=$conn->prepare("select idProg,nazev,popis,zacatek,konec,mistoKonani,obraz,popis_2,vyhry,sponzori from program where idProg=".$_GET['id'].";");
          $query1->execute();
          $query1->store_result();
          $query1->bind_result($idProg,$nazev,$popis,$zacatek,$konec,$mistoKonani,$obraz,$popis_2,$vyhry,$sponzori);


?>

<!DOCTYPE html>
<html lang="en">

<title><?php echo $nazev; ?></title>
<?php 
include "./header.php";
?>

<body>

<?php
include "./menu.php"; 
?>
    

  <main id="main">


  <?php

          while($spol=$query1->fetch())
              {
                echo'  
               <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>'.$nazev.'</h2>
      </div>
    </div>

    
    <section id="course-details" class="course-details">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-8">
            <img src="assets/img/course-details.jpg" class="img-fluid" alt="">
            <h3>'.$nazev.'</h3>
            <p>
              #text

            </p>
          </div>
          <div class="col-lg-4">

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Místnost</h5>
              <p><a href="#">'.$mistoKonani.'</a></p>
            </div>';
            
            if($zacatek==$konec)
            {
            echo '<div class="course-info d-flex justify-content-between align-items-center">
              <h5>Čas</h5>
              <p>'.$zacatek.'</p>
            </div>';
            }
            else {
              echo '
              <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Začátek</h5>
              <p>'.$zacatek.'</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Konec</h5>
              <p>'.$konec.'</p>
            </div>';

            }

         

     echo '
          </div>
        </div>

      </div>
    </section>

    <section id="cource-details-tabs" class="cource-details-tabs">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Popis akce</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Výhry</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Sponzoři</a>
              </li>
      
                <a class="btn-get-started" data-bs-toggle="tab" href="./register_akce.php">Přihlášení na akci</a>
              
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Popis akce</h3>
                    <p class="fst-italic">#text_databaze</p>
                    <p>'.$popis_2.'</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/course-details-tab-1.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-2">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Výhry</h3>
                    <p class="fst-italic">#text_databaze</p>
                    <p>'.$vyhry.'</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/course-details-tab-3.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-3">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Sponzoři</h3>
                    <p class="fst-italic">#text_databaze</p>
                    <p>'.$sponzori.'</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/course-details-tab-4.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  ';
              
       }

        ?>
    
    
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

</body>

</html>