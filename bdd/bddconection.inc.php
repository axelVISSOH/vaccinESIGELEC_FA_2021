<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=sitevaccin;charset=utf8','root','Doublefuck24',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e){ 
    die('Error:'.$e->getMessage());
}
?>