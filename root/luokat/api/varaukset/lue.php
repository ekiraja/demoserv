<?php
// sisällytetään kanta ja objekti tiedostot
include_once '../config/database.php';
include_once '../objects/varatut.php';
 
// yhdistetään kantaan
$database = new Database();
$db = $database->getConnection();
 
// luodaan varaus objecti
$varaus = new Varaus($db);
 
// kysely varaus
$stmt = $varaus->read();
$num = $stmt->rowCount();
// onko yhtään tietuetta
if($num>0){
 
    // varauksett taulukko
    $varaukset_arr=array();
    $varaukset_arr["varaukset"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $varaus_item=array(
            "id" => $id,
            "aihe" => $aihe,
            "kouluttaja" => $kouluttaja,
            "kurssi" => $kurssi,
            "tila" => $tila,
            "varaus" => $varaus
        );
        array_push($varaukset_arr["varaukset"], $varaus_item);
    }
 
    echo json_encode($varaukset_arr["varaukset"]);
}
else{
    echo json_encode(array());
}
?>
