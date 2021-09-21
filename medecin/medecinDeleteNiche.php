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
    <div>
        <!--header-->
        <?php include("../medecin/navbarMedecin.php")?>
        <!---end header-->
        <?php
            echo '<p>Welcome Back Dr '.$_SESSION['surname'].' '.$_SESSION['name'].'.</p>';
        ?> 
        <div class="container">
            <div id="accordion">                
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                            Delete a niche.
                        </a>
                    </div>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <?php 
                                $reqN = $bdd -> query('SELECT * FROM niche_nch');
                                echo '<ol>';
                                while( $resN = $reqN->fetch()){
                                    $hours = explode('_', $resN['nch_hour']);
                                    echo '<li>'.$resN['nch_date'].' '.$hours[0].' to '.$hours[1].' <a href="#">Delete</a></li>';
                                     
                                }
                                echo '</ol>';?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--footer-->
        <?php include("../home/footer.php")?>
        <!---end footer-->
    </div>                         
</body>
</html>