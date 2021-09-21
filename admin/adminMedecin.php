<?php
    session_start();
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
        ?>   
        <p>haha</p> 
        <!--footer-->
        <?php include("../home/footer.php")?>
        <!---end footer-->
    </body>
</html>