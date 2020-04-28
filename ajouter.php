<?php
	include_once('./fonctions/bd.php');
	include_once('./fonctions/utilisateur.php');
	$bdd = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
	$msg = "";
    // Si le bouton de téléchargement est cliqué 
	if (isset($_POST['envoyer'])) {
  	// Get le nom de l'image
  	$nomFich = $_FILES['nomFich']['name'];
	// retourne lextension de nom de l'image
	$typeimage = strtolower(pathinfo($target,PATHINFO_EXTENSION));
	if($typeimage != "png" && $typeimage != "jpeg" && $typeimage != "gif" ) {
    echo 'le fichier avec lextension $typeimage nest pas autorisee ,seules les images JPEG, PNG et GIF sont autorisées';
    }
	//Vérifier si l'image existe déjà
	 if (image_exists($target)) {
		echo "Cette image existe déjà !";
    }
	//Get la description de l'image
  	$description = mysqli_real_escape_string($bdd, $_POST['description']);
	//get la categorie
	$catId = mysqli_real_escape_string($bdd, $_POST['catId']);
	//get le ID 
	$userId = mysqli_real_escape_string($_SESSION['id']);
	//répertoire du fichier dimages
	$target = "assets/img/".basename($nomFich);
  	
	$sql = "INSERT INTO photo (nomFich, description,catId, userId) VALUES ('$nomFich', '$description','$catId','$userId')";
  	
    
  	//executer query
  	executeQuery($bdd, $sql);

  	if (move_uploaded_file($_FILES['nomFich']['tmp_name'], $target)) {
  		$msg = 'Image téléchargée avec succes';
  	}
	else{
  		$msg = 'Impossible de télécharger limage';
  	}
  }
?>

<!doctype html>
<html lang="fr">
  <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Une nouvelle variante de Pinterest produite par des étudiants !" />
        <meta name="author" content="BONIS Alexis p1805132" />
        <title>MemePlanet</title>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">MemePlanet</a><button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <form action ="index-connected.php" method="post">
			                <button name="Deconnecter" class="btn btn-primary btn">Acceuil</button>
		                </form>
                        <form action ="index-connected.php" method="post">
			                <button name="Deconnecter" class="btn btn-primary btn">Se Déconnecter</button>
		                </form>
                    </ul>
                </div>
            </div>
        </nav>
		<!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <!-- Masthead Avatar Image--><img class="masthead-avatar mb-5" src="assets/img/logoM.png" alt="" /><!-- Masthead Heading-->
                <h1 class="masthead-heading text-uppercase mb-0">MemePlanet</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
				<!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0">La nouvelle application pour partager vos memes et voir ceux de vos amis ou du monde entier !</p>
            </div>
        </header>
        <!-- Portfolio Section-->
        <section class="page-section portfolio" id="galerie">
            <div class="container">
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">ajouter une photo</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
				</div>
			<form action="ajouter.php" method="post" enctype="multipart/form-data">
				<label class="font-weight-bold" for="nomFich">telecharger une image:</label>
				<input type="file" name="nomFich" id="update">
				<br>
				<br>
				<label for="description">description de l'image:</label>
				<textarea id="description" name="description" rows="4" cols="50" required></textarea>
				<br>
				<br>
				<label>Choisir une categorie:</label>
				<SELECT id="categorie" name="categorie">
                        <?php
                            require_once("fonctions/requetesql.php");
                            $link = getConnection("localhost", "root", "", "ProjetBDW");
                            RecupImageCategorie($link);
							closeConnexion($link);
                        ?>
				    </SELECT>
				<br>
				<input type="submit" value="envoyer" name="submit">
			</form>
            </div>
	</body>
</html>
