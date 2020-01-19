<?php
class Opettaja{
 
    // database yhteys ja taulun nimi
    private $conn;
    private $table_opettaja = "kouluttajat";
 
    // objektin ominaisuudet
    public $id;
    public $nimi;
    public $email;
    public $password;
    public $puhelin;
    public $oppi_aine;
    public $luotu;
 
    // constructor  $db kun yhteys kantaan
    public function __construct($db){
        $this->conn = $db;
    }

    // lue kaikki opettajat
    function read(){
    
        // valitaan kaikki kyselyyn
        $query = "SELECT
                    `id`, `nimi`, `email`, `password`, `puhelin`, `oppi_aine`, `luotu`
                FROM
                    " . $this->table_opettaja . " 
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
                    `id`, `nimi`, `email`, `password`, `puhelin`, `oppi_aine`, `luotu`
                FROM
                    " . $this->table_opettaja . " 
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
        $query = "INSERT INTO  ". $this->table_opettaja ." 
                        (`nimi`, `email`, `password`, `puhelin`, `oppi_aine`, `luotu`)
                  VALUES
                        ('".$this->nimi."', '".$this->email."', '".$this->password."', '".$this->puhelin."', '".$this->oppi_aine."', '".$this->luotu."')";
    
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
                    " . $this->table_opettaja . "
                SET
                    nimi='".$this->nimi."', email='".$this->email."', password='".$this->password."', puhelin='".$this->puhelin."', oppi_aine='".$this->oppi_aine."'
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
                    " . $this->table_opettaja . "
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
    //  turha kun kannassa uniikki
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_opettaja . " 
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