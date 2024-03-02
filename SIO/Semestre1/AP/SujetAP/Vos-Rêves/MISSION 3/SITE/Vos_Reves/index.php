<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=BD_VosReves;charset=utf8;', 'root', 'root');
if (isset($_POST['envoi'])) {
    if (!empty($_POST['Login_emp']) && !empty($_POST['Pass_emp'])) {
        $Login_emp = htmlspecialchars($_POST['Login_emp']);
        $Pass_emp = htmlspecialchars($_POST['Pass_emp']);

        $recupUser = $bdd->prepare('SELECT * FROM EMPLOYE WHERE EMPLOYE.Login_emp = ? AND EMPLOYE.Pass_emp = ?');
        $recupUser->execute(array($Login_emp, $Pass_emp));

        if ($recupUser->rowCount() > 0) {
            $_SESSION['Login_emp'] = $Login_emp;
            $_SESSION['Pass_emp'] = $Pass_emp;
            $_SESSION['ID_emp'] = $recupUser->fetch()['ID_emp'];
            header('Location: accueil.php');
            exit;
        } else {
            echo "Login ou Mot de passe incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Connexion - VosRèves</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
</style>

<body>
    <header id="connexion-header"></header>
    <div id="connexion-container-1">
        <img src="IMG/logo2.png">
        <p>VosRêves</p>
        <form method="POST" action="index.php">
            <input type="text" name="Login_emp" autocomplete="off" required placeholder="Identifiant...">
            <br>
            <input type="text" name="Pass_emp" autocomplete="off" required placeholder="Mot de Passe...">
            <br><br>
            <input type="submit" name="envoi" value="Connexion">
        </form>
    </div>
    <footer id="footer-container-1">
        <p id="Commentaire">© 2023 VosRêves. Tous droits réservés.</p>
    </footer>
</body>

</html>