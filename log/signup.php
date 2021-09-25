<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
    <link rel="stylesheet" href="../log/log.css">    
    <link rel="stylesheet" href="../home/home.css">
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
    <!--if error set-->
    <?php
        if(isset($_GET['error'])){
            switch ($_GET['error']){
                case "pass":
                    echo '<div class="alert alert-danger">
                            <strong>Password did\'nt match !</strong> Verify you enter the same password.
                          </div>';
                break;
                case "mail":
                    echo '<div class="alert alert-warning">
                            <strong>Mail did\'nt match !</strong> Verify you enter the same mail.
                          </div>';
                break;
                case "missing":
                    echo '<div class="alert alert-info">
                            <strong>Please fill all the field!</strong>.
                          </div>';
                break;   
                default: break;
            }
        }
    ?>
    <!--section-->
        <div class="container signup">
            <h2>New in ESIG'VACINATION...</h2>
            <form action="../log/logRegisterTraitment.php" method="post">
                <div class="row row-cols-2">
                    <input type="text" placeholder="Name" name="name" required/>
                    <input  type="text" placeholder="Surname" name="surname" required/>
                    <input  type="tel" placeholder="Phone: 07-31-31-31-31" name="phone" pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}"required/>
                    <input  type="date" placeholder="BirthDate" name="birthdate" required/>
                    <input  type="mail" placeholder="Mail" name="mail" required/>
                    <input  type="email" placeholder="Confirm Mail" name="confirmmail" required/>
                    <input  type="password" placeholder="Enter password" name="pswd" required/>
                    <input  type="password" placeholder="Confirm password" name="confirmpswd" required/>
                    <input name="form_function" type="hidden" value="Register"/></br>       
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div> 
    <!--end section-->
</body>
</html>