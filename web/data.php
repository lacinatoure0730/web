<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $email = htmlspecialchars($_POST["email"]);
    $telephone = htmlspecialchars($_POST["telephone"]);
    $message = htmlspecialchars($_POST["message"]);
    $fichier = $_FILES['fichier']['name'];
    $fichier_tmp = $_FILES['fichier']['tmp_name'];

    // Get the file extension
    $file_extension = pathinfo($fichier, PATHINFO_EXTENSION);
    
    // Validation et traitement des données
    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($telephone) && !empty($message) && !empty($fichier)) {
        // Affichage des données soumises
        echo "<h3>Informations soumises :</h3>";
        echo "<p><strong>Nom :</strong> $nom</p>";
        echo "<p><strong>Prénom :</strong> $prenom</p>";
        echo "<p><strong>Email :</strong> $email</p>";
        echo "<p><strong>Téléphone :</strong> $telephone</p>";
        echo "<p><strong>Message :</strong> $message</p>";
        echo "<p><strong>Fichier :</strong> $fichier</p>";
        
        // Connexion à la base de données
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Prepare and execute SQL statement to insert data into the "client" table
            $stmt = $pdo->prepare("INSERT INTO client (nom, prenom, email, telephone, message, fichier, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nom, $prenom, $email, $telephone, $message, $fichier, $file_extension]); // Ensure the number of placeholders matches the number of variables
            
            echo "<p><strong>Connexion à la base de données réussie.</strong></p>";
        } catch(PDOException $e) {
            echo "<p><strong>Erreur de connexion à la base de données :</strong> " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p><strong>Tous les champs du formulaire doivent être remplis.</strong></p>";
    }
}
header("Location: index.php");
?>
