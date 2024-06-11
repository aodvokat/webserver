<?php
header("Content-Type: application/json");
include 'db_config.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
     parse_str(file_get_contents("php://input"), $_DELETE);

     if (!isset($_DELETE['id'])) {
         echo json_encode(["error" => "Invalid input: ID is required"]);
         exit;
     }

     $userId = $_DELETE['id'];

     $stmt = $koneksi->prepare("DELETE FROM pengguna WHERE id = $userId");
     $stmt->bind_param("i", $userId);

     if ($stmt->execute()) {
         echo json_encode(["success" => true, "message" => "User deleted successfully"]);
     } else {
         echo json_encode(["error" => $stmt->error]);
     }

     $stmt->close();
     $koneksi->close();
 } else {
     echo json_encode(["error" => "Invalid request method"]);
 }

$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
$userId = end($parts); 
$server = "localhost";
$username = "root";
$password = "";
$dbname = "db_akademik";

$conn = mysqli_connect($server, $username, $password, $dbname);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql = "DELETE FROM pengguna WHERE id = '$userId'"; 
if (mysqli_query($conn, $sql)) {
    echo "Pengguna dengan ID $userId telah dihapus.";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>