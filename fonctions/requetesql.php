<?php

    require_once("bd.php");
    require_once("utilisateur.php");

    // On crée une fonction permettant de récupérer les différentes catégories et les images correspondantes aux catégories
    function RecupImageCategorie($link)
    {
        $query = "SELECT * FROM `Categorie` ";
        $result = executeQuery($link, $query);
        foreach($result as $Cat){
            echo "<OPTION value='".$Cat['catId']."'>".$Cat['nomCat']."</OPTION>";
        }
    }

    // On crée une fonction qui va afficher les images d'une catégorie séléctionnée
    function AfficherImageCategorie($Idcategorie, $link)
    {
        if(isset($_POST['Valider']))
        {
            $image=$_POST['categorie'];
            // On gère le cas où la catégorie "Tout" est séléctionnée, car nous avons créé cette option directement dans la page car elle n'est pas présente dans la base de donnée
            if($image=='Tout')
            {
                $query = "SELECT C.nomCat, P.nomFich, P.description FROM Photo P JOIN Categorie C ON C.catId=P.catId; ";
            }
            else
            {
                $query = "SELECT C.nomCat, P.photoId, P.nomFich, P.description FROM Photo P JOIN Categorie C ON C.catId=P.catId WHERE P.catId =$Idcategorie; ";
            }
        }
        $resultat = executeQuery($link, $query);
        $i = 0;
        // On crée des modals propre à chaque image qui s'afficheront lorsque l'on clique sur une image. Elles indiqueront leur nom, leur description ainsi que leur catégorie
        foreach($resultat as $r)
        {
            echo '<img src="assets/img/'.$r['nomFich'].'" data-toggle="modal" data-target="#'.$r['nomFich'].'" type="button" class="card card-tall"/>
            </img>
            <div class="modal fade" id="'.$r['nomFich'].'">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="width:650px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> '.$r['nomFich'].'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="assets/img/'.$r['nomFich'].'"  style="width: 250px;height: 250px;margin-right:20px;" align="left">

                            <div>Nom de la photo: '.$r['nomFich'].'</div>
                            </br>
                            <div>Sa description: '.$r['description'].'</div>
                            </br>
                            <div>Et sa catégorie: '.$r['nomCat'].'</div>
                        </div>
                    </div>
                </div>
            </div>';
            $i = $i+1;
        }
    }

    //On crée une fonction pour afficher toutes les images pour que lorsqu'aucune option n'est encore séléctionnée (par exemple lorsque l'on vient de charger la page), on affiche toute les images
    function AfficherToutesLesImages()
    {
        $link = getConnection("localhost", "root", "", "ProjetBDW");
        $query = "SELECT C.nomCat, P.nomFich, P.description FROM Photo P JOIN Categorie C ON C.catId=P.catId; ";
        $resultat = executeQuery($link, $query);
        $i = 0;

        foreach($resultat as $r)
        {
            echo '<img src="assets/img/'.$r['nomFich'].'" data-toggle="modal" data-target="#'.$r['nomFich'].'" type="button" class="card card-tall"/>
            </img>
            <div class="modal fade" id="'.$r['nomFich'].'">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="width:650px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> '.$r['nomFich'].'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="assets/img/'.$r['nomFich'].'"  style="width: 250px;height: 250px;margin-right:20px;" align="left">

                            <div>Nom de la photo: '.$r['nomFich'].'</div>
                            </br>
                            <div>Sa description: '.$r['description'].'</div>
                            </br>
                            <div>Et sa catégorie: '.$r['nomCat'].'</div>
                        </div>
                    </div>
                </div>
            </div>';
            $i = $i+1;
        }
    }
?>