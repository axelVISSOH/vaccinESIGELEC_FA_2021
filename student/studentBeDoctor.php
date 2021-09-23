<?php
    session_start();
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
            if(isset($_GET['error'])){
                switch ($_GET['error']){
                    case 'success':
                        echo '<div class="alert alert-success">
                            <strong>Congratulation !!!</strong> You\'ll receive a mail when your request will be examinated.
                          </div>';
                    break;
                    case 'extension':
                        echo '<div class="alert alert-warning">
                            <strong>Extension did not match !</strong> Please send us a pdf or a word with all needed informations.
                          </div>';
                    break;
                    case 'size':
                        echo '<div class="alert alert-info">
                            <strong>File size !!!</strong> Your file is too voluminous(send a file under 5Mo).
                          </div>';
                    break;
                    case 'error':
                        echo '<div class="alert alert-danger">
                            <strong>ERROR !!!</strong> There was an error. Try again please.'.$_SESSION['error'].'
                          </div>';
                    break;
                    case 'already':
                        echo '<div class="alert alert-info">
                            <strong>You already made a demand on the </strong>'.$_SESSION['date'].' It\'s '.$_SESSION['state'].' You\'ll receive a mail when your request will be fully processed.
                          </div>';
                    break;
                    default: break;
                }
            }
        ?>
        <div>
            <!--<img src="../medecin/doctor.png" alt="A funny picture of a doctor.">-->
            <h1>Are you a Doctor ?...</h1>
            <p>We need some informations to change your personal area.</p>
        </div>  
        <div class="container sendinfo">               
                <h2 class="text-center">Send the Informations...</h2>  
                <form action="../student/studentTraitment.php" method="post" enctype="multipart/form-data">
                    <textarea name="info" placeholder="Tell us more" row="5" cols="30" required></textarea>
                    <label for="file">Send us a valid cetificate or a diploma.</label><input type="file" name="file" maxlength="250" id="file" required/></br>
                    <input type="hidden" name="form_function" value="studentBeDoctor">
                    <input type="submit" class="btn btn-primary" value="Send"/>
                </form>
        </div>
        <!--footer-->
        <?php include("../home/footer.php")?>
        <!---end footer-->
    </body>
</html>



