<?php
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/tilat.php';
 
// luodaan yhteys kantaan
$database = new Database();
$db = $database->getConnection();
 
// luodaan tila objekti
$tila = new Tila($db);
// asetetaan ID muokattavaksi
$tila->id = isset($_GET['id']) ? $_GET['id'] : die();
// luetaan tietue muokattavaksi
$stmt = $tila->read_single();
if($stmt->rowCount() > 0){
    // haetaan rivit
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // tehdään taulu
    $tila_arr=array(
        "id" => $row['id'],
        "nimi" => $row['nimi'],
        "tila" => $row['tila'],
        "luotu" => $row['luotu']
    );
}
// muotoillaan json 
print_r(json_encode($tila_arr));
?>
