
<!doctype html>
<html lang="fr">
<link href="css/styles.css" rel="stylesheet" />

<head>
  <meta charset="utf-8">
  <title>Inscription</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
</br>
</br>
  <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Inscription</h2>
  <div class="divider-custom">
    <div class="divider-custom-line"></div>
    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
    <div class="divider-custom-line"></div>
  </div>
  <form action="inscription.php" method="POST">
    <div class="container">
      <div class="fillform" style="margin: 1rem;">
        <div class="control-group">
          <div class="form-group floating-label-form-group controls mb-0 pb-2">
            <label for="pseudo"><b>Pseudo souhaité:</b></label><input class="form-control" type="text" name="pseudo" placeholder="Pseudo souhaité *" required="required" data-validation-required-message="Entrez votre pseudo s'il vous plaît." />
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group floating-label-form-group controls mb-0 pb-2">
            <label for="mdp"><b>Mot de passe:</b></label></label><input class="form-control" type="password" name="mdp" placeholder="Mot de passe *" required="required" data-validation-required-message="Entrez votre mot de passe s'il vous plaît." />
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group floating-label-form-group controls mb-0 pb-2">
            <label for="mdp"><b>Répétez le mot de passe: </b></label></label><input class="form-control" type="password" name="mdp-repeat" placeholder="Répétez le mot de passe *" required="required" data-validation-required-message="Entrez votre mot de passe s'il vous plaît." />
            <p class="help-block text-danger"></p>
          </div>
        </div>
      </div>
      <div class="butt" style="text-align: center; margin: 1rem;">
        <a class="btn btn-primary btn-xl" type="text" href="index.php">Annuler</a>
        <button class="btn btn-primary btn-xl" type="submit" name="valider">S'inscrire</button>
      </div>
    </div>
    <div style="text-align: center; margin: 1rem;"> <a href="./connexion.php">Vous vous êtes déjà inscrit ?</a> </div>
  </form>
</body>

</html>

<?php
session_start();
require_once 'fonctions/bd.php';
require_once 'fonctions/utilisateur.php';

$stateMsg = "";

// Si on clique sur valider alors
if (isset($_POST["valider"])) {
  $pseudo = $_POST["pseudo"];
  $hashMdp = md5($_POST["mdp"]);
  $hashConfirmMdp = md5($_POST["mdp-repeat"]);

  $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
  $available = checkAvailability($pseudo, $link);

  //On vérifie les conditions pour l'inscription
  if ($hashMdp == $hashConfirmMdp) {
    if ($available) {
      register($pseudo, $hashMdp, $link);
      header('Location: connexion.php?subscribe=yes');
      exit();
      // Si le pseudo demandé existe déjà
    } else {
      echo "Le pseudo demandé est déjà utilisé, choisissez en un autre";
    }
    // Si le mot de passe rentré n'est pas le même pour la confirmation de mot de passe
  } else {
     echo "Les mots de passe ne correspondent pas, veuillez réessayer";
  }
}
?>