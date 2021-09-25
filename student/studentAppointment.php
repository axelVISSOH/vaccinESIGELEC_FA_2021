<?php
    session_start();
    require_once("../bdd/bddconection.inc.php");//connection to the database
    $req = $bdd->query('SELECT * FROM niche_nch');

    function correctTime($h1,$h2,$m1,$m2){//Verify if the newHour is good 

        if($h2<$h1)
            return false;
        else if($h2==$h1){
            if($m2<=$m1)
                return false;
            else{
                if($m2-$m1<15)
                    return false;
                else
                    return true;
            }
        }
        else{
            if($h2-$h1==1){
                if((60-$m1)+$m2>=15)
                    return true;
                else    
                    return false;
            }
            else
                return true;
        }
    }
    function changeHour($hour,  $id, $bdd){//charge the doctor niche
        $hours = explode(':',$hour);
        $h1 = (int)$hours[0];
        $m1 = (int)$hours[1];
        $h2 = (int)$hours[2];
        $m2 = (int)$hours[3];        
        $newhour = '';
        if((($m1+15)<60))
            $newhour = $h1.':'.($m1+15).':'.$h2.':'.$m2;
        elseif($m1+15==60)
            $newhour = ($h1+1).':'.($m1-$m1).':'.$h2.':'.$m2;
        else
            $newhour = ($h1+1).':'.($m1-45).':'.$h2.':'.$m2;

        $hours = explode(':',$newhour);
        if(correctTime( (int)$hours[0], (int)$hours[1], (int)$hours[2], (int)$hours[3]) ){
            $req = $bdd->prepare('UPDATE niche_nch SET nch_hour=? WHERE nch_id = ?');
            $req->execute(array( (int)$hours[0].':'.(int)$hours[1].':'. (int)$hours[2].':'. (int)$hours[3], $id));
        }else{
            $req = $bdd->prepare('DELETE FROM niche_nch WHERE nch_id = ?');
            $req->execute(array($id));
        }
    }
    function verifyAppointment($bdd, $idnch){//if the Appointment is good to take 
        $row = 0;
        $row1 = 0;      
        $req = $bdd -> prepare('SELECT nch_date FROM niche_nch WHERE nch_id = ?');
        $req -> execute(array($idnch));
        $datench = $req-> fetch();
        
        $req = $bdd -> prepare('SELECT aptm_nch_id FROM appointment_aptm WHERE aptm_vst_mail = ?');
        $req -> execute(array($_SESSION['mail']));        
        while($res = $req -> fetch()){
            $row++;
            $req1 = $bdd -> prepare('SELECT nch_date FROM niche_nch WHERE nch_id = ?');
            $req1 -> execute(array($res['aptm_nch_id']));
            $dateaptm = $req1 -> fetch();
            if( $dateaptm['nch_date'] == $datench['nch_date'] ){
                $row1++;
            }
        }     
        
        while($res = $req -> fetch()){
            $row++;
        }
        if($row!=0)
            if( $row1 !=0 )
                return false;//appointment already taken 
            else
                return true;
        else
            return true;//there is no appointment for the moment
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
        <?php
            echo '<div class="alert alert-success">
                                <strong>Welcome Back: </strong>'.$_SESSION['surname'].' '.$_SESSION['name'].'.
                            </div>';
            echo '<p class="container">
                    Choose niche to take an appointment.
                  </p>';
        ?>
        <?php 
            if(isset($_GET['a'])){
                $id = explode('_',$_GET['a']);
                if(verifyAppointment($bdd, (int)$id[1])){
                    $req = $bdd -> prepare('INSERT INTO appointment_aptm (aptm_nch_id, aptm_vst_mail, aptm_state) VALUES (?,?,?)');
                    $req -> execute(array((int)$id[1], $_SESSION['mail'], "Waiting"));
                    echo '<div class="alert alert-success">
                            <p><a href="../student/studentAppointment.php"><<--Return</a></p>
                            <strong>Congratulation !!!</strong> You have taken an appointment. Be there on time the d-day.
                      </div>';
                    $req1 = $bdd->prepare('SELECT nch_hour FROM niche_nch WHERE nch_id = ? ');
                    $req1 -> execute(array((int)$id[1]));
                    $res1 = $req1 -> fetch();                                                      
                    changeHour($res1['nch_hour'], (int)$id[1], $bdd);
                }
                else{
                    echo '<div class="alert alert-danger">
                            <p><a href="../student/studentAppointment.php"><<--Return</a></p>
                            <strong>Error ...</strong> You can\'t choose an appointment you\'ve already taken or the same day.
                          </div>';
                }
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
                                    <td><p> <a href="../student/studentAppointment.php?a=rdvT_'.$res['nch_id'].'"> Choose </a></p></td>
                                </tr>';
                        }
                    ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
    </body>
</html>