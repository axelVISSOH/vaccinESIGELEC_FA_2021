<?php
    session_start();
    require_once("../bdd/bddconection.inc.php");//connection to the database
    require_once("../student/studentGenerateCertificate.inc.php");//load the past appointment

    function changeHour($hour,  $id, $bdd){//charge the doctor niche
        $hours = explode(':',$hour);
        $h1 = (int)$hours[0];
        $m1 = (int)$hours[1];
        $h2 = (int)$hours[2];
        $m2 = (int)$hours[3];        
        $newhour = '';
        if((($m1-15)>0))
            $newhour = $h1.':'.($m1-15).':'.$h2.':'.$m2;
        elseif($m1-15==0)
            $newhour = $h1.':'.($m1-$m1).':'.$h2.':'.$m2;
        else
            $newhour = ($h1-1).':'.(45+$m1).':'.$h2.':'.$m2;

        $hours = explode(':',$newhour);
        $req = $bdd->prepare('UPDATE niche_nch SET nch_hour=? WHERE nch_id = ?');
        $req->execute(array( (int)$hours[0].':'.(int)$hours[1].':'. (int)$hours[2].':'. (int)$hours[3], $id));
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="student.css">
        <link rel="stylesheet" href="../home/home.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student</title>
    </head>
    <body>
        <!--header-->
            <?php include("../student/navbarStudent.php")?>
        <!---end header-->
        <?php if( isset($_SESSION['surname']) AND isset($_SESSION['name']) ){?>        
        <?php
            echo '<div class="alert alert-success">
                                <strong>Welcome Back: </strong>'.$_SESSION['surname'].' '.$_SESSION['name'].'.
                            </div>';
            echo '<p class="container">
                    Delete or download your Certificates.
                  </p>';
        ?>
        <?php
        if(isset($_GET['a'])){
                $id = explode('_',$_GET['a']);
                if($id[0]=="D"){
                    $req = $bdd -> prepare('DELETE FROM appointment_aptm WHERE aptm_nch_id = ?');
                    $req -> execute(array((int)$id[1]));
                    echo '<div class="alert alert-success">
                            <p><a href="../student/studentAppointment.php"><<--Return</a></p>
                            <strong>You\'ve just deleted an appointement !!!</strong>You can go back to choose another one by clic on the return link.
                         </div>';                                                      
                    changeHour($id[2], (int)$id[1], $bdd);
                }
                else{
                    echo '<div class="alert alert-danger">
                            <p><a href="../student/studentAppointment.php"><<--Return</a></p>
                            <strong>Error ...</strong> You can\'t choose an appointment you\'ve already taken or the same day.
                          </div>';
                }
            }else{?>
            <div class="container">            
                <div id="accordion">
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                Your Scheduled Appointment.
                            </a>                    
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <div class="container">
                                    <table class="table table-bordered table-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">From</th>
                                                <th scope="col">To</th>
                                                <th scope="col">Vaccine</th>
                                                <th scope="col">Delete</th>                                    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $req = $bdd->prepare('SELECT aptm_nch_id, aptm_hour FROM appointment_aptm WHERE aptm_vst_mail = ?');
                                                $req -> execute(array($_SESSION['mail']));
                                                while($res = $req->fetch()){
                                                    $req1 = $bdd-> prepare('SELECT * FROM niche_nch WHERE nch_id = ?');
                                                    $req1 -> execute(array($res['aptm_nch_id']));
                                                    while($res1 = $req1 -> fetch()){
                                                        $today = date('Y-m-d');
                                                        if( $res1['nch_date'] >= $today){
                                                            $hour = explode(':',$res['aptm_hour']);
                                                            echo '<tr>
                                                                    <th scope="row">'.$res1['nch_id'].'</th>
                                                                    <td>'.$res1['nch_date'].'</td>
                                                                    <td>'.$hour[0].':'.$hour[1].'</td>
                                                                    <td>'.$hour[2].':'.$hour[3].'</td>
                                                                    <td>'.$res1['nch_vcn'].'</td>
                                                                    <td><p> <a href="../student/studentCertificates.php?a=D_'.$res1['nch_id'].'_'.$res1['nch_hour'].'"> Delete </a></p></td>
                                                                 </tr>';
                                                        }
                                                    }    
                                                }                                            
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#collapseTwo">
                                Your Certification.
                            </a>                    
                        </div>
                        <div id="collapseTwo" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <div class="container">
                                    <table class="table table-bordered table-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Certificates</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $req = $bdd->prepare('SELECT * FROM certificate_crft WHERE crft_path = ?');
                                                $req -> execute(array($_SESSION['mail'].'_certificate.pdf'));
                                                $row = 1;
                                                while($res = $req->fetch()){
                                                    echo '<tr>
                                                            <th scope="row">'.$row.'</th>
                                                            <td><p> <a href="../uploads/'.$res['crft_path'].'"> Download </a></p></td>
                                                        </tr>';
                                                    $row++;
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
        <?php 
                }
            }else{
                header('Location: ../log/login.php');//if session is not set       
            }
        ?>          
    </body>
</html>