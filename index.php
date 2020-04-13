<?php
session_start();
require_once 'fonctions/bd.php';
require_once 'fonctions/utilisateur.php';

$stateMsg = "";

if (isset($_POST["valider"])) {
  $pseudo = $_POST["pseudo"];
  $hashMdp = md5($_POST["mdp"]);

  $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
  $check = getUser($pseudo, $hashMdp, $link);

  if (getUser($pseudo, $hashMdp, $link) == TRUE) {
    $_SESSION["pseudo"]= $pseudo;
    $_SESSION["mdp"]= $hashMdp;
    setConnected($pseudo, $link);
    header('Location: index.html?subscribe=yes');
    exit();
  } 
  else {
    $stateMsg = "Le couple pseudo/mot de passe ne correspond à aucun utilisateur enregistré";
  }
echo $stateMsg;
}


?>

<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Page Connexion</title>
</head>

<body>
  <style>
    body {
      width: 50%;
      padding: 10% 22%;
      justify-content: center;
      /* text-align: center; */
    }
  </style>
  <!-- à compléter -->
  <h1 style="text-align: center;">Connexion à la BDW</h1>
  <form action="index.php" style="border:2px solid #ccc; border-radius: 30px;" method="POST">
    <div class="container">
      <div class="fillform" style="margin: 1rem;">
        <label for="pseudo"><b>Pseudo:</b></label>
        <input type="text" placeholder="Entrer un pseudo" name="pseudo" required>
        <br>
        <br>
        <label for="mdp"><b>Mot de passe:</b></label>
        <input type="password" placeholder="Entrer MDP" name="mdp" required>
        <br>
        <br>
      </div>
      <div class="butt" style="text-align: center; margin: 1rem;">
        <button type="button" class="cancelbtn"><b>Annuler</b></button>
        <button type="submit" class="valider" name="valider"><b>Se Connecter</b></button>
      </div>
    </div>
    <div style="text-align: center; margin: 1rem;"> <a href="./inscription.php">Première connexion ?</a> </div>

  </form>
</body>

</html>