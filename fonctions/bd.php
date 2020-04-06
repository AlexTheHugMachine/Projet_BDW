<?php

$dbHost = "localhost";// à compléter
$dbUser = "root";// à compléter
$dbPwd = "";// à compléter
$dbName = "chat_bdw";

/*Cette fonction prend en entrée l'identifiant de la machine hôte de la base de données, les identifiants (login, mot de passe) d'un utilisateur autorisé 
sur la base de données contenant les tables pour le chat et renvoie une connexion active sur cette base de donnée. Sinon, un message d'erreur est affiché.*/
function getConnection($dbHost, $dbUser, $dbPwd, $dbName)
{
/*

	$link = mysqli_connect($dbHost, $dbUser, $dbPwd, $dbName);
	if (!$link) {
		echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
	        echo "Erreur de débogage : " . mysqli_connect_errno() . PHP_EOL;
	        echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
		exit;
	echo "Succès : Une connexion correcte à MySQL a été faite! La base de donnée chat est au point." . PHP_EOL;
	echo "Information d'hôte : " . mysqli_get_host_info($link) . PHP_EOL;
	return $link;
}
*/
try {
		$cnx = new PDO("mysql:host=$dbHost;dbname=$dbName", "$dbUser", "$dbPwd"); // on créer la connexion
		$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$cnx->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		// Connexion module PDO
	} catch (PDOException $e) {
		// en cas d'erreur
		$erreur = $e->getMessage();
		echo "vous n'êtes pas connecté" . $e->getMessage();
	}
	return $cnx;
}

/*Cette fonction prend en entrée une connexion vers la base de données du chat ainsi 
qu'une requête SQL SELECT et renvoie les résultats de la requête. Si le résultat est faux, un message d'erreur est affiché*/
function executeQuery($link, $query)
{
	 // Perform query

	//echo "req: $query";
	 /* 
	 if ($result = mysqli_query($link, $query, MYSQLI_USE_RESULT)) {
		if (!mysqli_query($link, "SET @a:='this will not work'")) {
			printf("Erreur : %s\n", mysqli_error($link));
		}
		else {
		while($row = mysqli_fetch_array($result)) {
			print_r($row);
		}
	}
	mysqli_free_result($result);
	}
	 */ 

    /* $result = mysqli_query($link, $query);
    if(!$result){
        echo "La requete ".$query." n'a pas pu etre executee a cause d'une erreur de syntaxe";
    }
	return $result;
 */
	try {
		$sth = $link->prepare($query);
		$sth->execute(array());
		$res = $sth->fetchAll();

		return $res;
	} catch (PDOException $e) {
		$erreur = $e->getMessage();
		echo"Erreur requête";
	}
}

/*Cette fonction prend en entrée une connexion vers la base de données du chat ainsi 
qu'une requête SQL INSERT/UPDATE/DELETE et ne renvoie rien si la mise à jour a fonctionné, sinon un 
message d'erreur est affiché.*/
function executeUpdate($link, $query)
{
	/* echo "req: $query";
	if($link == NULL){
		printf("Echec de update (connexion)");
	}

	if (!mysqli_query($link, $query)) {
			echo "Error updating record: " . mysqli_error($link);
		}
	 */
	
	try {
		$sth = $link->prepare($query);
		$sth->execute();

		return $sth;
			
	} catch (PDOException $e) {
		$erreur = $e->getMessage();
		echo"Erreur requête";
	}
}

/*Cette fonction ferme la connexion active $link passée en entrée*/
function closeConnexion($link)
{
	// à compléter
//	mysqli_close($link);
	try {
		$link = null;

	}catch (PDOException $e) {
		$erreur = $e->getMessage();
	}
}
