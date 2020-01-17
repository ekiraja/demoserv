<?php
 
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/opettaja.php';
 
// luodaan yhteys kantaan
$database = new Database();
$db = $database->getConnection();
 
// luodaan opettaja objekti
$opettaja = new Opettaja($db);
 
// opettaja objektin arvot
$opettaja->id = $_POST['id'];
$opettaja->nimi = $_POST['nimi'];
$opettaja->email = $_POST['email'];
$opettaja->password = base64_encode($_POST['password']);
$opettaja->puhelin = $_POST['puhelin'];
$opettaja->oppi_aine = $_POST['oppi_aine'];
 
// create the opettaja
if($opettaja->update()){
    $opettaja_arr=array(
        "status" => true,
        "message" => "Muutos tehty!"
    );
}
else{
    $opettaja_arr=array(
        "status" => false,
        "message" => "Sähköposti on jo olemassa!"
    );
}
print_r(json_encode($opettaja_arr));
?>