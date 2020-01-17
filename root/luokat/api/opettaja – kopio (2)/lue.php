<?php
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/opettaja.php';
 
// yhdistetään kantaan
$database = new Database();
$db = $database->getConnection();
 
// luodaan opettaja objekti
$opettaja = new Opettaja($db);
 
// kysely opettaja
$stmt = $opettaja->read();
$num = $stmt->rowCount();
// onko yhtään tietuetta
if($num>0){
 
    // opettajat taulukko
    $opettajat_arr=array();
    $opettajat_arr["opettajat"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $opettaja_item=array(
            "id" => $id,
            "nimi" => $nimi,
            "email" => $email,
            "password" => $password,
            "puhelin" => $puhelin,
            "oppi_aine" => $oppi_aine,
            "luotu" => $luotu
        );
        array_push($opettajat_arr["opettajat"], $opettaja_item);
    }
 
    echo json_encode($opettajat_arr["opettajat"]);
}
else{
    echo json_encode(array());
}
?>
