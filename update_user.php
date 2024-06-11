<?php
header("Content-Type: application/json");
include 'db_config.php';
// Get the posted data
$data = json_decode(file_get_contents("php://input"));
// Validate the data
if (!isset($data->id) || !isset($data->name) || !isset($data->nim) || !isset($data->prodi) || !isset($data->semester) || !isset($data->email)) {
die(json_encode(["error" => "Invalid input"]));
}
$id = $koneksi->real_escape_string($data->id);
$name = $koneksi->real_escape_string($data->name);
$nim = $koneksi->real_escape_string($data->nim);
$prodi = $koneksi->real_escape_string($data->prodi);
$semester = $koneksi->real_escape_string($data->semester);
$email = $koneksi->real_escape_string($data->email);
$sql = "UPDATE pengguna SET name='$name', nim='$nim', prodi='$prodi', semester='$semester', email='$email' WHERE id=$id";
if ($koneksi->query($sql) === TRUE) {
echo json_encode(["success" => true]);
} else {
echo json_encode(["error" => $koneksi->error]);
}
$koneksi->close();
?>
