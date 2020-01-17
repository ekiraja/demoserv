<?php
 
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/tilat.php';
// yhteys kantaan
$database = new Database();
$db = $database->getConnection();
 
// luodaan tila objecti
$tila = new Tila($db);
 
// tila objektin arvot
$tila->id = $_POST['id'];
 
// poista tila
if($tila->delete()){
    $tila_arr=array(
        "status" => true,
        "message" => "Poisto onnistui"
    );
}
else{
    $tila_arr=array(
        "status" => false,
        "message" => "Tilaa ei voida poistaa. Ehkä sille on varaus"
    );
}
print_r(json_encode($tila_arr));
?>
