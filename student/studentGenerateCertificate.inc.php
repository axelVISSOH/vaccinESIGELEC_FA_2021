<?php    
    require_once("../bdd/bddconection.inc.php");//connection to the database
    $req = $bdd->prepare('SELECT aptm_nch_id FROM appointment_aptm WHERE aptm_vst_mail = ?');
    $req -> execute(array($_SESSION['mail']));
    while($res = $req->fetch()){
        $req1 = $bdd-> prepare('SELECT * FROM niche_nch WHERE nch_id = ?');
        $req1 -> execute(array($res['aptm_nch_id']));
        while($res1 = $req1 -> fetch()){
            $today = date("Y-m-d");
            if( $res1['nch_date'] >= $today ){
                $req2 = $bdd->prepare('UPDATE appointment_aptm SET aptm_state ="Past" WHERE aptm_vst_mail = ?');
                $req2 -> execute(array($_SESSION['mail']));    
            }
        }    
    }
?>