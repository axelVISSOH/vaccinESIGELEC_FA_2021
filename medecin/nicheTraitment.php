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
        $today = new DateTime();  
        if(isWeekend($dates)==1)
            return 1;//date is weekend
        if($today>$dates)
            return 1;//date is past
        $req = $bdd -> prepare('SELECT nch_hour FROM niche_nch WHERE nch_vst_mail = ? AND nch_date = ?');
        $req -> execute(array($_POST['mail'],$dates));  
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
    function verifyCerticate($aptmid, $bdd){
        $row = 0;
        $req = $bdd -> prepare('SELECT * FROM certificate_crft WHERE crft_aptm_id = ?');
        $req -> execute((array((int)$aptmid)));
        while($res = $req -> fetch()){
            $row ++;
        }
        if($row != 0)
            return false;
        else
            return true;
    }

    if($_POST['form_function']=="createniche"){// if the form for niche creation is send        
            if(isset($_POST['nicheDate']) AND isset($_POST['hour1']) AND isset($_POST['hour2']) AND isset($_POST['min1']) AND isset($_POST['min2']) AND isset($_POST['vaccine'])){
               if(correctTime($_POST['hour1'], $_POST['hour2'], $_POST['min1'], $_POST['min2'])){
                    switch (correctDate($_POST['nicheDate'], $_POST['hour2'], $_POST['min2'], $bdd)){
                        case 1:
                            header('Location: ../medecin/medecinCreateNiche.php?error=week_end');//if the date is in the weekend 
                        break;
                        case 11:
                            header('Location: ../medecin/medecinCreateNiche.php?error=nicheTaken');//if the niche is already in the db
                        break;
                        case 0:
                            $req = $bdd->prepare('INSERT INTO niche_nch (nch_vst_mail, nch_hour, nch_date, nch_vcn) VALUES (?,?,?,?)');//''.$date[2].'-'.$date[1].'-'.$date[0]
                            $req->execute(array($_POST['mail'], $_POST['hour1'].':'.$_POST['min1'].':'.$_POST['hour2'].':'.$_POST['min2'], $_POST['nicheDate'], $_POST['vaccine']));         
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
    else if($_POST['form_function']=="certificate"){//if the form certifcate is send
        if(verifyCerticate($_POST['aptmId'], $bdd)){
            if (isset($_FILES['certificate']) AND $_FILES['certificate']['error'] == 0){//test if the file is send & if there is no error
                // test if the file is voluminous
                if ($_FILES['certificate']['size'] <= 1000000){
                    // test if the extension is allowed
                    $fileInfo = pathinfo($_FILES['certificate']['name']);
                    $extensionUpload = $fileInfo['extension'];
                    $extensionsAllowed = array('pdf');
                    if (in_array($extensionUpload, $extensionsAllowed)){
                        move_uploaded_file($_FILES['certificate']['tmp_name'],'../uploads/'.basename(''.$_POST['to'].'_certificate.pdf'));
                        $req = $bdd->prepare('INSERT INTO certificate_crft (crft_aptm_id, crft_path) VALUES(?,?)');
                        $req->execute(array($_POST['aptmId'],''.$_POST['to'].'_certificate.pdf'));
                        header('Location: ../medecin/medecinCertificates.php?error=success');//if everything was good
                    }
                    else{
                        header('Location: ../medecin/medecinCertificates.php?error=extension');//if the extension is not good
                    }
                }else{
                    header('Location: ../medecin/medecinCertificates.php?error=size');//if the size is too voluminous
                }
            }else{
                header('Location: ../medecin/medecinCertificates.php?error=error');//if the file is not sent or ther is a php error
            }
        }else{
            header('Location: ../medecin/medecinCertificates.php?error=already');//if there is already a certificate for that aptm
            
        }
        
    }
?>