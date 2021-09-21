<?php
    session_start();
    require_once("../bdd/bddconection.inc.php");    
    function isWeekend($dates) {
        $date = ''.$dates[2].'-'.$dates[1].'-'.$dates[0];
        $weekDay = date('w', strtotime($date));
        if($weekDay == 0 || $weekDay == 6)
            return 1;
        else 
            return 0;
    }
    function correctTime($h1,$h2,$m1,$m2){
        if($h2<$h1)
            return false;
        else if($h2==$h1){
            if($m2<=$m1)
                return false;
            else{
                if($m2-$m1<30)
                    return false;
                else
                    return true;
            }
        }
        else{
            if($h2-$h1==1){
                if((59-$m1)+$m2>=30)
                    return true;
                else    
                    return false;
            }
            else
                return true;
        }
    }
    function correctDate($dates,$h2,$m2,$bdd){   
        if(isWeekend($dates)==1)
            return 1;//date is weekend
        $req = $bdd -> prepare('SELECT nch_hour FROM niche_nch WHERE nch_vst_mail = ? AND nch_date = ?');
        $req -> execute(array($_POST['mail'],''.$dates[2].'-'.$dates[1].'-'.$dates[0]));  
        while( $res = $req -> fetch() ){
            $hours = explode(':',$res['nch_hour']);
            if($hours[0]<$h2)
                return 11;//date & time already exist
            else if($hours[0] == $h2){
                if($hours[1]<$m2)
                    return 11;//date & time already exist
                else
                    return 0;//date exist but time is correct for a niche
            }                
        }
    }

    if($_POST['form_function']=="createniche"){// if the form for niche creation is send        
            if(isset($_POST['nicheDate']) AND isset($_POST['hour1']) AND isset($_POST['hour2']) AND isset($_POST['min1']) AND isset($_POST['min2']) AND isset($_POST['vaccine'])){
                $date = explode('/',$_POST['nicheDate']);               
                if(correctTime($_POST['hour1'], $_POST['hour2'], $_POST['min1'], $_POST['min2'])){
                    switch (correctDate($date, $_POST['hour2'], $_POST['min2'], $bdd)){
                        case 1:
                            header('Location: ../medecin/medecinCreateNiche.php?error=week_end');//if the date is in the weekend 
                        break;
                        case 11:
                            header('Location: ../medecin/medecinCreateNiche.php?error=nicheTaken');//if the niche is already in the db
                        break;
                        case 0:
                            $req = $bdd->prepare('INSERT INTO niche_nch (nch_vst_mail, nch_hour, nch_date, nch_vcn) VALUES (?,?,?,?)');
                            $req->execute(array($_POST['mail'], $_POST['hour1'].':'.$_POST['min1'].':'.$_POST['hour2'].':'.$_POST['min2'], ''.$date[2].'-'.$date[1].'-'.$date[0], $_POST['vaccine']));         
                            header('Location: ../medecin/medecinCreateNiche.php?error=null');
                        break;
                        default: break;
                    }
                }
                else{
                    header('Location: ../medecin/medecinCreateNiche.php?error=hours');
                }                           
            }
            else{
                header('Location: ../medecin/medecinCreateNiche.php?error=missing');//if some field were not fill
            }          
                  
    }
    else if($_POST['form_function']=="editniche") {//if the form for niche edition is send

    }
    else if($_POST['form_function']=="deleteniche") {//if the form for niche edition is send

    }

?>