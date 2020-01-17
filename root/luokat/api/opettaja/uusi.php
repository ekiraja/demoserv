<?php
 
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/opettaja.php';
// yhteyden teko
$database = new Database();
$db = $database->getConnection();
 
// tehdään opettaja objekti
$opettaja = new Opettaja($db);
 
// opettaja objektin arvot
$opettaja->nimi = $_POST['nimi'];
$opettaja->email = $_POST['email'];
$opettaja->password = base64_encode($_POST['password']);
$opettaja->puhelin = $_POST['puhelin'];
$opettaja->oppi_aine = $_POST['oppi_aine'];
$opettaja->luotu = date('Y-m-d H:i:s');
// lisätään opettaja
if($opettaja->create()){
    $opettaja_arr=array(
        "status" => true,
        "message" => "Lisääminen onnistui.",
        "id" => $opettaja->id,
        "nimi" => $opettaja->nimi,
        "email" => $opettaja->email,
        "puhelin" => $opettaja->puhelin,
        "oppi_aine" => $opettaja->oppi_aine
    );
}
else{
    $opettaja_arr=array(
        "status" => false,
        "message" => "Sähköposti tai nimi on jo olemassa!"
    );
}
print_r(json_encode($opettaja_arr));
?>