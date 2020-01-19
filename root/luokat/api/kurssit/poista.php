<?php
 
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/kurssit.php';
// yhteys kantaan
$database = new Database();
$db = $database->getConnection();
 
// luodaan kurssi objecti
$kurssi = new Kurssi($db);
 
// kurssi objektin arvot
$kurssi->id = $_POST['id'];
 
// poista kurssi
if($kurssi->delete()){
    $kurssi_arr=array(
        "status" => true,
        "message" => "Poisto onnistui"
    );
}
else{
    $kurssi_arr=array(
        "status" => false,
        "message" => "Kurssia ei voida poistaa. Ehkä sille on varattu opetus tila"
    );
}
print_r(json_encode($kurssi_arr));
?>
