<?php
session_start();
include "./db.php";
?>

<!DOCTYPE html>
<html lang="en">

<title>Hravé odpoledne</title>
<?php 
include "./header.php";
?>

<body>

<?php
include "./menu.php"; 
?>
  
  <section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
      <h1>Hravé odpoledne<br>v Moravské Ostravě</h1>
      <a href="./program.php" class="btn-get-started">Program</a>
    </div>
  </section>

  <main id="main">

    
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>Hravé odpoledne v Moravské Ostravě</h3>
            <p class="fst-italic">
             #text
            </p>
          </div>
        </div>

      </div>
    </section>

    
    <section id="counts" class="counts section-bg">
      <div class="container">

        <div class="row counters">

          <div class="col-lg-3 col-6 text-center offset-3">
            <span >28. 06.</span>
            <p>Datum</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="11" data-purecounter-duration="1" class="purecounter"></span>
            <p>Počet akcí</p>
          </div>

        </div>

      </div>
    </section>

    
    <section id="why-us" class="why-us">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
              <h3>Spolupráce na akci</h3>
              <p>
              #text
              </p>
              <div class="text-center">
                <a href="./contacts.php" class="more-btn">Číst více...<i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>


          <div class="col-lg-8 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
          <?php
            $query1=$conn->prepare("select nazev,obraz,popis,facebok,insta from spoluprace order by RAND() limit 3;");
            $query1->execute();
            $query1->store_result();
            $query1->bind_result($nazev,$obraz,$popis,$facebok,$insta);
            $akcikarray=array();
            while($spol=$query1->fetch())
                  {
                    echo '
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-receipt"></i>
                    <h4>'.$nazev.'</h4>
                    <p>'.$popis.'</p>
                  </div>
                </div>';


                  }
                


          ?>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    

    
    <section id="popular-courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Akce</h2>
          
        </div>

        <div class="row" data-aos="zoom-in" data-aos-delay="100">

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="course-item">
              <img src="assets/img/course-1.jpg" class="img-fluid" alt="...">
              <div class="course-content">
                <h3><a href="course-details.html">Akce 1</a></h3>
                <p>#text_databaze</p>
              </div>
            </div>
          </div> 

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="course-item">
              <img src="assets/img/course-2.jpg" class="img-fluid" alt="...">
              <div class="course-content">
                <h3><a href="course-details.html">Akce 2</a></h3>
                <p>#text_databaze</p>
              </div>
            </div>
          </div> 

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="course-item">
              <img src="assets/img/course-3.jpg" class="img-fluid" alt="...">
              <div class="course-content">
                <h3><a href="course-details.html">Akce 3</a></h3>
                <p>#text_databaze</p>
              </div>
            </div>
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
  <script src="assets/vendor/php-email-form/validate.js"></script>

  
  <script src="assets/js/main.js"></script>

</body>

</html>