<?php
session_start();
$pageTitle = 'Gestion des Ventes';
include 'infos-Functions.php';
include 'connexion.php';
// connexionDataBase();

if (isset($_SESSION['pseudo'])) {
    $do = '';
    if (isset($_GET['do'])) { $do = $_GET['do'];} 
?>

<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php getTitle() ?></title>

    <link rel="stylesheet" href="assets/css/style.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="assets/css/fontawesome.min.css" rel="stylesheet">
    <style>

    </style>
</head>

<body>
    <style>
        body {
            padding-top: 25rem !important;
            background: #ecf0f1 !important;
        }
    </style>

    <!-- panier -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form action="?do=insert_command" method="post">

                <div class="modal-content">
                    <form action="post" method="?do="></form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Votre panier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <div class="panier container-fluid">
                            <div class="row">
                                <aside class="col-lg-9">
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped">
                                                <thead class="text-muted">
                                                    <tr class="small text-uppercase">
                                                        <th scope="col">Produit</th>
                                                        <th scope="col" width="120">Quantity</th>
                                                        <th scope="col" width="120">Price</th>
                                                        <th scope="col" width="120">Total</th>
                                                        <th scope="col" class="text-right d-none d-md-block"
                                                            width="200">
                                                            Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                        
                                                if(isset($_SESSION['code'])){
                                                    [$rows_product, $count_product] = getAllCartProducts($con, $_SESSION['code']);
                                                }
                                                if($count_product<=0){
                                                    echo "<tr><td colspan=5 class='text-center text-danger'><b>Votre panier est vide veuillez commander d'autres produits !</b></td></tr>";
                                                }
                                                foreach ($rows_product as $row_product) {
                                                    # code...
                                                    ?>


                                                    <tr>
                                                        <td>
                                                            <figure class="itemside align-items-center">
                                                                <div class="aside"><img
                                                                        src="https://i2.wp.com/www.titanui.com/wp-content/uploads/2020/11/21/3D-eCommerce-Icons-Sketch-Figma-And-PNG.jpg?ssl=1"
                                                                        class="img-sm"></div>
                                                                <figcaption class="info"> <a href="#"
                                                                        class="title text-dark"
                                                                        data-abc="true"><?php echo $row_product['Désignation'] ?></a>
                                                                </figcaption>
                                                            </figure>
                                                            <!-- hidden input -->
                                                            <input type="hidden"
                                                                name="productid-<?php echo $row_product['Code_Produit'] ?>"
                                                                value="<?php echo $row_product['Code_Produit'] ?>" />
                                                        </td>
                                                        <td>
                                                            <input type="number" min="1"
                                                                value="<?php echo $row_product['Qte']; ?>"
                                                                name="qte-<?php echo $row_product['Code_Produit']; ?>"
                                                                class="form-control" id="exampleInputEmail1"
                                                                aria-describedby="emailHelp" readonly>
                                                        </td>
                                                        <td>
                                                            <div class="price-wrap"> <var
                                                                    class="price"><?php echo $row_product['Prix_Unitaire']." DH" ?></var>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="price-wrap"> <var
                                                                    class="price"><?php echo $row_product['Total_produit']." DH" ?></var>
                                                            </div>
                                                        </td>

                                                        <td class="text-center">
                                                            <a href="server.php?do=delete_product_panier&panierid=<?php echo $row_product['Code_panier'] ?>"
                                                                class="btn btn-light confirm"
                                                                onclick="javascript:return confirm('êtes-vous sûr de supprimer le produit <?php echo $row_product['Désignation'] ?>!');">
                                                                Supprimer</a>
                                                        </td>
                                                    </tr>


                                                    <?php
                        }
                        ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </aside>
                                <aside class="col-lg-3">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <form>
                                                <div class="form-group"> <label>Avez vous un coupon de
                                                        reduction?</label>
                                                    <div class="input-group"> <input type="text"
                                                            class="form-control coupon" name=""
                                                            placeholder="Coupon code"> <span class="input-group-append">
                                                            <button
                                                                class="btn btn-primary btn-apply coupon">Appliquer</button>
                                                        </span> </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <dl class="dlist-align">
                                                <dt>Total price:</dt>
                                                <dd class="text-right ml-3">
                                                    <?php echo intval(getTotalPanier($_SESSION['code'], $con)); ?> DH
                                                </dd>
                                            </dl>
                                            <dl class="dlist-align">
                                                <dt>Discount:</dt>
                                                <dd class="text-right text-danger ml-3">
                                                    <?php echo intval(getTotalPanier($_SESSION['code'], $con))<=0?0:-10 ?>
                                                    DH</dd>
                                            </dl>
                                            <dl class="dlist-align">
                                                <dt>Total Command:</dt>
                                                <dd class="text-right text-dark b ml-3"> <strong>
                                                    </strong><?php echo intval(getTotalPanier($_SESSION['code'], $con))<=0?0:intval(getTotalPanier($_SESSION['code'], $con))-10 ?>
                                                    DH
                                                </dd>
                                            </dl>
                                            <hr> <button type="submit"
                                                class="btn btn-out btn-primary btn-square btn-main" data-abc="true">
                                                Passer la Commande </button>
                                            <a href="?do=products"
                                                class="btn btn-out btn-success btn-square btn-main mt-2"
                                                data-abc="true">Continue Shopping</a>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- here closing form -->
            </form>





        </div>
    </div>


    <!-- Page Content Holder -->
    <div class="fixed-top">
        <div class="row">
            <div class="col-md-12">
                <div class="card-content h-100">

                    <div class="card-desc text-end">
                        <div class="text-center">
                            <h3><b>Gestion Commerciale - GestCom</b></h3>
                            <h4>Gestion de commandes</h4>
                        </div>
                        <!-- templates error -->
                        <!-- templates error -->
                        <!-- templates error -->
                        <!-- templates error -->
                        <?php 
            if(isset($_SESSION['add_product_success'])) {
                // echo '<script language="Javascript"> var t=setTimeout("document.location.replace(\''.$url.'\')", '.$seconds.');  </script>';
                ?>
                        <div class="alert alert-success text-center">
                            Le produit <b><?php echo $_SESSION['add_product_success']; ?></b> ajouté avec succes !
                            <img src="close.soon" style="display:none;"
                                onerror="(function(el){ setTimeout(function(){ el.parentNode.parentNode.removeChild(el.parentNode); },5000 ); })(this);" />
                        </div>
                        <?php
                unset($_SESSION['add_product_success']);
            }

            if(isset($_SESSION['deleted_product'])) {
                getAlertTemplate(
                    "Le produit est supprimé avec succes !",
                    $_SESSION['deleted_product'],
                    "danger"
                );
                unset($_SESSION['deleted_product']);
            } 
            
            if(isset($_SESSION['add_command_success'])) {
                getAlertTemplate(
                    "Felicitation votre commande est passé avec succès !",
                    $_SESSION['add_command_success'],
                    "success"
                );
                unset($_SESSION['add_command_success']);
            }
            ?>
                        <div class="dropdown-divider"></div>

                        <div class="row">
                            <div class="col-md-4 text-start">
                                <button type="button" class="btn btn-primary position-relative" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Panier
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?php echo intval(getCountProducts($_SESSION['code'], $con)) ?>
                                    </span>
                                </button>
                            </div>
                            <div class="col-md-8">
                                <b>Code client: </b> <?php echo $_SESSION['code'] ?> *****
                                <b>Nom client: </b> <?php echo $_SESSION['nom'] ?> *****
                                <b>Pseudo: </b> <?php echo $_SESSION['pseudo'] ?> *****
                                <a href="?do=disconnect" class="btn btn-secondary">Se deconnecter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="details-card">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-content h-100">
                            <div class="card-desc">
                                <form action="?do=search_command" method="post">
                                    <div class="form-group text-center mb-1">
                                        <label for="exampleInputEmail1" class="mb-4">
                                            <h3>Recapitulatif de commandes : </h3>
                                        </label>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label mb-2"><b>A Partir
                                                    de:</b></label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="inputEmail3" name="date"
                                                    placeholder="date">
                                            </div>
                                        </div>
                                        <small id="emailHelp" class="form-text text-muted">Selectionner la date a partir
                                            duquel
                                            vous avez commandé.</small>
                                    </div>
                                    <button type="submit" class="btn-card">CHERCHER</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card-content h-100 text-center">
                            <div class="card-desc">
                                <h3>Passation de commandes</h3>
                                <p>Pour passer une commande il faut cliquer sur le button ci-dessous: </p>

                                <a href="?do=products" class="btn-card mt-5">PASSER LA COMMANDE</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <div class="container">
        <div class="mt-2">
            <?php
        //start menage page
        if ($do == 'search_command') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $date = $_POST['date'];
                $user = $_SESSION['pseudo'];
                // echo "your date is : ".$date;
                $query = '';
                $error_commande = '';
                $error_date = '';
                $total_vente=0;
                $chiffre_affaire=0;
                // pour les commandes de chaque client 
                $commandes = $con->prepare("SELECT commande.* 
                                            from commande 
                                            INNER JOIN client on client.Code_Client=commande.Code_Client
                                            WHERE client.Pseudo='$user' 
                                            AND commande.Date BETWEEN '$date' 
                                            AND now()
                                        ");
                $commandes->execute();
                $rows_commandes = $commandes->fetchAll();
                $count_commandes = $commandes->rowCount();
                // $count_product="";
                if(empty($date)){
                    $error_date="Veuillez renseigner la date s'il vous plait";    
                }
                elseif($count_commandes <= 0) {
                    $error_commande="Aucune commande n'est passée a partir de cette date $date";
                }
        }
    ?>
            <?php 
if(!empty($error_date)){
    ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-content h-100">
                        <div class="card-desc">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Avertissement !</h4>
                                <p><?php echo $error_date ?></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <?php
    $error_date="";
}
elseif(!empty($error_commande)){
    ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-content h-100">
                        <div class="card-desc">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Avertissement !</h4>
                                <p><?php echo $error_commande ?></p>
                                <hr>
                                <p class="mb-0">Vous pouvez passer des commandes dans la rubrique <b
                                        class="text-danger">passation de comande</b> au dessus.</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php
    $error_commande="";
}else{
    ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-content h-100">
                        <div class="card-desc">
                            <div class="alert alert-success" role="alert">
                                <h5 class="alert-heading">Recapitulatif A partir de : <?php echo $date; ?> !</h5>
                            </div>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">N° commande</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Code Produit</th>
                                        <th scope="col">Designation</th>
                                        <th scope="col">PU</th>
                                        <th scope="col">Qte</th>
                                        <th scope="col">Tot Prd</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                foreach ($rows_commandes as $row_command) {
                                    [$rows_product, $count_product] = getCommandProducts($row_command['Numéro_Commande'],$con);
                                    ?>

                                    <tr>
                                        <th scope="row" rowspan="<?php echo $count_product+1 ?>">
                                            <?php echo $row_command['Numéro_Commande'] ?></th>
                                        <td rowspan="<?php echo $count_product+1 ?>"><?php echo $row_command['Date'] ?>
                                        </td>

                                        <!-- pour lister les produits -->
                                        <?php
                                foreach ($rows_product as $row_product) {
                                ?>
                                    <tr>
                                        <td><?php echo $row_product['Code_Produit'] ?></td>
                                        <td><?php echo $row_product['Désignation'] ?></td>
                                        <td><?php echo $row_product['Prix_Unitaire'] ?></td>
                                        <td><?php echo $row_product['Qte'] ?></td>
                                        <td><?php echo $row_product['prixVente'] ?></td>
                                    </tr>



                                    <?php
                                $total_vente+=$row_product['prixVente'];
                                }
                                    ?>
                                    </tr>

                                    <tr class="table-success text-center fw-bold">
                                        <td colspan="6">total commande N° <?php echo $row_command['Numéro_Commande'] ?>
                                        </td>
                                        <td><?php echo $total_vente." DH" ?></td>
                                    </tr>
                                    <?php
                                    $chiffre_affaire+=$total_vente;
                                    $total_vente=0;
                                }
                                ?>
                                </tbody>
                            </table>

                            <div class="alert alert-info mt-4 mb-xxl-5 text-center" role="alert">
                                <h5 class="fw-bold">Chiffre d'affaire du client
                                    (<?php echo $_SESSION['code']." - ".$_SESSION['nom']; ?>) est : <div
                                        class="text-success"><?php echo $chiffre_affaire; ?> DH</div>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <?php
}

?>

            <?php  } 
    elseif($do=='products'){
        // getting products with its count *
        [$rows_product, $count_product]=getAllProducts($con);
?>
            <h5>Choisissez le produit qui vous convient !</h5>
            <section class="details-card">
                <div class="container">
                    <div class="row">
                        <?php
            if($count_product > 0){
                foreach ($rows_product as $row_product) {
                ?>
                        <div class="col-md-3 mb-2">
                            <div class="card-content h-100">
                                <div class="card-img">
                                    <img class="img_product"
                                        src="https://i2.wp.com/www.titanui.com/wp-content/uploads/2020/11/21/3D-eCommerce-Icons-Sketch-Figma-And-PNG.jpg?ssl=1"
                                        alt="">
                                    <span>
                                        <h4><?php echo $row_product['Prix_Unitaire']." DH" ?></h4>
                                    </span>
                                </div>
                                <div class="card-desc">
                                    <h5><?php echo $row_product['Désignation'] ?></h5>
                                    <p>Description du produit....</p>
                                    <button type="button" class="btn-card" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal-<?php echo $row_product['Code_Produit']?>">
                                        Ajouter Au Panier
                                    </button>
                                    <!-- <a href="server.php?do=add_product&userid=<?php echo $row_product['Code_Produit']?>" class="btn-card text-capitalize">Ajouter au panier</a>    -->
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="exampleModal-<?php echo $row_product['Code_Produit']?>"
                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail du produit: <b
                                                class="text-danger text-in"><?php echo $row_product['Désignation'] ?></b>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="?do=add_to_panier" method="post">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="col-form-label">#Code produit: </label>
                                                <input type="text" name="codeProduit"
                                                    value="<?php echo $row_product['Code_Produit']?>"
                                                    class="form-control" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="message-text" class="col-form-label">Désignation:</label>
                                                <textarea class="form-control" name="designation" id="message-text"
                                                    readonly><?php echo $row_product['Désignation']?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Prix Unitaire du produit : </label>
                                                <input type="text" name="prixUnitaire"
                                                    value="<?php echo $row_product['Prix_Unitaire']?>"
                                                    class="form-control" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Specifier la quantité
                                                    a
                                                    commander: </label>
                                                <input type="number" name="qte" value="1" min="1" class="form-control"
                                                    id="recipient-name">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Ajouter Au Panier</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                }
            }else{
                echo "les produits n'existe pas dans la base de données !";
            }
            ?>
                        <!-- Modal -->
                    </div>
                </div>
            </section>


            <?php



    }elseif($do=='add_to_panier') {        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $code_produit = $_POST["codeProduit"];
            $code_client = $_SESSION["code"];
            $qte = $_POST["qte"];
            $prix_unitaire = $_POST["prixUnitaire"];
            $total_produit = $qte*$prix_unitaire;
            $designation = $_POST["designation"];

            $formerrors = array();
            $count = $con->query("SELECT count(panier.Code_Produit) FROM  panier WHERE panier.Code_Produit=$code_produit AND panier.Code_Client=$code_client")->fetchColumn();
            if($count > 0) {

                $stmt = $con->prepare("UPDATE panier SET 
                                        panier.Qte=panier.Qte+$qte,
                                        panier.Total_produit=panier.Total_produit+($qte*$prix_unitaire)
                                        WHERE panier.Code_Produit=$code_produit 
                                        AND panier.Code_Client=$code_client");

                $stmt->execute();
                $_SESSION['add_product_success'] = $designation;
                $url = "server.php?do=products";
                $seconds = 0;
                echo '<script language="Javascript"> var t=setTimeout("document.location.replace(\'' . $url . '\')", ' . $seconds . ');  </script>';
            }
            else{
            if (empty($formerrors)) {
                try {
                    //insert product info in database
                    $stmt = $con->prepare("insert into panier (
                    Code_Produit,
                    Code_Client,
                    Qte,
                    Total_produit
                    )
                    values(
                    :zCode_Produit,
                    :zCode_Client,
                    :zQte,
                    :zTotal_produit
                    )");
                    $try = $stmt->execute(array(
                        ':zCode_Produit' => $code_produit,
                        ':zCode_Client' => $code_client,
                        ':zQte' => $qte,
                        ':zTotal_produit' => $total_produit
                    ));
  
                    $_SESSION['add_product_success'] = $designation;
                    $url = "server.php?do=products";
                    $seconds = 0;
                    echo '<script language="Javascript"> var t=setTimeout("document.location.replace(\'' . $url . '\')", ' . $seconds . ');  </script>';
                } catch (Exception $e) {
                    echo '<div class="alert alert-danger">Error on adding product to cart !</div>.' . $e;
                }
            }
        }
        } else {
            echo '<div class="container">';
            $errorMsg = '<div class="alert alert-danger">vous ne pouvez pas naviguer cette page directement</div>';
            redirectHome($errorMsg, 'back');
            echo "</div>";
        }

    }
    
    elseif($do=='insert_command') {        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $code_client = $_SESSION['code'];
            $date = date('Y-m-d');

            $count = $con->query("select count(panier.Code_panier) from  panier WHERE panier.Code_Client=$code_client")->fetchColumn();
            
            if ($count > 0) {

                $stmt = $con->prepare("select * from panier where Code_Client=?");
                $stmt->execute(array($code_client));
                $rows = $stmt->fetchAll();
                // adding commande***************************************
                $stmt = $con->prepare("insert into commande (
                    Code_Client,
                    Date
                    )
                    values(
                    :zCode_Client,
                    :zDate
                    )");
                $stmt->execute(array(
                        ':zCode_Client' => $code_client,
                        ':zDate' => $date
                ));
                $id_Commande = $con->lastInsertId();
                
                
                //adding commandLines***************************
                foreach ($rows as $row) {
                    echo "hello => ".$row['Code_Produit']." qte => ".$row['Qte']." id commande =>".$id_Commande;  
                    $code = $row['Code_Produit'];
                    $qte = $row['Qte'];
                    try {
                        //code...
                        $stmt = $con->prepare("insert into ligne_commande(
                            Numéro_Commande,
                            Code_Produit,
                            Qte
                            )
                            values(
                                $id_Commande,
                                $code,
                                $qte
                            )")->execute();
                    } catch (Exception $e) {
                        echo '<div class="alert alert-danger">Error on adding CommandLine to DB !</div>.' . $e;
                    }
                }
                // Deleting Shopping cart products*******************************
                $stmt = $con->prepare("delete from panier where Code_Client=:zuser");
                $stmt->bindParam(":zuser", $code_client);
                $stmt->execute();
                
                $_SESSION['add_command_success'] ="command_success";
                $url = "server.php?do=products";
                $seconds = 0;
                echo '<script language="Javascript"> var t=setTimeout("document.location.replace(\'' . $url . '\')", ' . $seconds . ');  </script>';
            } 
        } else {
            echo '<div class="container">';
            $errorMsg = '<div class="alert alert-danger">vous ne pouvez pas naviguer cette page directement</div>';
            redirectHome($errorMsg, '?do=products');
            echo "</div>";
        }

    }elseif ($do == 'delete_product_panier') {

        $userid = isset($_GET['panierid']) && is_numeric($_GET['panierid']) ? intval($_GET['panierid']) : 0;

        $stmt = $con->prepare("select * from panier where Code_panier=? limit 1");
        $count = $con->query("select count(Code_panier) from  panier where Code_panier=$userid")->fetchColumn();
        $stmt->execute(array($userid));
        if ($count > 0) {
            $stmt = $con->prepare("delete from panier where Code_panier=:zuser");

            $stmt->bindParam(":zuser", $userid);

            $stmt->execute();

            $errorMsg = '<div class="alert alert-success"><strong>' . $stmt->rowCount() . '</strong> ' . ' ' . 'enregistrement est supprimé</div>';

            $_SESSION['deleted_product'] = "delete";
            
            $url = "server.php?do=products";
            $seconds = 0;
            echo '<script language="Javascript"> var t=setTimeout("document.location.replace(\'' . $url . '\')", ' . $seconds . ');  </script>';
        
            //redirectHome($errorMsg, 'back', 0);
        } 
        echo '</div></div>';
    }elseif ($do == 'disconnect') {
        disconnect("client.php",0);
    }
     
        ?>
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/popper.min.js"></script>
            <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
            <script src="assets/js/jquery.min.js"></script>


</body>


</html>
<?php



} else {
    header('location: client.php');
    exit();
}
    ?>

<!-- <script src="upload.js"></script> -->