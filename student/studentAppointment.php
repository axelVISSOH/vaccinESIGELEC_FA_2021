<?php
    session_start();
    require_once("../bdd/bddconection.inc.php");//connection to the database
    $req = $bdd->query('SELECT * FROM niche_nch');
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
        <?php
            echo '<div class="alert alert-success">
                                <strong>Welcome Back: </strong>'.$_SESSION['surname'].' '.$_SESSION['name'].'.
                            </div>';
        ?>
        <?php 
            if(isset($_GET['a'])){
                echo '<div class="alert alert-success">
                            <p><a hrel="../student/studentApointment.php"><<--Return</a></p>
                            <strong>Congratulation !!!</strong> You take the appointment. Be there on time the d-day.
                      </div>';
                $req = $bdd -> prepare('INSERT INTO appointment_aptm (aptm_nchid, aptm_vstmail, aptm_state)');
            }else{?>
                <div class="container">
                    <table class="table table-bordered table-dark" style="overflow-y=scroll;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Doctor Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Vaccine</th>
                                <th scope="col">Choose</th>                                    
                            </tr>
                        </thead>
                        <tbody>
                    <?php 
                        while($res = $req->fetch()){
                            $req1 = $bdd->prepare('SELECT vst_name, vst_surname FROM visitor_vst WHERE vst_mail = ? ');
                            $req1 -> execute(array($res['nch_vst_mail']));
                            $res1 = $req1 -> fetch();
                            $hour = explode(':',$res['nch_hour']);
                            echo '<tr>
                                    <th scope="row">'.$res['nch_id'].'</th>
                                    <td>'.$res1['vst_name'].' '.$res1['vst_surname'].'</td>
                                    <td>'.$res['nch_date'].'</td>
                                    <td>'.$hour[0].':'.$hour[1].'</td>
                                    <td>'.$hour[2].':'.$hour[3].'</td>
                                    <td>'.$res['nch_vcn'].' '.'</td>
                                    <td><p> <a href="../student/studentAppointment.php?a=rdvT"> Choose </a></p></td>
                                </tr>';
                        }
                    ?>
                        </tbody>
                    </table>
                </div>;
            <?php } ?>
        

        <!--footer-->
        <?php include("../home/footer.php")?>
        <!---end footer-->
    </body>
</html>



