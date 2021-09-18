<?php
session_start();
require_once("../bdd/bddconection.inc.php");

        if ($_POST['form_function']=="logIn"){
            if(isset($_POST['mail']) AND isset($_POST['pswd'])){               
                $req = $bdd->prepare('SELECT vst_name, vst_surname, vst_pass FROM visitor_vst WHERE vst_mail = ?');
                $req->execute(array($_POST['mail']));
                $response = $req->fetch();
                if(!$response){
                    echo '<p>You\'re not Register.\n Find the register form bellow.</p>';
                }
                else{
                    if(password_verify($_POST['pswd'], $response['vst_pass'])){
                        $_SESSION['name'] = htmlspecialchars($response['vst_name']);
                        $_SESSION['surname'] = htmlspecialchars($response['vst_surname']);
                        header('Location: ../student/studentPage.php'); 
                    }
                    else{?>
                        <script>
                            alert('Wrong identifiers');
                            header('Location: ../log/login.php');
                        </script>
    <?php
                        echo '<script> alert(\'Wrong identifiers\');
                                </script>';
                        header('Location: ../log/login.php');
                    }
                    
                }
            }  
        }
        else{
            if(isset($_POST['name']) AND isset($_POST['surname']) AND isset($_POST['phone']) AND isset($_POST['birthdate']) AND isset($_POST['mail']) AND isset($_POST['confirmmail']) AND isset($_POST['pswd']) AND isset($_POST['confirmpswd'])){
                if($_POST['mail']==$_POST['confirmmail'] AND $_POST['pswd']==$_POST['confirmpswd']){
                    $pass_hache = password_hash($_POST['pswd'], PASSWORD_DEFAULT);
                    $date = explode('/',$_POST['birthdate']); 
                    $req = $bdd->prepare('INSERT INTO visitor_vst (vst_mail, vst_pass, vst_phone, vst_birthDate, vst_type, vst_name, vst_surname) VALUES(?,?,?,?,?,?,?) ');
                    $req->execute(array($_POST['mail'],$pass_hache,$_POST['phone'], ''.$date[2].'-'.$date[1].'-'.$date[0].'',"student",$_POST['name'],$_POST['surname']));
                    header('Location: ../log/login.php'); 
                    echo "you're registered"; 
                }
                else{
                    header('Location: ../log/login.php');
                    echo "Informations don't match"; 
                }
            }
            else{
                echo "Fill all the fields";
                header('Location: ../log/login.php'); 
            } 
        }
    ?>
    