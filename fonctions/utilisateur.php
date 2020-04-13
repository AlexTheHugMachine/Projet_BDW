<?php

/*Cette fonction prend en entrée un pseudo à ajouter à la relation utilisateur et une connexion et 
retourne vrai si le pseudo est disponible (pas d'occurence dans les données existantes), faux sinon*/
function checkAvailability($pseudo, $link)
{
/*
	$sql_REQ = "SELECT pseudo FROM utilisateur WHERE pseudo='$pseudo';";
	$sql = executeQuery($link, $sql_REQ);
	if (mysqli_num_rows($sql) >= 1) {
		return false;
	} else {
		return true;
	}
*/
/* 
	$req = "SELECT * FROM utilisateur Where pseudo = \"$pseudo\"";
    $result = executeQuery($link,$req);
    return mysqli_num_rows($result) == 0; 
*/
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
	/* if (checkAvailability($pseudo, $link)) {

  $color = array('red', 'blue', 'yellow', 'black', 'orange', 'green');
  $Aleast = $color[rand(0, 5)];
  $query = "INSERT INTO utilisateur (pseudo, mdp, couleur,etat) VALUES ('$pseudo', '$hashPwd', '$Aleast', 'disconnected');";
  executeUpdate($link, $query);
  }
  else {
	  echo"Impossible d'enregistrer l'utilisateur avec un pseudo déjà utilisé";
  } */
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

/*Cette fonction renvoie la couleur associée à un utilisateur pour son affichage dans le fil de discussion*/
function getUserColor($pseudo, $link)
{
	// Optionnel, à compléter
}
