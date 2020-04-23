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

    function AfficherImageCategorie($link)
    {
        if(isset($_POST['Valider']))
        {
            $image=$_POST['categorie'];
            $query = "SELECT C.nomCat, P.nomFich, P.catId, P.description FROM Photo P join Categorie C ON C.catId=P.catId ;";
            /*if(($image==''))
            {
                $query = "SELECT C.nomCat, P.nomFich, P.catId, P.description FROM Photo P join Categorie C ON C.catId=P.catId ;";
            }
            else
            {
                $query = 'SELECT C.nomCat, P.nomFich, P.catId, P.description FROM Photo P join Categorie C ON C.catId=P.catId ;';
            }*/
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