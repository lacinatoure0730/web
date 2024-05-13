<?php
// Database connection
include('connect.php');
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Initialize clients variable
        $clients = [];

   
        if(isset($_GET['q']) && !empty($_GET['q'])) {
            // Sanitize the search query
            $searchQuery = htmlspecialchars($_GET['q']);
    
            
            $stmt = $pdo->prepare("SELECT * FROM client WHERE nom LIKE ? OR prenom LIKE ? OR email LIKE ?");
            $stmt->execute(["%$searchQuery%", "%$searchQuery%", "%$searchQuery%"]);
            $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
          } else {
          
            $stmt = $pdo->query("SELECT * FROM client");
            $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
             $stmt = $pdo->query("SELECT * FROM client");
            $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

      } catch(PDOException $e) {
          echo "<p><strong>Erreur de connexion à la base de données :</strong> " . $e->getMessage() . "</p>";
      }


$counter = 1;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
?>
