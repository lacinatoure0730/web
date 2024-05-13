<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$fileId = $_GET['id'] ?? '';

// Check if fileId is provided
if (empty($fileId)) {
    exit("File ID is missing");
}

// Connect to the database
include('connect.php');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=3306", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
            exit("Database connection failed: " . $e->getMessage());
}

    // Query the database for the file name and content
    $stmt = $pdo->prepare("SELECT fichier, type FROM client WHERE id = :id");
    $stmt->bindValue(':id', $fileId);

try {
    $stmt->execute();
    $fileData = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit("Error executing database query: " . $e->getMessage());
}

if (!$fileData) {
    exit("File not found in database");
}

$file = $fileData['fichier'];

$fileType = pathinfo($file, PATHINFO_EXTENSION);
switch ($fileType) {
    case 'png':
            $contentType = 'image/png';
            break;
    case 'jpeg':
            $contentType = 'image/jpeg';
    case 'pdf':
            $contentType = 'application/pdf';
    default:
            $contentType = 'application/octect-stream';
    }           
           // Output the file content
header('Content-Type: ' . $contentType);
header('Content-Disposition: attachment; filename="' . basename($file) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));

//Output the file content
if (readfile($file) === false) {
        echo "Error reading file: $file";
        exit;
}

?>