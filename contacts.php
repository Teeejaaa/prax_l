<?php
session_start();
include "./db.php";
?>

<!DOCTYPE html>
<html lang="en">

<title>Spolupráce</title>
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
        <h2>Spolupráce</h2>
        <p>#text</p>
      </div>
    </div>


    <section id="trainers" class="trainers">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <?php

              $query1=$conn->prepare("select nazev,obraz,popis,facebok,insta from spoluprace;");
              $query1->execute();
              $query1->store_result();
              $query1->bind_result($nazev,$obraz,$popis,$facebok,$insta);
              $akcikarray=array();
              while($spol=$query1->fetch())
                  {
                      echo' <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="member">
                          <img src="assets/img/sponz/'.$obraz.'" class="img-fluid" alt="">
                          <div class="member-content">
                            <h4>'.$nazev.'</h4>
                            <p>
                              '.$popis.'
                            </p>    
                     
                            <div class="social">  ';
                              if($facebok!=NULL)
                              {
                                echo '<a href="'.$facebok.'"><i class="bi bi-facebook"></i></a>';
                              }
                              if($insta!=NULL)
                              {
                                echo '<a href=""><i class="bi bi-instagram"></i></a>';
                              }
                              
                              
                        echo'  </div>
                          </div>
                        </div>
                      </div>    ';
                  }
                
              $query1->close();

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