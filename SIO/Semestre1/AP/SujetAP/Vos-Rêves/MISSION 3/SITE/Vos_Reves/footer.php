<?php

session_start();

// Vérification de la connexion
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
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Footer - VosRèves</title>
    <link rel="shortcut icon" href="IMG/logo3.png" type="image/x-icon">
</head>
<body>
    <div id="footer-container-1">
        <p id="Commentaire">© 2023 VosRêves. Tous droits réservés.</p>
    </div>
</body>
</html>