<?php
// Database connection
include('connect.php');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the ID parameter exists in the URL
    if (isset($_GET['id'])) {
        $client_id = $_GET['id'];

        // Prepare and execute SQL statement to select data of a specific client from the "client" table
        $stmt = $pdo->prepare("SELECT * FROM client WHERE id = ?");
        $stmt->execute([$client_id]);
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the client exists
          if ($client) {
              $nom = $client['nom'];
              $prenom = $client['prenom'];
              $email = $client['email'];
              $telephone = $client['telephone'];
              $fichier = $client['fichier'];
              $message = $client['message'];
          } else {
              echo "<p>client not found.</p>";
              exit;
          }
        } else {
            echo "<p>client ID not provided.</p>";
            exit;
        }
  } catch(PDOException $e) {
      echo "<p><strong>Erreur de connexion à la base de données :</strong> " . $e->getMessage() . "</p>";
      exit;
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php include 'header.php' ?>
  
    <div class="container">
        <?php include 'aside.php' ?>
        <main>
        <div class="form-container">
          <h2>Informations du client</h2>
          <form action="/liste.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nom">Nom:</label>
              <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="prenom">Prénom:</label>
              <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="telephone">Téléphone:</label>
              <input type="tel" id="telephone" name="telephone" value="<?php echo $telephone; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="fichier">Fichier:</label>
              <input type="text" id="fichier" name="fichier" value="<?php echo $fichier; ?>" readonly>
              <?php if (!empty($fichier)): ?>
                  <a href="download.php?id=<?php echo $client_id; ?>">Télécharger</a>
              <?php else: ?>
                  Aucun fichier associé.
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="message">Message:</label>
              <textarea id="message" name="message" rows="4" readonly><?php echo $message; ?></textarea>
            </div>
            <button type="submit">Terminer</button>
          </form>
        </div>
        </main>
    </div>

    <?php include 'footer.php' ?>
    <script src="js/script.js"></script>
    <script src="https://kit.fontawesome.com/fed9cd4040.js" crossorigin="anonymous"></script>
</body>
</html>
