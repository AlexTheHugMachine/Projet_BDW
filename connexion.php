
<!doctype html>
<html lang="fr">
<link href="css/styles.css" rel="stylesheet" />

<head>
  <meta charset="utf-8">
  <title>Connexion</title>
</head>

<body>
</br>
</br>
  <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Connexion</h2>
  <div class="divider-custom">
    <div class="divider-custom-line"></div>
    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
    <div class="divider-custom-line"></div>
  </div>
  <form action="connexion.php" method="POST">
    <div class="container">
      <div class="fillform" style="margin: 1rem;">
        <div class="control-group">
          <div class="form-group floating-label-form-group controls mb-0 pb-2">
            <label for="pseudo"><b>Pseudo:</b></label><input class="form-control" type="text" name="pseudo" placeholder="Pseudo *" required="required" data-validation-required-message="Entrez votre pseudo s'il vous plaît." />
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group floating-label-form-group controls mb-0 pb-2">
            <label for="mdp"><b>Mot de passe:</b></label></label><input class="form-control" type="password" name="mdp" placeholder="Mot de passe *" required="required" data-validation-required-message="Entrez votre mot de passe s'il vous plaît." />
            <p class="help-block text-danger"></p>
          </div>
        </div>
      </div>
      <div class="butt" style="text-align: center; margin: 1rem;">
        <a class="btn btn-primary btn-xl" type="text" href="index.php">Annuler</a>
        <button class="btn btn-primary btn-xl" type="submit" name="valider">Se connecter</button></div>
      </div>
    </div>
    <div style="text-align: center; margin: 1rem;"> <a href="./inscription.php">Vous voulez créer un compte ?</a> </div>

  </form>
</body>

</html>

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
    header('Location: index-connected.php?subscribe=yes');
    exit();
  } 
  else {
    $stateMsg = "Le pseudo ou mot de passe rentré, ne correspond à aucun compte enregistré";
  }
echo $stateMsg;
}


?>