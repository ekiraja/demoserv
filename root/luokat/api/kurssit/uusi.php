<?php
 
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/kurssit.php';
// yhteyden teko
$database = new Database();
$db = $database->getConnection();
 
// tehdään kurssi objekti
$kurssi = new Kurssi($db);
 
// kurssi objektin arvot
$kurssi->nimi = $_POST['nimi'];
$kurssi->koulutus_ala = $_POST['koulutus_ala'];
$kurssi->luotu = date('Y-m-d H:i:s');
// lisätään kurssi
if($kurssi->create()){
    $kurssi_arr=array(
        "status" => true,
        "message" => "Lisääminen onnistui.",
        "id" => $kurssi->id,
        "nimi" => $kurssi->nimi,
        "koulutus_ala" => $kurssi->koulutus_ala
    );
}
else{
    $kurssi_arr=array(
        "status" => false,
        "message" => "Kurssi on jo olemassa!"
    );
}
print_r(json_encode($kurssi_arr));
?>