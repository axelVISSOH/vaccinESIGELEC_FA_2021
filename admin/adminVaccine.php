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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminVaccine</title>
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
    <div class="container">            
            <div id="accordion">
                <div class="card">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#collapseOne">
                            Add a Vaccine.
                        </a>                    
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form action="../admin/adminTraitment.php" method="post" class="was-validated">
                                <div class="form-group">
                                    <input type="text" placeholder="Name of the Vaccine" name="vaccineName" required/>
                                </div>
                                <div class="form-group">
                                    <input type="number" max="3" placeholder="Number of dose [1-3]" name="numberDose" required/>
                                </div>
                                <div class="form-group">
                                    <input type="textarea" rows="10" cols="50" placeholder="Name of the Vaccine" name="vaccineInfo" required/>
                                </div> 
                                <inpput type="hidden" name="form_function" value="createNiche">                               
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                            <?php //$res->closeCursor(); ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!--footer-->
    <?php include("../home/footer.php")?>
    <!---end footer-->
</body>
</html>