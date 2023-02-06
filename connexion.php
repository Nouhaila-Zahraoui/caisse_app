<?php
/*connection*/
// $link=mysqli_connect("localhost" , "root" , "" , "gestion_ventes");
/*verification de la connexion*/
// if(mysqli_connect_errno()){
//     printf("echec de la connection : %s" , mysqli_connect_error());
//     exit();
// }
$dsn = 'mysql:host=localhost;dbname=gestion_ventes';
$user = 'root';
$pass = '';
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8',
);
try {
    $con = new PDO($dsn, $user, $pass, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    echo 'failed to connect' . $e->getMessage();
}
?>
