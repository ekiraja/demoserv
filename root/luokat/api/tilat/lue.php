<?php
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/tilat.php';
 
// yhdistetään kantaan
$database = new Database();
$db = $database->getConnection();
 
// luodaan tila objekti
$tila = new Tila($db);
 
// kysely tila
$stmt = $tila->read();
$num = $stmt->rowCount();
// onko yhtään tietuetta
if($num>0){
 
    // tilat taulukko
    $tilat_arr=array();
    $tilat_arr["tilat"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $tila_item=array(
            "id" => $id,
            "nimi" => $nimi,
            "paikat" => $paikat,
            "luotu" => $luotu
        );
        array_push($tilat_arr["tilat"], $tila_item);
    }
 
    echo json_encode($tilat_arr["tilat"]);
}
else{
    echo json_encode(array());
}
?>
