<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Client</title>
    <script>
        function confirmDelete() {
            return confirm("Êtes-vous sûr de supprimer ce client ?");
        }
    </script>
</head>
<body>
    <?php
    // Database connection
    include('connect.php');

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the ID parameter exists in the URL
        if (isset($_GET['id'])) {
            $client_id = $_GET['id'];

            // Delete the client from the database when confirmation is received
            if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
                $stmt = $pdo->prepare("DELETE FROM client WHERE id = ?");
                $stmt->execute([$client_id]);
                header("Location: liste.php");
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

    <script>
        // Call confirmDelete() function when the page loads
        window.onload = function() {
            if (confirmDelete()) {
                // If confirmed, redirect to delete.php with confirm=yes
                window.location.href = "delete.php?id=<?php echo $client_id; ?>&confirm=yes";
            } else {
                // If not confirmed, redirect to list page
                window.location.href = "liste.php";
            }
        };
    </script>
</body>
</html>
