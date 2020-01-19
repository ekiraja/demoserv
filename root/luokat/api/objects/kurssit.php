<?php
class Kurssi{
 
    // database yhteys ja taulun nimi
    private $conn;
    private $table_kurssi = "kurssit";
 
    // objektin ominaisuudet
    public $id;
    public $nimi;
    public $koulutus_ala;
    public $luotu;
 
    // constructor  $db kun yhteys kantaan
    public function __construct($db){
        $this->conn = $db;
    }

    // lue kaikki kurssit
    function read(){
    
        // valitaan kaikki kyselyyn
        $query = "SELECT
                    `id`, `nimi`, `koulutus_ala`, `luotu`
                FROM
                    " . $this->table_kurssi . " 
                ORDER BY
                    nimi ASC";
    
        // muotoillaan kysely
        $stmt = $this->conn->prepare($query);
    
        // ajetaan kysely
        $stmt->execute();
    
        return $stmt;
    }

    // haetaan yksi tietue 
    function read_single(){
    
        // kysellään kaikki
        $query = "SELECT
                    `id`, `nimi`, `koulutus_ala`, `luotu`
                FROM
                    " . $this->table_kurssi . " 
                WHERE
                    id= '".$this->id."'";
    
        // muotoillaan kysely
        $stmt = $this->conn->prepare($query);
    
        // ajetaan kysely
        $stmt->execute();
        return $stmt;
    }

    // lisätään kurssi
    function create(){
    
                
        // kysely tietueen lisäämiseen
        $query = "INSERT INTO  ". $this->table_kurssi ." 
                        (`nimi`, `koulutus_ala`, `luotu`)
                  VALUES
                        ('".$this->nimi."', '".$this->koulutus_ala."', '".$this->luotu."')";
    
        // muotoillaan kysely
        $stmt = $this->conn->prepare($query);
    
        // ajetaan kysely
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // muokataan kurssi 
    function update(){
    
        // kysely tietueen lisäämiseen
        $query = "UPDATE
                    " . $this->table_kurssi . "
                SET
                    nimi='".$this->nimi."', koulutus_ala='".$this->koulutus_ala."'
                WHERE
                    id='".$this->id."'";
    
        // muotoillaan kysely
        $stmt = $this->conn->prepare($query);
        // ajetaan kysely
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // poistetaan kurssi
    function delete(){
        
        //kysely tietueen lisäämiseen
        $query = "DELETE FROM
                    " . $this->table_kurssi . "
                WHERE
                    id= '".$this->id."'";
        
        // muotoillaan kysely
        $stmt = $this->conn->prepare($query);
        
        // ajetaan kysely
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    
    
}