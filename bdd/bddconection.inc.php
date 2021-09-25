<?php
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=sitevaccin;charset=utf8','root','Doublefuck24',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));//for me
        //$bdd = new PDO('mysql:host=localhost;dbname=bdd_16_4;charset=utf8','grp_16_4','Deeshu4Ai8',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));//for school
    }catch(Exception $e){ 
        die('Error:'.$e->getMessage());
    }
?>