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
                    case "not_registered":
                        echo '<div class="alert alert-info">
                                <strong>Mail did not match !</strong> Verify the mail or See you in the sign up page.
                            </div>';
                    break;
                    case "dont_match":
                        echo '<div class="alert alert-warning">
                                <strong>Password did not match !</strong>.
                            </div>';
                    break;                
                    case "not":
                        echo '<div class="alert alert-success">
                                <strong>Congratulation !!!</strong>You can now log in and choose a niche foor your vaccination.
                            </div>';
                    break;
                    default: break;
                }
            }
        ?>
        <!--section-->
        <section>
            <div class="container signin">            
                <h2 class="text-center">Already have an account...</h2>                
                <form action="../log/logRegisterTraitment.php" method="post">
                    <input type="email" id="mail" placeholder="Mail: xxxx@domain.yyyy" name="mail" required>
                    <input type="password" id="pswd" placeholder="Enter password" name="pswd" required>
                    <input type="hidden" name="form_function" value="logIn">   
                    <input type="submit" class="btn btn-primary" value="Connexion"/>
                </form>
            </div>
        </section>
        <!--end section-->  
    </body>
</html>