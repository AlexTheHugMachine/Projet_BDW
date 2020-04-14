<?php

/*Cette fonction prend en entrée un pseudo à ajouter à la relation utilisateur et une connexion et 
retourne vrai si le pseudo est disponible (pas d'occurence dans les données existantes), faux sinon*/
function checkAvailability($pseudo, $link)
{
	$valide = FALSE;
	$query = "SELECT * FROM `utilisateur` WHERE pseudo ='$pseudo'";
	if(executeQuery($link, $query) == NULL){
		$valide = TRUE;
	}

	return $valide;
}

/*Cette fonction prend en entrée un pseudo et un mot de passe, associe une couleur aléatoire dans le tableau de taille fixe  
array('red', 'green', 'blue', 'black', 'yellow', 'orange') et enregistre le nouvel utilisateur dans la relation utilisateur via la connexion*/
function register($pseudo, $hashPwd, $link)
{
  if(checkAvailability($pseudo, $link)){

	$couleur = array('red', 'green', 'blue', 'black', 'yellow', 'orange');
	$Aleat = $couleur[rand(0,5)];
	$query="INSERT INTO utilisateur (pseudo,mdp,couleur,etat) VALUES ('$pseudo','$hashPwd','$Aleat','disconnected')";
	executeUpdate($link, $query);
	}
	else{
		echo"Impossible d'enregistrer l'utilisateur avec un pseudo déjà utilisé";
	}	
}

/*Cette fonction prend en entrée un pseudo d'utilisateur et change son état en 'connected' dans la relation 
utilisateur via la connexion*/
function setConnected($pseudo, $link)
{
	$query="UPDATE `utilisateur` SET `etat` = 'connected' WHERE `utilisateur`.`pseudo` = '$pseudo'; ";
	executeUpdate($link, $query);
}

/*Cette fonction prend en entrée un pseudo et mot de passe et renvoie vrai si l'utilisateur existe (au moins un tuple dans le résultat), faux sinon*/
function getUser($pseudo, $hashPwd, $link)
{
	$existe=FALSE;
	$query="SELECT * from `utilisateur` WHERE pseudo ='$pseudo' and mdp ='$hashPwd';";
	$result = executeQuery($link, $query);
	if($result != NULL){
		$existe = TRUE;
	}
	return $existe;
}


/*Cette fonction renvoie un tableau (array) contenant tous les pseudos d'utilisateurs dont l'état est 'connected'*/
function getConnectedUsers($link)
{
	$query="SELECT pseudo from utilisateur WHERE etat='connected' ;";
	$res = executeQuery($link, $query);
	return $res;	
}

/*Cette fonction prend en entrée un pseudo d'utilisateur et change son état en 'disconnected' dans la relation 
utilisateur via la connexion*/
function setDisconnected($pseudo, $link)
{
	$query="UPDATE `utilisateur` SET `etat` = 'disconnected' WHERE `utilisateur`.`pseudo` = '$pseudo'; ";
	$resultat = executeUpdate($link, $query);
	return $resultat;
}