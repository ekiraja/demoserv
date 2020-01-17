<?php
class Tila{
 
    // database yhteys ja taulun nimi
    private $conn;
    private $table_tila = "tilat";
 
    // objektin ominaisuudet
    public $id;
    public $nimi;
    public $paikat;
    public $luotu;
 
    // constructor  $db kun yhteys kantaan
    public function __construct($db){
        $this->conn = $db;
    }

    // lue kaikki tilat
    function read(){
    
        // valitaan kaikki kyselyyn
        $query = "SELECT
                    `id`, `nimi`, `paikat`, `luotu`
                FROM
                    " . $this->table_tila . " 
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
                    `id`, `nimi`, `paikat`, `luotu`
                FROM
                    " . $this->table_tila . " 
                WHERE
                    id= '".$this->id."'";
    
        // muotoillaan kysely
        $stmt = $this->conn->prepare($query);
    
        // ajetaan kysely
        $stmt->execute();
        return $stmt;
    }

    // lisätään tila
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // kysely tietueen lisäämiseen
        $query = "INSERT INTO  ". $this->table_tila ." 
                        (`nimi`, `paikat`, `luotu`)
                  VALUES
                        ('".$this->nimi."', '".$this->paikat."', '".$this->luotu."')";
    
        // muotoillaan kysely
        $stmt = $this->conn->prepare($query);
    
        // ajetaan kysely
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // muokataan tila 
    function update(){
    
        // kysely tietueen lisäämiseen
        $query = "UPDATE
                    " . $this->table_tila . "
                SET
                    nimi='".$this->nimi."', paikat='".$this->paikat."'
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

    // poistetaan tila
    function delete(){
        
        //kysely tietueen lisäämiseen
        $query = "DELETE FROM
                    " . $this->table_tila . "
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

    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_tila . " 
            WHERE
                nimi='".$this->nimi."'";

        // muotoillaan kysely statement
        $stmt = $this->conn->prepare($query);

        // ajetaan kysely
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}