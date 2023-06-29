<?php

$nomAdh = get_nomMembre();
$prenomAdh = get_nomMembre();

if(isset($_POST["boutonAfficher"]))
{
    header('Location: '."index.php?page=tabordfed");
}

?>