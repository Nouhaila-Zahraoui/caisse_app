<!--
***********************
* infos-Functions.php *
***********************
-->
<?php

	function find($pseudo, $connexion)
	{
		$chercherPseudo="SELECT Pseudo , Password FROM
                    client WHERE Pseudo='$pseudo'"; 
		$requete = $connexion->prepare($chercherPseudo);
		//prepare($chercherPseudo);
		$requete->execute();
		$resultat=$requete->fetchall();
		if ( count($resultat)!=0)
			return 1;
		else
			return 0;
	}


	function getAllCartProducts($con, $code) {
		$products = $con->prepare("SELECT panier.*, produit.* 
								   FROM panier INNER JOIN produit 
								   on panier.Code_Produit=produit.Code_Produit 
								   WHERE panier.Code_Client=$code");
        $products->execute();
        $rows_product = $products->fetchAll();
		$count_product = $products->rowCount();
		return [$rows_product, $count_product];
	}

	function getAlertTemplate($message, $session, $theme) {
		if(isset($session)){
			?>
<div class="alert alert-<?php echo $theme ?> text-center">
	<?php echo $message ?>
	<img src="close.soon" style="display:none;"
		onerror="(function(el){ setTimeout(function(){ el.parentNode.parentNode.removeChild(el.parentNode); },5000 ); })(this);" />
</div>
<?php
			// unset($session);
		}
	}

	function getTotalPanier($code, $con){
		$products = $con->prepare("SELECT SUM(panier.Total_produit) as tot 
								   FROM panier WHERE panier.Code_Client=$code");
        $products->execute();
        $total_panier = $products->fetch();
		return $total_panier['tot'];
	}

	function getCountProducts($code, $con) {
		$products = $con->prepare("SELECT SUM(panier.Qte) as qte
								   FROM panier WHERE panier.Code_Client=$code");
        $products->execute();
        $count_panier_qte = $products->fetch();
		return $count_panier_qte['qte'];
	}
	
	/* Fonction reclamationHeader : affiche "Club de Sport"
      et "Réclamation"
  */
	function reclamationHeader(){
		echo '
			<p align=center>
				<b>
					<font size=6>Gestion Commerciale-GestCom</font>
				</b>
			</p>
			<hr width=300 size=4>
			<p align=center>
			<b>
				<font size=4>Gestion de commandes</font>
			</b>
				<hr width=100% size=4>
			</p>';
	}

	function getCommandProducts($codeCommand, $con) {
		$products = $con->prepare("SELECT ligne_commande.*,produit.*, 
                                    produit.Prix_Unitaire*ligne_commande.Qte as prixVente 
                                    FROM ligne_commande 
                                    INNER JOIN produit 
                                    on ligne_commande.Code_Produit=produit.Code_Produit 
                                    INNER JOIN commande on commande.Numéro_Commande=ligne_commande.Numéro_Commande 
                                    WHERE commande.Numéro_Commande=$codeCommand
    	");
        $products->execute();
        $rows_product = $products->fetchAll();
		$count_product = $products->rowCount();
		return [$rows_product, $count_product];
	}
  

	function getAllProducts($con) {
		$products = $con->prepare("SELECT * FROM produit");
        $products->execute();
        $rows_product = $products->fetchAll();
		$count_product = $products->rowCount();
		return [$rows_product, $count_product];
	}
 
	
	/* Fonction connexionHeader : affiche "Connexion" */
	function connexionHeader(){
		echo '
		<P align=center>
			<b>
				<font size=3>Connexion</font>
			</b>
		</P>
		<hr width=100% size=2>';
	}
	function getTitle(){
		global $pageTitle;
		if(isset($pageTitle)){
			echo $pageTitle;
		}else{
			echo 'Default';
		}
	}

	function disconnect($url,$seconds) {
		session_unset();
		session_destroy();
		echo '<script language="Javascript"> var t=setTimeout("document.location.replace(\''.$url.'\')", '.$seconds.');  </script>';
		exit();
	}

	function redirectHome($errorMsg,$url = null ,$seconds = 2000){
		if($url === null ){
			$url='index.php';
			$link='homepage';
		}else{
			if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !==''){
			$url=$_SERVER['HTTP_REFERER'];
			$link='previous page';
		}else{
				$url='index.php';
				$link='homepage';		
			}
		}
		echo $errorMsg; 
		echo "<div class='alert alert-info'>vous allez être redirigé après 2 seconds.</div>";
	   echo '<script language="Javascript"> var t=setTimeout("document.location.replace(\''.$url.'\')", '.$seconds.');  </script>';
		exit();	
	}

	function connexionDataBase()
	{
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
	}
?>