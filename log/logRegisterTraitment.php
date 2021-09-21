<?php
session_start();//starting the session
require_once("../bdd/bddconection.inc.php");//connection to the database

        if ($_POST['form_function']=="logIn"){//verify if the receving form is for the login
            if(isset($_POST['mail']) AND isset($_POST['pswd'])){// verify if both mail and password is set before sending the form              
                $req = $bdd->prepare('SELECT vst_name, vst_surname, vst_pass, vst_type FROM visitor_vst WHERE vst_mail = ?');
                $req->execute(array($_POST['mail']));
                $response = $req->fetch();
                if(!$response){
                    header('Location: ../log/login.php?error=not_registered');//no  email found in the database
                }
                else{
                    if(password_verify($_POST['pswd'], $response['vst_pass'])){//only if the password matches
                        //session variable to recongnze the visitor
                        $_SESSION['name'] = htmlspecialchars($response['vst_name']);
                        $_SESSION['surname'] = htmlspecialchars($response['vst_surname']);
                        $_SESSION['mail'] = htmlspecialchars($_POST['mail']);
                        if($response['vst_type']=="student"){
                            header('Location: ../student/studentNiche.php');//go to the main student page
                        }
                        elseif($response['vst_type']=="medecin"){
                            header('Location: ../medecin/medecinCreateNiche.php');//go to the main medecin page
                        }
                        else{
                            header('Location: ../admin/adminMedecin.php');//go to the admin page
                        }                            
                    }
                    else{   
                        header('Location: ../log/login.php?error=dont_match');//Both password don't not match
                    }                    
                }
            }  
        }
        else{// this is for the signup receving form
            if(isset($_POST['name']) AND isset($_POST['surname']) AND isset($_POST['phone']) AND isset($_POST['birthdate']) AND isset($_POST['mail']) AND isset($_POST['confirmmail']) AND isset($_POST['pswd']) AND isset($_POST['confirmpswd'])){
                if($_POST['mail']==$_POST['confirmmail']){
                    if($_POST['pswd']==$_POST['confirmpswd']){
                        $pass_hache = password_hash($_POST['pswd'], PASSWORD_DEFAULT);
                        $date = explode('/',$_POST['birthdate']); 
                        $req = $bdd->prepare('INSERT INTO visitor_vst (vst_mail, vst_pass, vst_phone, vst_birthDate, vst_type, vst_name, vst_surname) VALUES(?,?,?,?,?,?,?) ');
                        $req->execute(array($_POST['mail'],$pass_hache,$_POST['phone'], ''.$date[2].'-'.$date[1].'-'.$date[0].'',"student",$_POST['name'],$_POST['surname']));
                        header('Location: ../log/login.php?error=not');
                    }
                    else{
                        header('Location: ../log/signup.php?error=pass');//pass & confirm pass not the same
                    }
                }
                else{
                    header('Location: ../log/signup.php?error=mail');//mail & confirm mail not the same
                }
            }
            else{
                header('Location: ../log/signup.php?error=missing');//some field are not set                
            } 
        }
    ?>
    