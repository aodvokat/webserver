<?php
header("Content-Type: application/json");
include 'db_config.php';
// Get the posted data
$data = json_decode(file_get_contents("php://input"));
// Validate the data
if (!isset($data->name) || !isset($data->nim) || !isset($data->prodi) || !isset($data->semester) || !isset($data->email)) {
 die(json_encode(["error" => "Invalid input"]));
}
$name = $koneksi->real_escape_string($data->name);
$nim = $koneksi->real_escape_string($data->nim);
$prodi = $koneksi->real_escape_string($data->prodi);
$semester = $koneksi->real_escape_string($data->semester);
$email = $koneksi->real_escape_string($data->email);
$sql = "INSERT INTO pengguna (name, nim, prodi, semester, email) VALUES ('$name', '$nim', '$prodi', '$semester', '$email')";
if ($koneksi->query($sql) === TRUE) {
 echo json_encode(["success" => true]);
} else {
 echo json_encode(["error" => $koneksi->error]);
}
$koneksi->close();