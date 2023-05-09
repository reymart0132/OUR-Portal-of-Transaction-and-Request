<?php

class config{
    //hostinger
    // private $user = 'ceumnlre_root';
    // private $password = 'Eg5c272klko5';
    // public $pdo = null;

    //local
    private $user = 'root';
    private $password = '';
    public $pdo = null;

    public function con(){
        try {
            //hostinger
            // $this->pdo = new PDO('mysql:local=109.106.254.187:3306;dbname=ceumnlre_report', $this->user, $this->password);
            
            //local
            $this->pdo = new PDO('mysql:local=127.0.0.1:3306;dbname=ceumnlre_report', $this->user, $this->password);
            } catch (PDOException $e) {
                die($e->getMessage());
        }
        return $this->pdo;

    }
}

 ?>
