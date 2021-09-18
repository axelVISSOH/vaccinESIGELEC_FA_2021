<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
    <link rel="stylesheet" href="../log/log.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Connexion</title>
</head>
<body>
    <!--header-->
    <?php include("../home/navbarHome.php");?>
    <!--end header-->
    <!--section-->
    <section>
        <div class="container signin">
            <h2>Already have an account...</h2>
            <form action="../log/logRegisterTraitment.php" class="was-validated" method="post">
                <div class="form-group">
                    <input type="email" class="form-control" id="mail" placeholder="Mail: xxxx@domain.yyyy" name="mail" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="pswd" placeholder="Enter password" name="pswd" required>
                </div>    
                <input name="form_function" type="hidden" value="logIn">   
                <input type="submit" class="btn btn-primary" value="Connexion"/>
            </form>
        </div>
    </section>
    <!--end section-->
    <!--footer-->
    <?php include("../home/footer.php")?>
    <!--end footer--> 
</body>
</html>