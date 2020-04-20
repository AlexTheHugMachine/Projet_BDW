<?php
$target_dir = "assets/img/";
$target_image = $target_dir . basename($_imageS["update"]["name"]);
$uploadOk = 1;
$imageimageType = strtolower(pathinfo($target_image,PATHINFO_EXTENSION));
// Vérifier si l'image est une image réelle ou une fausse image
if(isset($_POST["submit"])) {
    $check = getimagesize($_imageS["update"]["tmp_name"]);
    if($check !== false) {
        echo "le fichier est une image " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "le fichier n'est pas une image.";
        $uploadOk = 0;
    }
}
// Vérifier si l'image existe déjà
if (image_exists($target_image)) {
    echo "Désolé, l'image existe déjà.";
    $uploadOk = 0;
}
// Vérifier la taille de l'image
if ($_imageS["update"]["size"] > 100000) {
    echo "Désolé, votre image est trop grande.";
    $uploadOk = 0;
}
// Autoriser certains formats d'images
if($imageimageType != "png" && $imageimageType != "jpeg" && $imageimageType != "gif" ) {
    echo "Désolé, seules les imagesJPEG, PNG et GIF sont autorisées";
    $uploadOk = 0;
}
// Vérifiez si $uploadOk est mis à 0 par une erreur
if ($uploadOk == 0) {
    echo "Désolé, votre image n'a pas été téléchargée";
// if everything is ok, on telecharge l'image
} else {
    if (move_uploaded_image($_imageS["update"]["tmp_name"], $target_image)) {
        echo "limage ". basename( $_imageS["update"]["name"]). " a été mis en téléchargée.";
    } else {
        echo "Désolé, il y a eu une erreur lors du téléchargement de votre image.";
    }
}
?>
<?php
	include_once('./fonctions/bd.php');
	include_once('./fonctions/utilisateur.php');
    // Si le bouton de téléchargement est cliqué ...
	if (isset($_POST['upload'])) {
  	// Get le nom de l'image
  	$nomFich = $_FILES['nomFich']['name'];
  	// Get la description de l'image
  	$description = mysqli_real_escape_string($db, $_POST['description']);
	//get la categorie
	//$catId=
  	// répertoire du fichier d'images
  	$target = "assets/img/".basename($nomFich);

  	$sql = "INSERT INTO images (nomFich, description) VALUES ('$nomFich', '$description')";
  	// executer query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['nomFich']['tmp_name'], $target)) {
  		$msg = "Image téléchargée avec succès";
  	}else{
  		$msg = "Impossible de télécharger l'image";
  	}
  }
  $result = mysqli_query($db, "SELECT * FROM images");
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
				telecharger une image:
				<input type="file" name="update" id="update">
				<br>
				<br>
				<label for="texte">description de l'image:</label>
				<textarea id="texte" rows="4" cols="50" required></textarea>
				<br>
				<br>
				<label>Choisir une categorie:</label>
				<SELECT name="categorie" size="1" required>
				<OPTION>none
				<OPTION>none
				<OPTION>none
				<OPTION>none
				</SELECT>
				<br>
				<input type="submit" value="envoyer" name="submit">
			</form>
            </div>
			
	</body>
</html>
