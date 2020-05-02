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


	$query="INSERT INTO utilisateur (pseudo,mdp,etat) VALUES ('$pseudo','$hashPwd','disconnected')";
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



function AffDate($date){
	if(!ctype_digit($date))
	 $date = strtotime($date);
	if(date('Ymd', $date) == date('Ymd')){
	 $diff = time()-$date;
	 if($diff < 60) /* moins de 60 secondes */
	  return 'Il y a '.$diff.' sec';
	 else if($diff < 3600) /* moins d'une heure */
	  return 'Il y a '.round($diff/60, 0).' min';
	 else if($diff < 10800) /* moins de 3 heures */
	  return 'Il y a '.round($diff/3600, 0).' heures';
	 else /*  plus de 3 heures ont affiche ajourd'hui à HH:MM:SS */
	  return 'Aujourd\'hui à '.date('H:i:s', $date);
	}
	else if(date('Ymd', $date) == date('Ymd', strtotime('- 1 DAY')))
	 return 'Hier à '.date('H:i:s', $date);
	else if(date('Ymd', $date) == date('Ymd', strtotime('- 2 DAY')))
	 return 'Il y a 2 jours à '.date('H:i:s', $date);
	else
	 return 'Le '.date('d/m/Y à H:i:s', $date);
   }