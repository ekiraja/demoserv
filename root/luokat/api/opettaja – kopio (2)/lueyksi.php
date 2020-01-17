<?php
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/opettaja.php';
 
// luodaan yhteys kantaan
$database = new Database();
$db = $database->getConnection();
 
// luodaan opettaja objekti
$opettaja = new Opettaja($db);
// asetetaan ID muokattavaksi
$opettaja->id = isset($_GET['id']) ? $_GET['id'] : die();
// luetaan tietue muokattavaksi
$stmt = $opettaja->read_single();
if($stmt->rowCount() > 0){
    // haetaan rivit
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // tehdään taulu
    $opettaja_arr=array(
        "id" => $row['id'],
        "nimi" => $row['nimi'],
        "email" => $row['email'],
        "password" => $row['password'],
        "puhelin" => $row['puhelin'],
        "oppi_aine" => $row['oppi_aine'],
        "luotu" => $row['luotu']
    );
}
// muotoillaan json 
print_r(json_encode($opettaja_arr));
?>
