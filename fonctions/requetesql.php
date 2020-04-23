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
                $query = "SELECT nomFich FROM Photo";
            }
            else
            {
                $query = "SELECT photoId,nomFich FROM `Photo` WHERE catId =$Idcategorie; ";
            }
        }
        $resultat = executeQuery($link, $query);
        $i = 0;
        foreach($resultat as $r)
        {
            echo '<img src="assets/img/'.$r['nomFich'].'"/> ';
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