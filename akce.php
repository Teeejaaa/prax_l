<?php
session_start();
include "./db.php";

          $query1=$conn->prepare("select idProg,nazev,popis,zacatek,konec,mistoKonani,obraz from program where idProg=".$_GET['id'].";");
          $query1->execute();
          $query1->store_result();
          $query1->bind_result($idProg,$nazev,$popis,$zacatek,$konec,$mistoKonani,$obraz);
          $vysledek=$spol=$query1->fetch();

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

    
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>#nazev_akce</h2>
      </div>
    </div>

    
    <section id="course-details" class="course-details">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-8">
            <img src="assets/img/course-details.jpg" class="img-fluid" alt="">
            <h3>#nazev_akce</h3>
            <p>
              #text

            </p>
          </div>
          <div class="col-lg-4">

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Místnost</h5>
              <p><a href="#"> #text_mistnost</a></p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Čas</h5>
              <p>#text_cas_zacatek</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Čas</h5>
              <p>#text_cas_konec</p>
            </div>

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
                <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">#popis_akce</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-2">#pokyny_k_akci</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-3">#mozne_vyhry</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-4">#sponzoři</a>
              </li>
              
                <a class="btn-get-started" data-bs-toggle="tab" href="./neco.php">Přihlášení na akci</a>
              
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>#popis_akce</h3>
                    <p class="fst-italic">#text_databaze</p>
                    <p>#text_databaze</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/course-details-tab-1.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-2">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>#pokyny_k_akci</h3>
                    <p class="fst-italic">#text_databaze</p>
                    <p>#text_databaze</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/course-details-tab-2.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-3">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>#mozne_vyhry</h3>
                    <p class="fst-italic">#text_databaze</p>
                    <p>#text_databaze</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/course-details-tab-3.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-4">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>#sponzoři</h3>
                    <p class="fst-italic">#text_databaze</p>
                    <p>#text_databaze</p>
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