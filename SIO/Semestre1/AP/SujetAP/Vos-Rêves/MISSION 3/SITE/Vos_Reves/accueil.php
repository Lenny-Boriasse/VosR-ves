<?php

session_start();

// Vérification de la connexion
if (!isset($_SESSION['Login_emp']) || !isset($_SESSION['Pass_emp'])) {
    header('Location: index.php');
    exit;
}

// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "BD_VosReves";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

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

// Récupérer l'ID de l'employé connecté
$id_emp = $_SESSION['ID_emp'];

// Requête SQL pour récupérer le nom et le prénom de l'employé
$sql_emp = "SELECT Nom_emp, Prenom_emp FROM EMPLOYE WHERE ID_emp = '$id_emp'";
$result_emp = $conn->query($sql_emp);
$employe = $result_emp->fetch_assoc();

// Vérifier si l'employé existe
if ($employe) {
    $nom_emp = $employe['Nom_emp'];
    $prenom_emp = $employe['Prenom_emp'];
} else {
    $nom_emp = "Nom inconnu";
    $prenom_emp = "Prénom inconnu";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACCUEIL - VOSRÈVES</title>
    <link rel="shortcut icon" href="IMG/logo3.png" type="image/x-icon">
</head>

<body>
    <header>
        <?php
        include('header.php');
        ?>
    </header>
    <div id="accueil-container-1">
        <div id="accueil-infos-emp">
            <img src="IMG/emp.png">
            <p id="Paragraphe">Bienvenue, <strong style="font-weight: bold;"><?php echo "$nom_emp, $prenom_emp"; ?></strong>.</p>
        </div>
        <div id="accueil-container-frais">
            <p id="Grand-Titre">Vos Frais :</p>
            <?php
            // Requête SQL pour récupérer les frais de l'employé
            $sql_frais = "SELECT * FROM Frais WHERE ID_emp = '$id_emp'";
            $result_frais = $conn->query($sql_frais);

            if ($result_frais->num_rows > 0) {
                echo "<ul id='accueil-liste-frais'>";
                while ($row = $result_frais->fetch_assoc()) {
                    echo "<li>";
                    echo "<p id='Paragraphe'>ID frais : " . $row["ID_frais"] . "</p>";
                    echo "<p id='Paragraphe'>Date du frais : " . $row["Date_frais"] . "</p>";
                    echo "<p id='Paragraphe'>Description : " . $row["Descriptif_frais"] . "</p>";
                    echo "<p id='Paragraphe'>Montant : " . $row["Montant_frais"] . "</p>";
                    if ($row["ID_etat_frais"] == "1") {
                        echo "<p id='Paragraphe'>État du frais : EN ATTENTE</p>";
                    } else if ($row["ID_etat_frais"] == "2") {
                        echo "<p id='Paragraphe'>État du frais : EN REMBOURSÉ</p>";
                    } else if ($row["ID_etat_frais"] == "3") {
                        echo "<p id='Paragraphe'>État du frais : REFUSÉ</p>";
                    }
                    echo "<div id='ligne-horizontal' style='margin-left:0; margin-top: 2px; margin-bottom: 2px; border: solid 2px black;'></div>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "Aucun frais trouvé pour cet employé.";
            }
            ?>
        </div>
    </div>
    <footer>
        <?php
        include('footer.php');
        ?>
    </footer>
</body>

</html>