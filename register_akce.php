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
                    header("Location: ./register_akce.php");
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



<!DOCTYPE html>
<html lang="en">

<?php 
include "./header.php";
?>

<title>Registrace na akci</title>


<body>

<?php
include "./menu.php"; 
?>

  <main id="main">

  <?php 
                        echo '<table>';
                        echo '<tr><th>Kde jsi přihlášený</th><th class="druhy_slup"></th></tr>';
                        foreach($akcikarray as $akcik)
                        {
                            echo '<tr>';
                                echo '<td>';
                                    echo $akcik["nazev1"];
                                echo '</td>';
                                echo '<td >';
                                    echo '<a href="smazto.php?idReg='.$akcik["idReg1"].'" >Odhlásit se z akce</a>';
                                echo '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                        
                    ?>
   
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
                                    if((isset($_GET["idProg"]))&&($_GET["idProg"]==$idProg))
                                    {
                                        echo '<option value="'.$idProg.'" selected="selected" >'.$nazev.'</option>';
                                    }
                                    else
                                    {
                                        echo '<option value="'.$idProg.'" >'.$nazev.'</option>'; 
                                    }
        
                                }
                            
                            
                            $query->close();
                            ?>
                            
                    </select>

                </div>
               <?php
               /*

                    $query3=$conn3->prepare("select idPred,nazev from prednaska");
                    $query3->execute();
                    $query3->store_result();
                    $query3->bind_result($idPred,$nazev);
           
                  
                    while($akcik2=$query3->fetch())
                    {
                      echo '<div class="row">';
                        if($idProg==4)
                        {
                            echo '<div class="col-md-6 form-group"><option value="'.$idPred.'" selected="selected" >'.$nazev.'</option> </div>';
                            echo'
                              <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="text" class="form-control" name="pozn" id="pozn" placeholder="poznámka" required>
                                  </div>
                              </div>  
                              ';
                        
                        
                        }
                        else {
                        echo'
                          <div class="row">
                              <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="text" class="form-control" name="pozn" id="pozn" placeholder="poznámka" required>
                              </div>
                          </div>';

                         }
                   
                }
                $query3->close();
                */
                ?>


              <?php echo'<input type="hidden" name="user_id" value="'.$_SESSION["idUz"].'" >'; ?>
              <div class="text-center"><button type="submit" name="reg">Registrovat se na akci</button></div>
              
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

</body>

</html>