<?php

class Model {
    
    // todos que 'extends Model' vão usar a variavel $db
    protected $db;

    public function __construct() {
        global $config;
        try{
            $this->db = new PDO("pgsql:dbname=".$config['dbname'].";host=".$config['dbhost'],
                $config['dbuser'], $config['dbpass']);
            // set the PDO error mode to exception
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Falhou: " . $e->getMessage();
        }
        
    }
}
