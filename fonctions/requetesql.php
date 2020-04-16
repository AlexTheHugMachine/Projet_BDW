<?php

    require_once("bd.php");
    require_once("utilisateur.php");

    function afficheimage($link)
    {
        $requete = "SELECT nomFich FROM Photo";
        $var = executeQuery($link, $requete);
        return $var;
    }

?>