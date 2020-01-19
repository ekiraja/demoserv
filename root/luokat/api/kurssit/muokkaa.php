<?php
 
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/kurssit.php';
 
// luodaan yhteys kantaan
$database = new Database();
$db = $database->getConnection();
 
// luodaan kurssi objekti
$kurssi = new kurssi($db);
 
// kurssi objektin arvot
$kurssi->id = $_POST['id'];
$kurssi->nimi = $_POST['nimi'];
$kurssi->koulutus_ala = $_POST['koulutus_ala'];
 
// kuo kurssi
if($kurssi->update()){
    $kurssi_arr=array(
        "status" => true,
        "message" => "Muutos tehty!"
    );
}
else{
    $kurssi_arr=array(
        "status" => false,
        "message" => "Et voi muokata!"
    );
}
print_r(json_encode($kurssi_arr));
?>