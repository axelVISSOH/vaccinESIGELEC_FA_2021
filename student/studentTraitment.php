<?php
    session_start();//starting the session
    require_once("../bdd/bddconection.inc.php");//connection to the database
    $req = $bdd->prepare('SELECT dmd_date, dmd_state FROM demand_dmd WHERE dmd_vst_mail= ? ');
    $req -> execute(array($_SESSION['mail']));
    $res = $req->fetch();

    if(!$res){
        if($_POST['form_function'] == "studentBeDoctor"){
            if (isset($_FILES['file']) AND $_FILES['file']['error'] == 0){//test if the file is send & if there is no error
                // test if the file is voluminous
                if ($_FILES['file']['size'] <= 1000000){
                    // test if the extension is allowed
                    $fileInfo = pathinfo($_FILES['file']['name']);
                    $extensionUpload = $fileInfo['extension'];
                    $extensionsAllowed = array('pdf');
                    if (in_array($extensionUpload, $extensionsAllowed)){
                        move_uploaded_file($_FILES['file']['tmp_name'],'../uploads/'.basename(''.$_SESSION['mail'].'_file.pdf'));
                        $req = $bdd->prepare('INSERT INTO demand_dmd (dmd_vst_mail, dmd_doc, dmd_date, dmd_info, dmd_state) VALUES(?,?,?,?,?)');
                        $req->execute(array($_SESSION['mail'],''.$_SESSION['mail'].'_file.pdf', date('Y-m-d'), $_POST['info'], "In Progress"));
                        header('Location: ../student/studentBeDoctor.php?error=success');//if everything was good
                    }
                    else{
                        header('Location: ../student/studentBeDoctor.php?error=extension');//if the extension is not good
                    }
                }else{
                    header('Location: ../student/studentBeDoctor.php?error=size');//if the size is too voluminous
                }
            }else{
                $_SESSION['error']=$_FILES['file']['error'];
                header('Location: ../student/studentBeDoctor.php?error=error');//if the file is not sent or ther is a php error
            }
        }
        
    }else{
        header('Location: ../student/studentBeDoctor.php?error=already');//if there is already a demand for this mail.
        $_SESSION['date'] = $res['dmd_date'];
        $_SESSION['state'] = $res['dmd_state'];
    }
    
    /*Lorsque vous mettrez le script sur Internet à l'aide d'un logiciel FTP, vérifiez que le dossier « uploads » sur le serveur existe et qu'il a les droits d'écriture. Pour ce faire, sous FileZilla par exemple, faites un clic droit sur le dossier et choisissez « Attributs du fichier ».
Cela vous permettra d'éditer les droits du dossier (on parle de CHMOD). Mettez les droits à 733, ainsi PHP pourra placer les fichiers uploadés dans ce dossier. */
?>