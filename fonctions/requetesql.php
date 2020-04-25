<?php

    require_once("bd.php");
    require_once("utilisateur.php");

    function afficheimage($link)
    {
        $requete = "SELECT nomFich FROM Photo";
        $var = executeQuery($link, $requete);
        return $var;
    }

    function RecupImageCategorie($link)
    {
        $query = "SELECT * FROM `Categorie` ";
        $result = executeQuery($link, $query);
        foreach($result as $Cat){
            echo "<OPTION value='".$Cat['catId']."'>".$Cat['nomCat']."</OPTION>";
        }
    }

    function AfficherImageCategorie($Idcategorie, $link)
    {
        if(isset($_POST['Valider']))
        {
            $image=$_POST['categorie'];
            if($image=='Tout')
            {
                $query = "SELECT C.nomCat, P.nomFich,`description` FROM Photo P JOIN Categorie C ON C.catId=P.catId; ";
            }
            else
            {
                $query = "SELECT C.nomCat, P.photoId, P.nomFich,`description` FROM Photo P JOIN Categorie C ON C.catId=P.catId WHERE catId =$Idcategorie; ";
            }
        }
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

    function AfficherToutesLesImages()
    {
        $link = getConnection("localhost", "root", "", "ProjetBDW");
        $resultat = afficheimage($link);
        $i = 0;

        foreach($resultat as $r)
        {
            echo '<img src="assets/img/'.$r['nomFich'].'"/> ';
            $i = $i+1;
        }
    }
?>