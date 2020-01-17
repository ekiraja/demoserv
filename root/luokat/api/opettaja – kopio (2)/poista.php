<?php
 
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/opettaja.php';
// yhteys kantaan
$database = new Database();
$db = $database->getConnection();
 
// luodaan opettaja objecti
$opettaja = new Opettaja($db);
 
// opettaja objektin arvot
$opettaja->id = $_POST['id'];
 
// poista opettaja
if($opettaja->delete()){
    $opettaja_arr=array(
        "status" => true,
        "message" => "Poisto onnistui"
    );
}
else{
    $opettaja_arr=array(
        "status" => false,
        "message" => "Kouluttajaa ei voida poistaa. Ehkä hänelle on varattu opetus tila"
    );
}
print_r(json_encode($opettaja_arr));
?>
