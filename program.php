<?php
session_start();
include "./db.php";
?>

<!DOCTYPE html>
<html lang="en">

<title>Program</title>
<?php 
include "./header.php";
?>

<body>

<?php
include "./menu.php"; 
?>

  <main id="main" data-aos="fade-in">

 
    <div class="breadcrumbs">
      <div class="container">
        <h2>Program</h2>
        <p>#text</p>
      </div>
    </div>


    <section id="courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">

        <?php

          $query1=$conn->prepare("select idProg,nazev,popis,zacatek,konec,mistoKonani,obraz from program;");
          $query1->execute();
          $query1->store_result();
          $query1->bind_result($idProg,$nazev,$popis,$zacatek,$konec,$mistoKonani,$obraz);
          $akcikarray=array();
          while($spol=$query1->fetch())
              {
                echo'  
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                  <div class="course-item">
                    <img src="assets/img/'.$obraz.'" class="img-fluid" alt="...">
                    <div class="course-content">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>'.$mistoKonani.'</h4>
                        <p class="price">'.$zacatek.' - '.$konec.'</p>
                      </div>

                      <h3><a href="course-details.html">'.$nazev.'</a></h3>
                      <p>'.$popis.'</p>
                      <div class="trainer d-flex justify-content-between align-items-center">
                        <div class="trainer-rank d-flex align-items-center">
                        <a href="./akce.php?id='.$idProg.'"> číst dále...</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> ';
              


              }



        ?>

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
  <script src="assets/vendor/php-email-form/validate.js"></script>

 
  <script src="assets/js/main.js"></script>

</body>

</html>