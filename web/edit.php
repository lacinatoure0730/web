<?php
// Database connection
include('connect.php');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the ID parameter exists in the URL
    if (isset($_GET['id'])) {
        $client_id = $_GET['id'];

        // Prepare and execute SQL statement to select data of a specific client from the "Client" table
        $stmt = $pdo->prepare("SELECT * FROM client WHERE id = ?");
        $stmt->execute([$client_id]);
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the client exists
        if ($client) {
            // Process form submission if POST request
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve form data
                $nom = htmlspecialchars($_POST["nom"]);
                $prenom = htmlspecialchars($_POST["prenom"]);
                $email = htmlspecialchars($_POST["email"]);
                $telephone = htmlspecialchars($_POST["telephone"]);
                $fichier = htmlspecialchars($_POST["fichier"]);
                $message = htmlspecialchars($_POST["message"]);

                // Update the client information in the database
                $stmt = $pdo->prepare("UPDATE client SET nom=?, prenom=?, email=?, telephone=?, fichier=?, message=? WHERE id=?");
                $stmt->execute([$nom, $prenom, $email, $telephone, $fichier, $message, $client_id]);

                // Redirect to the view page after editing
                header("Location: view.php?id=$client_id");
                exit;
            }

            // Display the form with client information for editing
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Modifier le client</title>
                <link rel="stylesheet" href="css/index.css"> <!-- Include the CSS file -->
            </head>
            <body>
                <?php include 'header.php' ?>
                <div class="container">
                    <?php include 'aside.php' ?>
                    <main>
                        <div class="form-container">
                            <h2>Modifier les informations du client</h2>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nom">Nom:</label>
                                    <input type="text" id="nom" name="nom" value="<?php echo $client['nom']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Prénom:</label>
                                    <input type="text" id="prenom" name="prenom" value="<?php echo $client['prenom']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" value="<?php echo $client['email']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="telephone">Téléphone:</label>
                                    <input type="tel" id="telephone" name="telephone" value="<?php echo $client['telephone']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="fichier">Fichier:</label>
                                    <input type="text" id="fichier" name="fichier" value="<?php echo $client['fichier']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message:</label>
                                    <textarea id="message" name="message" rows="4" required><?php echo $client['message']; ?></textarea>
                                </div>
                                <button type="submit">Modifier</button>
                            </form>
                        </div>
                    </main>
                </div>
                <?php include 'footer.php' ?>
                <script src="js/script.js"></script>
                <script src="https://kit.fontawesome.com/fed9cd4040.js" crossorigin="anonymous"></script>
            </body>
            </html>
            <?php
        } else {
            echo "<p>Client not found.</p>";
            exit;
        }
    } else {
        echo "<p>Client ID not provided.</p>";
        exit;
    }
} catch(PDOException $e) {
    echo "<p><strong>Erreur de connexion à la base de données :</strong> " . $e->getMessage() . "</p>";
    exit;
}
?>
