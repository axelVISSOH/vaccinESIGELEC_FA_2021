<?php
    session_start();
    require_once("../bdd/bddconection.inc.php");
    $req = $bdd ->query('SELECT vcn_name FROM vaccine_vcn');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="medecin.css">
        <link rel="stylesheet" href="../home/home.css">    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <title>Medecin</title>
    </head>
    <body>
        <!--header-->
        <?php include("../medecin/navbarMedecin.php")?>
        <!---end header-->
            <?php
                echo '<div class="alert alert-success">Welcome Back Dr
                                <strong>'.$_SESSION['surname'].' '.$_SESSION['name'].'</strong>
                            </div>';
                if(isset($_GET['error'])){
                    switch ($_GET['error']){
                        case 'success':
                            echo '<div class="alert alert-success">
                                    <p><a href="../medecin/medecinCertificates.php"><<--Return</a></p>
                                    <strong>Certificate sent !!!</strong>
                                </div>';
                        break;
                        case 'extension':
                            echo '<div class="alert alert-warning">
                                <p><a href="../medecin/medecinCertificates.php"><<--Return</a></p>
                                <strong>Extension did not match !</strong> Please send us a pdf or a word with all needed informations.
                            </div>';
                        break;
                        case 'size':
                            echo '<div class="alert alert-info">
                                    <p><a href="../medecin/medecinCertificates.php"><<--Return</a></p>                            
                                    <strong>File size !!!</strong> Your file is too voluminous(send a file under 5Mo).
                                </div>';
                        break;
                        case 'error':
                            echo '<div class="alert alert-danger">
                                    <p><a href="../medecin/medecinCertificates.php"><<--Return</a></p>
                                    <strong>ERROR !!!</strong> There was an error. Try again please.
                                  </div>';
                        break;
                        case 'already':
                            echo '<div class="alert alert-info">
                                    <p><a href="../medecin/medecinCertificates.php"><<--Return</a></p>                            
                                    <strong>You\'ve already sent the certificate.</strong>
                                 </div>';
                        break;
                        default: break;
                    }
                }
                else{?>
                    <div class="container">            
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                        Add a Niche.
                                    </a>                    
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                    <div class="card-body">                                        
                                         <div class="container">
                                            <table class="table table-bordered table-dark" style="overflow-y=scroll;">
                                                <thead>
                                                    <tr>                                                
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Patient Name</th>
                                                        <th scope="col">Vaccine</th>
                                                        <th scope="col">Certificates</th>                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $req = $bdd->prepare('SELECT aptm_id, nch_date, nch_vcn, aptm_vst_mail FROM appointment_aptm 
                                                                            INNER JOIN niche_nch ON ( aptm_nch_id = nch_id) 
                                                                            WHERE aptm_state = "Past" AND nch_vst_mail = ?');
                                                        $req -> execute(array($_SESSION['mail']));
                                                        while($res = $req->fetch()){
                                                            $req1 = $bdd-> prepare('SELECT vst_name, vst_surname  FROM visitor_vst WHERE vst_mail = ?');
                                                            $req1 -> execute(array($res['aptm_vst_mail']));
                                                            $res1 = $req1-> fetch();                                                    
                                                            echo '<tr>
                                                                    <th scope="row">'.$res['nch_date'].'</th>
                                                                    <td>'.$res1['vst_name'].' '.$res1['vst_surname'].'</td>
                                                                    <td>'.$res['nch_vcn'].'</td>
                                                                    <td><form action="../medecin/nicheTraitment.php" method="post" enctype="multipart/form-data">
                                                                            <label for="file">Send the cetificate.</label>
                                                                            <input type="file" name="certificate" maxlength="250" id="file" required/>
                                                                            <input type="hidden" name="to" value="'.$res['aptm_vst_mail'].'">
                                                                            <input type="hidden" name="aptmId" value="'.$res['aptm_id'].'">
                                                                            <input type="hidden" name="form_function" value="certificate">                    
                                                                            <input type="submit" class="btn btn-primary" value="Send"/></td>
                                                                        </form>
                                                                </tr>';
                                                        }                                            
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>  

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?> 
    </body>
</html>