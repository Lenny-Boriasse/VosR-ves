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

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "BD_VosReves";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée, contactez un administrateur.");
}

// Vérification si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire

    // Employe :
    $ID_type_frais = $_POST['ID_type_frais'];
    $Descriptif_frais = $_POST['Descriptif_frais'];
    $Date_frais = $_POST['Date_frais'];
    $Montant_frais = $_POST['Montant_frais'];
    // Récupération de l'ID_emp à partir de la session
    $ID_emp = $_SESSION['ID_emp'];

    $sql = "SELECT * FROM EMPLOYE WHERE ID_emp = '$ID_emp'";
    $resultat = $conn->query($sql);

    // Insertion des données dans la table "Frais"
    $sql = "INSERT INTO FRAIS (ID_type_frais, Descriptif_frais, Date_frais, ID_etat_frais, Montant_frais, ID_emp)
    VALUES ('$ID_type_frais', '$Descriptif_frais', '$Date_frais', 1, '$Montant_frais', '$ID_emp')";

    if ($conn->query($sql) !== TRUE) {
        echo "Echec de l'envoi : " . $conn->error;
    }

    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Traitement des données du formulaire ici

        // Redirection vers la page accueil.php avec un message de confirmation
        header('Location: accueil.php');
        exit;
    }
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ajout - VosRèves</title>
    <link rel="shortcut icon" href="IMG/logo3.png" type="image/x-icon">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
</style>

<body>
    <header>
        <?php
        include('header.php');
        ?>
    </header>
    <div id="formulaire-container-1">
        <p id="Grand-Titre" style="text-align: center; margin-bottom: 2px; margin-top: 15px;">Ajouter un Ticket</p>
        <div id="ligne-horizontal" style="margin-top: 2px; margin-bottom: 2px; border: solid 2px black;"></div>
        <p id="Commentaire" style="color: red; text-align: center;"><span id="formulaire-required">*</span>Champ obligatoire.</p>
        <form action="formulaire.php" method="POST">
            <div id="formulaire-container-box">
                <div id="formulaire-ligne">
                    <div id="formulaire-group">
                        <label for="type_frais"><span id="formulaire-required">* </span>Type de Frais :</label>
                        <select name="ID_type_frais" id="ID_type_frais" required>
                            <option value="" disabled selected>Sélectionnez...</option>
                            <option value="1">Hotel</option>
                            <option value="2">Restaurant</option>
                            <option value="3">Carburant</option>
                            <option value="4">Péage</option>
                        </select>
                    </div>
                    <div id="formulaire-group">
                        <label for="Date_frais"><span id="formulaire-required">* </span>Date du Frais :</label>
                        <input type="date" name="Date_frais" required autocapitalize="off" autocomplete="off">
                    </div>
                    <div id="formulaire-group">
                        <label for="Montant_frais"><span id="formulaire-required">* </span>Montant du Frais :</label>
                        <div id="formulaire-container-montant">
                            <input type="text" name="Montant_frais" required autocapitalize="off" placeholder="Montant..." maxlength="7" autocomplete="off">
                            <div id="formulaire-euro-symbol">€</div>
                        </div>
                    </div>
                </div>
                <div id="ligne-horizontal" style="margin-top: 2px; margin-bottom: 2px; border: solid 2px black;"></div>
                <div id="formulaire-ligne">
                    <div id="formulaire-group">
                        <label for="Descriptif_frais"><span id="formulaire-required">* </span>Descriptif du Frais :</label>
                        <textarea name="Descriptif_frais" cols="45" rows="9" autocomplete="off" required autocapitalize="off" placeholder="Établissement, Raison, etc..."></textarea>
                    </div>
                </div>
                <div id="formulaire-ligne">
                    <div id="formulaire-group">
                        <button type="reset" name="reset" id="formulaire-reset-btn">Reset</button>
                    </div>
                    <div id="formulaire-group">
                        <button name="submit" type="submit" id="formulaire-submit-btn">Envoyez</button>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <p id="Paragraphe" style="color: gray; margin-left: 400px;">Veuillez noter que toute fausse déclaration ou tentative de manipulation des informations fournies dans ce formulaire entraînera des sanctions appropriées. <br> Nous vous prions de remplir ce formulaire avec précision et honnêteté. <br> Votre coopération est essentielle pour garantir l'intégrité de nos processus et maintenir un environnement juste et équitable. <br> Merci de votre compréhension.</p>
    </div>
    <footer>
        <?php
        include('footer.php');
        ?>
    </footer>
</body>

</html>