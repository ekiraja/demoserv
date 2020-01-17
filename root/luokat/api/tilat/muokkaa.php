<?php
 
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/tilat.php';
 
// luodaan yhteys kantaan
$database = new Database();
$db = $database->getConnection();
 
// luodaan tila objekti
$tila = new Tila($db);
 
// tila objektin arvot
$tila->id = $_POST['id'];
$tila->nimi = $_POST['nimi'];
$tila->paikat = $_POST['paikat'];
 
// create the tila
if($tila->update()){
    $tila_arr=array(
        "status" => true,
        "message" => "Muutos tehty!"
    );
}
else{
    $tila_arr=array(
        "status" => false,
        "message" => "Tila on jo olemassa"
    );
}
print_r(json_encode($tila_arr));
?>