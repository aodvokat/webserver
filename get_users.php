<?php
include 'db_config.php';
$sql = "SELECT id, name, nim, prodi, semester, email FROM pengguna";
$result = $koneksi->query($sql);
$pengguna = array();
if ($result->num_rows > 0) {
 while ($row = $result->fetch_assoc()) {
 $pengguna[] = $row;
 }
}
header('Content-Type: application/json');
echo json_encode($pengguna);
$koneksi->close();