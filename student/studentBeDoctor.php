<?php
    session_start();
?>
</body>
</html>
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
    <div>
        <!--<img src="../medecin/doctor.png" alt="A funny picture of a doctor.">-->
        <h1>You are a Doctor?...</h1>
        <p>We need some informations to change your personal area.</p>
    </div>  
    <div class="container sendinfo">               
            <h2 class="text-center">Send the Informations...</h2>  
            <form action="../student/studentTraitment.php" method="post">
                <textarea name="info" placeholder="Tell us more" row="5" cols="30" required></textarea>
                <label for="file">Send us a valid cetificate or a diploma.</label><input type="file" name="file" placeholder="Your file" id="file" required/></br>
                <input type="hidden" name="form_function" value="studentBeDoctor">
                <input type="submit" class="btn btn-primary" value="Send"/>
            </form>
    </div>
    <!--footer-->
    <?php include("../home/footer.php")?>
    <!---end footer-->
</body>
</html>



