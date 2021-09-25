<?php
    session_start();//starting the session
    require_once("../bdd/bddconection.inc.php");//connection to the database
    $req = $bdd->query('SELECT dmd_id, dmd_vst_mail, dmd_doc, dmd_date, dmd_info FROM demand_dmd');
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="admin.css">
        <link rel="stylesheet" href="../home/home.css">    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AdminMedecin</title>
    </head>
    <body>
        <!--header-->
        <?php include("../admin/navbarAdmin.php")?>
        <!---end header-->
        <?php
            echo '<div class="alert alert-success">
                    <strong>Administrator: </strong>'.$_SESSION['surname'].' '.$_SESSION['name'].'.
                  </div>';
            echo '<p class="container">
                    Verify the informations and choose the best healthcare professional.
                  </p>';
        ?>
        
        <?php 
            if(isset($_GET['view']) AND isset($_GET['f'])){//if the admin want to see the file
                echo '<p><a href="../admin/adminMedecin.php"> <<--Return </a></p></br>';                
                echo '<embed class="container" src="../uploads/'.$_GET['f'].'" width="800px" height="350px" type=\'application/pdf\'/>';
            }else{//if the admin accept or reject
                if( isset($_GET['action']) AND isset($_GET['f1']) ){                                            
                    $f1 = explode('_',$_GET['f1']);
                    switch ($_GET['action']){
                        case 1:
                            $req1 = $bdd->query('UPDATE visitor_vst SET vst_type=\'medecin\' WHERE vst_mail=\''.$f1[0].'\'');                            
                            echo '<div class="alert alert-success">
                                    <strong>You\'ve just accepted the demand !!!</strong> The new Doctor will be notified.
                                  </div></br>
                                  <p><a href="../admin/adminMedecin.php"><<--Return </a></p>';
                        break;
                        case 0:
                            echo '<div class="alert alert-info">
                                    <strong>You\'ve just rejected the demand !!!</strong> The visitor will be notified.
                                 </div></br>
                                  <p><a href="../admin/adminMedecin.php"><<--Return </a></p>';                           
                        break;
                        default: break;
                    }
                    $req1 = $bdd->query('DELETE FROM demand_dmd WHERE dmd_vst_mail=\''.$f1[0].'\'');
                }else{?>
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Firstname</th>
                            <th scope="col">Date</th>
                            <th scope="col">Others Informations</th>
                            <th scope="col">File</th>
                            <th scope="col">Action</th>                    
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while($res = $req->fetch()){
                                $req1 = $bdd->prepare('SELECT vst_name, vst_surname FROM visitor_vst WHERE vst_mail= ? ');
                                $req1 -> execute(array($res['dmd_vst_mail']));
                                $res1 = $req1->fetch();
                                echo '<tr>
                                        <th scope="row">'.$res['dmd_id'].'</th>
                                        <td>'.$res1['vst_name'].'</td>
                                        <td>'.$res1['vst_surname'].'</td>
                                        <td>'.$res['dmd_date'].'</td>
                                        <td>'.$res['dmd_info'].'</td>
                                        <td><p> <a href="../admin/adminMedecin.php?view=1&f='.$res['dmd_doc'].'"> View </a> <a href="../uploads/'.$res['dmd_doc'].'">Download</a> </p></td>
                                        <td><p> <a href="../admin/adminMedecin.php?action=1&f1='.$res['dmd_doc'].'"> Accept </a>  <a href="../admin/adminMedecin.php?action=0&f1='.$res['dmd_doc'].'"> Refuse </a> </p></td>
                                    </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            <?php } } ?>
    </body>
</html>