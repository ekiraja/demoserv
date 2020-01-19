<?php
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/varatut.php';
 
// luodaan yhteys kantaan
$database = new Database();
$db = $database->getConnection();
 
// luodaan opettaja objekti
$varaus = new Varaus($db);
// asetetaan ID muokattavaksi
$varaus->id = isset($_GET['id']) ? $_GET['id'] : die();
// luetaan tietue muokattavaksi
$stmt = $varaus->read_single();
if($stmt->rowCount() > 0){
    // haetaan rivit
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // tehdään taulu
    $opettaja_arr=array(
        "id" => $row['id'],
        "aihe" => $row['aihe'],
        "kouluttaja" => $row['kouluttaja'],
        "kurssi" => $row['kurssi'],
        "tila" => $row['tila'],
        "varaus" => $row['varaus'],
    );
}
// muotoillaan json 
print_r(json_encode($opettaja_arr));
?>
