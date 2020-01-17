<?php
 
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/tilat.php';
// yhteyden teko
$database = new Database();
$db = $database->getConnection();
 
// tehdään tila objekti
$tila = new Tila($db);
 
// tila objektin arvot
$tila->nimi = $_POST['nimi'];
$tila->paikat = $_POST['paikat'];
$tila->luotu = date('Y-m-d H:i:s');
// lisätään tila
if($tila->create()){
    $tila_arr=array(
        "status" => true,
        "message" => "Lisääminen onnistui.",
        "id" => $tila->id,
        "nimi" => $tila->nimi,
        "paikat" => $tila->paikat
    );
}
else{
    $tila_arr=array(
        "status" => false,
        "message" => "Tila on jo olemassa!"
    );
}
print_r(json_encode($tila_arr));
?>