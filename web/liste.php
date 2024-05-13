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
        // If there's no search query, retrieve all clients
        $stmt = $pdo->query("SELECT * FROM client");
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

} catch(PDOException $e) {
    echo "<p><strong>Erreur de connexion à la base de données :</strong> " . $e->getMessage() . "</p>";
}

$counter = 1;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin page</title>
  <link rel="stylesheet" href="css/liste.css">
</head>
<body>
  <?php include 'header.php' ?>
  <div class="container">
    <?php include 'aside.php' ?>
    <main>
      <h1>La page de la liste des clients CBI - Cote d'Ivoire</h1>
      <div class="search-bar">
        <form action="liste.php" method="GET">
          <input type="text" name="q" placeholder="Rechercher..." >
          <button type="submit">Rechercher</button>
        </form>
      </div> <br>
      <div class="table-container">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nom</th>
              <th scope="col">Prenom</th>
              <th scope="col">Email</th>
              <th scope="col">Telephone</th>
              <th scope="col">Fichier</th>
              <th scope="col">Option</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($clients as $client): ?>
              <tr>
                <th scope="row"><?php echo $counter ?></th>
                <td><?php echo $client['nom']; ?></td>
                <td><?php echo $client['prenom']; ?></td>
                <td><?php echo $client['email']; ?></td>
                <td><?php echo $client['telephone']; ?></td>
                <td><?php echo $client['fichier']; ?></td>
                <td>
                  <a href="view.php?id=<?php echo $client['id']; ?>" class="text-green"><i class="fa-solid fa-eye"></i></a>
                  <a href="edit.php?id=<?php echo $client['id']; ?>"><i class="fas fa-edit"></i></a>
                  <a href="delete.php?id=<?php echo $client['id']; ?>" class="text-danger"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              <?php $counter++ ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
  <?php include 'footer.php' ?>
  <script src="js/script.js"></script>
  <script src="https://kit.fontawesome.com/fed9cd4040.js" crossorigin="anonymous"></script>
</body>
</html>
