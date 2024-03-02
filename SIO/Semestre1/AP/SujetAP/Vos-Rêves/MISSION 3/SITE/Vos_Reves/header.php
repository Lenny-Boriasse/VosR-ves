<?php

session_start();

// Vérification de la connexion.
if (!isset($_SESSION['Login_emp']) || !isset($_SESSION['Pass_emp'])) {
    header('Location: index.php');
    exit;
} 

// Vérification de la déconnexion
if (isset($_POST['logout'])) {
    // Détruire toutes les variables de session
    session_unset();
    // Détruire la session
    session_destroy();
    // Rediriger vers la page de connexion
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
</style>

<body>
    <div id="header-container">
        <div id="header-left">
            <a href="accueil.php">
                <img src="IMG/logo3.png">
            </a>
        </div>
        <div id="header-right">
            <a href="accueil.php"><i class="fa-solid fa-house fa-xl" style="color: #FF914D;"></i></a>
            <a href="formulaire.php"><i class="fa-solid fa-plus fa-xl" style="color: #FF914D;"></i></a>
            <form method="POST">
                <button type="submit" name="logout"><i class="fa-solid fa-right-from-bracket fa-xl" style="color: #FF914D;"></i></button>
            </form>
        </div>
    </div>
</body>

</html>