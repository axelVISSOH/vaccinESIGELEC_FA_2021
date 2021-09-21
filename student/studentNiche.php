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
    <?php 
       // Inclure le menu
        include("../student/navbarStudent.php")
    ?>
    <!---end header-->

    <div class="container mt-5">

    <?php
        echo 'Welcome Back '.$_SESSION['surname'].' '.$_SESSION['name'].'.';
        echo' <p> CHOIX CRENEAUX HORAIRES </p>'  
    ?> 
    
    <h3 class="text-center"> Choisissez votre Vaccin </h3>

    <!-- 
        Du coup, ce que je te propose, et tu pourras voir à quel point c'est réalisable avec Axel.
        Quand l'utilisateur aura choisi le vaccin et l'horaire, tu effectuera une requête dans la BDD qui vas récupérer
        la liste des médecins avec ces conditions là (vaccin & horaires)
        Tu n'auras plus qu'à l'afficher en effectuant une boucle et une fois que l'utilisateur valide, tu enregistre les 
        données du formulaire dans ta table appointment_aptm
    -->

    <form>
        <!-- Dans mon container, je veux que la div que j'ai crée prenne trois colonnes -->
        <div class="col-3 mx-auto mt-3">
            <select class=form-control>
                <option value="Pfizer" selected> Pfizer</option>
                <option value="Moderna"> Moderna </option>
                <option value="Jonhson"> Jonhson </option>
            </select>
        </div>

        <h3 class="text-center mt-3"> Choisissez votre Horaire </h3>

        <!-- Dans mon container, je veux que la div que j'ai crée prenne trois colonnes -->
        <div class="col-3 mx-auto mt-3">
            <select class=form-control>
                <option value="09h00-12h00" > 09h00-12h00  </option>
                <option value="13h00-15h30" selected > 13h00-15h30 </option>
                <option value="15h30-17h00" > 15h30-17h00 </option>
            </select>
        </div>

        <h3 class="text-center mt-3"> Choisissez un Médecin parmi la liste </h3>


        <div class="col-3 mx-auto mt-3">
            <select class=form-control>
                <option value="Nom_medecin" > Nom Médecin </option>
            </select>
        </div>

        <div class="row mt-3">
        <div class="col text-center">
        <button class="btn btn-success"> Valider </button>
        </div>
    </div>
  </form>

    </div>

    <!--footer-->
    <?php include("../home/footer.php")?>
    <!---end footer->
</body>
</html>



