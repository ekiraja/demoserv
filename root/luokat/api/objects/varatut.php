<?php
class Varaus{
 
    // database yhteys ja taulun nimi
    private $conn;
    private $table_varaus = "varaus";
  /*  private $table_name_K = "kurssit";
    private $table_name_T = "tilat";
    private $table_name_O = "kouluttajat";
*/ 
    // objektin ominaisuudet
    public $id;
    public $oppi_aine;
    public $kouluttaja_id;
    public $kurssi_id;
    public $tila_id;
    public $varaus;
 
    // constructor  $db kun yhteys kantaan
    public function __construct($db){
        $this->conn = $db;
    }

    // lue kaikki opettajat
    function read(){
    
        // valitaan kaikki kyselyyn
        $query = "SELECT
                    `id`, `oppi_aine`, `koluttaja_id`, `kurssi_id`, `tila_id`, `varaus`
                FROM
                    " . $this->table_varaus . " 
                ORDER BY
                    varaus DESC";
    
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
                     `id`, `oppi_aine`, `koluttaja_id`, `kurssi_id`, `tila_id`, `varaus`
                FROM
                    " . $this->table_varaus . " 
                WHERE
                    id= '".$this->id."'";
    
        // muotoillaan kysely
        $stmt = $this->conn->prepare($query);
    
        // ajetaan kysely
        $stmt->execute();
        return $stmt;
    }

    // lisätään opettaja
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // kysely tietueen lisäämiseen
        $query = "INSERT INTO  ". $this->table_varaus ." 
                        ( `oppi_aine`, `koluttaja_id`, `kurssi_id`, `tila_id`, `varaus`)
                  VALUES
                        ('".$this->oppi_aine."', '".$this->koluttaja_id."', '".$this->kurssi_id."', '".$this->tila_id."', '".$this->varaus."')";
    
        // muotoillaan kysely
        $stmt = $this->conn->prepare($query);
    
        // ajetaan kysely
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // muokataan opettaja 
    function update(){
    
        // kysely tietueen lisäämiseen
        $query = "UPDATE
                    " . $this->table_varaus . "
                SET
                    oppi_aine='".$this->oppi_aine."', kouluttaja_id='".$this->koluttaja_id."', kurssi_id='".$this->kurssi_id."', tila_id='".$this->tila_id."', varaus='".$this->varaus."'
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

    // poistetaan opettaja
    function delete(){
        
        //kysely tietueen lisäämiseen
        $query = "DELETE FROM
                    " . $this->table_varaus . "
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
                " . $this->table_varaus . " 
            WHERE
                email='".$this->email."'";

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
