<?php
 
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/varatut.php';
// yhteyden teko
$database = new Database();
$db = $database->getConnection();
 
// tehdään varaus objekti
$varaus = new varaus($db);
 
// varaus objektin arvot
$varaus->auhe = $_POST['aihe'];
$varaus->kouluttaja = $_POST['kouluttaja'];
$varaus->kurssi = $_POST['kurssi'];
$varaus->tila = $_POST['tila'];
$varaus->varaus = $_POST['varaus'];
// lisätään varaus
if($varaus->create()){
    $varaus_arr=array(
        "status" => true,
        "message" => "Lisääminen onnistui.",
        "id" => $varaus->id,
        "aihe" => $varaus->aihe,
        "kouluttaja" => $varaus->kouluttaja,
        "kurssi" => $varaus->kurssi,
        "tila" => $varaus->tila,
        "varaus" => $varaus->varaus
    );
}
else{
    $varaus_arr=array(
        "status" => false,
        "message" => "kyseiselle päivälle on jo kouluttaja varattu!"
    );
}
print_r(json_encode($varaus_arr));
?>