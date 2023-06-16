

<?php
session_start();
include './db.php';

if(!isset($_SESSION["email"]))
{
    header("Location: ./index.php");
    die();
}

if(isset($_GET["idReg"]))
{
    $query=$conn->prepare("select idReg from registrace where idUz = ? and idReg = ?");
    $query->bind_param("ii",$_SESSION["idUz"],$_GET["idReg"]);
    $query->execute();
    $query->store_result();
    $vysledek=$query->fetch();
    $query->close();
        if($vysledek==TRUE)
            {
                $query=$conn->prepare("delete from registrace where idUz = ? and idReg = ?");
                $query->bind_param("ii",$_SESSION["idUz"],$_GET["idReg"]);
                $query->execute();
                $query->store_result();
                $query->close();
                header("Location: ./regiter_akce.php");
            }
        else
        {
            header("Location: ./index.php");
            die();

        }
}







?>