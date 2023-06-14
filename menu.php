<?php
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>

<header id="header" class="fixed-top">
<div class="container d-flex align-items-center">

  <h1 class="logo me-auto"><a href="index.php">SPŠEI Ostrava</a></h1>
  
  <nav id="navbar" class="navbar order-last order-lg-0">
    <ul>
      <li><a class="<?= ($activePage == 'index') ? 'active':''; ?>" href="index.php">Domovská stránka</a></li>
      <li><a class="<?= ($activePage == 'program') ? 'active':''; ?>"  href="program.php">Program</a></li>
      <li><a class="<?= ($activePage == 'contacts') ? 'active':''; ?>" href="contacts.php">Spolupráce</a></li>
     
      <?php 
                if(!isset($_SESSION["email"]))
                {
                    $active=($activePage == 'register') ? 'rn':'';
                    echo '<li class="$active" ><a href="./register.php">Registrovat se</a></li>';
                    $active=($activePage == 'login') ? 'rn':'';
                    echo '<li class="last $active" ><a  href="./login.php">Přihlásit se</a></li>';


                }
                else
                {
                       if($_SESSION["opravneni"]==1)
                        {
                            $active=($activePage == 'uzivatele') ? 'rn':'';
                            echo '<li class=" $active" ><a  href="./uzivatele.php">Uživatelé</a></li>';


                        } 
                    $active=($activePage == 'login') ? 'rn':'';
                    echo '<li class="last $active" ><a  href="./logut.php">Odhlásit se</a></li>';
                                        
                }



           ?>
    
    
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
  </nav>



</div>
</header>





