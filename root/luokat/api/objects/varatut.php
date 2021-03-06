<?php
class Varaus{
 
    // database yhteys ja taulun nimi
    private $conn;
    // private $table_varaus = "tila_view";
    
   
    private $table_varaus = "varaus";
    private $table_kurssit = "kurssit";
    private $table_tilat = "tilat";
    private $table_kouluttajat = "kouluttajat";
    
    // objektin ominaisuudet
    public $id;
    public $aihe;
    public $kouluttaja;
    public $kurssi;
    public $tila;
    public $varaus;
 
    // constructor  $db kun yhteys kantaan
    public function __construct($db){
        $this->conn = $db;
    }

    // lue kaikki varaust
    function read(){
    
        // valitaan kaikki kyselyyn
        $query = "SELECT
                 `varaus`.`id`,
                 `varaus`.`varaus`,
                 `kurssit`.`nimi` AS `kurssi`,
                 `varaus`.`oppi_aine` AS `aihe`,
                 `tilat`.`nimi` AS `tila`,
                 `kouluttajat`.`nimi` AS `kouluttaja`
                FROM

                (        (        (
                 " . $this->table_varaus . "
                 INNER JOIN " . $this->table_kouluttajat . " ON `kouluttaja_id` = `kouluttajat`.`id`
                                  )
                 INNER JOIN " . $this->table_kurssit . " ON `kurssi_id` = `kurssit`.`id`
                        )
                 INNER JOIN " . $this->table_tilat . " ON `tila_id` = `tilat`.`id`
                )

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
                 `varaus`.`id`,
                 `varaus`.`varaus`,
                 `kurssit`.`nimi` AS `kurssi`,
                 `varaus`.`oppi_aine` AS `aihe`,
                 `tilat`.`nimi` AS `tila`,
                 `kouluttajat`.`nimi` AS `kouluttaja`
                FROM

                (        (        (
                 " . $this->table_varaus . "
                 INNER JOIN " . $this->table_kouluttajat . " ON `kouluttaja_id` = `kouluttajat`.`id`
                                  )
                 INNER JOIN " . $this->table_kurssit . " ON `kurssi_id` = `kurssit`.`id`
                        )
                 INNER JOIN " . $this->table_tilat . " ON `tila_id` = `tilat`.`id`
                )
                WHERE
                    id= '". $this->table_varaus .".".$this->id."'";
    
        // muotoillaan kysely
        $stmt = $this->conn->prepare($query);
    
        // ajetaan kysely
        $stmt->execute();
        return $stmt;
    }

    // lisätään varaus
    
    function create(){

        /*
        if($this->isAlreadyExistVaraus()){
            return false;
        }
        */
        
        
        // kysely tietueen lisäämiseen
        $query = "INSERT INTO  ". $this->table_varaus ." 
                        ( `aihe`, `koluttaja`, `kurssi`, `tila`, `varaus`)
                  VALUES
                        ('".$this->aihe."', '".$this->koluttaja."', '".$this->kurssi."', '".$this->tila."', '".$this->varaus."')";
    
        // muotoillaan kysely
        $stmt = $this->conn->prepare($query);
    
        // ajetaan kysely
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // muokataan varaus 
    function update(){
    
        // kysely tietueen lisäämiseen
        $query = "UPDATE
                    " . $this->table_varaus . "
                SET
                    aihe='".$this->aihe."', kouluttaja_id='".$this->koluttaja_id."', kurssi_id='".$this->kurssi_id."', tila_id='".$this->tila_id."', varaus='".$this->varaus."'
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

    // poistetaan varaus
    function delete(){
        
        //kysely tietueen poistoon
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
    /*  -- 
    function isAlreadyExistVaraus(){
        $query = "SELECT *
            FROM
                " . $this->table_varaus . " 
            WHERE
                kouluttaja_id ='".$this->kouluttaja_id."'";

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
    */
    
}
