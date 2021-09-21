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
                    case "week_end":
                        echo '<div class="alert alert-warning">
                            <strong>You can\'t make a niche on weekend</strong> Please change the date.
                          </div>';
                    break;
                    case "nicheTaken":
                        echo '<div class="alert alert-warning">
                            <strong>You\'ve already have a niche sheduled at date date and time.</strong> Please change the date or fix the hour.
                          </div>';
                    break;
                    case "null":
                        echo '<div class="alert alert-success">
                            <strong>Congratulation</strong> Your niche has been scheduled.
                          </div>';
                    break;
                    case "hours":
                        echo '<div class="alert alert-warning">
                            <strong>You can\'t choose an end time less than the start time.</strong> Please fix the time.
                          </div>';
                    break;
                    case "missing":
                        echo '<div class="alert alert-warning">
                            <strong>Lack of Informations </strong> Please fill all the fields.
                          </div>';
                    break;
                    case "dateFormat":
                        echo '<div class="alert alert-danger">
                            <strong>Bad date format !!!</strong> Please respect the date format.
                          </div>';
                    break;
                    default: break;
                }
            }
        ?> 
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
                            <form action="../medecin/nicheTraitment.php" method="post" class="was-validated">
                                <div class="form-group">
                                    <input type="date" placeholder="Niche date: Ex=03/11/2010" class="form-control" name="nicheDate" required/>
                                </div>
                                <div class="form-group">
                                    <p>From</p>
                                    <input type="number" min="8" max="18" name="hour1"/><label> H </label><input type="number" min="0" max="59" name="min1"/>
                                    <p>to</p>
                                    <input type="number" min="8" max="18" name="hour2"/><label> H </label><input type="number" min="0" max="59" name="min2"/>                        
                                </div>                     
                                <input name="form_function" type="hidden" value="createniche">   
                                <?php echo '<input name="mail" type="hidden" value='.$_SESSION['mail'].'/>';
                                    while( $res = $req->fetch()){
                                        echo '<input type="checkbox" name="vaccine" id="vaccineName" value="'.$res['vcn_name'].'"/><label for="vaccineName">'.$res['vcn_name'].'</label><br/>';
                                    }                                    
                                ?> 
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                            <?php //$res->closeCursor(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--footer-->
        <?php include("../home/footer.php")?>
        <!---end footer-->    
</body>
</html>