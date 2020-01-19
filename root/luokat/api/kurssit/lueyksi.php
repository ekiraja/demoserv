<?php
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/kurssit.php';
 
// luodaan yhteys kantaan
$database = new Database();
$db = $database->getConnection();
 
// luodaan kurssi objekti
$kurssi = new Kurssi($db);
// asetetaan ID muokattavaksi
$kurssi->id = isset($_GET['id']) ? $_GET['id'] : die();
// luetaan tietue muokattavaksi
$stmt = $kurssi->read_single();
if($stmt->rowCount() > 0){
    // haetaan rivit
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // tehdään taulu
    $kurssi_arr=array(
        "id" => $row['id'],
        "nimi" => $row['nimi'],
        "koulutus_ala" => $row['koulutus_ala'],
        "luotu" => $row['luotu']
    );
}
// muotoillaan json 
print_r(json_encode($kurssi_arr));
?>
