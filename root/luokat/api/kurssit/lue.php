<?php
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/kurssit.php';
 
// yhdistetään kantaan
$database = new Database();
$db = $database->getConnection();
 
// luodaan kurssi objekti
$kurssi = new Kurssi($db);
 
// kysely kurssi
$stmt = $kurssi->read();
$num = $stmt->rowCount();
// onko yhtään tietuetta
if($num>0){
 
    // kurssit taulukko
    $kurssit_arr=array();
    $kurssit_arr["kurssit"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $kurssi_item=array(
            "id" => $id,
            "nimi" => $nimi,
            "koulutus_ala" => $koulutus_ala,
            "luotu" => $luotu
        );
        array_push($kurssit_arr["kurssit"], $kurssi_item);
    }
 
    echo json_encode($kurssit_arr["kurssit"]);
}
else{
    echo json_encode(array());
}
?>
