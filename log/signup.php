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
        <div class="container signup">
            <h2>New in ESIG'VACINATION...</h2>
            <form action="../log/logRegisterTraitment.php" class="was-validated" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" name="name" required/>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Surname" name="surname" required/>
                </div>
                <div class="form-group">
                    <input type="tel" class="form-control" placeholder="Phone" name="phone" required/>
                </div>
                <div class="form-group">
                    <input type="date" class="form-control" placeholder="BirthDate" name="birthdate" required/>
                </div>
                <div class="form-group">
                    <input type="mail" class="form-control" placeholder="Mail" name="mail" required/>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Confirm Mail" name="confirmmail" required/>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required/>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="pwd" placeholder="Confirm password" name="confirmpswd" required/>
                </div>
                <input name="form_function" type="hidden" value="Register"/>         
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div> 
    </section>
    <!--end section-->
    <!--footer-->
    <?php include("../home/footer.php")?>
    <!--end footer--> 
</body>
</html>